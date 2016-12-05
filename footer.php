<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
</div><!--end #content-->
<hr/>
<div class="row show-for-medium-up" id="footer">
	<div class="small-12 columns">
		<div class="row">
			<div class="small-4 columns">
				<h4><a href="<?php echo BLOG_URL; ?>"><img src="<?php echo SS_ADDR_LOGO; ?>"></img>
				<span id="title"><?php echo $blogname; ?></span></a>
				</h4>
				<div class="size-14"><?php echo $bloginfo; ?></div>
				<p class="size-14">
					备案号:
					<a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a> 
					Powered by <a href="http://www.emlog.net" target="_blank">Emlog</a>
					Themed by <a href="http://www.pinruan.net/misc/33.html" title="品软网出品">SweetSlayer</a>
					
					<?php echo $footer_info; ?>
				</p>
			</div>
			<div class="small-6 columns">
				<?php widget_newcomm("评论");?>
			</div>
			<div class="small-2 columns">
				<?php 
				$text='<li><a href="'.SS_ADDR_QQ.'">QQ留言</a></li>
					<li><a href="'.SS_ADDR_TWITTER.'" target="_blank">Twitter</a></li>
					<li><a href="'.SS_ADDR_GITHUB.'" target="_blank">Github</a></li>
					<li><a href="'.SS_ADDR_OSC.'" target="_blank">OSC</a></li>
					<li><a href="'.SS_ADDR_ABOUT.'">关于本站</a></li>';
				widget_custom_text("关于",$text); ?>
			</div>
		</div>
		<div class="small-8 columns">

			<?php doAction('index_footer'); ?>
		</div>
	</div>
	
</div><!--end id=footer -->
<div id="copyright">版权所有 <?php echo $blogname;?>&copy;2014-<?php echo date('Y'); ?></div>
<!--end in header.php -->
<script>
$(document).foundation();
prettyPrint();
</script>
</body>
</html>