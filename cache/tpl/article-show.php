<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="m_l f_l">
	<div class="left_box">
		<div class="pos">当前位置: <a href="<?php echo DT_PATH;?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &raquo; <?php echo cat_pos($catid, ' &raquo; ');?> &raquo; 正文</div>
		<h1 class="title"><?php echo $title;?></h1>
		<div class="info"><span class="f_r"><img src="<?php echo DT_SKIN;?>image/zoomin.gif" width="16" height="16" alt="放大字体" class="c_p" onclick="fontZoom('+', 'article');"/>&nbsp;&nbsp;<img src="<?php echo DT_SKIN;?>image/zoomout.gif" width="16" height="16"  alt="缩小字体" class="c_p" onclick="fontZoom('-', 'article');"/></span>
		发布日期：<?php echo $adddate;?>
		<?php if($copyfrom) { ?>&nbsp;&nbsp;来源：<?php if($fromurl) { ?><a href="<?php echo $fromurl;?>" target="_blank"><?php } ?><?php echo $copyfrom;?><?php if($fromurl) { ?></a><?php } ?><?php } ?>
		<?php if($author) { ?>&nbsp;&nbsp;作者：<?php echo $author;?><?php } ?>
		&nbsp;&nbsp;浏览次数：<span id="hits"><?php echo $hits;?></span>	
		</div>
		<?php if($introduce && $user_status == 3) { ?><div class="introduce"><?php echo $introduce;?></div><?php } ?>
		<div id="content"><?php include template('content', 'chip');?></div>
		<?php if($voteid) { ?><div class="pd20"><?php if(is_array($voteid)) { foreach($voteid as $v) { ?>
		<?php echo load('vote_'.$v.'.htm');?><?php } } ?></div>
		<?php } ?>
		<?php if($pages) { ?><div class="pages"><?php echo $pages;?></div><?php } ?>
		<div class="b10 c_b">&nbsp;</div>
		<form method="post" action="<?php echo $MODULE['2']['linkurl'];?>sendmail.php" name="sendmail" id="sendmail" target="_blank">
		<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
		<input type="hidden" name="title" value="<?php echo $title;?>"/>
		<input type="hidden" name="linkurl" value="<?php echo $linkurl;?>"/>
		</form>
		<?php if($MOD['show_np']) { ?>
		<div class="np">
		<ul>
		<li><strong>下一篇：</strong><?php echo tag("moduleid=$moduleid&condition=status=3 and addtime>$addtime&pagesize=1&order=addtime asc&template=list-np", -1);?></li>
		<li><strong>上一篇：</strong><?php echo tag("moduleid=$moduleid&condition=status=3 and addtime<$addtime&pagesize=1&order=addtime desc&template=list-np", -1);?></li>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>
                
                <!-- JiaThis Button BEGIN -->
<div id="jiathis_style_32x32" style="float:left;padding-left:200px;margin-bottom:25px; width:448px">
	<a class="jiathis_button_qzone"></a>
	<a class="jiathis_button_tsina"></a>
	<a class="jiathis_button_tqq"></a>
	<a class="jiathis_button_kaixin001"></a>
	<a class="jiathis_button_renren"></a>
	<a href="http://www.jiathis.com/share/" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
</div>
<script type="text/javascript" src="http://v1.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->
		<center>
		[ <a href="<?php echo $MOD['linkurl'];?>search.php"><?php echo $MOD['name'];?>搜索</a> ]&nbsp;
		[ <script type="text/javascript">addFav('加入收藏');</script> ]&nbsp;
		[ <a href="javascript:$('sendmail').submit();void(0);">告诉好友</a> ]&nbsp;
		[ <a href="javascript:Print();">打印本文</a> ]&nbsp;
		[ <a href="javascript:window.close()">关闭窗口</a> ]&nbsp;
		[ <a href="javascript:window.scrollTo(0,0);">返回顶部</a> ]
		</center>
		<br/>
		<?php if($MOD['page_srelate']) { ?>
		<div class="b10">&nbsp;</div>
		<div class="left_head"><a href="<?php echo $MOD['linkurl'];?><?php echo $CAT['linkurl'];?>">同类<?php echo $MOD['name'];?></a></div>
		<div class="related">		<?php echo tag("moduleid=$moduleid&length=44&catid=$catid&condition=status=3&pagesize=".$MOD['page_srelate']."&order=".$MOD['order']."&cols=2&template=list-table", -2);?>
		</div>
		<?php } ?>
		<?php include template('comment', 'chip');?>
		<br/>
	</div>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r f_l">
	<?php if($MOD['page_srecimg']) { ?>
	<div class="box_head_1"><div><strong>推荐图文</strong></div></div>
	<div class="box_body thumb"><?php echo tag("moduleid=$moduleid&length=20&condition=status=3 and level=3 and thumb!=''&catid=$catid&pagesize=".$MOD['page_srecimg']."&order=".$MOD['order']."&width=120&height=90&cols=2&template=thumb-table");?></div>
	<div class="b10"> </div>
	<?php } ?>
	<?php if($MOD['page_srec']) { ?>
	<div class="box_head_1"><div><strong>推荐<?php echo $MOD['name'];?></strong></div></div>
	<div class="box_body li_dot"><?php echo tag("moduleid=$moduleid&condition=status=3 and level=1&catid=$catid&order=".$MOD['order']."&pagesize=".$MOD['page_srec']);?>
	</div>
	<div class="b10"> </div>
	<?php } ?>
	<?php if($MOD['page_shits']) { ?>
	<div class="box_head_1"><div><strong>点击排行</strong></div></div>
	<div class="box_body">
		<div class="rank_list"><?php echo tag("moduleid=$moduleid&condition=status=3 and addtime>$today_endtime-30*86400&catid=$catid&order=hits desc&pagesize=".$MOD['page_shits'], -2);?></div>
	</div>
	<?php } ?>
</div>
</div>
<?php include template('zoom', 'chip');?>
<?php include template('footer');?>