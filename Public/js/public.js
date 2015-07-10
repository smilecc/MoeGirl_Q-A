$(".js-follow").click(function(){
  if($(this).text()=='取消关注')
  {
    $(this).text('关注话题');
    $(this).removeClass('am-btn-success');
    $(this).addClass('am-btn-default');
  }
  else
  {
    $(this).text('取消关注');
    $(this).removeClass('am-btn-default');
    $(this).addClass('am-btn-success');
  }
});

function load_form_conf(){
  
  $("#put-question-form").submit(function(e){
    e.preventDefault();
    var reg = /\{\:(.+?)\!\}/;
    var result_content = reg.exec($("#put-question-content").val());
    console.log(result_content);
    var regg = /是哪部作品/;
    var result_title = regg.exec($("#put-question-title").val());
    if(false)//result_title && result_content) $('#stu-confirm').modal('open');
      ;
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

function login(from){
  $.ajax({
            type:"POST",
            url:"/index.php/User/Operation/login.html",
            data:{
                  user:$("#username").val(),
                  pass:$("#password").val(),
                  remember_me:$("#remember-me").val()
                  },
            success:function(re){
                var jsonObject = JSON.parse(re);
                if(jsonObject['info']=="Success"){
                  success_notify("登录成功，正在跳转");
                  if(from == 'NULL') window.location.href='/';
                  else window.location.href=from;
                }else{
                  console.log(re);
                  error_notify(jsonObject['error']);
                }
            }
  });
}

function register(from){
  $.ajax({
            type:"POST",
            url:"/index.php/User/Operation/register.html",
            data:{
                  username:$("#username").val(),
                  password:$("#password").val(),
                  email:$("#email").val(),
                  },
            success:function(re){
              var jsonObject = JSON.parse(re);
                if(jsonObject['info']=="Success"){
                  success_notify("注册成功，自动登录完毕，正在跳转");
                  if(from == 'NULL') window.location.href='/';
                  else window.location.href=from;
                }else{
                  console.log(re);
                  error_notify(jsonObject['error']);
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
            $("#put-question-content").val($("#put-question-content").val() + "![img](/Public/Uploads/" + data + ")");
            $('#put-question-popup').modal('open');
        }else if(mode == "answer"){
            $("#put-answer-content").val($("#put-answer-content").val() + "![img](/Public/Uploads/" + data + ")");
            $('#put-question-upload').modal('close');
        }
      }
    },
    error: function (data, status, e){
      error_notify(e);
    },
  });
    
}
function on_continue_put_question_btn_click(){
  $("#put-question-form").submit(function(e) {event.preventDefault()}).off('submit').submit(function() {console.log("submit unlock")});
  $("#put-question-form").submit();
}
function comment_toggle(data,mode){
  $("#comment-" + $(data).attr('value')).toggle();
  $("#div-comment-" + $(data).attr('value')).load('/index.php/Home/Question/get_comment.html?id='+$(data).attr('value')+'&mode='+mode);
  console.log('/index.php/Home/Question/get_comment.html?id='+$(data).attr('value')+'&mode='+mode);
}
function put_comment(project_id,mode){
  $.ajax({
            type:"POST",
            url:"/index.php/Home/Question/put_comment.html",
            data:{
                  id:project_id,
                  content:$("#put-comment-content-" + project_id).val(),
                  mode:mode
                  },
            success:function(re){
                if(re=="1"){
                  $("#div-comment-" + project_id).load('/index.php/Home/Question/get_comment.html?id='+project_id+'&mode='+mode);
                }else{
                  error_notify('评论失败');
                }
            }
  });
}


function agree_answer(answer_id,agree){
  //if(getCookie('mgqa_username') == "")
  agree_numb = $("#answer-agree-numb-" + answer_id).text();
  $("#answer-agree-numb-" + answer_id).text('');
  $("#answer-agree-numb-" + answer_id).append('<i class="am-icon-spinner am-icon-spin"></i>');
  $.ajax({
            type:"GET",
            url:"/index.php/Home/Question/agree?answer_id=" + answer_id + "&agree=" + agree,
            success:function(re){
                if(re == "-1"){
                    error_notify('失败，发生错误');
                    $("#answer-agree-numb-" + answer_id).text(agree_numb);
                }else if(re == "-2"){
                    error_notify('不要赞自己噢~');
                    $("#answer-agree-numb-" + answer_id).text(agree_numb);
                }else{
                    $("#answer-agree-numb-" + answer_id).text(re);
                    var btn_id = "";
                    var o_btn_id = "";
                    if (agree == 1) {
                      btn_id = "#agree-answer-btn-" + answer_id;
                      o_btn_id = "#unagree-answer-btn-" + answer_id;
                    }
                    else {
                      btn_id = "#unagree-answer-btn-" + answer_id;
                      o_btn_id = "#agree-answer-btn-" + answer_id;
                    }
                    if($(btn_id).hasClass("am-btn-primary")) $(btn_id).removeClass("am-btn-primary");
                    else {
                      $(btn_id).addClass("am-btn-primary");
                      $(o_btn_id).removeClass("am-btn-primary");
                    }
                }
            }
  });
}
function on_follow_topic_btn_click(tid,tname,btn){
  $.ajax({
            type:"GET",
            url:"/index.php/Home/Topic/set_follow_topic.html?topic_id=" + tid,
            success:function(re){
              var jsonObject = JSON.parse(re);
              if(jsonObject['status'])
              {
                success_notify_right('<strong>'+tname + '</strong> '+jsonObject['info']);
              }
             else
             {
              error_notify_right(jsonObject['error']);
             }
            }
  });
}

function getCookie(cookieName) {
    var strCookie = document.cookie;
    var arrCookie = strCookie.split("; ");
    for(var i = 0; i < arrCookie.length; i++){
        var arr = arrCookie[i].split("=");
        if(cookieName == arr[0]){
            return arr[1];
        }
    }
    return "";
}

function follow_user(from_name,to_user){
  btnName = '.follow-btn-' + to_user;
$(btnName).text('');
$(btnName).append('<i class="am-icon-spinner am-icon-spin"></i>');
    $.ajax({
            type:"POST",
            url:"/Home/User/follow.html",
            dataType:"json",
            data:{
                  toname:to_user
                  },
            success:function(re){
                console.log(re);
                if(re.error) error_notify(re.error);
                else{
                  if(re.relation == 0){
                    $('.follow-btn-' + to_user).addClass('am-btn-success');
                    $('.follow-btn-' + to_user).removeClass('am-icon-retweet');
                    $('.follow-btn-' + to_user).text("关注TA");
                  }else if (re.relation == 1){
                    $('.follow-btn-' + to_user).removeClass('am-icon-retweet');
                    if(from_name > to_user) {$('.follow-btn-' + to_user).removeClass('am-btn-success');$('.follow-btn-' + to_user).text("取消关注");}
                    else {$('.follow-btn-' + to_user).addClass('am-btn-success');$('.follow-btn-' + to_user).text("关注TA");}
                  }else if (re.relation == 2){
                    $('.follow-btn-' + to_user).removeClass('am-icon-retweet');
                    if(from_name > to_user) {$('.follow-btn-' + to_user).addClass('am-btn-success');$('.follow-btn-' + to_user).text("关注TA");}
                    else {$('.follow-btn-' + to_user).removeClass('am-btn-success');$('.follow-btn-' + to_user).text("取消关注");}
                  }else{
                    $('.follow-btn-' + to_user).removeClass('am-btn-success');
                    $('.follow-btn-' + to_user).addClass('am-icon-retweet');
                    $('.follow-btn-' + to_user).text(' 取消关注');
                  }
                }
            }
  });
}

function push2timeline(mode,project_id,btn){
    $.ajax({
              type:"GET",
              url:"/index.php/Home/Question/push2timeline.html?mode=" + mode + "&project_id=" + project_id,
              success:function(re){
                 $(btn).text("已推送");
                 $(btn).addClass("am-disabled");
              }
    });
}

function get_info(){
  if(!$('#topbar-info').hasClass('am-active')) return;
  $.ajax({
              type:"GET",
              url:"/index.php/Home/index/update_time.html"
    });

    $('#info_question').load('/index.php/Home/index/get_question.html');
    $('#info_follow').load('/index.php/Home/index/get_follow.html');
    $('#info_agree').load('/index.php/Home/index/get_agree.html');
}

function pushToFind(a_id)
{
  $.ajax({
  type:"POST",
  url:"/index.php/Admin/Find/AddItem",
  data:{
        answer_id:a_id,
        order:0
        },
  success:function(re){
     notify_re(re);
  }
  });
}

function notify_re(re)
{
  var jsonObject = JSON.parse(re);
  if(jsonObject['status']){
    success_notify_right(jsonObject['info']);
    return true;
  }
  else
  {
    error_notify_right(jsonObject['error']);
    return false;
  }
}