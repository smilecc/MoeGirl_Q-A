<?php
namespace Home\Model;
use Think\Model;

class TimelineTimeModel extends Model{
	public function update_time(){
		$data = array(
			'username'	=>	cookie('username')
			);
		$db = M('TimelineTime');
		$is_find = $db->where($data)->getField('id');
		if($is_find){
			$data['id']	= $is_find;
			$data['temp'] = array('exp','temp+1');
			$this->data($data)->save();
		}else{
			$data['temp'] = 0;
			$db->create($data);
			$db->add();
		}
	}

	public function get_unread(){
		$result_arr = array();
		$time = $this->where('username="%s"',cookie('username'))->getField("unix_timestamp(time)");
		$timeline_db = D('Timeline');
		$question_arr = $timeline_db->get_question($time);
		$follow_arr = $timeline_db->get_follow($time);
		$agree_arr = $timeline_db->get_agree($time);

		$result_arr['question'] = count($question_arr);
		$result_arr['follow'] = count($follow_arr);
		$result_arr['agree'] = count($agree_arr);
		$result_arr['sum'] = $result_arr['question'] + $result_arr['follow'] + $result_arr['agree'];

		trace($result_arr);
		return $result_arr;
	}
}

?>