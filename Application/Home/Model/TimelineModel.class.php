<?php
namespace Home\Model;
use Think\Model;

Class TimelineModel extends Model{

	// Question: 1 提交问题 2 关注问题 3 推送问题
	// Answer: 1 提交回答 2 赞同回答 3 推送回答
	public function push($mode,$project_id,$status){
		$data = array(
			'username'	=>	cookie('username'),
			'mode'		=>	$mode,
			'project_id'=>	$project_id,
			'status'	=>	$status
			);
		$timeline_id = $this->where($data)->getField('id');
		if($timeline_id != NULL AND $status != 3){
			$this->where('id=%d',$timeline_id)->delete();
		}else{
			$this->create($data);
			$this->add();
		}
	}

	public function get_index($page = 1){
		$follow_array = D('Follow')->get_follow();

		$search_data['username'] = array('in',$follow_array);
		$timeline_array = M('Timeline')->where($search_data)->order('id desc')->page($page,30)->select();
		
		foreach ($timeline_array as &$value) {
			if($value['mode'] == 1){
				$content = M('Question')->where('id=%d',$value['project_id'])->find();
				$value['content'] = $content;
			}else{
				$content = M('Answer')->where('id=%d',$value['project_id'])->find();
				$content['question_title'] = get_question_title($content['question_id']);
				$value['content'] = $content;
			}
		}
		
		for($i = 0; $i < count($timeline_array); $i++){
			if($timeline_array[$i] == NULL) continue;
			$timeline_array[$i]['us_array'] = array($timeline_array[$i]['username']);
			// 如果是提交就跳过当前循环，因为Answer的提交和Question的提交常量是相同的
			if($timeline_array[$i]['status'] == TIMELINE_ANSWER_SUBMIT) continue;
			for($j = $i + 1; $j < count($timeline_array); $j++){
				if($timeline_array[$j] == NULL) continue;
				// 判断状态、模式是否一致
				if($timeline_array[$i]['status'] == $timeline_array[$j]['status'] && $timeline_array[$i]['mode'] == $timeline_array[$j]['mode'])
				{
					// 过滤同一时间段重复push
					if($timeline_array[$i]['username'] == $timeline_array[$j]['username'])
					{
						unset($timeline_array[$j]);
						continue;
					}
					array_push($timeline_array[$i]['us_array'],$timeline_array[$j]['username']);
				}
			}
		}

		trace($timeline_array);
		// 重新整理序号
		ksort($timeline_array,SORT_NUMERIC);
		return $timeline_array;
	}
}