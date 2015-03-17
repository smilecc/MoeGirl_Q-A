function get_content(tid,mode,page){
  var id = "#load-div";
  if(page != 1) {
  	$('#load_more_btn').button('loading');
  	id = "#topic_load_more";
  }
  $(id).load('/index.php/Home/Topic/getcontent.html?tid=' + tid + '&mode=' + mode + '&page=' + page);
}

