<?php
namespace Home\Controller;
use Think\Controller;

class InboxController extends Controller {
  public function index(){
    if(IS_POST){
        if(I('type')=='send'){
          trace($_POST,'post_data');
          if(D('Inbox')->send(I('toname'),I('content'))){
            echo '发送成功';
          }else{
            echo '发送失败';
          }
        }
    }else{
        D('InboxAlert')->clean();
        $usname = cookie('username');
        $inbox_index = M('InboxIndex')->where('usname1="%s" or usname2="%s"',$usname,$usname)->order('unix_timestamp(time) desc')->select();
        trace($inbox_index);

        $this->assign('inbox_index',$inbox_index);
        $this->display();
      }
  }

  public function inboxpage($usname){
    if(IS_POST){

    }else{
      if(!test_user()) $this->error("登录错误");

      $usname1 = cookie('username');
      $usname2 = $usname;
      gtusname($usname1,$usname2);
      $inboxpage_con = M('Inbox')->where('usname1="%s" AND usname2="%s"',$usname1,$usname2)->order('id desc')->select();

      $this->assign('toname',$usname);
      $this->assign('inboxpage_con',$inboxpage_con);
      $this->display();
    }
  }
}