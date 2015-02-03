<?php
// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

// 用于加密内容
function login_en_code($string){
	return md5(md5($string));
}

// 用户是否登录 用于html - view中
function is_login(){
	if(session('user_status') == 1 || session('user_status') == 2) return true;
	else return false;
}

//  用于正则替换{:!}的图片标签
function img_replace($string){
    return preg_replace('/\{\:(.+)\!\}/U','<img src="/Public/Uploads/\1" />',$string);
}

function sub_question_content($string){
    $string = preg_replace('/\{\:(.+)\!\}/U','[图片]',$string);
    return mb_strcut($string,0,200,'utf8');
}

// 获取用户名的地址
function get_user_page($username){
    return '#';
}

// 测试用户是否真实
function test_user(){
    $cookie_username_token = login_en_code(M('UserLogin')->where('username="%s"',cookie('username'))->getField('random').cookie('username'));
    if(session('user_status') != 1 && cookie('token') != $cookie_username_token) return false;
    else return true;
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

?>