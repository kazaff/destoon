<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
	<div class="m_l f_l">
		<?php if($MOD['page_irec']) { ?>
		<div class="box_head_2"><strong class="px13">&raquo; 推荐<?php echo $MOD['name'];?></strong></div>
		<div class="box_body">
			<div class="thumb"><?php echo tag("moduleid=$moduleid&condition=status=3 and open=3 and level=1 and items>0&order=".$MOD['order']."&length=20&width=120&height=90&pagesize=".$MOD['page_irec']."&cols=4&template=list-photo");?></div>
		</div>
		<?php } ?>
		<?php if($MOD['page_icat']) { ?>
		<table cellpadding="0" cellspacing="0" width="100%">
<?php $i=0;?>
		<?php if(is_array($maincat)) { foreach($maincat as $c) { ?>
 <?php
        	if($c['catid'] == '8')
            	continue;
        ?>
		<?php if($i%2==0) { ?><tr><?php } ?>
		<td valign="top" width="320">
			<div class="b10"></div>
			<div class="box_head"><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo $c['linkurl'];?>">更多..</a></span><strong><?php echo $c['catname'];?></strong></div>
			<div class="box_body"><div class="thumb"><?php echo tag("moduleid=$moduleid&catid=".$c['catid']."&condition=status=3 and open=3 and items>0&order=".$MOD['order']."&length=20&width=120&height=90&pagesize=".$MOD['page_icat']."&cols=2&datetype=3&template=list-photo");?></div></div>			
		</td>
		<?php if($i%2==0) { ?><td>&nbsp;</td><?php } ?>
		<?php if($i%2==1) { ?></tr><?php } ?>
<?php $i++;?>
		<?php } } ?>
		</table>
		<?php } ?>
	</div>
	<div class="m_n f_l">&nbsp;</div>
	<div class="m_r f_l">
		<?php if($MOD['page_islide']) { ?>
		<div><?php echo tag("moduleid=$moduleid&condition=status=3 and open=3 and level=2 and items>0&order=".$MOD['order']."&pagesize=".$MOD['page_islide']."&width=300&height=225&target=_blank&template=slide", -2);?></div>
		<div class="b10"> </div>
		<?php } ?>
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
		<div class="box_head_1"><div><strong>点击排行</strong></div></div>
		<div class="box_body">
		<div class="rank_list"><?php echo tag("moduleid=$moduleid&condition=status=3 and open=3 and items>0 and addtime>$today_endtime-60*86400&order=hits desc&pagesize=10", -2);?></div>
		</div>
	</div>
</div>
<?php include template('footer');?>