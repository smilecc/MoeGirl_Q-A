function on_question_content_click(qid){
	if(question_content_is_load) return;
	 question_content_is_load = true;
	  $('#question-content-div').animate({ opacity: '0'}, 100);
	  $("#question-content-div").load('/index.php/Home/Question/get_question_content.html?qid='+ qid);
	  $("#question-content-div").css('cursor','auto');
	  $('#question-content-div').animate({ opacity: '1'}, 500);
}
function on_user_status_btn_click(qid,btn){
   $('#follow_btn').text('');
   $("#follow_btn").append('<i class="am-icon-spinner am-icon-spin"></i>');
	if(btn == 0){
		var follow = $("#follow_btn").hasClass("am-btn-success")?0:1;
		var anonymous = 0;//$("#anonymous_btn").hasClass("am-active")?1:0;
	}else{
		var follow = $("#follow_btn").hasClass("am-btn-success")?1:0;
		var anonymous = 0;//$("#anonymous_btn").hasClass("am-active")?0:1;
	}

	$.ajax({
            type:"GET",
            url:"/index.php/Home/Question/set_question_user_status.html?question_id=" + qid + "&follow=" + follow + "&anonymous=" + anonymous,
            success:function(re){
               if(re) error_notify_right(re);
               else
               {
               	success_notify_right((follow?'关注':'取消关注')+'问题成功');
               	if(follow) 
               		{
               			$('#follow_btn').text('取消关注');
               			$('#follow_btn').addClass('am-btn-success');
               		}
               	else 
               		{
               			$('#follow_btn').text('关注问题');
               			$('#follow_btn').removeClass('am-btn-success');
               		}
               }
            }
  });
}