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

    public function get_question(){
        $this->assign('timeline',D('Timeline')->get_question());
        $this->display();
    }

    public function get_follow(){
        $follow_array = D('Timeline')->get_follow();
        foreach ($follow_array as &$value) {
            $value['is_follow'] = is_follow(cookie('username'),$value['fromusername']);
        }
        $this->assign('timeline',$follow_array);
        $this->display();
    }

    public function get_agree(){
        $agree_array = D('Timeline')->get_agree();
        foreach ($agree_array as &$value) {
            $value['question_id'] = M('Answer')->where('id=%d',$value['answer_id'])->getField('question_id');
        }
        $this->assign('timeline',$agree_array);
        $this->display();
    }

    public function update_time(){
        D('TimelineTime')->update_time();
    }

    public function getinfo(){
        $info_arr = D('TimelineTime')->get_unread();
        echo json_encode($info_arr);
    }
}
