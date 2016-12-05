<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
include View::getView('top_widgets');
?>
<div class="row">
	<div class="small-12 columns">
		<h4><span class="post_title center"><?php topflg($top); ?><?php echo $log_title; ?></span></h4>
		<p class="post_item page_post_item">
			<?php blog_author($author); ?>&nbsp;
			<?php blog_sort($logid); ?>&nbsp;
			<?php blog_time($date); ?>&nbsp;
			<?php blog_tag($logid); ?>&nbsp;
			<?php editflg($logid,$author); ?></p>
			<?php echo $log_content; ?>

			<hr/>
				<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
				<?php blog_comments($comments); ?>
				<?php doAction('log_related', $logData); ?>
				<!--div class="nextlog"><?php neighbor_log($neighborLog); ?></div-->
	</div><!--end #contentleft-->
			<?php
 //include View::getView('side');
			include View::getView('footer');
			?>