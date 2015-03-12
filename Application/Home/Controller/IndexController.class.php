<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
    	$this->assign('timeline',D('Timeline')->get_index());
        $this->display();
    }
}
