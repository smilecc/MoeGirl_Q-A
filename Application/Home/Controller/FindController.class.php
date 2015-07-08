<?php
namespace Home\Controller;
use Think\Controller;

class FindController extends Controller {
    public function index(){
    	$findTable = M('Find')->order('orderNumber')->select();
    	foreach ($findTable as &$value) {
    		$res = M('Answer')->where('id=%d',$value['answer_id'])->find();
    		$value['time'] = $res['time'];
    		$value['agree'] = $res['agree'];
    	}

    	$this->assign('find_table',$findTable);
        $this->display();
    }

    public function day()
    {
    	$find_db = D('Answer');
    	$find_24 = $find_db->getFind(24);
    	$this->assign('find_24',$find_24);
    	$this->display();
    }

    public function month()
    {
    	$find_db = D('Answer');
    	$find_30 = $find_db->getFind(30);
    	$this->assign('find_30',$find_30);
    	$this->display();
    }
}
