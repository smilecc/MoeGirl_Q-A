<?php
namespace Home\Model;
use Think\Model;

Class TopicModel extends Model{
	public function search_question($tid,$page=1,$mode='near'){
		$sub_topic = array();
		$sub_topic = $this->where('father_topic=%d',$tid)->getField('id',true);
		// 判断一下上面的数组是不是空的
		if(count($sub_topic) == 0) $sub_topic = array($tid);
		else array_push($sub_topic, $tid);

		trace($sub_topic);

		// 装载查询条件
		$search_data['topic1|topic2|topic3'] = array('in',$sub_topic);

		if($mode == 'near'){
			// 最近30天
			$question_array = M('Question')->where($search_data)->where('%d < unix_timestamp(time)',(time() - 2592000))->order('id')->page($page,20)->select();
			foreach ($question_array as &$value) {
				$value['answer_content'] = M('Answer')->where('question_id=%d',$value['id'])->order('agree - unagree desc')->find();
			}
			trace($question_array);
			return $question_array;
		}else if($mode == 'hot'){
			// 精华
			$question_array = M('Question')->where($search_data)->order('id desc')->getField('id',true);
			$search_condition['question_id'] = array('in',$question_array);
			return M('Answer')->where($search_condition)->order('agree - unagree desc')->page($page,20)->select();
		}else if($mode == 'all'){
			// 全部
			return M('Question')->where($search_data)->order('id desc')->page($page,20)->select();
		}
		
	}

	public function tcreate($name,$introduce,$father_topic){
		if(!test_user()) return false;
		if($this->where('name="%s"',$name)->count()) return false;
		$data = array(
			'creater'		=>	cookie('username'),
			'name'			=>	htmlspecialchars($name),
			'introduce'		=>	htmlspecialchars($introduce),
			'father_topic'	=>	$father_topic
			);
		$this->create($data);
		return $this->add();
	}

}