<?php if (!defined('THINK_PATH')) exit();?>这些用户最近关注了你<hr />
<?php if(is_array($timeline)): foreach($timeline as $i=>$user): ?><div class="am-text-right">
<a target="_blank" href="<?php echo U('/Home/People/'.$user['fromusername']);?>"><?php echo $user['fromusername'];?></a>
<button type="button" class="follow-btn-<?php echo $user['fromusername'];?> am-btn <?php echo $user['is_follow']?'':'am-btn-success';?> am-radius <?php echo $user['is_follow'] == 3?'am-icon-retweet':'';?>" onclick="follow_user('<?php echo cookie('username');?>','<?php echo $user['fromusername'];?>')"><?php echo $user['is_follow'] == 3?' ':''; echo $user['is_follow']?'取消关注':'关注TA';?></button></div><hr /><?php endforeach; endif; ?>
	
<div class="am-alert am-alert-success" data-am-alert>
	  <p class="am-text-center">没有更多的内容了</p>
</div>