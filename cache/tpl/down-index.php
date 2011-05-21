<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
	<div class="m_l f_l">
		<?php if($MOD['page_irec']) { ?>
		<div class="box_head_2"><strong class="px13">&raquo; 推荐<?php echo $MOD['name'];?></strong></div>
		<div class="box_body">
			<div class="thumb">
			<?php echo tag("moduleid=$moduleid&length=20&condition=status=3 and thumb<>'' and level>0&pagesize=".$MOD['page_irec']."&order=".$MOD['order']."&width=120&height=90&cols=4&template=thumb-table&target=_blank");?>
			</div>
		</div>
		<?php } ?>
		<?php if($MOD['page_icat']) { ?>
		<table cellpadding="0" cellspacing="0" width="100%">
		<?php if(is_array($maincat)) { foreach($maincat as $i => $c) { ?>
		<?php if($i%2==0) { ?><tr><?php } ?>
		<td valign="top" width="320">
			<div class="b10"></div>
			<div class="box_head"><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo $c['linkurl'];?>">更多..</a></span><strong><?php echo $c['catname'];?></strong></div>
			<div class="box_body"><div class="thumbb"><?php echo tag("moduleid=$moduleid&catid=".$c['catid']."&condition=status=3&order=".$MOD['order']."&pagesize=".$MOD['page_icat']."&length=30&datetype=2&template=list-down&target=_blank");?></div></div>
		</td>
		<?php if($i%2==0) { ?><td>&nbsp;</td><?php } ?>
		<?php if($i%2==1) { ?></tr><?php } ?>
		<?php } } ?>
		</table>
		<?php } ?>
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
		<div class="b10 c_b"> </div>
		<div class="box_head_1"><div><strong>月下载排行</strong></div></div>
		<div class="box_body">
		<div class="rank_list"><?php echo tag("moduleid=$moduleid&condition=status=3 and addtime>$today_endtime-30*86400&order=download desc&pagesize=10", -2);?></div>
		</div>
		<div class="b10 c_b"> </div>
		<div class="box_head_1"><div><strong>总下载排行</strong></div></div>
		<div class="box_body">
		<div class="rank_list"><?php echo tag("moduleid=$moduleid&condition=status=3&order=download desc&pagesize=10", -2);?></div>
		</div>
	</div>
</div>
<?php include template('footer');?>