<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function get_timeline($page = 1){
    	$test = D('Timeline')->get_index($page);
    	trace($test);
    	$this->assign('next_page',$page + 1);
    	$this->assign('timeline',$test);
    	//$this->assign('timeline',D('Timeline')->get_index($page));
        $this->display();
    }
}
