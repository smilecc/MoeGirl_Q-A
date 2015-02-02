<?php
return array(
	//'配置项'=>'配置值'
	'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES'=>array(
		'Question/:qid\d' => 'Question/index',
		'Question/:qid\d/Answer/:aid\d' => 'Question/index',
		),
);