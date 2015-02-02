function on_question_content_click(qid){
	  $('#question-content-div').animate({ opacity: '0'}, 100);
	  $("#question-content-div").load('/index.php/Home/Question/get_question_content.html?qid='+ qid);
	  $("#question-content-div").css('cursor','auto');
	  $('#question-content-div').animate({ opacity: '1'}, 500);
}
function on_user_status_btn_click(qid,btn){
	if(btn == 0){
		var follow = $("#follow_btn").hasClass("am-active")?0:1;
		var anonymous = $("#anonymous_btn").hasClass("am-active")?1:0;
	}else{
		var follow = $("#follow_btn").hasClass("am-active")?1:0;
		var anonymous = $("#anonymous_btn").hasClass("am-active")?0:1;
	}

	$.ajax({
            type:"GET",
            url:"/index.php/Home/Question/set_question_user_status.html?question_id=" + qid + "&follow=" + follow + "&anonymous=" + anonymous,
            success:function(re){
               if(re) alert(re);
            }
  });
}