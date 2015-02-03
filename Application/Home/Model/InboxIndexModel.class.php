<?php
namespace Home\Model;
use Think\Model;

class InboxIndexModel extends Model{
	public function new_send($usname1,$usname2,$inbox_id,$from){
		$index_id = $this->where('usname1="%s" AND usname2="%s"',$usname1,$usname2)->getField('id');
		$data = array(
				'usname1'	=> $usname1,
				'usname2'   => $usname2,
				'from'		=> $from,
				'inbox_id'  => $inbox_id,
				'numb'		=> array('exp','numb+1')
				);
		//判断index_id是否存在 存在修改 不存在添加
		if($index_id){
			$this->where('id=%d',$index_id)->create($data);
			if($this->save()) return true;
			else return false;
		}else{
			$this->create($data);
			if($this->add()) return true;
			else return false;
		}

	}
}

?>