<?php if (!defined('THINK_PATH')) exit();?>	<?php if(is_array($timeline)): foreach($timeline as $i=>$vo): if($vo['type'] == 1): if(count($vo['us_array']) == 1): ?><a target="_blank" href="<?php echo GetUserPage($vo['fromusername']);?>" class="am-comment-author"><?php echo $vo['fromusername'];?></a>
            <?php else: ?>
                  <?php if(is_array($vo['us_array'])): $j = 0; $__LIST__ = array_slice($vo['us_array'],0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$usname): $mod = ($j % 2 );++$j;?><a target="_blank" href="<?php echo GetUserPage($usname);?>" class="am-comment-author"><?php echo $usname;?></a>
                        <?php if($j < count($vo['us_array'])): ?>、<?php endif; ?>
                        <?php if($j == 3): print_r() ?>等<?php echo count($vo['us_array']);?>人<?php endif; endforeach; endif; else: echo "" ;endif; endif; ?> 回答了问题 <strong>
                  <a target="_blank" href="/index.php/Home/Question/<?php echo $vo['question_id'];?>/Answer/<?php if(count($vo['answer_array']) == 1): echo $vo['answer_id']; else: if(is_array($vo['answer_array'])): foreach($vo['answer_array'] as $key=>$ansvo): echo $ansvo;?>|<?php endforeach; endif; endif; ?>"><?php echo get_question_title($vo['question_id']);?></a> 下的回答
            </strong>
      </strong>
      <?php elseif($vo['type'] == 2): ?><a target="_blank" href="<?php echo GetUserPage($vo['fromusername']);?>" class="am-comment-author"><?php echo $vo['fromusername'];?></a> 评论了你在问题 <strong>
            <a target="_blank" href="/index.php/Home/Question/<?php echo $vo['question_id'];?>/Answer/<?php echo $vo['answer_id'];?>"><?php echo get_question_title($vo['question_id']);?></a>
            </strong> 下的回答
      <?php elseif($vo['type'] == 3): ?> <a target="_blank" href="<?php echo GetUserPage($vo['fromusername']);?>"><?php echo $vo['fromusername'];?> </a>在提问问题 <strong>
            <a target="_blank" href="/index.php/Home/Question/<?php echo $vo['question_id'];?>"><?php echo get_question_title($vo['question_id']);?></a>
            </strong> 的时候召唤了你
      <?php elseif($vo['type'] == 4): ?> <a target="_blank" href="<?php echo GetUserPage($vo['fromusername']);?>"><?php echo $vo['fromusername'];?> </a>在回答问题 <strong>
            <a target="_blank" href="/index.php/Home/Question/<?php echo $vo['question_id'];?>/Answer/<?php echo $vo['answer_id'];?>"><?php echo get_question_title($vo['question_id']);?></a>
            </strong> 的时候召唤了你
      <?php elseif($vo['type'] == 5): ?> <a target="_blank" href="<?php echo GetUserPage($vo['fromusername']);?>"><?php echo $vo['fromusername'];?> </a>在评论问题 <strong>
            <a target="_blank" href="/index.php/Home/Question/<?php echo $vo['question_id'];?>/Answer/<?php echo $vo['answer_id'];?>"><?php echo get_question_title($vo['question_id']);?></a>
            </strong> 中的某一回答的时候召唤了你<?php endif; ?>
      <hr /><?php endforeach; endif; ?>
		
	<div class="am-alert am-alert-success" data-am-alert>
		  <p class="am-text-center">没有更多的内容了</p>
	</div>