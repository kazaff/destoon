<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<script type="text/javascript">
var i = 30;//time
</script>
<div class="m">
	<div class="warn">
		<div>
			<h1><?php echo $head_title;?></h1><br/>
			&nbsp;&nbsp;<span id="second" class="f_red f_b"><script type="text/javascript">document.write(i);</script></span> 秒后将自动跳转到<?php if($_userid) { ?><a href="<?php echo $MODULE['2']['linkurl'];?>grade.php">会员升级页面</a><?php } else { ?><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>">会员登录页面</a><?php } ?>
			<br/><br/>
			<?php if($_userid) { ?>
			&nbsp;&nbsp;1、请升级您的会员组。 <br/>
			<?php } else { ?>
			&nbsp;&nbsp;1、请 <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>">登录</a> 或 <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_register'];?>">免费注册</a>。<br/>
			<?php } ?>
			&nbsp;&nbsp;2、请检查输入的网址是否正确。 <br/>
			&nbsp;&nbsp;3、如果不能确认输入的网址，请浏览<a href="<?php echo DT_PATH;?>">网站首页</a>来查看所要访问的网址。 <br/>
		</div>
	</div>
</div>
<script type="text/javascript">
var interval=window.setInterval(
	function() {
		if(i == 0) {
			Go('<?php echo $MODULE['2']['linkurl'];?><?php if($_userid) { ?>grade.php<?php } else { ?><?php echo $DT['file_login'];?><?php } ?>');
			clearInterval(interval);
		} else {
			$('second').innerHTML = i;
			i--;
		}
	}, 
1000);
</script>
<?php include template('footer');?>