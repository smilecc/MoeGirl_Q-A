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

	// 用户赞同、不赞同问题的接口
	// answer_id 为 回答id
	// agree 用于标记 赞同还是反对 1为赞同 2为反对
	public function agree($answer_id,$agree){
		if(!test_user()) return false;
		$answer_agree_db = M('AnswerAgree');
		// 查询记录集数据是否存在
		$answer_info = $answer_agree_db->where('answer_id=%d AND username="%s"',$answer_id,cookie('username'))->find();
		$data_answer_agree = array();

		// 若 不存在 与 存在
		if (count($answer_info) == 0) {
			if($agree == 1){
				$data_answer_agree['agree'] = array('exp','agree+1');
			}else if($agree == 2){
				$data_answer_agree['unagree'] = array('exp','unagree+1');
			}
			
			$data = array(
				'answer_id' => $answer_id,
				'username'	=> cookie('username'),
				'is_agree'	=> $agree
				);
			$answer_agree_db->create($data);
			$answer_agree_db->add();

			$this->where('id=%d',$answer_id)->save($data_answer_agree);
		} else {
			// 用户 取消赞同 或 赞同
			if ($answer_info['is_agree'] == $agree) {
				if($agree == 1){
					$data_answer_agree['agree'] = array('exp','agree-1');
				}else if($agree == 2){
					$data_answer_agree['unagree'] = array('exp','unagree-1');
				}
				// 删除Answer Agree记录集中的记录
				$this->where('id=%d',$answer_id)->save($data_answer_agree);
				$answer_agree_db->where('id=%d',$answer_info['id'])->delete();
			} else {
				if($agree == 1){
					$data_answer_agree['agree'] = array('exp','agree+1');
					$data_answer_agree['unagree'] = array('exp','unagree-1');
				}else if($agree == 2){
					$data_answer_agree['agree'] = array('exp','agree-1');
					$data_answer_agree['unagree'] = array('exp','unagree+1');
				}
				$this->where('id=%d',$answer_id)->save($data_answer_agree);
				$data = array(
					'id' 		=> $answer_info['id'],
					'is_agree'	=> $agree
					);
				$answer_agree_db->save($data);
			}
		}
		return $this->where('id=%d',$answer_id)->getField('agree');
	}
}