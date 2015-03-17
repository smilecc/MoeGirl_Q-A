<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<?php $auto_login = new \User\Api\UserApi; $auto_login->autologin(); ?>
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

  <link rel="stylesheet" href="/Public/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="/Public/assets/css/app.css">

  <link rel="stylesheet" href="/Public/css/public.css">

  <!--[if (gte IE 9)|!(IE)]><!-->
<script src="/Public/assets/js/jquery.min.js"></script>
<script src="/Public/assets/js/amazeui.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->
<script type="text/javascript">
  var upload_mode = 'answer';
</script>
</head>
<body>
 <script type="text/javascript" src="/Public/js/sender.js"></script>
<div id="space_height">
	<!-- 头部 -->
	

  <script type="text/javascript">
    // 展示推送的信息
     var usname = "<?php echo cookie('username')?cookie('username'):'guest';?>";
    function show_msg(data) {
      if(data['type'] == "new-msg"){
        $('.msg-badge').text(data['numb']);
        $('.msg-badge').css("display",""); 
      }
      if(data['type'] == "new-info"){
        if(data['sum']){
          info_sum = data['sum'];
          info_question = data['question'];
          info_follow = data['follow'];
          info_agree = data['agree'];
          load_info_badge();
        }
    }

    function msg_login(){
      ws.send(JSON.stringify({"type":"login","name":usname}));
    }
  </script>


<header class="am-topbar">
<div class="am-container">
  <h1 class="am-topbar-brand">
    <a href="/">萌娘问答</a>
  </h1>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="" id="topbar-index"><a href="/">首页</a></li>
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
    var info_sum = <?php echo $unread_arr['sum'];?>;
    var info_question = <?php echo $unread_arr['question'];?>;
    var info_follow = <?php echo $unread_arr['follow'];?>;
    var info_agree = <?php echo $unread_arr['agree'];?>;
    load_info_badge();
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
        <input type="text" class="am-form-field am-input-sm" placeholder="搜索">
      </div>
    </form>
    <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm" onclick="load_form_conf()" data-am-modal="{target: '#put-question-popup',width: 400, height: 225}">提问</button>

  <?php if(is_login()): ?><!--提问窗口-->
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
            <select multiple data-am-selected="{searchBox: 1, btnWidth: 300, btnSize: 'sm', btnStyle: 'secondary'}" minchecked="1" maxchecked="3" name="topic[]">
            <?php $topic_list = M("Topic")->select(); ?>
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
            <small>提示：如果是询问图片所属作品可以在标题中包含“是哪部作品”的关键词，并上传图片，系统会有一定几率自动识别出图片所属的作品。系统会自动识别本答案的第一张图并给出识别答案。<br />例如标题为：请问这幅画是哪部作品中的？<br />
            </small>
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
          <li><a href="<?php echo U('/Home/People/'.cookie('username'));?>">个人主页</a></li>
          <li class="am-dropdown-header">用户操作</li>
          <li><a href="<?php echo U('/Home/Inbox');?>">私信 <span class="am-badge am-badge-danger am-round msg-badge"><?php echo get_inbox_alert();?></span></a></li>
          <li><a href="#">设置</a></li>
          <li class="am-divider"></li>
          <li><a href="javascript:;" onclick="logout()">登出</a></li>
        </ul>
      </li>
    </ul>
    </div><?php endif; ?>
<script type="text/javascript">
  if(<?php echo get_inbox_alert();?> == 0) $('.msg-badge').css("display","none"); 
</script>
    <?php if(!is_login()): ?><!--提问未登录的alert-->
    <div class="am-modal am-modal-alert" tabindex="-1" id="put-question-popup">
      <div class="am-modal-dialog">
        <div class="am-modal-hd">提示</div>
        <div class="am-modal-bd">
          不好意思，您还未登录！
        </div>
        <div class="am-modal-footer">
          <span class="am-modal-btn">确定</span>
        </div>
      </div>
    </div>

    <div class="am-topbar-right">
      <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm" data-am-offcanvas="{target: '#oc-login'}">登录</button>
    </div>

    <div class="am-modal am-modal-no-btn" tabindex="-1" id="login-model">
      <div class="am-modal-dialog">
        <div class="am-modal-hd">正在登录</div>
        <div class="am-modal-bd">
          <i class="am-icon-spinner am-icon-spin"></i>
        </div>
      </div>
    </div>


        <!-- 侧边栏内容 -->
    <div id="oc-login" class="am-offcanvas">
      <div class="am-offcanvas-bar am-offcanvas-bar-flip">
        <div class="am-offcanvas-content">
          <div class="am-vertical-align" style="height: 200px;">
            <div class="am-vertical-align-middle">
            <h2>登录<br /><small>请直接使用萌百账号登录</small></h2>

            <form method="post" class="am-form">
            <label for="username">用户名:</label>
            <input type="email" name="" id="username" value="">
            <br>
            <label for="password">密码:</label>
            <input type="password" name="" id="password" value="">
            <br>
            <label for="remember-me">
              <input id="remember-me" type="checkbox">
              自动登录
            </label>
            <br />
            <div class="am-cf">
              <input type="button" name="" onclick="$('#login-model').modal('open');login();" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
              <a href="http://zh.moegirl.org/index.php?title=Special:%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95&type=signup"><input type="button" name="" value="没有账号 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr"></a>
            </div>
          </form>
            </div>
          </div>
        </div>
      </div>
    </div><?php endif; ?>

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
	
<script type="text/javascript">
	$("#topbar-find").addClass("am-active");

	var arr_24 = new Array();
	var arr_30 = new Array();

	<?php if(is_array($find_24)): foreach($find_24 as $key=>$vo): ?>arr_24[<?php echo $vo['id'];?>] = false;<?php endforeach; endif; ?>
	<?php if(is_array($find_30)): foreach($find_30 as $key=>$vo): ?>arr_30[<?php echo $vo['id'];?>] = false;<?php endforeach; endif; ?>
</script>
<title>发现 - 萌娘问答</title>

<div class="am-g">
	<div class="am-u-md-9">
		<div class="am-tabs" data-am-tabs="{noSwipe: 1}">
		  <ul class="am-tabs-nav am-nav am-nav-tabs">
		    <li class="am-active"><a href="#tab24h">24小时</a></li>
		    <li><a href="#tab30d">30天</a></li>
		  </ul>

		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-active" id="tab24h">
		    <?php if(is_array($find_24)): foreach($find_24 as $key=>$vo): ?><article class="am-comment">
			  	<div class="am-btn-group-stacked am-comment-avatar">
				  <button id="agree-answer-btn-<?php echo $vo['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['id'];?>,1)" class="am-btn am-icon-angle-up <?php echo getAnsweraction($vo['id'],1);?>"><br /></button>
				  <center id="answer-agree-numb-<?php echo $vo['id'];?>"><?php echo $vo['agree'];?></center>
				  <button id="unagree-answer-btn-<?php echo $vo['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['id'];?>,2)" class="am-btn am-icon-angle-down <?php echo getAnsweraction($vo['id'],2);?>"></button>
				</div>
			    <!--<img src="" alt="" class="am-comment-avatar" width="48" height="48"/>-->
			  
				  <div>
				    <header>
				      <!--<h3 class="am-comment-title">评论标题</h3>-->
				      <div class="am-comment-meta qustion-title-content">
				        <a href="#link-to-user" class="am-comment-author"><?php echo $vo['username'];?></a>
				        发布于 <time><?php echo $vo['time'];?></time>
				      </div>
				    </header>
				    <div class="am-comment-bd">
				    <a class="qustion-title-content" target="_blank" href="/index.php/Home/Question/<?php echo $vo['question_id'];?>/Answer/<?php echo $vo['id'];?>"><h2><?php echo get_question_title($vo['question_id']);?></h2></a>
				      <?php echo sub_question_content($vo['content']);?>

				    </div>
				    <p class="am-text-right"><a class="am-link-muted" href="javascript:;" value="<?php echo $vo['id'];?>" name="123" onClick="javascript:comment_toggle(this,'answer');"><span class="am-icon-comment"> 评论列表</span></a></p>
				  </div>
				  <div class="am-panel am-panel-default" style="display: none;" id="comment-<?php echo $vo['id'];?>">
					    <div class="am-panel-bd" id="div-comment-<?php echo $vo['id'];?>">
					    	<i class="am-icon-spinner am-icon-spin"></i>正在加载评论
					    </div>
					</div>
				  <hr />
			</article><?php endforeach; endif; ?>
		    </div>


		    <div class="am-tab-panel" id="tab30d">
		    <?php if(is_array($find_30)): foreach($find_30 as $key=>$vo): ?><article class="am-comment">
			  	<div class="am-btn-group-stacked am-comment-avatar">
				  <button id="agree-answer-btn-<?php echo $vo['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['id'];?>,1)" class="am-btn am-icon-angle-up <?php echo getAnsweraction($vo['id'],1);?>"><br /></button>
				  <center id="answer-agree-numb-<?php echo $vo['id'];?>"><?php echo $vo['agree'];?></center>
				  <button id="unagree-answer-btn-<?php echo $vo['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['id'];?>,2)" class="am-btn am-icon-angle-down <?php echo getAnsweraction($vo['id'],2);?>"></button>
				</div>
			    <!--<img src="" alt="" class="am-comment-avatar" width="48" height="48"/>-->
			  
				  <div>
				    <header>
				      <!--<h3 class="am-comment-title">评论标题</h3>-->
				      <div class="am-comment-meta qustion-title-content">
				        <a href="#link-to-user" class="am-comment-author"><?php echo $vo['username'];?></a>
				        发布于 <time><?php echo $vo['time'];?></time>
				      </div>
				    </header>
				    <div class="am-comment-bd">
				    <a class="qustion-title-content" target="_blank" href="/index.php/Home/Question/<?php echo $vo['question_id'];?>/Answer/<?php echo $vo['id'];?>"><h2><?php echo get_question_title($vo['question_id']);?></h2></a>
				      <?php echo sub_question_content($vo['content']);?>

				    </div>
				    <p class="am-text-right"><a class="am-link-muted" href="javascript:;" value="<?php echo $vo['id'];?>" name="123" onClick="javascript:comment_toggle(this,'answer');"><span class="am-icon-comment"> 评论列表</span></a></p>
				  </div>
				  <div class="am-panel am-panel-default" style="display: none;" id="comment-<?php echo $vo['id'];?>">
					    <div class="am-panel-bd" id="div-comment-<?php echo $vo['id'];?>">
					    	<i class="am-icon-spinner am-icon-spin"></i>正在加载评论
					    </div>
					</div>
				  <hr />
			</article><?php endforeach; endif; ?>
		    </div>
		  </div>
		</div>
	</div>
</div>


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
    <p>CopyRight©2014 AllMoeGirl Inc.</p>
  </div>
</footer>
	<!-- /底部 -->
</div>
<script src="/Public/js/ajaxfileupload.js"></script>
<script src="/Public/js/public.js"></script>
</body>
</html>