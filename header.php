<!DOCTYPE html>
<?php
/*
Template Name:SweetSlayer
Description:跨屏幕自适应主题，品软网出品(友情提示：不支持旧版本浏览器)
Version:0.1
Author:Trinity
Author Url:http://www.pinruan.net/misc/33.html
Sidebar Amount:0
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content="<?php echo $site_key; ?>" />
	<meta name="description" content="<?php echo $site_description; ?>" />
	<meta name="generator" content="emlog" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_title; ?></title>
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
	<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
	<link href="<?php echo TEMPLATE_URL; ?>css/normalize.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo TEMPLATE_URL; ?>css/foundation.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo TEMPLATE_URL; ?>css/foundation-icons.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo TEMPLATE_URL; ?>css/TomorrowNight.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo TEMPLATE_URL;?>js/vendor/modernizr.js"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/vendor/prettify.js" type="text/javascript"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/vendor/jquery.js"></script>
	<script src="<?php echo TEMPLATE_URL; ?>js/foundation.min.js"></script>
	<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
	<style>
		.size-12 { font-size: 12px; }
		.size-14 { font-size: 14px; }
		.size-16 { font-size: 16px; }
		.size-18 { font-size: 18px; }
		.size-21 { font-size: 21px; }
		.size-24 { font-size: 24px; }
		.size-36 { font-size: 36px; }
		.size-48 { font-size: 48px; }
		.size-60 { font-size: 60px; }
		.size-72 { font-size: 72px; }
		.height-10{ height: 10px; }
		.height-20{ height: 20px; }
		.center{ text-align:center; }
		
		#searchbox{margin-top: 1rem; }

		a.post_title:hover{color: #EC0959;}
		a.post_title:active{color:#EC0959;}

		a.blog_item_tag:link{ color:#8A8F98; }
		a.blog_item_tag:hover{ color:#8A8F98; }
		a.blog_item_tag:active{ color:#8A8F98; }
		a.blog_item_tag:visited{ color:#8A8F98; }

		#title{color:#333;font-weight: bold;margin-bottom: -2rem;}
		.post_title{color:#333;font-weight: bold;}
		.post_title .comnum{font-size: 1rem;font-weight: normal;}
		.post_item{font-size: 0.8rem;color:#8A8F98;}
		.page_post_item{ margin-top:1rem; margin-bottom: 2rem; }
		.post_desc{font-size: 0.9rem; color:#8A8F98;}
		
		
		#tag-widget { margin-bottom: 1rem; }
		#search-widget{ margin-top: 1rem; }
		.tag{ margin-right: 0.8rem; margin-top: 1rem; }
		
		.comment-user{ font-size: 0.9rem; }
		.comment-time{ font-size: 0.8rem;color:#8A8F98; }
		.comment{background-color: #FFFFEC;font-size: 0.9rem;}
		
		#footer{ color:#6f6f6f;}
		#footer a{ color:#FF8686;}
		#pagenavi{text-align: center;}
		#copyright{text-align: center;font-size: 0.8rem;margin-bottom: 2rem;}
	</style>
<!--[if IE 6]>
<script src="<?php echo TEMPLATE_URL; ?>iefix.js" type="text/javascript"></script>
<![endif]-->
<?php doAction('index_head'); ?>
<script type="text/javascript" >
	/* 不得不说： 使用本模板，整个界面得到最大的简化。本模板为写作而生，非用于挂广告等。
	使用本模板，将意味着放弃侧面版，日历，最新文章等等。
        _                                           _   
       (_)                                         | |  
  _ __  _ _ __  _ __ _   _  __ _ _ __    _ __   ___| |_ 
 | '_ \| | '_ \| '__| | | |/ _` | '_ \  | '_ \ / _ \ __|
 | |_) | | | | | |  | |_| | (_| | | | |_| | | |  __/ |_ 
 | .__/|_|_| |_|_|   \__,_|\__,_|_| |_(_)_| |_|\___|\__|
 | |                                                    
 |_|   
	*/
</script>
</head>
<body class="antialiased hide-extras">
	<div class="contain-to-grid sticky"><!--导航-->
		<nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
			<ul class="title-area">
				<li class="name">
					<h1><a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a></h1>
				</li>
				<li class="toggle-topbar menu-icon"><a href="#">
					<span></span>
				</a></li>
			</ul>
			<section class="top-bar-section">

				<?php blog_navi_v2();?>

				<ul class="left">
					<li><a href="<?php echo BLOG_URL; ?>">首页</a></li>
				</ul>
			</section>
		</nav>
	</div>
	
	<!-- Tag 和搜索框。
	-->