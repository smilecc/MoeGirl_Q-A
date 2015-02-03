function on_follow_topic_btn_click(tid){
	$.ajax({
            type:"GET",
            url:"/index.php/Home/Topic/set_follow_topic.html?topic_id=" + tid,
            success:function(re){
               if(re) alert(re);
            }
  });
}