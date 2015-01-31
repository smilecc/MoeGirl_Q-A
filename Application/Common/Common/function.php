<?php
// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

// 用于加密内容
function login_en_code($string){
	return md5(md5($string));
}

// 用户是否登录 用于html - view中
function is_login(){
	if(session('user_status') == 1 || session('user_status') == 2) return true;
	else return false;
}
?>