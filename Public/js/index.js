function logout(){
  $.ajax({
            type:"GET",
            url:"__SELF__",
            success:function(re){
                location.replace(location);
            }
  });
}