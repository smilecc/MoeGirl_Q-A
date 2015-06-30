<?php
namespace User\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index($from = 'NULL'){
    	$this->assign('from',$from);
        $this->display();
    }

    public function register()
    {
    	$this->display();
    }
}