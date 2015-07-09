<?php
namespace User\Controller;
use Think\Controller;
Class OperationController extends Controller{
  	public function index(){
    	$this->error('illegal operation');
 	}

 	private function cUrlLogin($user, $pass, $token='',$cookie=''){
 		$url = "http://zh.moegirl.org/api.php?format=xml";
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
		// post数据
		if($cookie != '') curl_setopt($ch, CURLOPT_COOKIE,$cookie);
		curl_setopt($ch, CURLOPT_POST, 1);
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch); 
		// 解析数据
		$resultArray = array();
		preg_match('/<\?xml([\S\s]*)api>/',$output ,$outXML);
		preg_match('/Set-Cookie:(.*);/iU',$output ,$tmp_cookie);
		$resultArray['cookie'] = $tmp_cookie[1];
		$xml = simplexml_load_string($outXML[0]);
		$resultArray['token'] = (string)$xml->login['token'];
		$resultArray['result'] = (string)$xml->login['result'];
		if($cookie == '')return $resultArray;
		else return $xml;
 	}
	
 	public function login($user, $pass, $remember_me){
 		if(IS_POST)
 		{
			//$resultArray = $this->cUrlLogin($user,$pass);
			//$resultXML = $this->cUrlLogin($user,$pass,$resultArray['token'],$resultArray['cookie']);
			//print_r($resultXML);
			/*
			if('Success' == (string)$resultXML->login['result'])
			{
				// Set cookie value
				if($remember_me == 'on') cookie('token',login_en_code(D('User')->login_random((string)$resultXML->login['lgusername']).(string)$resultXML->login['lgusername']));
				cookie('username',$resultXML->login['lgusername']);
				//cookie('userid',$resultXML->login['lguserid']);

				// Set session
				/// user_status 是用户登录的标识
				/// 0 is no Login
				/// 1 is password Login
				/// 2 is cookies Login
				session('user_status',1);
			}
			echo $resultXML->login['result'];
			*/

			// 后改：自行注册
			$resultArr = D('User')->Login($user, $pass);
			if($resultArr['status'])
			{
				// Set cookie value
				if($remember_me == 'on') cookie('token',login_en_code(D('User')->login_random($user).$user));
				cookie('username',$user);

				// Set session
				/// user_status 是用户登录的标识
				/// 0 is no Login
				/// 1 is password Login
				/// 2 is cookies Login
				session('user_status',1);
			}
			echo json_encode($resultArr['json']);
		}
	}

	public function register($username,$password,$email)
	{
		if(IS_POST)
		{
			$resArr = D('User')->CreateUser($username,$password,$email);
			
			// 注册后立即登录
			if($resArr['info'] == 'Success')
			{
				cookie('token',login_en_code(D('User')->login_random($username).$username));
				cookie('username',$username);
				session('user_status',1);
			}
			echo json_encode($resArr);
		}
	}

	public function logout(){
		$user_api = new \User\Api\UserApi();
		$user_api->logout();
		echo 1;
	}

	public function ChangePassword($oldpw,$newpw)
    {
    	if(IS_POST)
    	{
    		echo json_encode(D('User')->ChangePassword($oldpw,$newpw));
    	}
    }
}