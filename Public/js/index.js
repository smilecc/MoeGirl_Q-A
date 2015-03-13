function get_timeline(page){
  var id = "#index_load";
  if(page != 1) {
  	$('#load_more_btn').button('loading');
  	id = "#index_load_more";
  }
  $(id).load('/index.php/Home/index/get_timeline.html?page=' + page);
}

