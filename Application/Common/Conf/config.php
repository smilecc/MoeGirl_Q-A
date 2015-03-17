<?php

// Question: 1 提交问题 2 关注问题 3 推送问题
// Answer: 1 提交回答 2 赞同回答 3 推送回答
define('TIMELINE_QUESTION', '1');
define('TIMELINE_ANSWER', '2');

define('TIMELINE_QUESTION_SUBMIT', '1');
define('TIMELINE_QUESTION_FOLLOW', '2');
define('TIMELINE_QUESTION_PUSH', '3');

define('TIMELINE_ANSWER_SUBMIT', '1');
define('TIMELINE_ANSWER_AGREE', '2');
define('TIMELINE_ANSWER_PUSH', '3');


// Timeline_Question
define('TIMELINE_QUESTION_ADD_ANSWER', '1');
define('TIMELINE_QUESTION_ADD_COMMENT', '2');

return array(
	//'配置项'=>'配置值'
	'SHOW_PAGE_TRACE' =>true,
	'URL_MODEL' => 1,
);