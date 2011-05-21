<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="m_l f_l">
	<div class="left_box">		
		<div class="pos">当前位置: <a href="<?php echo DT_PATH;?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &raquo; <?php echo cat_pos($catid, ' &raquo; ');?> &raquo; 正文</div>
		<h1 class="title"><?php echo $title;?></h1>
		<div class="info"><span class="f_r"><img src="<?php echo DT_SKIN;?>image/zoomin.gif" width="16" height="16" alt="放大字体" class="c_p" onclick="fontZoom('+');"/>&nbsp;&nbsp;<img src="<?php echo DT_SKIN;?>image/zoomout.gif" width="16" height="16"  alt="缩小字体" class="c_p" onclick="fontZoom('-');"/></span>
		发布日期：<?php echo $adddate;?>
		&nbsp;&nbsp;浏览次数：<span id="hits"><?php echo $hits;?></span>
		&nbsp;&nbsp;状态：<img src="<?php echo DT_SKIN;?>image/exh_p<?php echo $process;?>.gif" id="process" alt="状态" align="absmiddle"/>
		</div>
		<div class="pd20">
			<table cellspacing="1" cellpadding="10" width="100%" class="ctb">
			<tr>
			<td class="ltd">展会日期</td>
			<td class="rtd"><?php echo $fromtime;?> 至 <?php echo $totime;?></td>
			</tr>
			<tr>
			<td class="ltd">展出城市</td>
			<td class="rtd"><?php echo $city;?></td>
			</tr>
			<tr>
			<td class="ltd">展出地址</td>
			<td class="rtd"><?php echo $address;?></td>
			</tr>
			<tr>
			<td class="ltd">展馆名称</td>
			<td class="rtd"><?php echo $hallname;?></td>
			</tr>
			<tr>
			<td class="ltd">主办单位</td>
			<td class="rtd"><?php echo $sponsor;?></td>
			</tr>
			<?php if($undertaker) { ?>
			<tr>
			<td class="ltd">承办单位</td>
			<td class="rtd"><?php echo $undertaker;?></td>
			</tr>
			<?php } ?>
			</table>
			<br/>
			<table cellspacing="1" cellpadding="6" width="100%" class="ctb">
			<tr>
			<td class="ltd">展会说明</td>
			</tr>
			<tr>
			<td class="rtd"><div id="content"><?php include template('content', 'chip');?></div></td>
			</tr>
			</table>
			<?php if($remark) { ?>
			<br/>
			<table cellspacing="1" cellpadding="6" width="100%" class="ctb">
			<tr>
			<td class="ltd">展会备注</td>
			</tr>
			<tr>
			<td class="rtd"><div class="content"><?php echo nl2br($remark);?></div></td>
			</tr>
			</table>
			<?php } ?>
		</div>
		<div class="b10">&nbsp;</div>
		<form method="post" action="<?php echo $MODULE['2']['linkurl'];?>sendmail.php" name="sendmail" id="sendmail" target="_blank">
		<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/> 
		<input type="hidden" name="title" value="<?php echo $title;?>"/>
		<input type="hidden" name="linkurl" value="<?php echo $linkurl;?>"/>
		</form>
		<center>
		[ <a href="<?php echo $MOD['linkurl'];?>search.php"><?php echo $MOD['name'];?>搜索</a> ]&nbsp;
		[ <script type="text/javascript">addFav('加入收藏');</script> ]&nbsp;
		[ <a href="javascript:$('sendmail').submit();void(0);">告诉好友</a> ]&nbsp;
		[ <a href="javascript:Print();">打印本文</a> ]&nbsp;
		[ <a href="javascript:window.close()">关闭窗口</a> ]&nbsp;
		[ <a href="javascript:window.scrollTo(0,0);">返回顶部</a> ]
		</center>
		<br/>
		<?php include template('comment', 'chip');?>
		<br/>
	</div>
</div>
<div class="m_n f_l">&nbsp;</div>
	<div class="m_r f_l">
		<div class="box_head_1"><div><strong>按分类浏览</strong></div></div>
		<div class="box_body">
		<table width="100%" cellpadding="3">
		<?php if(is_array($maincat)) { foreach($maincat as $k => $v) { ?>
		<?php if($k%2==0) { ?><tr><?php } ?>
		<td><a href="<?php echo $MOD['linkurl'];?><?php echo $v['linkurl'];?>"><?php echo set_style($v['catname'],$v['style']);?></a> <span class="f_gray px10">(<?php echo $ITEMS[$v['catid']];?>)</span></td>
		<?php if($k%2==1) { ?></tr><?php } ?>
		<?php } } ?>
		</table>
		</div>
		<div class="b10 c_b">&nbsp;</div>
		<div class="box_head_1"><div><strong>最新<?php echo $MOD['name'];?></strong></div></div>
		<div class="box_body f_gray li_dot"><?php echo tag("moduleid=$moduleid&condition=status=3&order=".$MOD['order']."&pagesize=10");?></div>
	</div>
</div>
<?php include template('zoom', 'chip');?>
<?php include template('footer');?>