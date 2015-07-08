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
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">发现</strong> / <small>Find</small></div>
    </div>

<div class="am-modal am-modal-prompt" tabindex="-1" id="find-add-prompt">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">增加条目</div>
    <div class="am-modal-bd am-form-set am-form">
      <input type="text" id="input-find-add-answerid" placeholder="AnswerID">
      <input type="text" id="input-find-add-order" placeholder="优先级">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
    </div>
  </div>
</div>

<div class="am-modal am-modal-prompt" tabindex="-1" id="find-edit-prompt">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">修改条目</div>
    <div class="am-modal-bd am-form-set am-form">
      <input type="text" id="input-find-edit-answerid" placeholder="AnswerID">
      <input type="text" id="input-find-edit-order" placeholder="优先级">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
    </div>
  </div>
</div>

    <div class="am-g">
      <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
          <div class="am-btn-group am-btn-group-xs">
            <button type="button" class="am-btn am-btn-default" id="btn-add-find"><span class="am-icon-plus"></span> 新增</button>
            <!--<button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>-->
          </div>
        </div>
      </div>
    </div>

    <div class="am-g">
      <div class="am-u-sm-12">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check">
                  <input type="checkbox" />
                </th>
                <th class="table-id">AnswerID</th>
                <th class="table-title">标题</th>
                <th class="table-type">优先级</th>
                <th class="table-author am-hide-sm-only">作者</th>
                <!--<th class="table-date am-hide-sm-only">修改日期</th>-->
                <th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>

          <?php if(is_array($findList)): $i = 0; $__LIST__ = $findList;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="find-list-tr-<?php echo $vo['id'];?>">
              <td><input type="checkbox" /></td>
              <td id="find-list-answerid-<?php echo $vo['id'];?>"><?php echo $vo['answer_id'];?></td>
              <td>
              <a href="javascript:;" data-am-collapse="{target: '#find-answer-<?php echo $vo['id'] ?>'}"><?php echo get_question_title($vo['answer_question_id']);?></a>
                <div id="find-answer-<?php echo $vo['id'];?>" class="am-collapse">
                  <?php echo $vo['answer_sub'];?>..
                  <br/><a target="_blank" href="<?php echo U('/Home/Question/'.$vo['answer_question_id'].'/Answer/'.$vo['answer_id']);?>">查看全部</a>
                </div>
              </td>
              <td id="find-list-order-<?php echo $vo['id'];?>"><?php echo $vo['orderNumber'];?></td>
              <td class="am-hide-sm-only"><?php echo $vo['answer_author'];?></td>
              <!--<td class="am-hide-sm-only">2014年9月4日 7:28:47</td>-->
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="EditFindBtnClick(<?php echo $vo['id'];?>)"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onClick="DeleteFindBtnClick(<?php echo $vo['id'];?>)"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>

          </tbody>
        </table>
          <div class="am-cf">共 <?php echo ($findCount); ?> 条记录</div>
          <hr />
          <p>注：增加或修改以后需要手动刷新一下....</p>
      </div>

    </div>
  </div>
  <!-- content end -->
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