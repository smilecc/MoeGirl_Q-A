<?php
namespace Home\Controller;
use Think\Controller;

Class QuestionController extends Controller{
	public function index(){
		
	}

	public function put_question($title,$content,$anonymous='off'){
		if(IS_POST){
			if(preg_match('/是哪部作品/', $title) && preg_match('/\{:(.+)!\}/U', $content,$reg_img)){
				$this->assign('imgurl','http://'.$_SERVER['SERVER_NAME'].'/Public/Uploads/'.$reg_img[1]);
				$this->display();
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