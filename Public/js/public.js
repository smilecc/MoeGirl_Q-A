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

function upload(){
$('#put-question-upload').modal('close');
$('#put-question-uploading').modal('open');
    $.ajaxFileUpload({
    url:"/index.php/Home/Question/upload.html",
    secureuri:false,
    fileElementId:'put-question-upload-input',
    dataType:'text',
    success: function (data, status){
      $('#put-question-uploading').modal('close');
      var reg = /error\">(.*)<\/p>/;
      var result = reg.exec(data);
      if(result){
        alert(result[1]);
        $('#put-question-upload').modal('open');
      }
      else{
        alert("成功");
        $("#put-qustion-content").val($("#put-qustion-content").val() + "{:" + data + "}");
        $('#put-question-popup').modal('open');
        $("#put-qustion-content").focus().select();
      }
    },
    error: function (data, status, e){
      alert(e);
    },
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