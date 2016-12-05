<?php 
/**
 * 自定义404页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once('ssconfig.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SS_SITE_NAME; ?>-404公益</title>
</head>
<body>
<script type="text/javascript" src="http://www.qq.com/404/search_children.js" charset="utf-8" 
homePageUrl="<?php echo SS_SITE_URL; ?>" homePageName="返回<?php echo SS_SITE_NAME ?>首页"></script>
</body>
</html>