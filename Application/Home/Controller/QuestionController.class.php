<?php
namespace Home\Controller;
use Think\Controller;

Class QuestionController extends Controller{
	public function index($qid,$aid=0){
		// 问题内容查询
		$page_content = M('Question')->where('id=%d',$qid)->find();
		// 截取问题的内容
		$page_content['content'] = sub_question_content($page_content['content']);
		// 获得答案的数量
		$page_content['answer'] = M('Answer')->where('question_id=%d',$qid)->count();

		// 获得当前用户的匿名、关注状态
		$page_user_status = M('QuestionUserStatus')->where('username="%s" AND question_id=%d',cookie('username'),$qid)->find();
		// 获得我的答案
		$page_content['my_answer'] = M('Answer')->where('username="%s" AND question_id=%d',cookie('username'),$qid)->find();

		// 分发内容
		$page_answer = array();
		if($aid == 0){
			$page_answer = M('Answer')->where('question_id=%d',$qid)->select();
		}else{
			$page_answer = M('Answer')->where('id=%d',$aid)->find();
		}

		$this->assign('answer',$page_answer);
		$this->assign('page_user_status',$page_user_status);
		$this->assign('page',$page_content);
		$this->display();
	}

	// 获取问题内容
	public function get_question_content($qid){
		$page_content = M('Question')->where('id=%d',$qid)->getField('content');
		$page_content = img_replace(nl2br($page_content));
		echo $page_content;
	}

	// 提交问题
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

	// 提交答案
	public function put_answer($question_id,$content){
		if(IS_POST){
			//print_r(I('post.put-question-topic'));
			//return;
			$data = array(
				'question_id' 	=> $question_id,
				'content' 	=> $content,
				);
			$result_id = D('Answer')->add_answer($data);
			if($result_id){
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php/Home/Question/'.$question_id.'/answer/'.$result_id);
			}else{
				$this->error('发布失败，请退出后重新登录');	
			}
		}
	}

	// 图片的上传
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


	// 识图页面
	public function stu($imgurl){
		$this->assign('imgurl',$imgurl);
		$this->display();
	}

	// 设置用户对答案的状态（关注、匿名）
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