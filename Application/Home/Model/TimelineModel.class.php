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
		if($timeline_id != NULL){
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
		//trace($timeline_array);
		return $timeline_array;
	}
}