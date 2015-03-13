<?php
namespace User\Api;
use User\Model\UserModel;

class UserApi{
    /*
    初始化，实例化操作模型
    */
    protected $model;
    public function __construct(){
        $this->model = new UserModel();
    }

    //自动登录
    public function autologin(){
        if(session('user_status') == 2 || session('user_status') == 1){
            return true;
        }else{
            session('user_status',0);
            if(cookie('token') != NULL){
                $userinfo = M('User')->where('username="%s"',cookie('username'))->find();
                if(cookie('token') == login_en_code($userinfo['random'].$userinfo['username'])){
                    session('user_status',2);
                }
            }
        }
    }
    //用户登出
    public function logout(){
        session('user_status',NULL);
        cookie('token',NULL);
        cookie('username',NULL);
        cookie('userid',NULL);
    }

}
?>