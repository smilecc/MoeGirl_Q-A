<?php if (!defined('THINK_PATH')) exit();?>	<?php if(is_array($timeline)): foreach($timeline as $i=>$vo): if($vo['mode'] == 2): ?><article class="am-comment">
				  	<div class="am-btn-group-stacked am-comment-avatar">
					  <button id="agree-answer-btn-<?php echo $vo['content']['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['content']['id'];?>,1)" class="am-btn am-icon-angle-up <?php echo getAnsweraction($vo['content']['id'],1);?>"><br /></button>
					  <center id="answer-agree-numb-<?php echo $vo['content']['id'];?>"><?php echo $vo['content']['agree'];?></center>
					  <button id="unagree-answer-btn-<?php echo $vo['content']['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['content']['id'];?>,2)" class="am-btn am-icon-angle-down <?php echo getAnsweraction($vo['content']['id'],2);?>"></button>
					</div>
				    <!--<img src="" alt="" class="am-comment-avatar" width="48" height="48"/>-->
					  <div>
					    <header>
					      <!--<h3 class="am-comment-title">评论标题</h3>-->
					      <small><div class="am-link-muted"><span class="am-fr"><time><?php echo $vo['pushtime'];?></time></span></div></small>
					      <div class="am-comment-meta qustion-title-content">
					      <?php if(count($vo['us_array']) == 1): ?><a target="_blank" href="<?php echo U('/Home/People/'.$vo['content']['username']);?>" class="am-comment-author"><?php echo $vo['username'];?></a>
					      <?php else: ?>
					      	<?php if(is_array($vo['us_array'])): $j = 0; $__LIST__ = $vo['us_array'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$usname): $mod = ($j % 2 );++$j;?><a target="_blank" href="<?php echo U('/Home/People/'.$us);?>" class="am-comment-author"><?php echo $us;?></a>
					      		<?php if(j == 3): ?>等人<?php break; endif; ?>、<?php endforeach; endif; else: echo "" ;endif; endif; ?>
					        <?php if($vo['status'] == 1): ?>提交了<?php elseif($vo['status'] == 2): ?>赞同了<?php else: ?>推送了<?php endif; ?>回答
					      </div>
					    </header>
					    <div class="am-comment-bd">
					    <a class="qustion-title-content am-text-truncate" target="_blank" href="/index.php/Home/Question/<?php echo $vo['content']['question_id'];?>/Answer/<?php echo $vo['content']['id'];?>"><h2><?php echo $vo['content']['question_title'];?></h2></a>
					    <?php if($vo['status'] != 1): echo $vo['content']['username'];?><br /><?php endif; ?>
					      <?php echo sub_question_content($vo['content']['content']);?>
					    </div>
					    <p class="am-text-right"><a class="am-link-muted" href="javascript:;" value="<?php echo $vo['content']['id'];?>" name="123" onClick="javascript:comment_toggle(this,'answer');"><span class="am-icon-comment"> 评论列表</span></a></p>
					  </div>
					  <div class="am-panel am-panel-default" style="display: none;" id="comment-<?php echo $vo['content']['id'];?>">
						    <div class="am-panel-bd" id="div-comment-<?php echo $vo['content']['id'];?>">
						    	<i class="am-icon-spinner am-icon-spin"></i>正在加载评论
						    </div>
						</div>
					  <hr />
				</article>
			<?php else: ?>
				<small><div class="am-link-muted">
				    <a href="#link-to-user"><?php echo $vo['username'];?></a>
					<?php if($vo['status'] == 1): ?>提了一个问题<?php elseif($vo['status'] == 2): ?>关注了问题<?php else: ?>推送了问题<?php endif; ?> <span class="am-fr"><time><?php echo $vo['pushtime'];?></time></span>
				</div></small>
				<a target="_blank" href="/index.php/Home/Question/<?php echo $vo['content']['id'];?>"><h2><?php echo $vo['content']['title'];?></h2></a>
				<hr /><?php endif; endforeach; endif; ?>
		
		<?php if(empty($timeline)): ?><div class="am-alert am-alert-success" data-am-alert>
			  <p class="am-text-center">没有更多的内容了</p>
			</div>
		<?php else: ?>
			<div id="index_load_more"><button type="button" id="load_more_btn" class="am-btn am-btn-default am-btn-block btn-loading" onclick="get_timeline(<?php echo $next_page;?>)">加载更多</button></div><?php endif; ?>