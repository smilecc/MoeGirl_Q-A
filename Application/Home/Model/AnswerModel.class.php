<?php
namespace Home\Model;
use Think\Model;

Class AnswerModel extends Model{
	// 创建新答案
	public function add_answer($get_data){
		// 验证username
		//$cookie_username_token = login_en_code(M('UserLogin')->where('username="%s"',cookie('username'))->getField('random').cookie('username'));
		//if(session('user_status') != 1 && cookie('token') != $cookie_username_token) return false;
		if(!test_user()) return false;
		if(!$get_data['content'] || !$get_data['question_id']) return false;
		
		if($this->where('username="%s" AND question_id=%d',cookie('username'),$get_data['question_id'])->count()) return false;

		$data = array(
			'username' 	=> cookie('username'),
			'content'	=> $get_data['content'],
			'question_id' => $get_data['question_id'],
			);


		$this->create($data);
		return($this->add());
	}
}