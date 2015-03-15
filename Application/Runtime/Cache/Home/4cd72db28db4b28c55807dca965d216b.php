<?php if (!defined('THINK_PATH')) exit();?>	<?php if(is_array($timeline)): foreach($timeline as $i=>$vo): if(count($vo['us_array']) == 1): ?><a target="_blank" href="<?php echo U('/Home/People/'.$vo['fromusername']);?>" class="am-comment-author"><?php echo $vo['fromusername'];?></a>
      <?php else: ?>
      	<?php if(is_array($vo['us_array'])): $j = 0; $__LIST__ = $vo['us_array'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$usname): $mod = ($j % 2 );++$j;?><a target="_blank" href="<?php echo U('/Home/People/'.$us);?>" class="am-comment-author"><?php echo $us;?></a>
      		<?php if(j == 3): ?>等人<?php break; endif; ?>、<?php endforeach; endif; else: echo "" ;endif; endif; ?>
      <?php if($vo['type'] == 1): ?>回答了问题 <?php elseif($vo['type'] == 2): ?> 评论了你在问题<?php endif; ?>
      <a target="_blank" href="/index.php/Home/Question/<?php echo $vo['question_id'];?>/Answer/<?php echo $vo['answer_id'];?>"><?php echo get_question_title($vo['question_id']);?></a><?php if($vo['type'] == 2): ?>下的回答<?php endif; ?>
      <hr /><?php endforeach; endif; ?>
		
	<div class="am-alert am-alert-success" data-am-alert>
		  <p class="am-text-center">没有更多的内容了</p>
	</div>