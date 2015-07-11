<?php
namespace Admin\Controller;
use Think\Controller;
class FindController extends Controller {
    public function index(){
    	$this->assign('findList',M('Find')->order('orderNumber')->select());
    	$this->assign('findCount',M('Find')->count());
    	$this->display();
    }

    public function AddItem($answer_id,$order)
    {
    	if(IS_POST)
    	{
    		echo json_encode(D('Find')->AddItem($answer_id,$order));
    	}
    }

    public function DeleteItem($id)
    {
    	if(IS_POST)
    	{
    		echo json_encode(D('Find')->DeleteItem($id));
    	}
    }

    public function EditItem($id,$answer_id,$order)
    {
    	if(IS_POST)
    	{
    		echo json_encode(D('Find')->EditItem($id,$answer_id,$order));
    	}
    }
}