<?php
namespace Home\Model;
use Think\Model;

class InboxModel extends Model{
	public function send($toname,$content){
		if(!$toname or !$content) return false;
		if(!test_user()) return false;

		$usname1 = cookie('username');
		$usname2 = $toname;
		$touid = $usname2;
		if(!$usname2) return false;
		
		/*
		注解：
		判断信息是由哪方发送
		gtusname是一个usname1是否大于usname2的全局函数，如果大于则颠倒两变量的值 返回 true，不大于则 无操作 返回 false
		由于在调用本方法的时候，usname1总是发件人，usname2总是收件人。
		如果通过gtusname()颠倒后，所以发件人变为usname2，所以赋值变量from为2
		*/
		if(gtusname($usname1,$usname2)) $from = 2;
		else $from = 1;
		$data = array(
				'usname1'	=> $usname1,
				'usname2'   => $usname2,
				'from'  	=> $from,
				'content'	=> htmlspecialchars($content)
				);
		if($this->create($data)){
			$inbox_id = $this->add();
			if(!$inbox_id) return false;
			if(!D('InboxAlert')->new_send($touid)) return false;
			if(D('InboxIndex')->new_send($usname1,$usname2,$inbox_id,$from)) return true;
			else return false;
		}else{
			return false;
		}

	}
}

?>