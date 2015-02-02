<?php
namespace Home\Controller;
use Think\Controller;

Class QuestionController extends Controller{
	public function index($qid,$aid=0){
		$page_content = M('Question')->where('id=%d',$qid)->find();
		$page_content['content'] = sub_question_content($page_content['content']);
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
				$this->error('发布失败，未知错误');	
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
}