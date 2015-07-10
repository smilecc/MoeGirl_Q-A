<?php
namespace User\Model;
use Think\Model;

Class UserModel extends Model{
	// 创建或更新用户登录随机数
	public function login_random($username){
		$userinfo = $this->where('username="%s"',$username)->find();
		$data['random'] = rand();
		//$data['index'] = md5($username);
		trace(count($userinfo),'test');
		if(count($userinfo) == 0)
		{
			$data['username'] = $username;
			$this->create($data,Model::MODEL_INSERT);
			$this->add();
		}else{
			$this->where('username="%s"',$username)->save($data);
		}
		return $data['random'];
	}
	

	public function Login($username,$password)
	{
		if($username == '' || $password == '')
		{
			$resultArr = array(
			'status' => false,
			'json'	 => array('error'=>'存在未填项')
			);
			return $resultArr;
		}
		$userinfo = $this->where('username="%s"',$username)->find();
		$resultArr = array(
			'status' => false,
			'json'	 => array()
			 );

		if(count($userinfo) == 0)
		{
			$resultArr['json']['error'] = '用户不存在';
			return $resultArr;
		}

		// 校对密码
		if($userinfo['password'] == login_en_code($password))
		{
			$resultArr['status'] = true;
			$resultArr['username'] = $userinfo['username'];
			$resultArr['json']['info'] = 'Success';
		}
		else
		{
			$resultArr['json']['error'] = 'PasswordWrong:密码错误';
		}
		return $resultArr;
	}

	public function CreateUser($username,$password,$email)
	{

		if($username == '' || $password == '' || $email == '')
		{
			$jsonResult = array('error' => '存在未填项' );
			return $jsonResult;
		}

		// 一系列验证
		if(!preg_match('/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]{2,16}$/u',$username))
		{
			return $jsonResult = array('error' => '用户名不符合条件<br/>请输入字母、数字、下划线、中文汉字<br/>2-16个字符' );
		}


		if(!preg_match('/[\S]{6,128}/',$password))
		{
			return $jsonResult = array('error' => '密码不符合条件<br/>请输入6-128位密码' );
		}
		
		if(!preg_match('/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/',$email))
		{
			return $jsonResult = array('error' => 'Email不符合条件<br/>请输入正确的邮箱' );
		}

		// 检测用户存在情况
		$userinfo = $this->where('username="%s" OR email="%s"',$username,$email)->find();
		if(count($userinfo) > 0)
		{
			if($userinfo['username'] == $username) $jsonResult = array('error' => '用户已存在' );
			else $jsonResult = array('error' => 'Email已存在' );

			return $jsonResult;
		}
		// 入库
		$insertArray = array(
			'username'	=> $username,
			'password'	=> login_en_code($password),
			'email'		=> $email,
			'page'		=> md5($username)
		);
		
		$this->create($insertArray);
		$result = $this->add();

		// 返回数据
		$jsonResult = array('info' => '');
		if($result) $jsonResult['info'] = 'Success';
		else $jsonResult['error'] = 'SystemError';
		return $jsonResult;
	}

	public function ChangePassword($old,$new)
	{
		$resultArr = array(
			'status' => false
		 );
		if(!test_user())
		{
			$resultArr['error'] = '登录已失效';
			return $resultArr;
		}
		$userinfo = $this->where('username="%s"',cookie('username'))->find();

		if($userinfo['password'] != login_en_code($old))
		{
			$resultArr['error'] = '旧密码不对啦~';
			return $resultArr;
		}

		if(!preg_match('/[\S]{6,128}/',$new))
		{
			return $jsonResult = array('status' => false,'error' => '密码不符合条件<br/>请输入6-128位密码' );
		}

		$data = array(
			'username' 		=> cookie('username'),
			'password' 	=> login_en_code($new)
			);
		if($this->save($data))
		{
			$resultArr['status'] = true;
			$resultArr['info']	= '修改密码成功';
		}
		else
		{
			$resultArr['error']	= '修改密码失败，密码未变动或系统错误';
		}
		return $resultArr;
	}
}