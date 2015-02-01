<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
</head>
<body>
	<!-- 头部 -->
	

<header class="am-topbar">
<div class="am-container">
  <h1 class="am-topbar-brand">
    <a href="#">萌娘问答</a>
  </h1>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="am-active"><a href="#">首页</a></li>
      <li><a href="#">发现</a></li>
    </ul>

    <form class="am-topbar-form am-topbar-left am-form-inline" role="search">
      <div class="am-form-group">
        <input type="text" class="am-form-field am-input-sm" placeholder="搜索">
      </div>
    </form>
    <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm" data-am-modal="{target: '#put-question-popup'}">提问</button>

  <?php if(is_login()): ?><!--提问窗口-->
    <div class="am-popup" id="put-question-popup">
      <div class="am-popup-inner">
        <div class="am-popup-hd">
          <h4 class="am-popup-title">提问</h4>
          <span data-am-modal-close
                class="am-close">&times;</span>
        </div>
        <form>
          <div class="am-popup-bd">
            <p>提示：如果是询问图片所属作品可以在标题中包含“是哪部作品”的关键词，并上传图片，系统会有一定几率自动识别出图片所属的作品。</p>
            <p>例如标题为：请问这幅画是哪部作品中的？</p>
            <p>系统会自动识别本答案的第一张图并给出识别答案。
            如果问题不包含图片则不识别。
            </p>
            <hr />
            <input type="text" class="am-form-field am-round" id="put-question-title" placeholder="输入问题的标题">
            <hr />
             <div class="am-form-group">
              <label for="doc-ta-1">问题描述（选填）：</label>
              <textarea class="am-form-field am-radius" rows="10" id="put-qustion-content"></textarea>
            </div>
            <label for="remember-me">
              <input id="put-question-anonymous" type="checkbox">
              匿名
            </label>
            <button type="button" class="am-btn am-btn-primary am-fr">提交</button>
           </div>
        </form>
      </div>
    </div>

  <div class="am-collapse am-topbar-collapse am-topbar-right" id="doc-topbar-user">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <?php echo $username;?> <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li class="am-dropdown-header">用户操作</li>
          <li><a href="#">设置</a></li>
          <li class="am-divider"></li>
          <li><a href="javascript:;" onclick="logout()">登出</a></li>
        </ul>
      </li>
    </ul><?php endif; ?>

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



	<!-- /头部 -->

	<!-- 主体 -->
	<div class="am-container">
	
<title>首页 - 萌娘问答</title>

  <p>Hello world</p>



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


<!--
<script type="text/javascript">
  document.getElementById("space_height").style.cssText="height:"+(document.body.scrollHeight-160)+"px";
</script>
-->
	<!-- /底部 -->

<script src="/Public/js/public.js"></script>
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/Public/assets/js/jquery.min.js"></script>
<script src="/Public/assets/js/amazeui.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->
</body>
</html>