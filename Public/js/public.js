  function logout(){
  $.ajax({
            type:"GET",
            url:"/index.php/User/Operation/logout.html",
            complete:function(re){
               location.reload();
            }
  });
}
function login(){
  //$('#login-model').modal('open');
  $.ajax({
            type:"POST",
            url:"/index.php/User/Operation/login.html",
            data:{
                  user:$("#username").val(),
                  pass:$("#password").val(),
                  remember_me:$("#remember-me").val()
                  },
            success:function(re){
            	$('#login-model').modal('close');
            	alert(re);
                if(re=="Success"){
                  location.reload();
                }
            }
  });
}