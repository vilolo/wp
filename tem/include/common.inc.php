<?php
define('IN_MO',true); //系统入口

define('MO_ROOT',str_replace('\\','/',dirname(dirname(__FILE__)))); // 系统根目录

require_once(MO_ROOT . '/include/config.inc.php'); //包含系统配置文件

require_once(MO_ROOT . '/include/common.func.php'); //加载系统公用函数库

require_once(MO_ROOT . '/include/db.class.php'); //加载MYSQL数据库操作类文件

require_once(MO_ROOT . '/include/page.class.php'); //加载MYSQL数据库操作类文件

require_once(MO_ROOT . '/include/sqlfzr.php'); //sql防注入代码

header('Content-type:text/html; charset=' . $charset . ''); //设置网站字符集
$path_url='../';/*$_SERVER['HTTP_HOST'].'/'.'markham'.*/
if(function_exists('date_default_timezone_set')){
	//如果该函数存在，就设置时区
	date_default_timezone_set($timezone); //设置默认时区
}

unset($HTTP_ENV_VARS, $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_POST_FILES, $HTTP_COOKIE_VARS);  //清空php4.1一下的 post get取值方法

$_GET = stripSql($_GET); //过滤一些简单的sql关键字 

$_POST = stripSql($_POST);

$_COOKIE = stripSql($_COOKIE);

$magic_quotes_gpc = get_magic_quotes_gpc(); //获取系统是否自动转义GPC  get post cookie

if(!$magic_quotes_gpc){ 
	//如果没有开启
    if (!empty($_GET)){
		$_GET = myAddslashes($_GET); //使用自定义函数进行转义
	}
	
	if (!empty($_POST)){
		$_POST = myAddslashes($_POST);
	}
	
	$_COOKIE = myAddslashes($_COOKIE);
	
	$_REQUEST = myAddslashes($_REQUEST);
}
$db = new db($db_host, $db_user, $db_pass, $db_name);

$db_host = $db_user = $db_pass = $db_name = NULL;

error_reporting(E_ALL);

set_error_handler('myErrorHandler'); 

/*网站标题、关键词、描述、底部内容等配置内容*/
$sql='select * from setup where id=1';
$result=$db->query($sql);
if(!!$row = $db->getRow($result)){
$site_title=$row['site_title'];
$site_title_en=$row['site_title_en'];
$site_key=$row['site_key'];
$site_key_en=$row['site_key_en'];
$site_des=$row['site_des'];
$site_des_en=$row['site_des_en'];
$site_bot=$row['site_bot'];
$site_bot_en=$row['site_bot_en'];
$address=$row['address'];
$telephone=$row['telephone'];
$telephone1=$row['telephone1'];
$fax=$row['fax'];
$email=$row['email'];
$header_email=$row['header_email'];
$qq=$row['qq'];
$qq1=$row['qq1'];
$qq2=$row['qq2'];
$MSN=$row['MSN'];
$Skype=$row['Skype'];
$zcode=$row['zcode'];
$ip=$row['ip'];
$wtime=$row['wtime'];
}
$db->freeResult($result);

$bidd=1;
$sql='select * from link_co where lm=2 order by px desc,id asc';
$result=$db->query($sql);
while(!!$row = $db->getRow($result)){
$link_img_sl[$bidd]=$row['img_sl'];
$link_img_sl_en[$bidd]=$row['img_sl_en'];
$link_url[$bidd]=$row['link_url'];
$link_title[$bidd]=$row['title'];
$link_title_en[$bidd]=$row['title_en'];
$bidd++ ;
}
$db->freeResult($result);
?>