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
			$page_answer = M('Answer')->where('question_id=%d',$qid)->order('agree - unagree desc')->select();
		}else{
			// 指定多答案模式
			if(strstr($aid, "|"))
			{
				$aidArr = explode("|",$aid);
				$search_data['id'] = array('in',$aidArr);
				$page_answer = M('Answer')->where($search_data)->select();

			}
			else
			{
				// 单答案模式
				$page_answer[0] = M('Answer')->where('id=%d',$aid)->find();
			}
		}

		//print_r($page_answer);
		//print_r($page_content);
		$this->assign('answer',$page_answer);
		$this->assign('page_user_status',$page_user_status);
		$this->assign('page',$page_content);
		$this->display();
	}

	// 获取问题内容
	public function get_question_content($qid){
		$page_content = M('Question')->where('id=%d',$qid)->getField('content');
		$page_content = ParseMd($page_content);
		echo $page_content;
	}

	// 提交评论
	public function put_comment($id,$content,$mode,$touser = ''){
		if(!test_user()) {echo json_encode(array('status'=>false,'error'=>'系统错误'));return false;}
		if(!IS_POST) {echo json_encode(array('status'=>false,'error'=>'非法提交方式'));return false;}

		$data = array(
			'username'	=> cookie('username'),
			'project_id'=> $id,
			'content'	=> htmlspecialchars(ParseAtUser($content)),
			'mode'		=> (($mode == 'question')? 0 : 1),
			'tousername'=> $touser
			);
		$Comment_db = M('Comment');
		$Comment_db->create($data);
		if($re_id = $Comment_db->add()) {
			echo json_encode(array('status'=>true,'info'=>'评论发布成功'));

		PushAtUser($content,'comment',
					array(
						'question_id' 	=> M('Answer')->where('id=%d',$id)->getField('question_id'),
						'answer_id'		=> $id, // 目前认为只有评论答案的这一种模式
						)
					);
				
			if($data['mode'])
			{
				$answer_info = M('Answer')->where('id=%d',$id)->find();
				D('Timeline')->question_add_comment($answer_info['question_id'],$id,$answer_info['username']);
			}
			
		}
		else echo json_decode(array('status'=>false,'error'=>'系统错误'));
	}

	// 获取评论
	public function get_comment($id,$mode){
		$comment = M('Comment')->where('project_id=%d AND mode=%d',$id,(($mode == 'question')? 0 : 1))->order('id')->select();
		$this->assign('mode',$mode);
		$this->assign('project_id',$id);
		$this->assign('comment',$comment);
		$this->display();	
	}

	// 提交问题
	public function put_question($title,$content,$topic,$anonymous='off'){
		if(IS_POST){
			//print_r(I('post.put-question-topic'));
			//return;
			$data = array(
				'title' 	=> $title,
				'content' 	=> ParseAtUser($content),
				'topic'		=> $topic,
				'anonymous' => ($anonymous=='off') ? 0 : 1,
				);
			$result_id = D('Question')->add_question($data);
			if($result_id){
				PushAtUser($content,'question',
						array(
								'question_id' => $result_id,
								'answer_id'	  => 0
							)
					);
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
				'content' 	=> ParseAtUser($content),
				);
			$result_id = D('Answer')->add_answer($data);
			if($result_id){
				PushAtUser($content,'answer',
						array(
								'question_id' => $question_id,
								'answer_id'	  => $result_id
							)
					);

				D('Timeline')->question_add_answer($question_id,$result_id);
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

	// 赞同、不赞同接口
	public function agree($answer_id,$agree){
		if(true){ // IS_POST
			if ($agree != 1 && $agree != 2) {
				echo -1;
				return;
			}else if(cookie('username') == M('Answer')->where('id=%d',$answer_id)->getField('username')){
				echo -2;
				return;
			}else{
				echo D('Answer')->agree($answer_id,$agree);
				if($agree == 1)
					D('Timeline')->agree($answer_id);
			}
		}
	}


	// 设置用户对答案的状态（关注、匿名）
	public function set_question_user_status($question_id,$follow,$anonymous){
		if(!test_user()) {echo '用户登录失效，请检查';return false;}

		$data = array(
			'username' 		=> cookie('username'),
			'question_id'	=> $question_id,
			'follow'		=> (($follow != 0) ? 1 : 0),
			'anonymous'		=> (($anonymous != 0) ? 1 : 0)
			);

		$db = M('QuestionUserStatus');
		$db_id = $db->where('username="%s" AND question_id=%d',cookie('username'),$question_id)->getField('id');
		$db->data($data);
		if($db_id){
			$db->where('id=%d',$db_id)->save();
		}else{
			$db->add();
		}
		D('Timeline')->push(1,$question_id,2);
	}

	// 推送给关注我的人
	public function push2timeline($mode,$project_id){
		if($mode == 1){
			D('Timeline')->push(1,$project_id,3);
		}else{
			D('Timeline')->push(2,$project_id,3);
		}
	}
}