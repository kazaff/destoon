<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="m_l_1 f_l">
	<div class="left_box">
		<div class="pos">当前位置: <a href="<?php echo DT_PATH;?>">首页</a>
		&raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a>
		<?php if($typeid!=99) { ?>&raquo; <a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('index.php?typeid='.$typeid);?>"><?php echo $TYPE[$typeid];?></a><?php } ?>
		<?php if($catid) { ?>&raquo; <?php echo cat_pos($catid);?><?php } ?>
		</div>
		<div class="category">
			<p><img src="<?php echo DT_SKIN;?>image/arrow.gif" width="17" height="12" alt=""/> <strong>按行业浏览</strong></p>
			<div>
			<table width="100%" cellpadding="3">
			<?php if(is_array($maincat)) { foreach($maincat as $k => $v) { ?>
			<?php if($k%$MOD['page_subcat']==0) { ?><tr><?php } ?>
			<td><a href="<?php echo $MOD['linkurl'];?><?php echo $v['linkurl'];?>"><?php echo set_style($v['catname'],$v['style']);?></a> <span class="f_gray px10">(<?php echo $ITEMS[$v['catid']];?>)</span></td>
			<?php if($k%$MOD['page_subcat']==($MOD['page_subcat']-1)) { ?></tr><?php } ?>
			<?php } } ?>
			</table>
			</div>
		</div>
		<div class="b10">&nbsp;</div>
		<div class="type">
		<a href="<?php echo $MOD['linkurl'];?>" class="<?php if($typeid==99) { ?>type_1<?php } else { ?>type_2<?php } ?>">全部</a>
		<?php if(is_array($TYPE)) { foreach($TYPE as $k => $v) { ?>
		<a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('index.php?typeid='.$k.'&catid='.$catid);?>" class="<?php if($typeid==$k) { ?>type_1<?php } else { ?>type_2<?php } ?>"><?php echo $v;?></a>
		<?php } } ?>
		</div>
		<div class="b10 c_b">&nbsp;</div>
		<form method="post">
		<div class="sell_tip" id="sell_tip" style="display:none;" title="双击关闭" ondblclick="Dh(this.id);">
			<div>
				<p>您可以</p>
				<input type="submit" value="对比选中" onclick="this.form.action='<?php echo $MOD['linkurl'];?>compare.php';" class="btn_1" onmouseover="this.className='btn_2'" onmouseout="this.className='btn_1'"/> 或 
				<input type="submit" value="批量询价" onclick="this.form.action='<?php echo $MOD['linkurl'];?>inquiry.php';" class="btn_1" onmouseover="this.className='btn_2'" onmouseout="this.className='btn_1'"/>
			</div>
		</div>
		<div class="img_tip" id="img_tip" style="display:none;">&nbsp;</div>
		<div class="tool">
			<table>
			<tr height="30">
			<td width="25" align="center" title="全选/反选">&nbsp;<input type="checkbox" onclick="checkall(this.form);"/><td>
			<td>
				<input type="submit" value="对比选中" onclick="this.form.action='<?php echo $MOD['linkurl'];?>compare.php';" class="btn_1" onmouseover="this.className='btn_2'" onmouseout="this.className='btn_1'"/>&nbsp;
				<input type="submit" value="批量询价" onclick="this.form.action='<?php echo $MOD['linkurl'];?>inquiry.php';" class="btn_1" onmouseover="this.className='btn_2'" onmouseout="this.className='btn_1'"/>
			</td>
			<td align="right">
			<script type="text/javascript">var sh = '<?php echo $MOD['linkurl'];?>search.php?catid=<?php echo $catid;?><?php if($typeid>-1) { ?>&typeid=<?php echo $typeid;?><?php } ?>';</script>
			<input type="checkbox" onclick="Go(sh+'&price=1');"/>标价&nbsp;
			<input type="checkbox" onclick="Go(sh+'&thumb=1');"/>图片&nbsp;
			<input type="checkbox" onclick="Go(sh+'&vip=1');"/><?php echo VIP;?>&nbsp;
			<select onchange="Go(sh+'&day='+this.value)">
			<option value="0">更新时间</option>
			<option value="1">1天内</option>
			<option value="3">3天内</option>
			<option value="7">7天内</option>
			<option value="15">15天内</option>
			<option value="30">30天内</option>
			</select>&nbsp;
			<select onchange="Go(sh+'&order='+this.value)">
			<option value="0">显示顺序</option>
			<option value="2">价格由高到低</option>
			<option value="3">价格由低到高</option>
			<option value="4"><?php echo VIP;?>级别由高到低</option>
			<option value="5"><?php echo VIP;?>级别由低到高</option>
			<option value="6">供货量由高到低</option>
			<option value="7">供货量由低到高</option>
			<option value="8">起订量由高到低</option>
			<option value="9">起订量由低到高</option>
			</select>&nbsp;	
			<img src="<?php echo DT_SKIN;?>image/list_txt.gif" width="16" height="16" alt="文字列表" align="absmiddle" class="c_p" onclick="Go(sh+'&list=2');"/>&nbsp;
			<img src="<?php echo DT_SKIN;?>image/list_img.gif" width="16" height="16" alt="图片列表" align="absmiddle" class="c_p" onclick="Go(sh+'&list=1');"/>&nbsp;
			<img src="<?php echo DT_SKIN;?>image/list_mix_on.gif" width="16" height="16" alt="图文列表" align="absmiddle" class="c_p" onclick="Go(sh+'&list=0');"/>&nbsp;
			</td>
			</tr>
			</table>
		</div>
		<?php if($page == 1) { ?><?php echo load('ad_m'.$moduleid.'.htm');?><?php } ?>		<?php echo tag("moduleid=$moduleid&condition=status=3$dtype&catid=$catid&pagesize=".$MOD['pagesize']."&page=$page&showpage=1&datetype=5&group=".$MOD['group']."&order=".$MOD['order']."&fields=".$MOD['fields']."&template=list-sell");?>
		<div class="tool">
			<table>
			<tr height="30">
			<td width="25" align="center">&nbsp;<td>
			<td>
				<input type="submit" value="对比选中" onclick="this.form.action='<?php echo $MOD['linkurl'];?>compare.php';" class="btn_1" onmouseover="this.className='btn_2'" onmouseout="this.className='btn_1'"/>&nbsp;
				<input type="submit" value="批量询价" onclick="this.form.action='<?php echo $MOD['linkurl'];?>inquiry.php';" class="btn_1" onmouseover="this.className='btn_2'" onmouseout="this.className='btn_1'"/>
			</td>
			<td align="right"><img src="<?php echo DT_SKIN;?>image/arrow.gif" width="17" height="12" alt=""/> <a href="javascript:window.scrollTo(0,0);">返回顶部</a>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo DT_SKIN;?>image/arrow.gif" width="17" height="12" alt=""/> <a href="<?php echo $MOD['linkurl'];?>search.php">高级搜索</a>&nbsp;</td>
			</tr>
			</table>
		</div>
		</form>
	<br/>
	</div>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r_1 f_l">
	<div class="sponsor"><?php echo ad($moduleid,$catid,$kw,7);?></div>
	<div class="box_head_1"><div><strong>本周搜索排行</strong></div></div>
	<div class="box_body">
		<div class="rank_list">
			<?php echo tag("moduleid=$moduleid&table=keyword&condition=moduleid=$moduleid and status=3 and updatetime>$today_endtime-86400*7&pagesize=10&order=week_search desc&key=week_search&template=list-search_rank", -2);?>
		</div>		
	</div>
	<div class="b10">&nbsp;</div>
	<div class="box_head_1"><div><strong>按地区浏览</strong></div></div>
	<div class="box_body">
			<table width="100%" cellpadding="3">
			<?php $mainarea = get_mainarea(0, $AREA)?>
			<?php if(is_array($mainarea)) { foreach($mainarea as $k => $v) { ?>
			<?php if($k%2==0) { ?><tr><?php } ?>
			<td><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?areaid='.$v['areaid'].'&typeid='.$typeid);?>"><?php echo $v['areaname'];?></a></td>
			<?php if($k%2==1) { ?></tr><?php } ?>
			<?php } } ?>
			</table>
	</div>
</div>
</div>
<?php include template('footer');?>