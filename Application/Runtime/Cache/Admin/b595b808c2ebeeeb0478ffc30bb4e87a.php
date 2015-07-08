<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<?php $auto_login = new \User\Api\UserApi; $auto_login->autologin(); if(!CheckAdmin()) { echo "Pemission Error,You cannot view this page.<br /><a href='/'>Click here goto Index</a>"; exit; } ?>
<html class="no-js">
<head>
	<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo C('SITE_TITLE');?> Admin Center</title>
  <meta name="description" content="这是一个 index 页面">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="/Public/css/pnotify.custom.min.css"/>
  <link rel="stylesheet" href="/Public/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="/Public/css/admin.css">
  <link rel="stylesheet" href="/Public/assets/css/app.css">
  <link rel="stylesheet" href="/Public/css/public.css">

  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="/Public/assets/js/jquery.min.js"></script>
  <!--<script type="text/javascript" src="/Public/bootstrap/js/bootstrap.min.js"></script>-->
  <script src="/Public/assets/js/amazeui.min.js"></script>
  <script src="/Public/js/notify.js"></script>
  <script src="/Public/js/admin.js"></script>
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
    <strong><?php echo C('SITE_TITLE');?></strong> <small>Admin Center</small>
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
        <li><a href="<?php echo U('/Admin/Find');?>"><span class="am-icon-table"></span> 发现</a></li>
        <li><a href="<?php echo U('/Admin/Setting');?>"><span class="am-icon-pencil-square-o"></span> 设置</a></li>
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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>Index</small></div>
    </div>

    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><span class="am-icon-btn am-icon-file-text"></span><br/>共有问题<br/><?php echo $page['questionCount'];?></li>
      <li><span class="am-icon-btn am-icon-briefcase"></span><br/>共有回答<br/><?php echo $page['answerCount'];?></li>
      <li><span class="am-icon-btn am-icon-recycle"></span><br/>话题数量<br/><?php echo $page['topicCount'];?></li>
      <li><span class="am-icon-btn am-icon-user-md"></span><br/>拥有用户<br/><?php echo $page['userCount'];?></li>
    </ul>

    <div class="am-g">
      <div class="am-u-md-6">
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">管理员列表<span class="am-icon-chevron-down am-fr" ></span></div>
          <div id="collapse-panel-2" class="am-in">
            <table class="am-table am-table-bd am-table-bdrs am-table-striped am-table-hover">
              <tbody>
              
              <tr>
                <th class="am-text-center">#</th>
                <th>用户名</th>
                <th>组</th>
              </tr>
              
              <?php if(is_array($page['adminList'])): foreach($page['adminList'] as $k=>$vo): ?><tr>
                <td class="am-text-center"><?php echo $k;?></td>
                <td><?php echo $vo['username'];?></td>
                <td><?php echo $vo['pemission'];?></td>
              </tr><?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">文件上传<span class="am-icon-chevron-down am-fr" ></span></div>
          <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <ul class="am-list admin-content-file">
              <li>
                <strong><span class="am-icon-upload"></span> Kong-cetian.Mp3</strong>
                <p>3.3 of 5MB - 5 mins - 1MB/Sec</p>
                <div class="am-progress am-progress-striped am-progress-sm am-active">
                  <div class="am-progress-bar am-progress-bar-success" style="width: 82%">82%</div>
                </div>
              </li>
              <li>
                <strong><span class="am-icon-check"></span> 好人-cetian.Mp3</strong>
                <p>3.3 of 5MB - 5 mins - 3MB/Sec</p>
              </li>
              <li>
                <strong><span class="am-icon-check"></span> 其实都没有.Mp3</strong>
                <p>3.3 of 5MB - 5 mins - 3MB/Sec</p>
              </li>
            </ul>
          </div>
        </div>

      </div>

      <div class="am-u-md-6">
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-4'}">任务 task<span class="am-icon-chevron-down am-fr" ></span></div>
          <div id="collapse-panel-4" class="am-panel-bd am-collapse am-in">
            <ul class="am-list admin-content-task">
              <li>
                <div class="admin-task-meta"> Posted on 25/1/2120 by John Clark</div>
                <div class="admin-task-bd">
                  The starting place for exploring business management; helping new managers get started and experienced managers get better.
                </div>
                <div class="am-cf">
                  <div class="am-btn-toolbar am-fl">
                    <div class="am-btn-group am-btn-group-xs">
                      <button type="button" class="am-btn am-btn-default"><span class="am-icon-check"></span></button>
                      <button type="button" class="am-btn am-btn-default"><span class="am-icon-pencil"></span></button>
                      <button type="button" class="am-btn am-btn-default"><span class="am-icon-times"></span></button>
                    </div>
                  </div>
                  <div class="am-fr">
                    <button type="button" class="am-btn am-btn-default am-btn-xs">删除</button>
                  </div>
                </div>
              </li>
              <li>
                <div class="admin-task-meta"> Posted on 25/1/2120 by 呵呵呵</div>
                <div class="admin-task-bd">
                  基兰和狗熊出现在不同阵营时。基兰会获得BUFF，“装甲熊憎恨者”。狗熊会获得BUFF，“时光老人憎恨者”。
                </div>
                <div class="am-cf">
                  <div class="am-btn-toolbar am-fl">
                    <div class="am-btn-group am-btn-group-xs">
                      <button type="button" class="am-btn am-btn-default"><span class="am-icon-check"></span></button>
                      <button type="button" class="am-btn am-btn-default"><span class="am-icon-pencil"></span></button>
                      <button type="button" class="am-btn am-btn-default"><span class="am-icon-times"></span></button>
                    </div>
                  </div>
                  <div class="am-fr">
                    <button type="button" class="am-btn am-btn-default am-btn-xs">删除</button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>


      </div>
    </div>
  </div>




	<!-- /主体 -->

	<!-- 底部 -->
	</div>
<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
</footer>
	<!-- /底部 -->
</body>
</html>