<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller {
    public function people($usname){
    	$user_info = M('User')->where('username="%s"',$usname)->find();
    	$this->assign('user',$user_info);
        $this->display();
    }
}
