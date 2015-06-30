<?php
namespace User\Model;
use Think\Model;

Class UserModel extends Model{
	// 创建或更新用户登录随机数
	public function login_random($username){
		$userinfo = $this->where('username="%s"',$username)->find();
		$data['random'] = rand();
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
			$resultArr['json']['info'] = 'Success';
		}
		else
		{
			$resultArr['json']['info'] = 'PasswordWrong';
		}
		return $resultArr;
	}

	public function CreateUser($username,$password,$email)
	{
		// 检测用户存在情况
		$userinfo = $this->where('username="%s"',$username)->find();
		if(count($userinfo) > 0)
		{
			$jsonResult = array('error' => '用户已存在' );
			return $jsonResult;
		}
		// 入库
		$insertArray = array(
			'username'	=> $username,
			'password'	=> login_en_code($password),
			'email'		=> $email
		);
		
		$this->create($insertArray);
		$result = $this->add();

		// 返回数据
		$jsonResult = array('info' => '');
		if($result) $jsonResult['info'] = 'Success';
		else $jsonResult['info'] = 'SystemError';
		return $jsonResult;
	}
}