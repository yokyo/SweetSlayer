<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
include View::getView('top_widgets');
?>

<div class="row">
<div class="small-12 columns">
<?php doAction('index_loglist_top'); ?>

<?php 
if (!empty($logs)):
foreach($logs as $value): 
?>
	<h5><?php topflg($value['top'], $value['sortop'], isset($sortid)?$sortid:''); ?>
	<a href="<?php echo $value['log_url']; ?>" class="post_title">
		<?php echo $value['log_title']; ?>
		<span class="right"><i class="fi-foot size-20"></i>
		<span class="comnum"><?php echo $value['views']; ?></span></span>
	</a>
	</h5>

	<p class="post_item">
	<?php //blog_sort($value['logid']); ?>&nbsp;
	<?php blog_time($value['date']); ?>&nbsp;
	<?php blog_tag($value['logid']); ?>&nbsp;
	<!--?php blog_author($value['author']); ?-->
	
	<?php editflg($value['logid'],$value['author']); ?>

	</p>
	<p class="post_desc">
	<?php $desc=$value['log_description'];
		$desc = substr($desc,0,strpos($desc,"<p class=\"readmore\">"));
		echo $desc;//$value['log_description']; ?>
	</p>
	<!--浏览评论量p class="count">
	<a href="<?php echo $value['log_url']; ?>#comments">评论(<?php echo $value['comnum']; ?>)</a>
	<a href="<?php echo $value['log_url']; ?>">浏览(<?php echo $value['views']; ?>)</a>
	</p-->
	<hr/>
<?php 
endforeach;

else:
?>
	<h4>恭喜</h4>
	<p>您来到了一个一片荒原。</p>
<?php endif;?>

<div class="pagination-centered">
	<ul class="pagination">
	<?php echo pr_paging($lognum, $index_lognum, $page, $pageurl); // 翻页?>
	</ul>
</div>

</div><!-- end #contentleft-->
<?php
 //include View::getView('side');
 include View::getView('footer');
?>