<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
	<div class="m_l f_l">
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<td valign="top" width="320">
			<div class="quote_head">
			<span class="f_r">
			<form action="<?php echo $MOD['linkurl'];?>price.php" onsubmit="return quote_search();">
			<input type="text" size="12" value="输入产品名" name="kw" id="quote_kw" class="quote_head_i" onclick="if(this.value=='输入产品名')this.value='';"/> <input type="image" src="<?php echo DT_SKIN;?>image/btn_quote.gif" align="absmiddle"/>
			</form>
			</span>
			<div><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('price.php?product=all');?>" class="w"><strong>行情速递</strong></a></div>
			</div>
			<div class="quote_body">
				<div id="quote_0" style="height:140px;overflow:hidden;">
				<div id="quote_1">
				<?php $tags=tag("moduleid=5&condition=tag<>'' and unit<>'' and price>0 and status=3&pagesize=100&order=edittime desc&template=null");?>
				<ul>
				<?php if(is_array($tags)) { foreach($tags as $k => $t) { ?>
				<li><span class="f_r">&nbsp;<?php echo $t['price'];?> <?php echo $DT['money_unit'];?> / <?php echo $t['unit'];?></span><a href="<?php echo $t['linkurl'];?>" target="_blank" title="[<?php echo area_pos($t['areaid'], '', 2);?>] <?php echo $t['alt'];?>"><?php echo $t['tag'];?></a></li>
				<?php } } ?>
				</ul>
				</div>
				</div>
			</div>
		</td>
		<td width="10"></td>
		<td valign="top">
			<div class="headline">
			<?php echo tag("moduleid=$moduleid&condition=status=3 and level=5&order=".$MOD['order']."&pagesize=1&template=list-hl");?>
			<?php echo tag("moduleid=$moduleid&condition=status=3 and level=4&pagesize=2&order=".$MOD['order']."&template=list-hlr&cols=2&target=_blank");?>
			</div>
			<div class="b5"></div>
			<div class="subline">
			<?php echo tag("moduleid=$moduleid&condition=status=3 and level=1&order=".$MOD['order']."&pagesize=5&datetype=2&class=b&target=_blank");?>
			</div>	
		</td>
		</tr>
		</table>
		<div class="c_b"></div>
		<?php if($MOD['page_icat']) { ?>
		<table cellpadding="0" cellspacing="0" width="100%">
		<?php if(is_array($maincat)) { foreach($maincat as $i => $c) { ?>
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
		<div class="box_head_1"><div><strong>本周关注排行</strong></div></div>
		<div class="box_body">
			<div class="rank_list">
				<?php echo tag("moduleid=$moduleid&table=keyword&condition=moduleid=$moduleid and status=3 and updatetime>$today_endtime-86400*7&pagesize=10&order=week_search desc&key=week_search&template=list-search_rank", -2);?>
			</div>
		</div>
		<div class="b10 c_b"> </div>
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
		<div class="box_head_1"><div><strong><a href="<?php echo $MOD['linkurl'];?>product.php">产品分类</a></strong></div></div>
		<div class="box_body">
		<?php echo tag("moduleid=$moduleid&table=quote_product&condition=1&pagesize=10&order=listorder desc,pid desc&pagesize=10&template=list-quote_product&cols=2");?>
		</div>
		<div class="b10 c_b">&nbsp;</div>
		<div class="box_head_1"><div><strong>点击排行</strong></div></div>
		<div class="box_body">
		<div class="rank_list"><?php echo tag("moduleid=$moduleid&condition=status=3 and addtime>$today_endtime-30*86400&order=hits desc&pagesize=10", -2);?></div>
		</div>
	</div>
</div>
<?php echo load('quote.js');?>
<?php include template('footer');?>