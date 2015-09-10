<?php
// markdown解析器
include("Parsedown.php");
// 搜索索引
include("search.php");

// 权限编码到权限名称
function PemissionToName($id)
{
    switch ($id) {
        case 1:
            return '创始人';
            break;
        case 2:
            return '管理员';
        default:
            return '未知';
            break;
    }
}

function CheckAdmin()
{
    if(!test_user()) {
        return false;
    }
    $res = M('Admin')->where('username="%s"',cookie('username'))->find();
    if(count($res)) 
    {
        return $res['pemission'];
    }
    else return false;
}

// 数据模型操作时对权限的效验
function ModelOperationCheckAdmin()
{
    if(!CheckAdmin())
    {
        echo json_encode(array('status'=>false,'error'=>'非法闯入'));
        exit;
    }
}

// 获得用户index
function GetUserPage($username)
{   
    $page = M('User')->where('username="%s"',$username)->getField('page');
    if($page == null) return false;
    else return U('/Home/People/'.$page);
}

// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

// 用于加密内容
function login_en_code($password,$username=null){
    $redis = new Redis();
    $redis->connect("127.0.0.1","6379");

    if($username == null) $username = cookie('username');

    $salt = $redis->get($username.'_Salt');

    if($salt == false)
    {
        // Redis中无salt
        $salt = rand();
        $redis->set($username.'_Salt',$salt);
    }

	return md5(md5($string.$salt));
}

// 用户是否登录 用于html - view中
function is_login(){
	if(session('user_status') == 1 || session('user_status') == 2) return true;
	else return false;
}

//  用于正则替换{:!}的图片标签
function img_replace($string){
    return preg_replace('/\{\:(.+)\!\}/U','![Alt text](\1)"',$string);
}

function sub_question_content($string){
    $string = preg_replace('/!\[(.+)\)/U','[图片]',$string);
    return mb_strcut($string,0,200,'utf8');
}

// // 获取用户名的地址
// function GetUserPage
// GetUserPage($username){
//     return U('/Home/People/'.$username);
// }

function get_user_intro($username){
    return M('User')->where('username="%s"',$username)->getField('introduce_short');
}

// 测试用户是否真实
function test_user(){
    $cookie_username_token = DoubleMd5(M('User')->where('username="%s"',cookie('username'))->getField('random').cookie('username'));
    if(session('user_status') != 1 && cookie('token') != $cookie_username_token) return false;
    else return true;
}

function DoubleMd5($string)
{
    return md5(md5($string));
}

function get_inbox_alert(){
    $info = M('InboxAlert')->where('usname="%s"',cookie('username'))->find();
    if($info) return $info['numb'];
    return 0;
}

// use tcp send to user brower
function tcp_new_msg($usname,$numb){
    $client = stream_socket_client('tcp://127.0.0.1:7273');
    if(!$client) exit("can not connect");
    fwrite($client, '{"type":"new-msg","tousname":"'.$usname.'","numb":"'.$numb.'"}'."\n");
}

// use tcp send to user brower
function tcp_new_info($us_arr){
    $redis = new Redis();
    $redis->connect("127.0.0.1","6379");
    // 查询可用锁
    $unlock = 0;
    for ($unlock=0;; $unlock++) { 
        if(!$redis->get('info-lock-'.$unlock)) {
            // 加锁
            $redis->set('info-lock-'.$unlock,1);
            break;
        }
    }
    $redis->multi();
    // 保存发送用户集合
    foreach ($us_arr as $value) {
        $redis->sAdd('info-'.$unlock , $value);
    }
    $redis->exec();
    $client = stream_socket_client('tcp://127.0.0.1:7273');
    if(!$client)exit("can not connect");
    fwrite($client, '{"type":"new-info","lock":"'.$unlock.'"}'."\n");
}

// 获得问题的标题
function get_question_title($question_id){
    $question_info = M('Question')->where('id=%d',$question_id)->find();
    return $question_info['title'];
}

// 自动跳转的curl_exec
function curl_redir_exec($ch,$debug="") 
{
    static $curl_loops = 0; 
    static $curl_max_loops = 20; 

    if ($curl_loops++ >= $curl_max_loops) 
    { 
        $curl_loops = 0; 
        return FALSE; 
    } 
    curl_setopt($ch, CURLOPT_HEADER, true); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $data = curl_exec($ch);
    $debbbb = $data; 
    list($header, $data) = explode("\n\n", $data, 2); 
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 

    if ($http_code == 301 || $http_code == 302) { 
        $matches = array(); 
        preg_match('/Location:(.*?)\n/', $header, $matches); 
        $url = @parse_url(trim(array_pop($matches))); 
        //print_r($url); 
        if (!$url) 
        { 
            //couldn't process the url to redirect to 
            $curl_loops = 0; 
            return $data; 
        } 
        $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL)); 
    /*    if (!$url['scheme']) 
            $url['scheme'] = $last_url['scheme']; 
        if (!$url['host']) 
            $url['host'] = $last_url['host']; 
        if (!$url['path']) 
            $url['path'] = $last_url['path'];*/ 
        $new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . ($url['query']?'?'.$url['query']:''); 
        curl_setopt($ch, CURLOPT_URL, $new_url); 
    //    debug('Redirecting to', $new_url); 

        return curl_redir_exec($ch); 
    } else { 
        $curl_loops=0; 
        return $debbbb; 
    }
} 

// 解析Markdown文本
function ParseMd($text)
{
   return Parsedown::instance()
    ->setBreaksEnabled(true)
    ->setMarkupEscaped(true) # escapes markup (HTML)
    ->text($text);
}
// 解析Markdown文本 - 行模式
function ParseMdLine($text)
{
   return Parsedown::instance()
    ->setBreaksEnabled(true)
    ->setMarkupEscaped(true) # escapes markup (HTML)
    ->line($text);
}

function ParseAtUser($value)
{
    // 进行链接替换
    return $temp_value = preg_replace_callback(
            "/@([\S]+)\s{1}/",
            function ($matches) {
                // 查询用户是否存在
                if($res = GetUserPage($matches[1]))
                    return "[".$matches[0]."](".$res.")";
                // 不存在不替换内容
                else return $matches[0];
            },
            $value
        );
}

function PushAtUser($value,$mode,$data)
{
    preg_match_all("/@([\S]+)\s{1}/", $value, $macthArr);

    foreach ($macthArr[1] as $value) {
        // 查询用户是否存在
        if(GetUserPage($value))
            D('Timeline')->AtUser($value,$mode,$data);
    }
    
    return $temp_value;
}

?>