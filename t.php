<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="row">
<div class="small-12 columns">
    <?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?>
    <div class="row">
        <div class="small-1 columns">
            <div class="th"><img src="<?php echo $avatar; ?>" width="32px" height="32px" /></div>
        </div>
        <div class="small-2 columns">
            <?php echo $author; ?>
            <!--p class="time"><?php echo $val['date'];?> </p-->
        </div>
        <div class="small-9 columns">
            <?php echo $val['t'].'<br/>'.$img;?>
        </div>
    </div>
    <hr/>
    <?php endforeach;?>
	<div id="pagenavi"><?php echo $pageurl;?></div>
</div><!--end #contentleft-->
<?php
 //include View::getView('side');
 include View::getView('footer');
?>