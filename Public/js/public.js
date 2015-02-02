function load_form_conf(){
  $("#put-question-form").submit(function(e){
    e.preventDefault();
    var reg = /\{\:(.+?)\!\}/;
    var result_content = reg.exec($("#put-question-content").val());
    console.log(result_content);
    var regg = /是哪部作品/;
    var result_title = regg.exec($("#put-question-title").val());
    if(result_title && result_content) $('#stu-confirm').modal('open');
    else{
      $("#put-question-form").submit(function(e) {event.preventDefault()}).off('submit').submit(function() {console.log("submit unlock")});
      $("#put-question-form").submit();
    }
  });
}

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

function upload(mode){
if(mode == "question") $('#put-question-upload').modal('close');
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
        if(mode == "question") $('#put-question-upload').modal('open');
      }
      else{
        if(mode == "question"){
            $("#put-question-content").val($("#put-question-content").val() + "{:" + data + "!}");
            $('#put-question-popup').modal('open');
        }else if(mode == "answer"){
            $("#put-answer-content").val($("#put-answer-content").val() + "{:" + data + "!}");
            $('#put-question-upload').modal('close');
        }
      }
    },
    error: function (data, status, e){
      alert(e);
    },
  });
    
}
function on_continue_put_question_btn_click(){
  $("#put-question-form").submit(function(e) {event.preventDefault()}).off('submit').submit(function() {console.log("submit unlock")});
  $("#put-question-form").submit();
}