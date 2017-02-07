<?php 

/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
require_once('ssconfig.php');
?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="bloggerinfo">
	<div id="bloggerinfoimg">
	<?php if (!empty($user_cache[1]['photo']['src'])): ?>
	<img src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="<?php echo $user_cache[1]['photo']['width']; ?>" height="<?php echo $user_cache[1]['photo']['height']; ?>" alt="blogger" />
	<?php endif;?>
	</div>
	<p><b><?php echo $name; ?></b>
	<?php echo $user_cache[1]['des']; ?></p>
	</ul>
	</li>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<div id="calendar">
	</div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
	</li>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogtags">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
	</ul>
	</li>
<?php 
}
?>

<?php 
// pinruan.net customize tag cloud
function pr_tags()
{
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags'); 
	$count = 0;	// tag 数目 ?>
	
	<?php foreach($tag_cache as $value): 
		
		if($count%SS_TAGS_PER_ROW == 0){
			echo '</br>';
		}
		$count += 1; ?>

		<span class="round secondary label tag"><a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
<?php 
}
?>

<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<h5><span><?php echo $title; ?></span></h5>
	<ul class="no-bullet">
	<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
	?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>">
	<?php echo $value['sortname']; ?></a>
	<?php if (!empty($value['children'])): ?>
		<ul>
		<?php
		$children = $value['children'];
		foreach ($children as $key):
			$value = $sort_cache[$key];
		?>
		<li>
			<a href="<?php echo Url::sort($value['sid']); ?>">
			<?php echo $value['sortname']; ?></a>
		</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//widget：最新微语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="twitter">
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li><?php echo $value['t']; ?><?php echo $img;?><p><?php echo smartDate($value['date']); ?></p></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p><a href="<?php echo BLOG_URL . 't/'; ?>">更多&raquo;</a></p>
	<?php endif;?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<h5><span><?php echo $title; ?></span></h5>
	<ul class="no-bullet size-14">
	<?php
	$count=0;
	foreach($com_cache as $value):
		if($count++ == 5)break;
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<li><?php echo $value['name'].':'; ?>
	<a href="<?php echo $url; ?>" title="<?php echo $value['content'];?>">
	<?php if(mb_strlen($value['content'],'utf-8') > 24){
			echo mb_substr($value['content'],0,24,'utf-8').'...';
			}else{
				echo $value['content'];
				} ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<h5><span><?php echo $title; ?></span></h5>
	<ul class="no-bullet">
	<?php 
	$count=0;
	foreach($newLogs_cache as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>">
	<?php
		if(mb_strlen($value['title'],'utf-8') > 10){
			echo mb_substr($value['title'],0,10,'utf-8').'...';
			}else{
			echo $value['title']; 
			}?>
	</a></li>
	<?php if(++$count==8)break; ?>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="hotlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：随机文章
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="randlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="logsearch">
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
	<input name="keyword" class="search" type="text" />
	</form>
	</ul>
	</li>
<?php } ?>

<?php
//pinruan.net customize search
function pr_search(){ ?>
	<form id="searchbox" name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
		<div class="row">
			<div class="large-12 columns">
				<div class="row collapse postfix-round">
					<div class="small-9 columns">
						<input name="keyword" type="text" placeholder="Value">
					</div>
					<div class="small-3 columns">
						<button class="button postfix" type="summit">Go</button>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php } ?>

<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<h5><span><?php echo $title; ?></span></h5>
	<ul class="no-bullet size-14">
	<?php echo $content; ?>
	</ul>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="link">
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?> 
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul class="button-group">
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li><a class="button" href="<?php echo BLOG_URL; ?>admin/">管理</a></li>
			<li><a class="button" href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>
		<li>
			<a class="button" href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
			<?php if (!empty($value['children'])) :?>
            <ul class="button-group">
                <?php foreach ($value['children'] as $row){
                        echo '<li><a class="button" href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

            <?php if (!empty($value['childnavi'])) :?>
            <ul>
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li><a class="button" href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

		</li>
	<?php endforeach; ?>
	</ul>
<?php }?>

<?php
//blog：导航顶部
function blog_navi_v2(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul class="right">
	<?php
	foreach($navi_cache as $value):
        if ($value['pid'] != 0) {
            continue;
        }
		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li><a href="<?php echo BLOG_URL; ?>admin/">管理</a></li>
			<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';      
		?>
		
        <?php if (!empty($value['childnavi'])) : // 如果有子nav则优先按照有子nav的方式列出 nav?>
        	<li class="has-dropdown">
        	<a href="#"><?php echo $value['naviname']; ?></a>
            <ul class="dropdown">
                <?php foreach ($value['childnavi'] as $row): 
                    $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : ''; ?>
                    <li><a href="<?php echo $row['url'];?>" <?php echo $newtab; ?> >
                    <?php echo $row['naviname']; ?> </a></li>
                <?php endforeach; ?>
			</ul>
			</li>
        <?php else: // 否则?>
            
            <?php if (!empty($value['children'])) : //检查是否有子分类 按子分类方式列 nav ?>
            	<li class="has-dropdown">
            	<a href="#"><?php echo $value['naviname']; ?></a>
            	<ul class="dropdown">
                <?php foreach ($value['children'] as $row): ?>
                    <li><a href="<?php echo Url::sort($row['sid']); ?>"><?php echo $row['sortname']; ?></a></li>;
                <?php endforeach; ?>
				</ul>
				</li>
            <?php else: // 正常列出 nav?>
            	<li><a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
            	</li>
            <?php endif; ?>
        <?php endif;?>
		<li class="divider"></li>
	<?php endforeach; ?>
	</ul>
<?php }?>

<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
    }
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID 
	? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' 
	: '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a class="blog_item_tag" href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>">
    <?php echo $log_cache_sort[$blogid]['name']; ?>
    </a>
	<?php endif;?>
<?php }?>

<?php
//blog：发表时间
function blog_time($time){
	echo "&nbsp;".gmdate('Y-n-j', $time);
}
?>

<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '标签:';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "&nbsp;&nbsp;<a class=\"blog_item_tag\" href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo "作者:<a class=\"blog_item_tag\" href=\"".Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	<a class="left" href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo "&lt;".$prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog):?>
		 <a class="right" href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title']."&gt;";?></a>
	<?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);?>
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="row">
		<div class="small-1 columns">
			<?php if($isGravatar == 'y'): ?>
			<div class="th"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div>
			<?php endif; ?>
		</div>
		<div class="small-11 columns">
			<b class="comment-user"><?php echo $comment['poster']; ?></b>
			<span class="comment-time">&nbsp;发布于&nbsp;<?php echo $comment['date']; ?></span>
			<div class="row">
				<div class="small-10 columns comment">
					<?php echo $comment['content']; ?>
				</div>
				<div class="small-2 columns">
					<a class="button tiny round" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
				</div>
			</div>
			<div class="row">
				<?php blog_comments_children($comments, $comment['children']); ?>
			</div>
		</div>
	</div>
	<hr/>
	<?php endforeach; ?>
    <div id="pagenavi">
	    <?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="row">
		<div class="small-1 columns">
			<?php if($isGravatar == 'y'): ?>
				<div class="th"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div>
			<?php endif; ?>
		</div>
		<div class="small-11 columns">
			<b class="comment-user"><?php echo $comment['poster']; ?> </b>
			<span class="comment-time">&nbsp;发布于&nbsp;<?php echo $comment['date']; ?></span>
			<div class="row">
				<div class="small-10 columns comment">
					<?php echo $comment['content']; ?>
				</div>
				<div class="small-2 columns">
					<a class="button round tiny" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
				</div>
			</div>
			<div class="row">
				<?php blog_comments_children($comments, $comment['children']);?>
			</div>
			<?php if($comment['level'] < 4): ?>
			<?php endif; ?>
		</div>
		
	</div>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div class="row" id="comment-place">
	<div class="small-12 columns comment-post" id="comment-post">
		<div class="row cancel-reply" id="cancel-reply" style="display:none">
			<div class="small-12 columns">
			<a class="button alert right" href="javascript:void(0);" onclick="cancelReply()">取消</a>
			</div>
		</div>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<div class="row">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == ROLE_VISITOR): ?>
			<div class="small-6 columns">
				<input type="text" name="comname" maxlength="49" placeholder="昵称" value="<?php echo $ckname; ?>" size="22" tabindex="1">	
			</div>
			<div class="small-6 columns">
				<input type="text" name="nobot" maxlength="128" placeholder="<?php echo SS_NOBOT_QUESTION; ?>" value="" size="22" tabindex="2">
			</div>

			<div class="small-6 columns">
				<input type="text" name="commail"  maxlength="128" placeholder="邮箱（可选）" value="<?php echo $ckmail; ?>" size="22" tabindex="3">	
			</div>
				
			<div class="small-6 columns">
				<input type="text" name="comurl" maxlength="128" placeholder="主页（可选）" value="<?php echo $ckurl; ?>" size="22" tabindex="5">
			</div>
				
			<?php endif; ?>
			<div class="small-12 columns">
				<textarea name="comment" id="comment" rows="4" tabindex="6"></textarea>
			</div>
			<div class="small-12 columns"><?php echo $verifyCode; ?> 
				<button class="button small right" type="submit" id="comment_submit" value="发布" tabindex="7">
					发布
				</button>
			</div>
			</div>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}

/**
 * 分页函数
 *
 * @param int $count 条目总数
 * @param int $perlogs 每页显示条数目
 * @param int $page 当前页码
 * @param string $url 页码的地址
 */
function pr_paging($count, $perlogs, $page, $url, $anchor = '') {
	$pnums = @ceil($count / $perlogs);
	$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|", "", $url);

	$re = '';
	for ($i = $page - 5; $i <= $page + 5 && $i <= $pnums; $i++) {
		if ($i > 0) {
			if ($i == $page) {
				$re .= "<li class=\"current\"><a href=\"#\">$i</a></li>";
			} elseif ($i == 1) {
				$re .= "<li><a href=\"$urlHome$anchor\">$i</a><li> ";
			} else {
				$re .= "<li><a href=\"$url$i$anchor\">$i</a></li>";
			}
		}
	}
	if ($page > 6)
		$re = "<li class=\"arrow\"><a href=\"{$urlHome}$anchor\">&laquo;</a></li><li class=\"unavailable\"><a href=\"\">&hellip;</a></li>$re";
	if ($page + 5 < $pnums)
		$re .= "&hellip;<li class=\"arrow\"><a href=\"$url$pnums$anchor\">&raquo;</a></li>";
	if ($pnums <= 1)
		$re = '';
	return $re;
}

?>
