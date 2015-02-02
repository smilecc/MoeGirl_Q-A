function on_question_content_click(qid){
	  $("#question-content-div").load('/index.php/Home/Question/get_question_content.html?qid='+ qid);
	  $("#question-content-div").css('cursor','auto');
}