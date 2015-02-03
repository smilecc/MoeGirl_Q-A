<?php
namespace Home\Controller;
use Think\Controller;

class TopicController extends Controller {
	public function index(){
		$this->display();
	}

	public function topic($tid,$mode='near',$page=1){
		echo $mode;
		$topic_content['answer_array'] = D('Topic')->search_question($tid,$page,$mode);
		print_r($topic_content['answer_array']);
		$topic_content = M('Topic')->where("id=%d",$tid)->find();
		$topic_content['is_follow'] = M('TopicFollow')->where('username="%s" AND topic_id=%d',cookie('username'),$tid)->count();
		$topic_content['follow_count'] = M('TopicFollow')->where('topic_id=%d',$tid)->count();
		$topic_content['question_count'] = M('Question')->where('topic1=%d OR topic2=%d OR topic3=%d',$tid,$tid,$tid)->count();


		//print_r($topic_content);
		$this->assign('topic',$topic_content);
		$this->display();
	}

	public function set_follow_topic($topic_id){
		if(!test_user()) echo '用户登录失效，请检查';

		$db = M('TopicFollow');
		$db_count = $db->where('username="%s" AND topic_id=%d',cookie('username'),$topic_id)->count();
		if($db_count){
			$db->where('username="%s" AND topic_id=%d',cookie('username'),$topic_id)->delete();
		}else{
			$data = array(
				'username' 	=> cookie('username'),
				'topic_id'	=> $topic_id
			);
			$db->data($data);
			$db->add();
		}

	}
}