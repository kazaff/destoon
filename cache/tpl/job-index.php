<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<script type="text/javascript">
function job_search(id) {
	if(id == 1) {
		$('jst_1').className = 'type_1';
		$('jst_2').className = 'type_2';
		$('add_link').href = '<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?action=add&mid=<?php echo $moduleid;?>';
		$('add_img').src = '<?php echo DT_SKIN;?>image/add_job.gif';
		$('sbm_img').src = '<?php echo DT_SKIN;?>image/job_search.gif';
		$('action').value = '';
	} else if(id == 2) {
		$('jst_1').className = 'type_2';
		$('jst_2').className = 'type_1';
		$('add_link').href = '<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?action=add&mid=<?php echo $moduleid;?>&resume=1';
		$('add_img').src = '<?php echo DT_SKIN;?>image/add_resume.gif';
		$('sbm_img').src = '<?php echo DT_SKIN;?>image/resume_search.gif';
		$('action').value = 'resume';
	}
	$('search_all').href = $('jst_'+id).href;
}
</script>
<div class="m">
<div class="m_l f_l">
	<div class="left_box" style="border-top:none;">
		<div class="type">
		<a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?action=job');?>" class="type_1" id="jst_1" onmouseover="job_search(1);">职位搜索</a>
		<a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?action=resume');?>" class="type_2" id="jst_2" onmouseover="job_search(2);">人才搜索</a>
		</div>
		<div class="b10">&nbsp;</div>
		<form action="<?php echo $MOD['linkurl'];?>search.php" id="fsearch">
		<input type="hidden" name="action" id="action" value="job"/>
		<table cellpadding="5" cellspacing="5" width="100%">
		<tr>
		<td width="80" align="right">关 键 词：</td>
		<td><input type="text" size="50" name="kw" style="padding:3px 0 3px 1px;"/>&nbsp;&nbsp;<span class="f_gray">可直接输入职位名称、城市名等</span></td>
		</tr>
		<tr>
		<td align="right">行业/职位：</td>
		<td>
		<?php echo ajax_category_select('catid', '选择行业/职位', 0, $moduleid);?>
		&nbsp;&nbsp;&nbsp;
		地区：
		<?php echo ajax_area_select('areaid', '选择地区');?>
		</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td>
		<input type="image" src="<?php echo DT_SKIN;?>image/job_search.gif" id="sbm_img"/>
		&nbsp;&nbsp;
		<a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?action=job');?>" id="search_all"><img src="<?php echo DT_SKIN;?>image/btn_advance_search.gif"/></a>
		<a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?action=add&mid=<?php echo $moduleid;?>" id="add_link"><img src="<?php echo DT_SKIN;?>image/add_job.gif" style="margin-left:150px;" id="add_img"/></a>
		</td>
		</tr>
		</table>
		</form>
	</div>
	<div class="b10">&nbsp;</div>
	<?php if($MOD['page_ijob']) { ?>
	<div class="tab_head">
	<ul>
		<li class="tab_2" id="job_t_1" onmouseover="Tb(1, 2, 'job', 'tab');">最新招聘</li>
		<li class="tab_1" id="job_t_2" onmouseover="Tb(2, 2, 'job', 'tab');">推荐招聘</li>
	</ul>
	</div>
	<div class="box_body">
		<div id="job_c_1" style="display:">
		<?php echo tag("moduleid=$moduleid&condition=status=3&pagesize=".$MOD['page_ijob']."&length=20&group=username&order=".$MOD['order']."&template=table-job");?>
		</div>
		<div id="job_c_2" style="display:none">
		<?php echo tag("moduleid=$moduleid&condition=status=3 and level>0&pagesize=".$MOD['page_ijob']."&length=20&group=username&order=".$MOD['order']."&template=table-job");?>
		</div>
	</div>
	<div class="b10">&nbsp;</div>
	<?php } ?>
	<?php if($MOD['page_iresume']) { ?>
	<div class="tab_head">
	<ul>
		<li class="tab_2" id="resume_t_1" onmouseover="Tb(1, 2, 'resume', 'tab');">最新简历</li>
		<li class="tab_1" id="resume_t_2" onmouseover="Tb(2, 2, 'resume', 'tab');">推荐简历</li>
	</ul>
	</div>
	<div class="box_body">
		<div id="resume_c_1" style="display:">
		<?php echo tag("moduleid=$moduleid&table=resume&condition=status=3 and open=3&pagesize=".$MOD['page_iresume']."&length=20&group=username&order=edittime desc&template=table-resume");?>
		</div>
		<div id="resume_c_2" style="display:none">
		<?php echo tag("moduleid=$moduleid&table=resume&condition=status=3 and open=3 and level>0&pagesize=".$MOD['page_iresume']."&length=20&group=username&order=edittime desc&template=table-resume");?>
		</div>
	</div>
	<?php } ?>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r f_l">
	<div class="box_head_1"><div><strong>按行业浏览</strong></div></div>
	<div class="box_body">
	<div class="b5">&nbsp;</div>
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr align="center">
	<td width="20" height="20" class="tab_1_1">&nbsp;&nbsp;</td>
	<td width="50" class="tab_1_2" id="cat_t_1" onmouseover="Tb(1, 2, 'cat', 'tab_1');">招聘</td>
	<td width="50" class="tab_1_1" id="cat_t_2" onmouseover="Tb(2, 2, 'cat', 'tab_1');">求职</td>
	<td class="tab_1_1">&nbsp;&nbsp;</td>
	</tr>
	</table>
	<div class="b10">&nbsp;</div>
	<div id="cat_c_1" style="display:">
	<table width="100%" cellpadding="3">
	<?php if(is_array($maincat)) { foreach($maincat as $k => $v) { ?>
	<?php if($k%2==0) { ?><tr><?php } ?>
	<td width="25%"><a href="<?php echo $MOD['linkurl'];?><?php echo $v['linkurl'];?>"><?php echo set_style($v['catname'],$v['style']);?></a> <span class="f_gray px10">(<?php echo $ITEMS[$v['catid']];?>)</span></td>
	<?php if($k%2==1) { ?></tr><?php } ?>
	<?php } } ?>
	</table>
	</div>
	<div id="cat_c_2" style="display:none;">
	<table width="100%" cellpadding="3">
	<?php if(is_array($maincat)) { foreach($maincat as $k => $v) { ?>
	<?php if($k%2==0) { ?><tr><?php } ?>
	<td width="25%"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?action=resume&catid='.$v['catid']);?>"><?php echo set_style($v['catname'],$v['style']);?></a></td>
	<?php if($k%2==1) { ?></tr><?php } ?>
	<?php } } ?>
	</table>
	</div>
	</div>
	<div class="b10 c_b">&nbsp;</div>
	<div class="box_head_1"><div><strong>按地区浏览</strong></div></div>
	<div class="box_body">
	<div class="b5">&nbsp;</div>
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr align="center">
	<td width="20" height="20" class="tab_1_1">&nbsp;&nbsp;</td>
	<td width="50" class="tab_1_2" id="area_t_1" onmouseover="Tb(1, 2, 'area', 'tab_1');">招聘</td>
	<td width="50" class="tab_1_1" id="area_t_2" onmouseover="Tb(2, 2, 'area', 'tab_1');">求职</td>
	<td class="tab_1_1">&nbsp;&nbsp;</td>
	</tr>
	</table>
	<div class="b10">&nbsp;</div>
	<?php $mainarea = get_mainarea(0, $AREA)?>
	<div id="area_c_1" style="display:">
	<table width="100%" cellpadding="3">
	<?php if(is_array($mainarea)) { foreach($mainarea as $k => $v) { ?>
	<?php if($k%4==0) { ?><tr><?php } ?>
	<td><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?areaid='.$v['areaid']);?>"><?php echo $v['areaname'];?></a></td>
	<?php if($k%4==3) { ?></tr><?php } ?>
	<?php } } ?>
	</table>
	</div>
	<div id="area_c_2" style="display:none">
	<table width="100%" cellpadding="3">
	<?php if(is_array($mainarea)) { foreach($mainarea as $k => $v) { ?>
	<?php if($k%4==0) { ?><tr><?php } ?>
	<td><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?action=resume&areaid='.$v['areaid']);?>"><?php echo $v['areaname'];?></a></td>
	<?php if($k%4==3) { ?></tr><?php } ?>
	<?php } } ?>
	</table>
	</div>
	</div>
</div>
</div>
<?php include template('footer');?>