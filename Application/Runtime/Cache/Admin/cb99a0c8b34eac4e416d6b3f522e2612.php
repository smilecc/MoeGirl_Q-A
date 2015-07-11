<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<?php $auto_login = new \User\Api\UserApi; $auto_login->autologin(); if(!test_user()) { header("Location: /User/Login?from=".$_SERVER['PHP_SELF'].$_SERVER["QUERY_STRING"]); exit; } if(!CheckAdmin()) { echo "Pemission Error,You cannot view this page.<a href='/'>Click here goto Index</a>"; exit; } ?>
<html class="no-js">
<head>
	<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>萌娘问答 Admin Center</title>
  <meta name="description" content="这是一个 index 页面">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="/Public/css/pnotify.custom.min.css"/>
  <link href="/Public/css/font-awesome.css" rel="stylesheet" type="text/css"/>
  <!--<link href="/Public/bootstrap/css/bootstrap.css" id="bootstrap-css" rel="stylesheet" type="text/css"/>-->
  <link rel="stylesheet" href="/Public/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="/Public/css/admin.css">
  <link rel="stylesheet" href="/Public/assets/css/app.css">
  <link rel="stylesheet" href="/Public/css/public.css">

  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="/Public/assets/js/jquery.min.js"></script>
  <!--<script type="text/javascript" src="/Public/bootstrap/js/bootstrap.min.js"></script>-->
  <script src="/Public/assets/js/amazeui.min.js"></script>
  <script src="/Public/js/pnotify.custom.min.js"></script>
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，萌娘问答 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->


</head>
<body>
 
	<!-- 头部 -->
	<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>萌娘问答</strong> <small>Admin Center</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      
    </ul>

  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="<?php echo U('/Admin/Index');?>"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 页面 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
            <li><a href="<?php echo U('/Admin/Help');?>"><span class="am-icon-puzzle-piece"></span> 帮助页</a></li>

          </ul>
        </li>
        <li><a href="<?php echo U('/Admin/Setting');?>"><span class="am-icon-pencil-square-o"></span> 设置</a></li>
        <li><a href="<?php echo U('/Admin/Find');?>"><span class="am-icon-table"></span> 发现设置</a></li>
        <li><a href="<?php echo U('/');?>"><span class="am-icon-sign-out"></span> 返回主站</a></li>
      </ul>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p>一切慢慢来。</p>
        </div>
      </div>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-tag"></span> 啦啦啦</p>
          <p>闭眼随便过，睁眼将就活，我们的生活多美好</p>
        </div>
      </div>
    </div>
  </div>
  <!-- sidebar end -->
	<!-- /头部 -->

	<!-- 主体 -->

	

  <!-- content start -->
  <div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">帮助页面</strong> / <small>Help Page</small></div>
    </div>

    <hr/>

    <div class="am-g">
      <div class="am-u-sm-12 am-u-sm-centered">
        <h2>Amaze UI 1.0.0 Beta</h2>
        <p>对于 Amaze UI，我们不是创造者。</p>
        <p>Amaze UI 的诞生，依托于 GitHub 及其他技术社区上一些优秀的资源；Amaze UI 的成长，则离不开用户的支持。</p>
        <p>感谢开源！感谢有你！</p>
        <hr/>
      </div>

      <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
        <h3>Bug 反馈</h3>
        <p>感谢对 Amaze UI 的关注和支持，如遇到 Bug 或者使用问题，可以通过以下途径反馈给我们：</p>
        <ol>
          <li>在 GitHub 项目主页提交 <a href="">Issue</a>。</li>
          <li>在 GitHub 项目主页提交 <a href="">Issue</a>。</li>
        </ol>
        <p>反馈注意事项</p>
        <p>为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。</p>
        <p>下面的几个链接是我们在几个在线调试工具上建的页面， 已经引入了 Amaze UI 样式和脚本，你可以选择你喜欢的工具【Fork】一份， 把要有问题的场景粘在里面，反馈给我们。</p>
        <ol>
          <li><a href="http://jsbin.com/kijiqu/1/edit?html,output" target="_blank">JSBin</a> </li>
          <li><a href="http://jsfiddle.net/hegfirose/W22fV/" target="_blank">JSFiddle</a> </li>
          <li><a href="http://codepen.io/minwe/pen/AEeup" target="_blank">CodePen</a> </li>
        </ol>
      </div>
    </div>
  </div>
  <!-- content end -->



	<!-- /主体 -->

	<!-- 底部 -->
	</div>
<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
</footer>
	<!-- /底部 -->

</body>
</html>