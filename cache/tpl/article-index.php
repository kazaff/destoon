<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
	<div class="m_l f_l">
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<?php if($MOD['page_islide']) { ?>
		<td valign="top" width="320">
			<?php echo tag("moduleid=$moduleid&condition=status=3 and level=2 and thumb!=''&order=".$MOD['order']."&pagesize=".$MOD['page_islide']."&width=320&height=200&target=_blank&template=slide");?>
		</td>
		<td width="10"></td>
		<?php } ?>
		<td valign="top">
			<div class="headline">
			<?php echo tag("moduleid=$moduleid&condition=status=3 and level=5&order=".$MOD['order']."&pagesize=1&target=_blank&template=list-hl");?>
			<?php echo tag("moduleid=$moduleid&condition=status=3 and level=4&pagesize=2&order=".$MOD['order']."&target=_blank&template=list-hlr&cols=2");?>
			</div>
			<div class="b5"></div>
			<div class="subline">
			<?php echo tag("moduleid=$moduleid&condition=status=3 and level=1&order=".$MOD['order']."&pagesize=5&datetype=2&target=_blank&class=b");?>
			</div>
		</td>
		</tr>
		</table>
		<div class="c_b"></div>
		<?php if($MOD['page_icat']) { ?>
		<table cellpadding="0" cellspacing="0" width="100%">
		<?php if(is_array($childcat)) { foreach($childcat as $i => $c) { ?>
		<?php if($i%2==0) { ?><tr><?php } ?>
		<td valign="top" width="320">
			<div class="b10"></div>
			<div class="box_head"><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo $c['linkurl'];?>">更多..</a></span><strong><?php echo $c['catname'];?></strong></div>
			<div class="box_body li_dot f_gray"><?php echo tag("moduleid=$moduleid&catid=".$c['catid']."&condition=status=3&order=".$MOD['order']."&pagesize=".$MOD['page_icat']."&datetype=2&target=_blank");?></div>			
		</td>
		<?php if($i%2==0) { ?><td>&nbsp;</td><?php } ?>
		<?php if($i%2==1) { ?></tr><?php } ?>
		<?php } } ?>
		</table>
		<?php } ?>
	</div>
	<div class="m_n f_l">&nbsp;</div>
	<div class="m_r f_l">
		<?php if($MOD['show_icat']) { ?>
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
		<?php } ?>
		<?php if($MOD['page_irecimg']) { ?>
		<div class="box_head_1"><div><strong>推荐图文</strong></div></div>
		<div class="box_body thumb"><?php echo tag("moduleid=$moduleid&length=20&condition=status=3 and level=3 and thumb<>''&pagesize=".$MOD['page_irecimg']."&order=".$MOD['order']."&width=120&height=90&cols=2&target=_blank&template=thumb-table");?></div>
		<div class="b10 c_b"> </div>
		<?php } ?>
		<?php if($MOD['page_ihits']) { ?>
		<div class="box_head_1"><div><strong>点击排行</strong></div></div>
		<div class="box_body">
		<div class="rank_list"><?php echo tag("moduleid=$moduleid&condition=status=3 and addtime>$today_endtime-30*86400&order=hits desc&pagesize=".$MOD['page_ihits']."&target=_blank", -2);?></div>
		</div>
		<?php } ?>
	</div>
</div>
<?php include template('footer');?>