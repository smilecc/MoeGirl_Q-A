<?php
namespace Home\Model;
use Think\Model;

Class QuestionModel extends Model{
	// 创建新问题
	public function add_question($get_data){
		// 验证username
		if(!test_user()) return false;

		$get_data_topic_count = count($get_data['topic']);
		if(!$get_data['title'] || !$get_data_topic_count) return false;

		$data = array(
			'username' 	=> cookie('username'),
			'title'		=> $get_data['title'],
			'content'	=> $get_data['content'],
			'anonymous' => $get_data['anonymous'],
			);
		
		for($i = 1; $i <= $get_data_topic_count; $i++){
			$data['topic'.$i] = $get_data['topic'][$i-1];
		}

		$this->create($data);
		return($this->add());
	}
}