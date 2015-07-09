<?php
namespace Home\Controller;
use Think\Controller;

class TopicController extends Controller {
	public function index(){
		$topic_arr = M('TopicFollow')->where('username="%s"',cookie('username'))->select();
		$this->assign('topic',$topic_arr);
		$this->display();
	}

	public function topic($tid,$mode='near',$page=1){
		
		//print_r($page_content);
		$topic_content = M('Topic')->where("id=%d",$tid)->find();
		$topic_content['is_follow'] = M('TopicFollow')->where('username="%s" AND topic_id=%d',cookie('username'),$tid)->count();
		$topic_content['follow_count'] = M('TopicFollow')->where('topic_id=%d',$tid)->count();
		$topic_content['question_count'] = M('Question')->where('topic1=%d OR topic2=%d OR topic3=%d',$tid,$tid,$tid)->count();


		//print_r($page_content);
		$this->assign('tid',$tid);
		$this->assign('mode',$mode);
		$this->assign('topic',$topic_content);
		$this->display();
	}

	public function tlist(){
		//$topic_list = M('Topic')->order('id')->select();
		$count = M('Topic')->count();
		$nodeArr = M('Node')->select();
		
		$panel_class = array('primary','secondary','success','warning','danger');
		for($i=0;$i<count($nodeArr);$i++)
		{
			$nodeArr[$i]['class'] = $panel_class[$i];
			$nodeArr[$i]['value'] = M('Topic')->where('node=%d',($i+1))->select();
		}

		$this->assign('node',$nodeArr);
		$this->assign('count',$count);
		$this->display();
	}

	public function getcontent($tid,$mode='near',$page=1){
		$page_content = D('Topic')->search_question($tid,$page,$mode);
		$this->assign('tid',$tid);
		$this->assign('mode',$mode);
		$this->assign('content',$page_content);
		$this->assign('next_page',$page + 1);
		$this->display();
	}

	public function set_follow_topic($topic_id){
		$resultJson = array();
		if(!test_user()){
			$resultJson['error'] = '用户登录失效，请检查';
			$resultJson['status'] = 0;
			echo json_encode($resultJson);
			return;
		}

		$db = M('TopicFollow');
		$db_count = $db->where('username="%s" AND topic_id=%d',cookie('username'),$topic_id)->count();
		if($db_count){
			$db->where('username="%s" AND topic_id=%d',cookie('username'),$topic_id)->delete();
			$resultJson['info'] = '取消关注成功';
		}else{
			$data = array(
				'username' 	=> cookie('username'),
				'topic_id'	=> $topic_id
			);
			$db->data($data);
			$db->add();
			$resultJson['info'] = '关注成功';
		}
		$resultJson['status'] = 1;
		echo json_encode($resultJson);
	}

	public function tcreate($name,$introduce,$node,$father_topic = 0){
		if($name=='' || $introduce=='')
		{
			exit(json_encode(array('status'=>0,'error'=>'数据不完整')));
		}
		$id = D('Topic')->tcreate($name,$introduce,$node,$father_topic);
		echo(json_encode(array('status'=>($id?1:0),'topic_id'=>$id,'error'=>($id?'NULL':'存在重名或系统错误'))));
	}
}