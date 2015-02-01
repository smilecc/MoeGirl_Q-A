<?php
namespace Home\Model;
use Think\Model;

Class QuestionModel extends Model{
	// 创建或更新用户登录随机数
	public function add($data){
		$this->create($data);
		$this->add();
	}
}