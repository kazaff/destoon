<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header', $module);?>
<?php if(!$_userid) { ?>
<div class="warn">您还没有登录，本站部分功能和服务可能受到一定的使用限制，建议 <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>" class="f_b t">立即登录</a> 或 <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_register'];?>" class="f_b t">注册会员</a></div>
<div class="b10"></div>
<?php } ?>
<table cellspacing="1" cellpadding="10" class="tb">
<?php if(is_array($MYMODS)) { foreach($MYMODS as $v) { ?>
<?php if($v == 9) { ?>
<tr>
<td class="tl"><a href="<?php echo $MODULE[$v]['linkurl'];?>" target="_blank">招聘</a></td>
<td class="tr">
<?php if($_userid) { ?><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=<?php echo $v;?>" class="b">管理</a>&nbsp;&nbsp;<?php } ?>
<a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=<?php echo $v;?>&action=add" class="b">发布</a>
</td>
</tr>
<?php } else if($v==-9) { ?>
<tr>
<td class="tl"><a href="<?php echo $MODULE['9']['linkurl'];?>" target="_blank">简历</a></td>
<td class="tr">
<?php if($_userid) { ?><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=9&resume=1" class="b">管理</a>&nbsp;&nbsp;<?php } ?>
<a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=9&action=add&resume=1" class="b">发布</a>
</td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><a href="<?php echo $MODULE[$v]['linkurl'];?>" target="_blank"><?php echo $MODULE[$v]['name'];?></a></td>
<td class="tr">
<?php if($_userid) { ?><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=<?php echo $v;?>" class="b">管理</a>&nbsp;&nbsp;<?php } ?>
<a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=<?php echo $v;?>&action=add" class="b">发布</a>
</td>
</tr>
<?php } ?>
<?php } } ?>
</table>
<?php include template('footer', $module);?>