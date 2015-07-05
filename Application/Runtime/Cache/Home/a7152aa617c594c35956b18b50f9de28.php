<?php if (!defined('THINK_PATH')) exit();?>		<?php if($mode == 'near'): if(is_array($content)): foreach($content as $i=>$vo): if(!empty($vo['answer_content']['id'])): ?><article class="am-comment">
			  	<div class="am-comment-avatar">
				  <button id="agree-answer-btn-<?php echo $vo['answer_content']['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['answer_content']['id'];?>,1)" class="am-btn am-icon-angle-up <?php echo getAnsweraction($vo['answer_content']['id'],1);?>"><br /></button>
				  <center id="answer-agree-numb-<?php echo $vo['answer_content']['id'];?>"><?php echo $vo['answer_content']['agree'];?></center>
				  <button id="unagree-answer-btn-<?php echo $vo['answer_content']['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['answer_content']['id'];?>,2)" class="am-btn am-icon-angle-down <?php echo getAnsweraction($vo['answer_content']['id'],2);?>"></button>
				</div>
			    <!--<img src="" alt="" class="am-comment-avatar" width="48" height="48"/>-->
				  <div>
				    <header>
				      <!--<h3 class="am-comment-title">评论标题</h3>-->
				      <div class="am-comment-meta qustion-title-content">
				        <a target="_blank" href="<?php echo U('/Home/People/'.$vo['answer_content']['username']);?>" class="am-comment-author"><?php echo $vo['answer_content']['username'];?></a>
				        发布于 <time><?php echo $vo['answer_content']['time'];?></time>
				      </div>
				    </header>
				    <div class="am-comment-bd">
				    <a class="qustion-title-content am-text-truncate" target="_blank" href="/index.php/Home/Question/<?php echo $vo['id'];?>/Answer/<?php echo $vo['answer_content']['id'];?>"><h2><?php echo $vo['title'];?></h2></a>
				      <?php echo sub_question_content($vo['answer_content']['content']);?>
				    </div>
				    <p class="am-text-right"><a class="am-link-muted" href="javascript:;" value="<?php echo $vo['answer_content']['id'];?>" name="123" onClick="javascript:comment_toggle(this,'answer');"><span class="am-icon-comment"> 评论列表</span></a></p>
				  </div>
				  <div class="am-panel am-panel-default" style="display: none;" id="comment-<?php echo $vo['answer_content']['id'];?>">
					    <div class="am-panel-bd" id="div-comment-<?php echo $vo['answer_content']['id'];?>">
					    	<i class="am-icon-spinner am-icon-spin"></i>正在加载评论
					    </div>
					</div>
				  <hr />
			</article><?php endif; endforeach; endif; ?>
		<?php elseif($mode == 'hot'): ?>
			<?php if(is_array($content)): foreach($content as $i=>$vo): if(!empty($vo['id'])): ?><article class="am-comment">
			  	<div class="am-comment-avatar">
				  <button id="agree-answer-btn-<?php echo $vo['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['id'];?>,1)" class="am-btn am-icon-angle-up <?php echo getAnsweraction($vo['id'],1);?>"><br /></button>
				  <center id="answer-agree-numb-<?php echo $vo['id'];?>"><?php echo $vo['agree'];?></center>
				  <button id="unagree-answer-btn-<?php echo $vo['id'];?>" type="button" onclick="agree_answer(<?php echo $vo['id'];?>,2)" class="am-btn am-icon-angle-down <?php echo getAnsweraction($vo['id'],2);?>"></button>
				</div>
			    <!--<img src="" alt="" class="am-comment-avatar" width="48" height="48"/>-->
			  
				  <div>
				    <header>
				      <!--<h3 class="am-comment-title">评论标题</h3>-->
				      <div class="am-comment-meta qustion-title-content">
				        <a href="<?php echo get_user_page($vo['username']);?>" class="am-comment-author"><?php echo $vo['username'];?></a>
				        发布于 <time><?php echo $vo['time'];?></time>
				      </div>
				    </header>
				    <div class="am-comment-bd">
				    <a class="qustion-title-content am-text-truncate" target="_blank" href="/index.php/Home/Question/<?php echo $vo['question_id'];?>/Answer/<?php echo $vo['id'];?>"><h2><?php echo get_question_title($vo['question_id']);?></h2></a>
				      <?php echo sub_question_content($vo['content']);?>

				    </div>
				    <p class="am-text-right"><a class="am-link-muted" href="javascript:;" value="<?php echo $vo['id'];?>" name="123" onClick="javascript:comment_toggle(this,'answer');"><span class="am-icon-comment"> 评论列表</span></a></p>
				  </div>
				  <div class="am-panel am-panel-default" style="display: none;" id="comment-<?php echo $vo['id'];?>">
					    <div class="am-panel-bd" id="div-comment-<?php echo $vo['id'];?>">
					    	<i class="am-icon-spinner am-icon-spin"></i>正在加载评论
					    </div>
					</div>
				  <hr />
			</article><?php endif; endforeach; endif; ?>
		<?php else: ?>
			<?php if(is_array($content)): foreach($content as $i=>$vo): ?><small><div class="am-link-muted">
				    <?php echo $vo['anonymous']?'匿名用户 ':'<a href="'.get_user_page($vo['username']).'">'.$vo['username'].' </a>';?>
					提交于 <time><?php echo $vo['time'];?></time>
				</div></small>
				<a target="_blank" href="/index.php/Home/Question/<?php echo $vo['id'];?>"><h2><?php echo $vo['title'];?></h2></a>
				<hr /><?php endforeach; endif; endif; ?>

		<?php if(empty($content)): ?><div class="am-alert am-alert-success" data-am-alert>
			  <p class="am-text-center">没有更多的内容了</p>
			</div>
		<?php else: ?>
			<div id="topic_load_more"><button type="button" id="load_more_btn" class="am-btn am-btn-default am-btn-block btn-loading" onclick="get_content(<?php echo $tid;?>,'<?php echo $mode;?>',<?php echo $next_page;?>)">加载更多</button></div><?php endif; ?>