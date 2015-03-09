<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
    	D('Timeline')->get_index();
        $this->display();
    }
}
