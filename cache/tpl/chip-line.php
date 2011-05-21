<?php defined('IN_DESTOON') or exit('Access Denied');?>var dt_userid = <?php echo $_userid;?>;
var dt_username = '<?php echo $_username;?>';
var dt_member = '<img src="<?php echo DT_SKIN;?>image/user.gif" width="24" height="13" align="absmiddle"/>&nbsp; 欢迎，';
<?php if($_userid) { ?>
dt_member += '<span class="f_red f_b"><?php echo $_truename;?></span> (<?php echo $MG['groupname'];?>) | <a href="<?php echo $MODULE['2']['linkurl'];?>">商务中心</a> | <?php if($MG['inbox_limit']>-1) { ?><?php if($_message) { ?><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_newmessage.gif" width="16" height="12" align="absmiddle" alt=""/> <?php } ?><a href="<?php echo $MODULE['2']['linkurl'];?>message.php">站内信</a>(<?php if($_message) { ?><a href="<?php echo $MODULE['2']['linkurl'];?>message.php?action=last"><span class="f_red f_b"><?php echo $_message;?></span></a><?php } else { ?><span class="px11">0</span><?php } ?>) | <?php } ?><a href="<?php echo $MODULE['2']['linkurl'];?>record.php"><?php echo $DT['money_name'];?>(<span class="px11"><?php echo $_money;?></span>)</a> | <a href="<?php echo $MODULE['2']['linkurl'];?>credits.php"><?php echo $DT['credit_name'];?>(<span class="px11"><?php echo $_credit;?></span>)</a> | <a href="<?php echo $MODULE['2']['linkurl'];?>logout.php">退出</a>';
<?php if($_message) { ?>
dt_member += '<embed src="<?php echo DT_PATH;?>file/flash/message.swf" quality="high" type="application/x-shockwave-flash" height="0" width="0"></embed>';
<?php } ?>
<?php } else { ?>
dt_member += '<span class="f_red">客人</span> | <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_register'];?>">免费注册</a> | <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>">会员登录</a> | <a href="<?php echo $MODULE['2']['linkurl'];?>send.php">忘记密码?</a>';
<?php } ?>
try { document.getElementById('destoon_member').innerHTML = dt_member; } catch(e) {}