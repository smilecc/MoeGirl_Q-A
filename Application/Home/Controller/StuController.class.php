<?php
namespace Home\Controller;
use Think\Controller;
header('Content-type: text/json');

Class StuController extends Controller{
	private function cUrlGet($url,$cookie=''){
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
		//preg_match('/Set-Cookie:(.*);/iU',$output ,$tmp_cookie);
		return $output;
 	}


	public function index($imgurl){
		$content = $this->cUrlGet('http://stu.baidu.com/i?objurl='.urlencode($imgurl).'&filename=&rt=0&rn=10&ftn=extend.chrome.contextMenu&ct=1&stt=0&tn=shituresult&appid=4');
		// 提取
		preg_match('/&keyword=([\S]+)&img/',$content,$baike['keyword']);
		preg_match('/baikeTitle:\"([\S | \s]*)\",resultType/',$content,$baike['title']);
		preg_match('/baikeText:\"([\S | \s]*)\",baikeTitle/',$content,$baike['content']);
		preg_match('/baikeURL:\"([\S | \s]*)\",baikeText/',$content,$baike['url']);

		$baike_string = array(
			'keyword' => urldecode($baike['keyword'][1]),
			'title' => $baike['title'][1],
			'content' => $baike['content'][1],
			'url' => $baike['url'][1]
		 );

		//echo htmlspecialchars($content);
		if($baike['keyword'][1]){
			echo json_encode($baike_string);
		}else{
			echo json_encode(array('title' => "没有获取到相关内容"));
		}
	}
}