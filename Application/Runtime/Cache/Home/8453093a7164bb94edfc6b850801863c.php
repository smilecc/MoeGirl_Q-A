<?php if (!defined('THINK_PATH')) exit(); if(is_array($comment)): foreach($comment as $i=>$vo): ?><p><?php echo $vo['username'];?><span class="am-fr"><?php echo $vo['time'];?></span><br /><?php echo $vo['content'];?><hr /></p><?php endforeach; endif; ?>
<?php if(count($comment) == 0): ?><div class="am-alert">
	  一条评论也木有
	</div><?php endif; ?>
<hr />
<label>评论:</label>
<textarea class="am-form-field am-radius" rows="3" id="put-comment-content-<?php echo $project_id;?>" name="content"></textarea>
<p class="am-text-right"><button type="button" class="am-btn am-btn-success am-radius" onclick="put_comment(<?php echo $project_id;?>,'<?php echo $mode;?>')">提交</button></p>