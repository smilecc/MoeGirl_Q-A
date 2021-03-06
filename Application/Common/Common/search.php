<?
require_once '/usr/local/xunsearch/sdk/php/lib/XS.php';

function SearchAnswerAdd($answer_id,$question_id,$question_title,$answer_content,$author)
{
	$xs = new XS('answer');
	$index = $xs->index;

	$data = array(
	    'id' 			=> $answer_id,
	    'question' 		=> $question_title,
	    'answer' 		=> $answer_content,
	    'username'		=> $author,
	    'time' 			=> time(),
	    'question_id'	=> $question_id
	);
	 
	// 创建文档对象
	$doc = new XSDocument;
	$doc->setFields($data);
	 
	// 添加到索引数据库中
	$index->add($doc);
}