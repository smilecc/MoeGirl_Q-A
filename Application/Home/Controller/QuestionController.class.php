<?php
namespace Home\Controller;
use Think\Controller;

Class QuestionController extends Controller{
	public function index(){
		
	}

	public function put_question($title,$content,$anonymous){
		if(IS_POST){

		}
	}

	public function upload(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传目录
		// 上传单个文件 
		$info   =   $upload->uploadOne($_FILES['put-question-upload-input']);
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功 获取上传文件信息
			echo $info['savepath'].$info['savename'];
		}
	}


	private function cUrlGet($url,$cookie=''){
		$returnArray = array();
		$post_data = array ("action" 	=> "login",
							"lgname"	=> $user,
							"lgpassword"=> $pass,
							"lgtoken"	=> $token
							);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		// Cookie
		if($cookie != '') curl_setopt($ch, CURLOPT_COOKIE,$cookie);
		$output = curl_exec($ch);
		curl_close($ch); 
		// 解析数据
		preg_match('/Set-Cookie:(.*);/iU',$output ,$tmp_cookie);
		return $output;
 	}


	public function stu($imgurl){
		$content = $this->cUrlGet('http://stu.baidu.com/i?objurl='.urlencode($imgurl).'&filename=&rt=0&rn=10&ftn=extend.chrome.contextMenu&ct=1&stt=0&tn=shituresult&appid=4');
		// 提取
		preg_match('/&keyword=([\S]+)&img/',$content,$keyword);
		preg_match('/baikeTitle:\"([\S | \s]*)\",resultType/',$content,$baike_title);
		preg_match('/baikeText:\"([\S | \s]*)\",baikeTitle/',$content,$baike_content);
		preg_match('/baikeURL:\"([\S | \s]*)\",baikeText/',$content,$baike_url);
		if($keyword[1]){
			echo "<p>KeyWord：<strong>".urldecode($keyword[1]).'</strong></p>';
			echo '<p>百科猜测：<strong><a href="'.$baike_url[1].'">'.$baike_title[1].'</a></strong></p>';
			echo "<p>百科内容：<strong>".$baike_content[1].'</strong></p>';
		}else{
			echo "没有获取到相关内容";
		}
		$this->display();
	}
}