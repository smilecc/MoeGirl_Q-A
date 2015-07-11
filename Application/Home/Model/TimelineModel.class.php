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

	// 获取首页的timeline内容
	public function get_index($page = 1,$username=false){
		if($username == false)
		{
			$follow_array = D('Follow')->get_follow();
		}else{
			$follow_array = array($username);
		}
		$search_data['username'] = array('in',$follow_array);
		trace($search_data);

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
		// 过滤、分类重复

		$arr_count = count($timeline_array);
		for($i = 0; $i < $arr_count; $i++){
			if(!array_key_exists($i,$timeline_array)) continue;
			$timeline_array[$i]['us_array'] = array($timeline_array[$i]['username']);
			// 如果是提交就跳过当前循环，因为Answer的提交和Question的提交常量是相同的
			if($timeline_array[$i]['status'] == 1) continue;
			for($j = $i + 1; $j < $arr_count; $j++){
				if(!array_key_exists($j,$timeline_array)) continue;
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
					unset($timeline_array[$j]);
				}
			}
		}
		// 重新整理序号 并返回
		return array_merge($timeline_array);
	}

	// 当问题添加回答
	public function question_add_answer($question_id,$answer_id){
		$data = array(
			'fromusername'	=>	cookie('username'),
			'question_id'	=>	$question_id,
			'answer_id'		=>	$answer_id,
			'type'			=>	1
			);
		$db = M('TimelineQuestion');
		$db->create($data);
		$db->add();
		// 将提示发送给用户
		tcp_new_info(M('QuestionUserStatus')->where('follow=1')->getField('username',true));
	}

	// 增加评论时
	public function question_add_comment($question_id,$answer_id,$tousername){
		$data = array(
			'fromusername'	=>	cookie('username'),
			'tousername'	=>	$tousername,
			'question_id'	=>	$question_id,
			'answer_id'		=>	$answer_id,
			'type'			=>	2
			);
		$db = M('TimelineQuestion');
		$db->create($data);
		if($db->add())
			tcp_new_info(array($tousername));
	}

	// @用户的入库
	public function AtUser($touser,$mode,$argData)
	{
		trace($argData);
		$data = array(
			'fromusername'	=>	cookie('username'),
			'tousername'	=>	$touser,
			'question_id' 	=>  $argData['question_id']
		);

		switch ($mode) {
			case 'question':
				$data['answer_id'] = 0;
				$data['type'] = 3;
				break;
			case 'answer':
				$data['answer_id'] = $argData['answer_id'];
				$data['type'] = 4;
				break;
			case 'comment':
				$data['answer_id'] = $argData['answer_id'];
				$data['type'] = 5;
				break;
			default:
				return false;
				break;
		}

		$db = M('TimelineQuestion');
		$db->create($data);
		if($db->add())
			tcp_new_info(array($touser));
	}

	// 获取Question相关的内容
	public function get_question($search_time = NULL){
		$follow_question_array = M('QuestionUserStatus')->where('username="%s" AND follow=1',cookie('username'))->getField('question_id',true);
		// 防止空查
		$follow_question_array['null'] = 0;
		trace($follow_question_array);
		// 两种情况：关注的问题、推送到用户名
		$search_data['question_id&type'] = array(array('in',$follow_question_array),1,'_multi'=>true);
		$search_data['tousername'] = cookie('username');
		$search_data['_logic'] = 'or';

		$get_arr = array();
		if($search_time == NULL) $get_arr = M('TimelineQuestion')->where($search_data)->order('id desc')->limit(200)->select();
		else{
			$new_search_data['_complex'] = $search_data;
			$get_arr = M('TimelineQuestion')->where($new_search_data)->where('%d < unix_timestamp(time)',$search_time)->order('id desc')->select();
			if(count($get_arr) == 0) $get_arr = array();
		}

		// 过滤、分类重复
		$arr_count = count($get_arr);
		for($i = 0; $i < $arr_count; $i++){
			if(!array_key_exists($i,$get_arr)) continue;
			$get_arr[$i]['us_array'] = array($get_arr[$i]['fromusername']);
			$get_arr[$i]['answer_array'] = array($get_arr[$i]['answer_id']);
			// 如果是提交就跳过当前循环，因为Answer的提交和Question的提交常量是相同的
			for($j = $i + 1; $j < $arr_count; $j++){
				if(!array_key_exists($j,$get_arr)) continue;
				// 判断状态、模式是否一致
				//trace($get_arr[$i]['question_id'] ."-". $get_arr[$j]['question_id'] ."-". $get_arr[$i]['type'] ."-". $get_arr[$j]['type']);
				if($get_arr[$j]['type'] == 3 || $get_arr[$j]['type'] == 4 || $get_arr[$j]['type'] == 5) continue;
				if($get_arr[$i]['question_id'] == $get_arr[$j]['question_id'] && $get_arr[$i]['type'] == $get_arr[$j]['type'])
				{
					// 过滤同一时间段重复push
					if($get_arr[$i]['fromusername'] == $get_arr[$j]['fromusername'])
					{
						unset($get_arr[$j]);
						continue;
					}
					array_push($get_arr[$i]['us_array'],$get_arr[$j]['fromusername']);
					array_push($get_arr[$i]['answer_array'],$get_arr[$j]['answer_id']);
					unset($get_arr[$j]);
				}else {
					//trace($get_arr[$i]['question_id'] ."-". $get_arr[$j]['question_id'] ."-". $get_arr[$i]['type'] ."-". $get_arr[$j]['type']);
					break;}
			}
		}
		if(count($get_arr) == 0) $get_arr = array();
		// 重新整理序号 并返回
		return array_merge($get_arr);
	}

	// 当follow用户时
	public function follow($tousername){
		$data = array(
			'fromusername'	=>	cookie('username'),
			'tousername'	=>	$tousername
			);
		$db = M('TimelineFollow');
		$is_find = $db->where($data)->count();
		if($is_find){
			$db->where($data)->delete();
		}else{
			$db->create($data);
			$db->add();
		}
		// 将提示发送给用户
		tcp_new_info(array($tousername));
	}

	public function get_follow($search_time = NULL){
		$result_arr = array();
		if($search_time == NULL) $result_arr = M('TimelineFollow')->where('tousername="%s"',cookie('username'))->order('id desc')->limit(30)->select();
		else $result_arr = M('TimelineFollow')->where('tousername="%s" AND %d < unix_timestamp(time)',cookie('username'),$search_time)->order('id desc')->select();
		return $result_arr;
	}

	// 当赞同问题时
	public function agree($answer_id){
		$tousername = M('Answer')->where('id=%d',$answer_id)->getField('username');
		$data = array(
			'fromusername'	=>	cookie('username'),
			'tousername'	=>	$tousername,
			'answer_id'		=>	$answer_id
			);
		$db = M('TimelineAgree');
		$is_find = $db->where($data)->count();
		if($is_find){
			$db->where($data)->delete();
		}else{
			$db->create($data);
			$db->add();
		}
		tcp_new_info(array($tousername));
	}

	public function get_agree($search_time = NULL){
		$get_arr = array();

		trace('debug');
		if($search_time == NULL) $get_arr = M('TimelineAgree')->where('tousername="%s"',cookie('username'))->order('id desc')->limit(200)->select();
		else {
			$get_arr = M('TimelineAgree')->where('tousername="%s" AND %d < unix_timestamp(time)',cookie('username'),$search_time)->order('id desc')->select();
			if(count($get_arr) == 0) $get_arr = array();
			
		}
		trace($get_arr);
		// 过滤、分类重复
		$arr_count = count($get_arr);
		for($i = 0; $i < $arr_count; $i++){
			if(!array_key_exists($i,$get_arr)) continue;
			$get_arr[$i]['us_array'] = array($get_arr[$i]['fromusername']);
			// 如果是提交就跳过当前循环，因为Answer的提交和Question的提交常量是相同的
			for($j = $i + 1; $j < $arr_count; $j++){
				if(!array_key_exists($j,$get_arr)) continue;
				// 判断状态、模式是否一致
				if($get_arr[$i]['answer_id'] == $get_arr[$j]['answer_id'])
				{
					// 过滤同一时间段重复push
					if($get_arr[$i]['fromusername'] == $get_arr[$j]['fromusername'])
					{
						unset($get_arr[$j]);
						continue;
					}
					array_push($get_arr[$i]['us_array'],$get_arr[$j]['fromusername']);
					unset($get_arr[$j]);
				}else break;
			}
		}
		if(count($get_arr) == 0) $get_arr = array();
		// 重新整理序号 并返回
		return array_merge($get_arr);
	}
}