<?php
defined('IN_DESTOON') or exit('Access Denied');
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
# http://help.destoon.com/faq/config.php shows detail

//数据库配置
$CFG['db_host'] = 'localhost';
$CFG['db_name'] = 'destoon';
$CFG['db_user'] = 'root';
$CFG['db_pass'] = 'root';
$CFG['db_charset'] = 'utf8';
$CFG['database'] = 'mysql';
$CFG['pconnect'] = '0';
$CFG['tb_pre'] = 'destoon_';
$CFG['charset'] = 'utf-8';


$CFG['path'] = '/destoon/';	//相对路径 （相对于环境根目录www）
$CFG['url'] = 'http://192.168.1.62/destoon/';	//绝对路径

$CFG['absurl'] = '0';	//是否启用绝对地址1=启用[如有任一模块绑定二级域名时必须启用] 0=不启用
$CFG['com_domain'] = '';	//公司主页绑定二级域名
$CFG['com_dir'] = '1';		//泛解析绑定目录 1=company目录 0=网站根目录
$CFG['com_rewrite'] = '0';	//会员顶级域名ReWrite 1=开启 0=关闭
$CFG['com_vip'] = 'VIP';	//VIP会员名称
$CFG['file_mod'] = 0777;	//默认文件操作权限
$CFG['cache_dir'] = '';		//缓存路径
$CFG['db_expires'] = '0';	//数据库查询结果缓存过期时间(秒) 
$CFG['tag_expires'] = '0';	//数据调用标签缓存过期时间(秒) 
$CFG['template_refresh'] = '1';	//模板自动刷新(0=关闭,1=打开,如不再修改模板,请关闭)
$CFG['template_trim'] = '0';	//去除模板换行等多余标记,可以压缩一定网页体积(0=关闭,1=打开)

$CFG['cookie_domain'] = '';		//cookie 作用域 例如 .destoon.com 如果绑定了二级域名 此项必须设置
$CFG['cookie_path'] = '/';		//cookie 作用路径
$CFG['cookie_pre'] = 'destoon_';	//cookie 前缀
$CFG['timezone'] = 'Etc/GMT-8';		//时区设置(>PHP 5.1),Etc/GMT-8 实际表示的是 GMT+8 GMT+8
$CFG['timediff'] = '0';		//服务器时间校正 单位(秒) 可以为负数

$CFG['skin'] = 'default';	//风格
$CFG['template'] = 'default';	//模板
$CFG['language'] = 'zh-cn';

$CFG['authkey'] = 'MPEYY9bjAV0xRMj';	//网站安全密钥，建议定期在后台修改 推荐字母和数字组合

/*
 	创始人ID
	创始人相对于其他超级管理员独具以下系统权限
	全站设置 管理员管理 模块管理/设置 数据库管理 模板管理 栏目管理 地区管理 在线升级等系统关键操作
 */
$CFG['founderid'] = '1';
	
$CFG['edittpl'] = '1';		//是否允许在后台编辑模板 (0=关闭,1=打开)
$CFG['executesql'] = '1';	//是否允许在后台运行SQL语句 (0=关闭,1=打开)
?>