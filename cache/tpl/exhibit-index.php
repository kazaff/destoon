<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
	<div class="m_l f_l">
		<table cellpadding="4" cellspacing="1" width="100%" bgcolor="#C5D7ED">
		<tr bgcolor="#F1F7FC" align="center">
		<?php for($i=1;$i<13;$i++){ $j = $i<10 ? '0'.$i : $i;?>
		<td<?php if($j==date('m')) { ?> bgcolor="#AACCEE"<?php } ?>><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?month='.$i);?>"><?php echo $j;?>月</a></td>
		<?php } ?>
		</tr>
		</table>
		<div class="b10"> </div>	
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<td valign="top" width="300">
			<?php echo tag("moduleid=$moduleid&condition=status=3 and level=2 and thumb!=''&order=".$MOD['order']."&pagesize=".$MOD['page_islide']."&width=290&height=230&template=slide-focus");?>
		</td>
		<td valign="top">
			<div class="exh_rec">
			<?php $tags=tag("moduleid=$moduleid&condition=status=3 and level=1&pagesize=3&order=".$MOD['order']."&template=null");?>
			<table width="100%">
			<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
			<tr>
			<td valign="top">
			<ul>
			<li><a href="<?php echo $t['linkurl'];?>" target="_blank" title="<?php echo $t['alt'];?>"><?php echo $t['title'];?></a></li>
			<li>&nbsp;<?php echo timetodate($t['fromtime'], 3);?> 至 <?php echo timetodate($t['totime'], 3);?> [<?php echo $t['city'];?>]</li>
			<li title="<?php echo $t['city'];?><?php echo $t['hallname'];?>">&nbsp;主办：<?php echo $t['sponsor'];?></li>
			</ul>
			</td>
			</tr>
			<?php } } ?>
			</table>
			</div>		
		</td>
		</tr>
		</table>
		<?php if(is_array($maincat)) { foreach($maincat as $i => $c) { ?>
		<div class="b10 c_b"> </div>
		<div class="box_head"><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo $c['linkurl'];?>">更多..</a></span><strong><?php echo $c['catname'];?></strong></div>
		<div class="box_body f_gray li_dot">
		<?php $tags=tag("moduleid=$moduleid&catid=".$c['catid']."&condition=status=3&order=".$MOD['order']."&pagesize=".$MOD['page_icat']."&template=null");?><ul>
		<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
		<li title="<?php echo $t['alt'];?>&#13;主办：<?php echo $t['sponsor'];?>&#13;展馆：<?php echo $t['hallname'];?>"><span class="f_r">[<?php echo $t['city'];?>] &nbsp;&nbsp; <?php echo timetodate($t['fromtime'], 3);?> 至 <?php echo timetodate($t['totime'], 3);?></span><a href="<?php echo $t['linkurl'];?>" target="_blank"><?php echo $t['title'];?></a></li>
		<?php } } ?>
		</ul>
		</div>
		<?php } } ?>

	</div>
	<div class="m_n f_l">&nbsp;</div>
	<div class="m_r f_l">

		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE[$MOD['news_id']]['linkurl'];?><?php echo $NC[$MOD['cat_news']]['linkurl'];?>">更多..</a></span><strong>展会资讯</strong></div></div>
		
		<div class="box_body">

		<div class="thumb"><?php echo tag("moduleid=".$MOD['news_id']."&condition=status=3 and thumb!=''&catid=".$MOD['cat_news']."&pagesize=2&length=20&order=addtime desc&width=120&height=90&cols=2&template=thumb-table&target=_blank");?></div>

		<div class="f_gray" style="border-top:#C0C0C0 1px dotted;padding:5px 5px 0 5px;">
		<?php echo tag("moduleid=".$MOD['news_id']."&condition=status=3&catid=".$MOD['cat_news']."&pagesize=".$MOD['cat_news_num']."&datetype=2&order=addtime desc&target=_blank");?></div>
		</div>
		<div class="b10"></div>

		<?php if($MOD['cat_hall']) { ?>
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE[$MOD['news_id']]['linkurl'];?><?php echo $NC[$MOD['cat_hall']]['linkurl'];?>">更多..</a></span><strong>展馆介绍</strong></div></div>
		<div class="box_body thumb"><?php echo tag("moduleid=".$MOD['news_id']."&condition=status=3 and thumb!=''&catid=".$MOD['cat_hall']."&pagesize=".$MOD['cat_hall_num']."&length=15&order=addtime desc&width=120&height=90&cols=2&template=thumb-table&target=_blank");?></div>
		<div class="b10"></div>
		<?php } ?>

		<?php if($MOD['cat_service']) { ?>
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE[$MOD['news_id']]['linkurl'];?><?php echo $NC[$MOD['cat_service']]['linkurl'];?>">更多..</a></span><strong>展会服务</strong></div></div>
		<div class="box_body f_gray li_dot">			<?php echo tag("moduleid=".$MOD['news_id']."&condition=status=3&catid=".$MOD['cat_service']."&pagesize=".$MOD['cat_service_num']."&order=addtime desc&target=_blank");?></div>
		<div class="b10"></div>
		<?php } ?>
	</div>
</div>
<?php include template('footer');?>