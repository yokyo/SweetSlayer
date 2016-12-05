<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="height-20"></div>
<div class="row">
<div class="small-12 columns">
	<h4 class="center"><span class="post_title"><?php echo $log_title; ?></span></h4>
	<hr>
	<?php echo $log_content; ?>
	<?php blog_comments($comments); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
</div><!--end #contentleft-->
<?php
 //include View::getView('side');
 include View::getView('footer');
?>