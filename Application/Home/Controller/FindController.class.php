<?php
namespace Home\Controller;
use Think\Controller;

class FindController extends Controller {
    public function index(){
    	$find_db = D('Answer');
    	$find_24 = $find_db->getFind(24);
    	$find_30 = $find_db->getFind(30);

    	$this->assign('find_24',$find_24);
    	$this->assign('find_30',$find_30);
        $this->display();
    }
}
