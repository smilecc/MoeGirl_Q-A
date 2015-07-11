<?php if (!defined('THINK_PATH')) exit(); if(is_array($comment)): foreach($comment as $i=>$vo): ?><p class="js-comment" value="<?php echo $vo['id'];?>"><a target="_blank" href="<?php echo GetUserPage($vo['username']);?>"><?php echo $vo['username'];?></a><span class="am-fr"><a style="display:none;" id="js-comment-<?php echo $vo['id'];?>" href="javascript:;" user="<?php echo $vo['username'];?>" onclick="CommemtAddAtuser(<?php echo $project_id;?>,this)">回复Ta</a> <span><?php echo $vo['time'];?></span></span><br /><?php echo ParseMdLine($vo['content']);?><hr /></p><?php endforeach; endif; ?>
<?php if(count($comment) == 0): ?><div class="am-alert">
	  一条评论也木有
	</div><?php endif; ?>
<label>评论:</label>
<textarea class="am-form-field am-radius" rows="3" id="put-comment-content-<?php echo $project_id;?>" name="content"></textarea>
<p class="am-text-right"><button type="button" class="am-btn am-btn-success am-radius" onclick="put_comment(<?php echo $project_id;?>,'<?php echo $mode;?>')">提交</button></p>
<script type="text/javascript">
$('.js-comment').hover(
		function(){
			$('#js-comment-'+$(this).attr('value')).show();
		},
		function(){
			$('#js-comment-'+$(this).attr('value')).hide();
		}
	);
</script>