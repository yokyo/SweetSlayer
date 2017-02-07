<?php
require_once(ACTIVE_TPL_PATH.'ssconfig.php');

function on_post_comment() {
	$nobot=$_POST['nobot'];
	if(!isset($nobot)){
		emMsg('请填写验证');
	}
	if($nobot != SS_NOBOT_ANSWER){
		emMsg('验证错误，无法评论');
	}
}
addAction('comment_post','on_post_comment');
?>