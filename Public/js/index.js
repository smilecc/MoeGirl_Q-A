function get_timeline(page,user){
  var id = "#index_load";
  if(page != 1) {
  	$('#load_more_btn').button('loading');
  	id = "#index_load_more";
  }
  $(id).load('/index.php/Home/index/get_timeline.html?page=' + page + (user==0?'':'&username=' + user));
}

