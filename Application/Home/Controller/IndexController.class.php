<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
    	$auto_login = new \User\Api\UserApi;
    	$auto_login->autologin();
    	//echo session('user_status');
        $this->display();
    }
}
