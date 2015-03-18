<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller {
    public function people($usname){
    	// 获取用户信息
    	$user_info = M('User')->where('username="%s"',$usname)->find();
    	$user_info['is_follow'] = is_follow(cookie('username'),$usname);
        trace($user_info);
    	// 计数
    	$user_info['question'] = M('Question')->where('username="%s"',$usname)->count();
    	$user_info['answer'] = M('Answer')->where('username="%s"',$usname)->count();
    	// 取得最近三个内容
    	$user_question = M('Question')->where('username="%s"',$usname)->order('id desc')->limit(3)->select();
    	$user_answer = M('Answer')->where('username="%s"',$usname)->order('id desc')->limit(3)->select();

    	$this->assign('question',$user_question);
    	$this->assign('answer',$user_answer);
    	$this->assign('user',$user_info);
        $this->display();
    }

    public function setting(){
        if(IS_POST){
            if(!test_user()){
                echo json_encode(array('result' => '登录失效'));
                return;
            }
            $data = array(
                'introduce_short' => I('i_short'),
                'introduce_long'  => I('i_long'),
                'weibo'           => I('weibo')
                );
            $result_arr = array();
            if(M('User')->where('username="%s"',cookie('username'))->save($data)) echo json_encode(array('result' => '已保存'));
            else echo json_encode(array('result' => '保存失败'));
        }else{
            $this->assign('user',M('User')->where('username="%s"',cookie('username'))->find());
            $this->display();
        }
    }

    public function follow($toname){
    	$result_temp = D('Follow')->follow($toname);
    	$result = array();
    	if($result_temp == -1) $result['error'] = '登录失效';
    	else {
            $result['relation'] = $result_temp;
            if(is_follow(cookie('username'),$toname,$result['relation'])) D('Timeline')->follow($toname);
        }
    	echo json_encode($result);
    }
}
