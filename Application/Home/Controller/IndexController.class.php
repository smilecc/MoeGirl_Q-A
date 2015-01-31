<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
    	//echo session('user_status');
    	$this->assign('username',cookie('username'));
        $this->display();
    }
}
