<?php 
/**
 * 上部标签云 和 搜索 控件
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="row">
	<div class="medium-8 columns show-for-medium-up" id="tag-widget">
		<?php echo pr_tags(); ?>
	</div>
	<div class="medium-4 columns" id="search-widget">
		<?php echo pr_search(); ?>
	</div>
	<hr>
</div>