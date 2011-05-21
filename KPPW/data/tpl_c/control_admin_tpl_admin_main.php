<?php Template_Class::subtplcheck('control/admin/tpl/admin_main', '1303866357', 'control/admin/tpl/admin_main');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>main</title>
</head>
<body>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script src="tpl/js/jquery.js" type="text/javascript"></script>
<script src="tpl/js/common.js" type="text/javascript"></script>
<div class="main">
 
<div class="clear"></div>
 

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top">
        <div class="in_v_info">
        <dl><dt>&nbsp;站点统计</dt>
        <dd class="p_10">
        <ul>
    	<li><strong>任务统计</strong></li>
<li>任务总数 :<?=$total_task_count?>&nbsp;&nbsp;，悬赏任务数量：<?=$xs_task_count?>&nbsp;&nbsp;， 招标任务数量：<?=$zb_task_count?>&nbsp;&nbsp; </li>

<li><strong>用户统计</strong></li>
<li>用户总数 :<?=$total_user_count?>&nbsp;&nbsp;，VIP用户数量：<?=$vip_user_count?>&nbsp;&nbsp;， 认证用户数量：<?=$auth_user_count?>&nbsp;&nbsp; </li>
        </ul></dd></dl></div>
        </td>
    <td width="1%">&nbsp;</td>
    <td valign="top">
        <div class="in_v_info">
        <dl><dt>备忘录</dt>
        <dd class="p_10">
        <textarea  id="notepadarea" style="height:95px;width:98%;overflow: auto;word-break:break-all;word-wrap:break-word;" onblur="savenotepad(this.innerHTML)"><?=$notice_text?></textarea>
        </dd></dl></div>
        </td>
      </tr>
  <tr>
    <td height="10" colspan="3" valign="top">&nbsp;</td>
      </tr>
  <tr>
    <td valign="top">
        <div class="in_v_info">
        <dl><dt>系统公告</dt>
        <dd class="p_10">
        <ul id="">
        <script type="text/javascript" charset="gbk" src="<?=$sysinfo?>" ></script>
    </ul>
</dd>
</dl>
</div>
        
        </td>
    <td>&nbsp;</td>
    <td valign="top">
        <div class="in_v_info">
        <dl><dt>授权信息</dt>
        <dd class="p_10">
        <ul>
    	<li id="li_lic1">版 本 号 :<?=P_NAME?> <?=KEKE_VERSION?> (<?=KEKE_RELEASE?>)</li>
        <li id="li_lic2">授权类别 :<span id='kekelic'></span></li>
        <li id="li_lic3"><?php if($lic) { ?>授 权 码 :<?=$lic?><?php } ?>&nbsp;</li>
        <li id="li_lic4">&nbsp;</li>
        <li id="li_lic5">&nbsp;</li>
        </ul></dd></dl></div>
        </td>
      </tr>
  <tr>
    <td height="10" colspan="3" valign="top">&nbsp;</td>
      </tr>
  <tr>
    <td colspan="3">
        <div class="in_v_info">
        <dl><dt>服务器信息</dt>
        <dd class="p_10">
         
         <div class="S_list">&nbsp;&nbsp;服务器IP：<?=$sys_info['ip']?></div>
    <div class="S_list">服务器软件：<span class="forumRow"><?=$sys_info['web_server']?></span></div>
    <div class="S_list" style="overflow:hidden;">&nbsp;&nbsp;站点物理路径：<?=S_ROOT?></div>
    <div class="S_list">&nbsp;&nbsp;MySQL 支持：<font color=green>[√]</font> /版本:<?=$mysql_ver?></div>
    <div class="S_list">&nbsp;&nbsp;PHP版本 ： <?=$sys_info['php_ver']?></div>    
       
    <div class="S_list" style="width:100%;">&nbsp;&nbsp;safe_mode :<?=$sys_info['safe_mode']?><font color=green>[√]Off</font>&nbsp;&nbsp;</div>
    <div class="S_list" style="width:100%;">&nbsp;&nbsp;服务器最大上传文件  :<?=$sys_info['max_filesize']?> </div>            
    </div>        
        
        </td>
      </tr>
  </table>

    <div class="clear"></div>
</div>
<script type="text/javascript" src="<?=$notice?>" charset="gbk"></script>
<script>
$(function(){
     $("#notepadarea").blur(function(){
    		val = $('#notepadarea').val();
    		$.get('index.php?do=main&ac=ajnotice',{val:val});
         })
})



</script>

</body>


</html><?php Template_Class::ob_out();?>