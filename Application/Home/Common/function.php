<?php

//用inbox_id获取该私信内容
function getInboxcontent($inbox_id){
	return M('Inbox')->where('id=%d',$inbox_id)->getField('content');
}

//gtusname gt为大于的意思 比较两username大小，usname1比usname2大时 颠倒两变量值，usname1比usname2小时 则不变
function gtusname(&$usname1,&$usname2){
    if($usname1>$usname2){
        $i = $usname2;
        $usname2 = $usname1;
        $usname1 = $i;
        return true;
    }else return false;
}

//itusname it为小于的意思 比较两username大小，usname2比usname1大时 颠倒两变量值，usname2比usname1小时 则不变
function itusname(&$usname1,&$usname2){
    if($usname1<$usname2){
        $i = $usname2;
        $usname2 = $usname1;
        $usname1 = $i;
        return true;
    }else return false;
}

function getTopicname($topic_id){
	return M('Topic')->where('id=%d',$topic_id)->getField('name');
}

function getTopicinfo($topic_id){
	return M('Topic')->where('id=%d',$topic_id)->find();
}

function getIsfollowtopic($topic_id){
	return M('TopicFollow')->where('username="%s" AND topic_id=%d',cookie('username'),$topic_id)->count();
}

function getAnsweraction($answer_id,$agree){
	$is_agree = M('AnswerAgree')->where('answer_id=%d AND username="%s"',$answer_id,cookie("username"))->getField('is_agree');
	if($is_agree != NULL){
		if($agree == 1 AND $is_agree == 1) return 'am-btn-primary';
		else if($agree == 2 AND $is_agree == 2) return 'am-btn-primary';
	}
}

// 1表示true 3表示互相关注
function is_follow($us_1,$us_2){
	$is_change = itusname($us_1,$us_2);
	$info = M('Follow')->where('us1 = "%s" AND us2="%s"',$us_1,$us_2)->find();
	if(count($info) == 0 || $info['relation'] == 0) return false;
	if($is_change){
		if($info['relation'] == 1) return false;
		else if($info['relation'] == 2) return 1;
		else return 3;
	}else{
		if($info['relation'] == 1) return 1;
		else if($info['relation'] == 2) return false;
		else return 3;
	}
}