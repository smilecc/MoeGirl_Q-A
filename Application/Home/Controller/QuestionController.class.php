<?php
namespace Home\Controller;
use Think\Controller;

Class QuestionController extends Controller{
	public function index($qid,$aid=0){
		$page_content = M('Question')->where('id=%d',$qid)->find();
		$page_content['content'] = sub_question_content($page_content['content']);


		$page_user_status = M('QuestionUserStatus')->where('username="%s" AND question_id=%d',cookie('username'),$qid)->find();
		trace($page_user_status);

		$this->assign('page_user_status',$page_user_status);
		$this->assign('page',$page_content);
		$this->display();
	}

	public function get_question_content($qid){
		$page_content = M('Question')->where('id=%d',$qid)->getField('content');
		$page_content = img_replace(nl2br($page_content));
		echo $page_content;
	}

	public function put_question($title,$content,$topic,$anonymous='off'){
		if(IS_POST){
			//print_r(I('post.put-question-topic'));
			//return;
			$data = array(
				'title' 	=> $title,
				'content' 	=> $content,
				'topic'		=> $topic,
				'anonymous' => ($anonymous=='off') ? 0 : 1,
				);
			$result_id = D('Question')->add_question($data);
			if($result_id){
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php/Home/Question/'.$result_id);
			}else{
				$this->error('发布失败，请退出后重新登录');	
			}
		}
	}

	public function upload(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传目录
		// 上传单个文件 
		$info   =   $upload->uploadOne($_FILES['put-question-upload-input']);
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功 获取上传文件信息
			echo $info['savepath'].$info['savename'];
		}
	}


	public function stu($imgurl){
		$this->assign('imgurl',$imgurl);
		$this->display();
	}

	public function set_question_user_status($question_id,$follow,$anonymous){
		if(!test_user()) echo '用户登录失效，请检查';

		$data = array(
			'username' 		=> cookie('username'),
			'question_id'	=> $question_id,
			'follow'		=> (($follow != 0) ? 1 : 0),
			'anonymous'		=> (($anonymous != 0) ? 1 : 0)
			);

		$db = M('QuestionUserStatus');
		$db_count = $db->where('username="%s" AND question_id=%d',cookie('username'),$question_id)->count();
		$db->data($data);
		if($db_count){
			$db->save();
		}else{
			$db->add();
		}

	}
}