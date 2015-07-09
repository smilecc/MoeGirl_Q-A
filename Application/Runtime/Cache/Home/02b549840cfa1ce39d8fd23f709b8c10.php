<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<?php $auto_login = new \User\Api\UserApi; $auto_login->autologin(); if(!test_user()) { header("Location: /User/Login?from=".$_SERVER['PHP_SELF'].$_SERVER["QUERY_STRING"]); exit; } $isAdmin = CheckAdmin(); ?>
<html class="no-js">
<head>
	  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="/Public/assets/i/favicon.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="/Public/assets/i/app-icon72x72@2x.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="/Public/assets/i/app-icon72x72@2x.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="/Public/assets/i/app-icon72x72@2x.png">
  <meta name="msapplication-TileColor" content="#0e90d2">

  <link rel="stylesheet" href="/Public/css/pnotify.custom.min.css"/>
  <!--<link href="/Public/bootstrap/css/bootstrap.css" id="bootstrap-css" rel="stylesheet" type="text/css"/>-->
  <link rel="stylesheet" href="/Public/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="/Public/assets/css/app.css">
  <link rel="stylesheet" href="/Public/css/public.css">

  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="/Public/assets/js/jquery.min.js"></script>
  <!--<script type="text/javascript" src="/Public/bootstrap/js/bootstrap.min.js"></script>-->
  <script src="/Public/assets/js/amazeui.min.js"></script>
  <script src="/Public/js/notify.js"></script>
<!--<![endif]-->

<!--[if IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，不能达到完整的浏览体验。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->
<!--[if lte IE 8]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，萌娘问答 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<script type="text/javascript">
  var upload_mode = 'answer';
</script>
</head>
<body>
 
<div id="space_height">
	<!-- 头部 -->
	

<script type="text/javascript">
function load_info_badge(sum,question,follow,agree){
    if(sum == 0){
      $('#info-question-badge').addClass('info-nodisplay-badge');
      $('#info-follow-badge').addClass('info-nodisplay-badge');
      $('#info-agree-badge').addClass('info-nodisplay-badge');
      $('#info-badge').addClass('info-nodisplay-badge');
    }else{
      $('#info-badge').removeClass('info-nodisplay-badge');
      $('#info-badge').text(sum);

      if(question) {
        $('#info-question-badge').removeClass('info-nodisplay-badge');
        $('#info-question-badge').text(question);
      }
      if(follow) {
        $('#info-follow-badge').removeClass('info-nodisplay-badge');
        $('#info-follow-badge').text(follow);
      }
      if(agree) {
        $('#info-agree-badge').removeClass('info-nodisplay-badge');
        $('#info-agree-badge').text(agree);
      }
    }
  }
  // 展示推送的信息
     var usname = "<?php echo cookie('username')?cookie('username'):'guest';?>";
    function show_msg(data) {
      if(data['type'] == "new-msg"){
        $('.msg-badge').text(data['numb']);
        $('.msg-badge').css("display",""); 
      }
      if(data['type'] == "new-info"){
        $.ajax({
            type:"GET",
            dataType:"json",
            url:"/index.php/Home/index/getinfo",
            complete:function(re){
              load_info_badge(re.responseJSON.sum,re.responseJSON.question,re.responseJSON.follow,re.responseJSON.agree);
            }
        });
    }
}
    function msg_login(){
      ws.send(JSON.stringify({"type":"login","name":usname}));
    }
</script>
<script type="text/javascript" src="/Public/js/sender.js"></script>

<header class="am-topbar">
<div class="am-container">
  <h1 class="am-topbar-brand">
    <a href="/"><?php echo C('SITE_TITLE');?></a>
  </h1>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="" id="topbar-index"><a href="/">时间线</a></li>
      <li id="topbar-find"><a href="<?php echo U('/Home/Find');?>">发现</a></li>
      <li id="topbar-topic"><a href="<?php echo U('/Home/Topic');?>">话题</a></li>
<li id="topbar-info" onclick="get_info()" data-am-dropdown>
<?php $unread_arr = get_unread(); ?>
<a href="javascript:;" class="am-dropdown-toggle">消息 <span class="am-badge am-badge-danger am-round info-nodisplay-badge" id="info-badge"><?php echo $unread_arr['sum'];?></span></a>

<!--消息页面-->
<div data-am-widget="tabs" class="am-tabs am-tabs-d2 am-dropdown-content info" data-am-tabs-noswipe="1">
  <ul class="am-tabs-nav am-cf">
    <li class="am-active">
      <a href="[data-tab-panel-0]"><i class="am-icon-th-list"></i> 问答 <span class="am-badge am-badge-danger am-round info-nodisplay-badge" id="info-question-badge"><?php echo $unread_arr['question'];?></span></a>
    </li>
    <li class="">
      <a href="[data-tab-panel-1]"><i class="am-icon-users"></i> 用户 <span class="am-badge am-badge-danger am-round info-nodisplay-badge" id="info-follow-badge"><?php echo $unread_arr['follow'];?></span></a>
    </li>
    <li class="">
      <a href="[data-tab-panel-2]"><i class="am-icon-heart"></i> 赞同 <span class="am-badge am-badge-danger am-round info-nodisplay-badge" id="info-agree-badge"><?php echo $unread_arr['agree'];?></span></a>
    </li>
  </ul>
  <script type="text/javascript">
    load_info_badge(<?php echo $unread_arr['sum'];?>,<?php echo $unread_arr['question'];?>,<?php echo $unread_arr['follow'];?>,<?php echo $unread_arr['agree'];?>);
  </script>
  <div class="am-tabs-bd">
    <div data-tab-panel-0 class="am-tab-panel am-active am-scrollable-vertical info-tab" id="info_question">
    <button type="button" class="am-btn am-btn-default am-btn-block"><i class="am-icon-spinner am-icon-spin"></i> 加载中</button>
    <hr />
    </div>
    <div
    data-tab-panel-1 class="am-tab-panel am-scrollable-vertical info-tab" id="info_follow">
    <button type="button" class="am-btn am-btn-default am-btn-block"><i class="am-icon-spinner am-icon-spin"></i> 加载中</button>
    </div>
  <div
  data-tab-panel-2 class="am-tab-panel am-scrollable-vertical info-tab" id="info_agree">
  <button type="button" class="am-btn am-btn-default am-btn-block"><i class="am-icon-spinner am-icon-spin"></i> 加载中</button>
  </div>
</div>
</div>


</li>

      
      


    </ul>


    <form class="am-topbar-form am-topbar-left am-form-inline" role="search">
      <div class="am-form-group">
        <input type="text" class="am-form-field am-input-sm"  id="bdcsMain" placeholder="搜索">
      </div>
    </form>
    <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm" onclick="load_form_conf()" data-am-modal="{target: '#put-question-popup',width: 400, height: 225}">提问</button>


    <!--提问窗口-->
    <div class="am-popup" id="put-question-popup">
      <div class="am-popup-inner">
        <div class="am-popup-hd">
          <h4 class="am-popup-title">提问</h4>
          <span data-am-modal-close
                class="am-close">&times;</span>
        </div>
        <form action="/index.php/Home/Question/put_question.html" method="post" id="put-question-form">
          <div class="am-popup-bd">
            <!--<p>提示：如果是询问图片所属作品可以在标题中包含“是哪部作品”的关键词，并上传图片，系统会有一定几率自动识别出图片所属的作品。例如标题为：请问这幅画是哪部作品中的？
            系统会自动识别本答案的第一张图并给出识别答案，如果问题不包含图片则不识别。</p>
            <hr />-->
            <input type="text" class="am-form-field am-round" id="put-question-title" name="title" placeholder="输入问题的标题" required="required">
            <hr />
             <!--话题框-->
             <label for="doc-ta-1">话题： </label>
            <select multiple data-am-selected="{maxHeight: 100,searchBox: 1, btnWidth: 300, btnSize: 'sm', btnStyle: 'secondary'}" minchecked="1" maxchecked="3" name="topic[]">
            <?php $topic_list = M("Topic")->order('id')->select(); ?>
            <?php if(is_array($topic_list)): foreach($topic_list as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
            </select>
            <hr />
             <div class="am-form-group">
              <label for="doc-ta-1">问题描述（选填）： </label>
              <a class="am-fr" href="javescript:;"  data-am-modal="{target: '#put-question-upload', closeViaDimmer: 0, width: 400, height: 225}" onclick="upload_mode='question';$('#put-question-popup').modal('close');"><span class="am-icon-image"></span> 图片上传</a>
              <textarea class="am-form-field am-radius" rows="9" id="put-question-content" name="content"></textarea>
            </div>


            <label for="remember-me">
              <input id="put-question-anonymous" name="anonymous" type="checkbox">
              匿名
            </label>
            <button type="submit" class="am-btn am-btn-primary am-fr">提交</button>
            <hr />
            <small>
            你可以使用Markdown语法，不了解？<a target="_blank" href="http://www.appinn.com/markdown/"><strong>点击这儿学习</strong></a>
            </small>
            <!--<small>提示：如果是询问图片所属作品可以在标题中包含“是哪部作品”的关键词，并上传图片，系统会有一定几率自动识别出图片所属的作品。系统会自动识别本答案的第一张图并给出识别答案。<br />例如标题为：请问这幅画是哪部作品中的？<br />
            </small>-->
           </div>
        </form>
      </div>
    </div>

  <!--图片上传窗口-->
  <div class="am-modal am-modal-no-btn" tabindex="-1" id="put-question-upload">
    <div class="am-modal-dialog">
      <div class="am-modal-hd">图片上传
        <a href="javascript:;"  onclick="if(upload_mode == 'question') $('#put-question-popup').modal('open');" class="am-close am-close-spin" data-am-modal-close>&times;</a>
      </div>
      <hr />
      <div class="am-modal-bd">
        <div class="am-form-group">
          <p><input type="file" id="put-question-upload-input" name="put-question-upload-input" class="am-center am-btn am-btn-success"></p>
          <button type="button" class="am-btn am-btn-primary" onclick="upload(upload_mode)">提交</button>
        </div>
      </div>
    </div>
  </div>

      <div class="am-modal am-modal-no-btn" tabindex="-1" id="put-question-uploading">
        <div class="am-modal-dialog">
          <div class="am-modal-hd">正在上传图片</div>
          <div class="am-modal-bd">
            <i class="am-icon-spinner am-icon-spin"></i>
          </div>
        </div>
      </div>

      <div class="am-modal am-modal-confirm" tabindex="-1" id="stu-confirm">
        <div class="am-modal-dialog">
          <div class="am-modal-hd">萌娘问答</div>
          <div class="am-modal-bd">
            检测到识别关键词与图片存在，请问要识别吗？
          </div>
          <div class="am-modal-footer">
            <span class="am-modal-btn" onclick="on_continue_put_question_btn_click()" data-am-modal-cancel>继续提问</span>
            <span class="am-modal-btn" onclick="on_stu_btn_click()" data-am-modal-confirm>确定</span>
          </div>
        </div>
      </div>

  <!--用户名下拉菜单-->
  <div class="am-collapse am-topbar-collapse am-topbar-right" id="doc-topbar-user">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;"><span class="am-badge am-badge-danger am-round msg-badge"><?php echo get_inbox_alert();?></span>
          <?php echo cookie('username');?> <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li class="am-dropdown-header">我的页面</li>
          <li><a href="<?php echo GetUserPage(cookie('username'));?>">个人主页</a></li>
          <?php if($isAdmin): ?><li class="am-dropdown-header">站点管理</li>
            <li><a href="<?php echo U('/Admin');?>">管理中心</a></li><?php endif; ?>
          <li class="am-dropdown-header">用户操作</li>
          <li><a href="<?php echo U('/Home/Inbox');?>">私信 <span class="am-badge am-badge-danger am-round msg-badge"><?php echo get_inbox_alert();?></span></a></li>
          <li><a href="<?php echo U('/Home/User/setting');?>">设置</a></li>
          <li class="am-divider"></li>
          <li><a href="javascript:;" onclick="logout()">登出</a></li>
        </ul>
      </li>
    </ul>
    </div>

<script type="text/javascript">
  if(<?php echo get_inbox_alert();?> == 0) $('.msg-badge').css("display","none"); 
</script>


  </div>
  </div>
</header>


<script type="text/javascript">
function on_stu_btn_click(){
    var reg = /\{\:(.+?)\!\}/;
    var result_content = reg.exec($("#put-question-content").val());
    window.open('/index.php/Home/Question/stu.html?imgurl=http://<?php echo $_SERVER['HTTP_HOST'];?>/Public/Uploads/' + result_content[1]);
}
</script>

	<!-- /头部 -->

	<!-- 主体 -->
	<div class="am-container">
	
<title>收件箱 - <?php echo C('SITE_TITLE');?></title>

<script type="text/javascript">
function postmsg(){
  console.log($("#toname").val());
    $.ajax({
            type:"POST",
            url:"<?php echo U('/Home/Inbox');?>",
            data:{
                  type:'send',
                  toname:$("#toname").val(),
                  content:$("#comenttext").val()
                  },
            cache:false, //不缓存此页面   
            success:function(re){
        alert(re);
         if(re=="发送成功")  location.replace(location);
            }
        });


  }
</script>



<div class="am-modal am-modal-no-btn" tabindex="-1" id="new-msg-modal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">发送私信
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd am-form">
      <input type="text" class="form-control" id="toname" placeholder="请输入要私信的用户名 只能输一个哦( • ̀ω•́ )✧..." /><hr>
      <div class="am-alert am-alert-info">长度限1000字</div>
      <textarea name="content" onKeyDown='if (this.value.length>=1000){if(event.keyCode != 8)event.returnValue=false;}' class="form-control" rows="7" id="comenttext"></textarea>
      <hr>
      <span class="am-fr">
        <button type="button" class="am-btn am-btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="am-btn am-btn-primary" onclick="postmsg()" data-dismiss="modal">提交</button>
      </span>
    </div>
  </div>
</div>

<div class="am-g">

<div class="am-u-md-8">
<div class="page-header">
  <h2>我的私信 <small><button class="am-btn am-btn-success" data-am-modal="{target: '#new-msg-modal', closeViaDimmer: 0, width: 500, height: 450}">写私信</button></small></h2>
</div>
<hr />
<?php if(is_array($inbox_index)): $i = 0; $__LIST__ = $inbox_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p><?php if(($vo['from'] == 1)): if(($vo['usname1'] == cookie('username'))): ?>我发送给<a href="<?php echo GetUserPage($vo['usname2']);?>"><?php echo $vo['usname2'];?></a>
  <?php else: ?>
  <a href="<?php echo GetUserPage($vo['usname1']);?>"><?php echo $vo['usname1'];?></a><?php endif; ?>

  <?php else: ?>

  <?php if(($vo['usname1'] == cookie('username'))): ?><a href="<?php echo GetUserPage($vo['usname2']);?>"><?php echo $vo['usname2'];?></a>
  <?php else: ?>
  我发送给<a href="<?php echo GetUserPage($vo['usname1']);?>"><?php echo $vo['usname1'];?></a><?php endif; endif; ?>
  ：<?php echo getInboxcontent($vo['inbox_id']);?>... <br />
  <span><?php echo ($vo['time']); ?></span><span style="float:right"><a href="/Home/Inboxpage/<?php echo ($vo['usname1'] == cookie('username')?$vo['usname2']:$vo['usname1']); ?>" target="_BLANK">共<?php echo ($vo['numb']); ?>条对话</a></span></p>
  <hr><?php endforeach; endif; else: echo "" ;endif; ?>


</div><!--col-md-8-->

<div class="am-u-sm-4"></div>

</div><!--container-->


	</div>
	<!-- /主体 -->

	<!-- 底部 -->
	<footer data-am-widget="footer" class="am-footer am-footer-default qa-footer-grey" data-am-footer="{  }">
  <div class="am-footer-switch">
    <span>萌娘问答</span>
  </div>
  <div class="am-footer-miscs ">
    <p>你正在浏览的是
      <a href="http://zh.moegirl.org/" title="萌娘百科" target="_blank" class="">萌娘百科</a> 的子项目 - 萌娘问答</p>
    <p>CopyRight©2014-2015 MoeGirl.Wiki.</p>
<!--百度统计-->
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "//hm.baidu.com/hm.js?6751f8c150b62574e5cff5ec3a8dad22";
var s = document.getElementsByTagName("script")[0]; 
s.parentNode.insertBefore(hm, s);
})();
</script>
<!--百度统计-->
  </div>
</footer>
	<!-- /底部 -->
</div>
<script src="/Public/js/ajaxfileupload.js"></script>
<script src="/Public/js/notify.js"></script>
<script src="/Public/js/public.js"></script>
</body>
</html>