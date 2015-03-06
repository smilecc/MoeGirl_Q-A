<?php
namespace Home\Model;
use Think\Model;

Class FollowModel extends Model{
	public function follow($to_user){
		// 验证username
		if(!test_user()) return -1;
		$from_user = cookie('username');
		// 默认状态 1 > 2
		$us_1 = $from_user;
		$us_2 = $to_user;
		// 初始化姓名顺序
		itusname($us_1,$us_2);
		$data = array(
					'us1' 		=> $us_1,
					'us2' 		=> $us_2
				);
		// 获取关系信息
		$info = $this->where('us1 = "%s" AND us2="%s"',$us_1,$us_2)->find();
		// 判断关系逻辑
		if(count($info) == 0 || $info['relation'] == 0){
			if($us_1 == $from_user){
				$data['relation'] = 1;
				$this->add_relation($us_1,$us_2);
			}else{
				$data['relation'] = 2;
				$this->add_relation($us_2,$us_1);
			}
		}else if($info['relation'] == 1){
			if($us_1 == $from_user){
				$data['relation'] = 0;
				$this->remove_relation($us_1,$us_2);
			}else{
				$data['relation'] = 3;
				$this->add_relation($us_2,$us_1);
			}
		}else if($info['relation'] == 2){
			if($us_1 == $from_user){
				$data['relation'] = 3;
				$this->add_relation($us_1,$us_2);
			}else{
				$data['relation'] = 0;
				$this->remove_relation($us_2,$us_1);
			}
		}elseif ($info['relation'] == 3) {
			if($us_1 == $from_user){
				$data['relation'] = 2;
				$this->remove_relation($us_1,$us_2);
			}else{
				$data['relation'] = 1;
				$this->remove_relation($us_2,$us_1);
			}
		}

		// 保存数据
		if(count($info) == 0){
			$this->create($data);
			$this->add();
		}else{
			$this->where('id=%d',$info['id'])->save($data);
		}

		return $data['relation'];
	}

	// 给us1增加一个follow，给us2增加一个fans
	private function add_relation($us_1,$us_2){
		$User = M('User');
		$User->where('username="%s"',$us_1)->setInc('follow');
		$User->where('username="%s"',$us_2)->setInc('fans');
	}
	// 给us1减去一个follow，给us2减去一个fans
	private function remove_relation($us_1,$us_2){
		$User = M('User');
		$User->where('username="%s"',$us_1)->setDec('follow');
		$User->where('username="%s"',$us_2)->setDec('fans');
	}
}