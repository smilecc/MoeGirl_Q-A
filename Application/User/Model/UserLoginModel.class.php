<?php
namespace User\Model;
use Think\Model;

Class UserLoginModel extends Model{
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
}