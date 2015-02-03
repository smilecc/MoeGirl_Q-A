<?php
namespace Home\Model;
use Think\Model;

class InboxAlertModel extends Model{
	public function new_send($usname){
		$find_usname = $this->where('usname="%s"',$usname)->getField('usname');
		$data = array(
				'usname'	=> $usname,
				'numb'		=> array('exp','numb+1')
				);
		//判断$find_usname是否存在 存在修改 不存在添加
		if($find_usname){
			$this->where('usname="%s"',$usname)->create($data);
			if($this->save()) return true;
			else return false;
		}else{
			$this->create($data);
			if($this->add()) return true;
			else return false;
		}

	}

	public function clean(){
		if(!test_user()) return false;
		$usname = cookie('username');
		$find_usname = $this->where('usname="%s"',$usname)->getField('usname');
		$data = array(
				'usname'	=> $usname,
				'numb'		=> 0
				);
		if($find_usname){
			$this->where('usname=%d',$usname)->create($data);
			if($this->save()) return true;
			else return false;
		}else{
			return true;
		}

	}
}

?>