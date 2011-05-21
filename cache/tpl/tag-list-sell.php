<?php defined('IN_DESTOON') or exit('Access Denied');?><?php if(is_array($tags)) { foreach($tags as $k => $t) { ?>
<div class="list" id="item_<?php echo $t['itemid'];?>">
	<table>
	<tr align="center">
		<td width="25">&nbsp;<input type="checkbox" id="check_<?php echo $t['itemid'];?>" name="itemid[]" value="<?php echo $t['itemid'];?>" onclick="sell_tip(this, <?php echo $t['itemid'];?>);"/> </td>
		<td width="90"><div><a href="<?php echo $t['linkurl'];?>" target="_blank"><img src="<?php echo imgurl($t['thumb'], 1);?>" width="80" height="80" alt="<?php echo $t['alt'];?>" onmouseover="img_tip(this, this.src);" onmouseout="img_tip(this, '');"/></a></div></td>
		<td width="10"> </td>
		<td align="left">
			<ul>
			<li><?php if($t['vip']) { ?><span class="f_r"><img src="<?php echo DT_SKIN;?>image/vip.gif"/> <img src="<?php echo DT_SKIN;?>image/vip_<?php echo $t['vip'];?>.gif"/></span><?php } ?><a href="<?php echo $t['linkurl'];?>" target="_blank"><strong class="px14"><?php echo $t['title'];?></strong></a></li>
			<li class="f_gray"><?php echo $t['introduce'];?></li>
			<li><span class="f_r px11"><?php echo timetodate($t['edittime'], $datetype);?>&nbsp;&nbsp;</span><?php echo cat_pos($t['catid'], '&nbsp;');?></li>
			<li>
			<span class="f_r f_gray">
			<?php if($t['qq'] && $DT['im_qq']) { ?><?php echo im_qq($t['qq']);?>&nbsp;<?php } ?>
			<?php if($t['ali'] && $DT['im_ali']) { ?><?php echo im_ali($t['ali']);?>&nbsp;<?php } ?>
			<?php if($t['msn'] && $DT['im_msn']) { ?><?php echo im_msn($t['msn']);?>&nbsp;<?php } ?>
			<?php if($t['skype'] && $DT['im_skype']) { ?><?php echo im_skype($t['skype']);?></a>&nbsp;<?php } ?>
			[<?php echo area_pos($t['areaid'], '');?>]&nbsp;&nbsp;</span>
			<a href="<?php echo userurl($t['username']);?>" target="_blank"><?php echo $t['company'];?></a>&nbsp;
			<span class="f_gray">
			<?php if($t['validated']) { ?><span class="f_green">[已核实]</span><?php } else { ?>[未核实]<?php } ?>
			<?php if(!$t['username']) { ?> [未注册]<?php } ?>
			</span>
			</li>
			</ul>
		</td>
		<td width="10"> </td>
		<td width="100"> 
		<?php if($t['unit'] && $t['price']>0) { ?>
			<span class="f_red"><strong class="px14"><?php echo $t['price'];?></strong>/<?php echo $t['unit'];?></span><br/>
			<?php echo $t['minamount'];?><?php echo $t['unit'];?>起订<br/>
			<img src="<?php echo DT_SKIN;?>image/spacer.gif" width="1" height="10"/><br/>
			<a href="<?php echo $path;?><?php echo rewrite('order.php?itemid='.$t['itemid']);?>" class="l"><img src="<?php echo DT_SKIN;?>image/buy.gif" title="订购"/></a>
		<?php } else { ?>
		<span class="f_gray">面议</span><br/>
		<img src="<?php echo DT_SKIN;?>image/spacer.gif" width="1" height="10"/><br/>
		<a href="<?php echo $path;?><?php echo rewrite('inquiry.php?itemid='.$t['itemid']);?>" class="l"><img src="<?php echo DT_SKIN;?>image/inquiry.gif" title="询价"/></a>
		<?php } ?>
		</td>
	</tr>
	</table>
</div>
<?php } } ?>		
<?php if($showpage && $pages) { ?><div class="pages"><?php echo $pages;?></div><?php } ?>