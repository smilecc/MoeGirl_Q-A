<?php

//用inbox_id获取该私信内容
function getInboxcontent($inbox_id){
	return M('Inbox')->where('id=%d',$inbox_id)->getField('content');
}

//gtuid 比较两username大小，usname1比usname2大时 颠倒两变量值，usname1比usname2小时 则不变
function gtuid(&$usname1,&$usname2){
    if($usname1>$usname2){
        $i = $usname2;
        $usname2 = $usname1;
        $usname1 = $i;
        return true;
    }else return false;
}
