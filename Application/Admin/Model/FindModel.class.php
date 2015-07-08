<?php
namespace Admin\Model;
use Think\Model;

Class FindModel extends Model{
	// 构造函数 检测登录
	function __construct() {
       parent::__construct();
       ModelOperationCheckAdmin();
   }

   // 增加或修改项目
   // 此处的isUpdate又当作传递id的参数
	function AddItem($answerID,$order,$isUpdate=false)
	{
		$resultArr = array();

		// 效验增加数据的正确性
		$answer = M('Answer')->where('id=%d',$answerID)->find();
		if(count($answer) == 0)
		{
			$resultArr['status'] = false;
			$resultArr['error']	= '所添加的回答不存在'.$answerID;
			return $resultArr;
		}

		// 分情况查询
		$isBehave = false;
		if($isUpdate)
		{
			// update的时候查询不含当前id的值
			if($this->where('answer_id=%d AND id!=%d',$answerID,$isUpdate)->count())
			{
				$isBehave = true;
			}
		}
		else
		{
			// add的时候直接查询
			if($this->where('answer_id=%d',$answerID)->count())
			{
				$isBehave = true;
			}
		}

		if($isBehave)
		{
			$resultArr['status'] = false;
			$resultArr['error']	= '所添加的回答已存在';
			return $resultArr;
		}


		// 装填数据
		$data = array(
			'answer_id'				=> $answerID,
			'orderNumber'			=> $order,
			'answer_sub'			=> $answer['content'],
			'answer_author'			=> $answer['username'],
			'answer_question_id'	=> $answer['question_id']
			);

		// 判断更新模式还是创建模式
		if($isUpdate)
		{
			$data['id'] = $isUpdate;
			$res = $this->save($data);
		}
		else
		{
			$res = $this->add($data);
		}

		if($res)
		{
			$resultArr['status'] = true;
			$resultArr['info']	= '成功'.($isUpdate?'更新':'添加').'数据';
			$resultArr['find_id'] = $res;
		}
		else
		{
			$resultArr['status'] = false;
			if($isUpdate) $resultArr['error']	= '未更新数据或系统错误';
			else $resultArr['error']	= 'System Error';
		}
		return $resultArr;
	}

	// 删除项目
	function DeleteItem($id)
	{
		$res = $this->where('id=%d',$id)->delete();
		$resultArr = array();
		if($res == 0)
		{
			$resultArr['status'] = false;
			$resultArr['error'] = '删除失败';
		}
		else
		{
			$resultArr['status'] = true;
			$resultArr['info'] = '删除成功';
		}
		return $resultArr;
	}

	// 修改接口的伪装
	function EditItem($id,$answerID,$order)
	{
		return $this->AddItem($answerID,$order,$id);
	}
}