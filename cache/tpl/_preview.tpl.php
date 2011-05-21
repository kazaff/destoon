<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<link rel="stylesheet" type="text/css" href="<?php echo DT_SKIN;?>index.css"/>
<div class="m">
<table width="100%" cellspacing="0" cellpadding="0">
<tr align="center">
<td><?php echo ad(20);?></td>
<td><?php echo ad(21);?></td>
<td><?php echo ad(22);?></td>
<td><?php echo ad(23);?></td>
<td><?php echo ad(24);?></td>
<td><?php echo ad(25);?></td>
</tr>
</table>
</div>
<div class="m b10">&nbsp;</div>
<div class="m">
	<div class="m_l f_l">
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
		<td width="240" valign="top">
			<?php if($DT['page_price']) { ?>
			<div class="quote_head">
			<span class="f_r">
			<form action="<?php echo $MODULE['7']['linkurl'];?>price.php" onsubmit="return quote_search();">
			<input type="text" size="12" value="输入产品名" name="kw" id="quote_kw" class="quote_head_i" onclick="if(this.value=='输入产品名')this.value='';"/> <input type="image" src="<?php echo DT_SKIN;?>image/btn_quote.gif" align="absmiddle"/>
			</form>
			</span>
			<div><a href="<?php echo $MODULE['7']['linkurl'];?><?php echo rewrite('price.php?product=all');?>" class="w"><strong>行情速递</strong></a></div>
			</div>
			<div class="quote_body">
				<div id="quote_0" style="height:140px;overflow:hidden;">
				<div id="quote_1">
				<?php $tags=tag("moduleid=5&table=sell&condition=tag<>'' and unit<>'' and price>0 and status=3&pagesize=".$DT['page_price']."&order=edittime desc&template=null");?>
				<ul>
				<?php if(is_array($tags)) { foreach($tags as $k => $t) { ?>
				<li><span class="f_r">&nbsp;<?php echo $t['price'];?> <?php echo $DT['money_unit'];?> / <?php echo $t['unit'];?></span><a href="<?php echo $t['linkurl'];?>" target="_blank" title="[<?php echo area_pos($t['areaid'], '', 2);?>] <?php echo $t['alt'];?>"><?php echo $t['tag'];?></a></li>
				<?php } } ?>
				</ul>
				</div>
				</div>
			</div>
			<?php } ?>
		</td>
		<td>&nbsp;</td>
		<td width="400" valign="top">
		<div><?php echo ad(14);?></div>
		<div class="announce"><a href="<?php echo extendurl('announce');?>"><strong>公告栏：</strong></a> <a href=" " id="printAnnounce" target="_blank"></a></div>
		</td>
		</tr>
		</table>
	</div>
	<div class="m_n f_l">&nbsp;</div>
	<div class="m_r f_l">
		<?php if($DT['page_login']) { ?>
		<?php include template('user', 'chip');?>
		<?php } ?>
	</div>
</div>

<div class="m b10"></div>

<div class="m">
	<div class="m_l f_l">
		<?php if($DT['page_trade']) { ?>
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
		<td width="320" valign="top">
			<div class="trade_head"><span class="f_r c_p"><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?action=add&mid=5"><img src="<?php echo DT_SKIN;?>image/ico_page_add.gif" width="18" height="18" title="发布供应信息" alt=""/></a>&nbsp;<img src="<?php echo DT_SKIN;?>image/ico_page_pre.gif" width="18" height="18"  title="上一页" alt="" onclick="ipage('sell', '-');"/>&nbsp;<img src="<?php echo DT_SKIN;?>image/ico_page_nxt.gif" width="18" height="18"  title="下一页" alt="" onclick="ipage('sell', '+');"/></span><a href="<?php echo $MODULE['5']['linkurl'];?>"><strong>供应信息</strong></a></div>
			<div class="trade_body" id="isell"><?php echo tag("moduleid=5&condition=status=3&pagesize=".$DT['page_trade']."&datetype=2&order=addtime desc&time=addtime&template=list-trade");?></div>
		</td>
		<td width="10">&nbsp;</td>
		<td valign="top">
			<div class="trade_head"><span class="f_r c_p"><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?action=add&mid=6"><img src="<?php echo DT_SKIN;?>image/ico_page_add.gif" width="18" height="18" title="发布求购信息" alt=""/></a>&nbsp;<img src="<?php echo DT_SKIN;?>image/ico_page_pre.gif" width="18" height="18" title="上一页" alt="" onclick="ipage('buy', '-');"/>&nbsp;<img src="<?php echo DT_SKIN;?>image/ico_page_nxt.gif" width="18" height="18" title="下一页" alt="" onclick="ipage('buy', '+');"/></span><a href="<?php echo $MODULE['6']['linkurl'];?>"><strong>求购信息</strong></a></div>
			<div class="trade_body" id="ibuy"><?php echo tag("moduleid=6&condition=status=3&pagesize=".$DT['page_trade']."&datetype=2&order=addtime desc&time=addtime&template=list-trade");?></div>
		</td>
		</tr>
		</table>
		<?php } ?>
	</div>
	<div class="m_n f_l">&nbsp;</div>
	<div class="m_r f_l">
	<?php if($DT['page_com']) { ?>
		<div class="tab_head">
		<ul>
			<li class="tab_2" id="com_t_1" onmouseover="Tb(1, 2, 'com', 'tab');"><a href="<?php echo $MODULE['4']['linkurl'];?>"><?php echo VIP;?>企业</a></li>
			<li class="tab_1" id="com_t_2" onmouseover="Tb(2, 2, 'com', 'tab');"><a href="<?php echo $MODULE['4']['linkurl'];?>">最新企业</a></li>
			<li>&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE['2']['linkurl'];?>grade.php" class="f_n">我如何加入?</a></li>
		</ul>
		</div>
		<div class="box_body li_dot">
			<div id="com_c_1" style="display:">
			<?php echo tag("moduleid=4&condition=vip>0 and catids<>''&pagesize=".$DT['page_com']."&order=fromtime desc&template=list-com");?>
			</div>
			<div id="com_c_2" style="display:none">
			<?php echo tag("moduleid=4&condition=groupid>5 and catids<>''&pagesize=".$DT['page_com']."&order=userid desc&template=list-com");?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

<div class="m b10"></div>

<div class="m">
	<div class="m_l f_l">
		<?php if($DT['page_product']) { ?>
		<div class="tab_head_2">
		<ul>
			<li class="tab_2_2" id="product_t_1" onmouseover="Tb(1, 3, 'product', 'tab_2');"><a href="<?php echo $MODULE['5']['linkurl'];?>"><span>推荐产品</span></a></li>
			<li class="tab_2_1" id="product_t_2" onmouseover="Tb(2, 3, 'product', 'tab_2');"><a href="<?php echo $MODULE['5']['linkurl'];?>"><span>最新产品</span></a></li>
			<li class="tab_2_1" id="product_t_3" onmouseover="Tb(3, 3, 'product', 'tab_2');"><a href="<?php echo $MODULE['5']['linkurl'];?>"><span>热门产品</span></a></li>
		</ul>
		</div>
		<div class="tab_body_2 product">
			<div id="product_c_1" style="display:">
			<?php echo tag("moduleid=5&length=14&condition=status=3 and level>0 and thumb<>''&pagesize=".$DT['page_product']."&order=addtime desc&width=80&height=80&cols=6&target=_blank&template=thumb-product");?>
			</div>
			<div id="product_c_2" style="display:none">
			<?php echo tag("moduleid=5&length=14&condition=status=3 and thumb<>''&pagesize=".$DT['page_product']."&order=addtime desc&width=80&height=80&cols=6&target=_blank&template=thumb-product");?>
			</div>
			<div id="product_c_3" style="display:none">
			<?php echo tag("moduleid=5&length=14&condition=status=3 and thumb<>'' and addtime>$today_endtime-15*86400&pagesize=".$DT['page_product']."&order=hits desc&width=80&height=80&cols=6&target=_blank&template=thumb-product");?>
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="m_n f_l">&nbsp;</div>
	<div class="m_r f_l">
		<?php if($DT['page_news']) { ?>
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['21']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['21']['linkurl'];?>"><strong>行业资讯</strong></a></div></div>
		<div class="box_body c_b">
		<?php if($DT['page_newsh']) { ?>
		<div class="headline">
		<?php echo tag("moduleid=21&condition=status=3 and level=5&order=addtime desc&pagesize=1&target=_blank&template=list-hl");?>
		</div>
		<?php } ?>
		<?php if($DT['page_newsr']) { ?>
		<table width="100%" cellspacing="2" cellpadding="2" class="newsr">
		<tr>
		<td valign="top" width="120" class="imb"><?php echo tag("moduleid=21&length=16&condition=status=3 and level=3 and thumb<>''&pagesize=1&target=_blank&order=addtime desc&width=100&height=80&cols=1&template=thumb-table");?></td>
		<td valign="top"><?php echo tag("moduleid=21&condition=status=3 and level=1&pagesize=5&order=addtime desc&target=_blank");?></td>
		</tr>
		</table>
		<?php } ?>
		<div class="li_dot f_gray">
		<?php echo tag("moduleid=21&condition=status=3&pagesize=".$DT['page_news']."&datetype=2&order=addtime desc&target=_blank");?></div>
		</div>
		<?php } ?>
	</div>
</div>

<div class="m b10"></div>

<div class="m">
	<div class="m_l f_l">
		<?php if($DT['page_catalog']) { ?>
		<?php echo load('catalog.css');?>
		<div class="catalog_menu">
			<div class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?action=add&mid=5" target="_blank" id="iadd"><img src="<?php echo DT_SKIN;?>image/btn_add.gif" width="81" height="20" title="发布信息" alt="" onmouseover="this.src='<?php echo DT_SKIN;?>image/btn_add_on.gif';" onmouseout="this.src='<?php echo DT_SKIN;?>image/btn_add.gif';"/></a></div>
			<div>
				<ul>
					<li id="catalog_0" class="catalog_on" onclick="catalog(0);">供应</li>
					<li id="catalog_1" class="catalog_li" onclick="catalog(1);">求购</li>
					<li id="catalog_2" class="catalog_li" onclick="catalog(2);">公司</li>
				</ul>
			</div>
		</div>
		<?php if($DT['page_letter']) { ?>
		<div class="catalog_letter">
			<div>拼音索引</div>
			<ul>
			<?php if(is_array($LETTER)) { foreach($LETTER as $l) { ?>
				<li id="index_<?php echo $l;?>" class="catalog_letter_li" onmouseover="index_timer('<?php echo $l;?>');" onmouseout="index_out();"><?php echo $l;?></li>
			<?php } } ?>
			</ul>
		</div>
		<?php } ?>
		<div class="dsn" id="catalog_index" onmouseout="index_leave(this, event);"></div>
		<div class="catalog c_b">		
		<div id="catalog">
			<?php $mid = 5;?>
			<?php include template('catalog', 'chip');?>
		</div>
		</div>
		<div class="b10 c_b"></div>
		<?php } ?>
		<?php if($DT['page_brand']) { ?>
		<div class="box_head"><div><span class="f_r"><a href="<?php echo $MODULE['13']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['13']['linkurl'];?>"><strong>品牌展示</strong></a></div></div>
		<div class="box_body">
		<div class="thumb"><?php echo tag("moduleid=13&condition=status=3 and level>0&pagesize=".$DT['page_brand']."&order=addtime desc&width=120&height=40&cols=4&target=_blank&template=thumb-brand");?></div>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>
		<?php if($DT['page_exhibit']) { ?>
		<div class="box_head"><div><span class="f_r"><a href="<?php echo $MODULE['8']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['8']['linkurl'];?>"><strong>行业展会</strong></a></div></div>
		<div class="box_body li_dot">
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td valign="top" width="495">
				<?php $tags=tag("moduleid=8&condition=status=3&pagesize=".$DT['page_exhibit']."&order=addtime desc&template=null");?>
				<ul>
				<?php if(is_array($tags)) { foreach($tags as $t) { ?>
				<li title="<?php echo $t['alt'];?>&#13;<?php echo timetodate($t['fromtime'], 'Y年m月d日');?> 至 <?php echo timetodate($t['totime'], 'Y年m月d日');?>"><span class="f_r">[<?php echo $t['city'];?>]</span><a href="<?php echo $t['linkurl'];?>" target="_blank"><?php echo $t['title'];?></a></li>
				<?php } } ?>
				</ul>			
			</td>
			<td> </td>
			<td valign="top" width="155">
				<div class="b5">&nbsp;</div>
				<?php echo ad(5);?>
				<div class="b5">&nbsp;</div>
				<?php echo ad(6);?>			
			</td>
			</tr>
			</table>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>

		<?php if($DT['page_job']) { ?>
		<div class="tab_head">
		<ul>
			<li class="tab_2" id="job_t_1" onmouseover="Tb(1, 2, 'job', 'tab');"><a href="<?php echo $MODULE['9']['linkurl'];?>">招聘信息</a></li>
			<li class="tab_1" id="job_t_2" onmouseover="Tb(2, 2, 'job', 'tab');"><a href="<?php echo $MODULE['9']['linkurl'];?>">求职简历</a></li>
		</ul>
		</div>
		<div class="box_body">
			<div id="job_c_1" style="display:">
			<?php echo tag("moduleid=9&condition=status=3&pagesize=".$DT['page_job']."&length=30&group=username&order=edittime desc&template=table-job");?>
			</div>
			<div id="job_c_2" style="display:none">
			<?php echo tag("moduleid=9&table=resume&condition=status=3 and open=3&pagesize=".$DT['page_job']."&group=username&order=edittime desc&template=table-resume");?>
			</div>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>

		<?php if($DT['page_photo']) { ?>
		<div class="box_head"><div><span class="f_r"><a href="<?php echo $MODULE['12']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['12']['linkurl'];?>"><strong>图片中心</strong></a></div></div>
		<div class="box_body">
		<div class="thumb"><?php echo tag("moduleid=12&condition=status=3 and open=3 and level>0&pagesize=".$DT['page_photo']."&order=addtime desc&width=120&height=90&cols=4&target=_blank&template=list-photo");?></div>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>
	</div>
	<div class="m_n f_l">&nbsp;</div>
	<div class="m_r f_l">

		<?php if($DT['page_comnews']) { ?>
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['4']['linkurl'];?><?php echo rewrite('news.php?more=1');?>">更多..</a></span><a href="<?php echo $MODULE['4']['linkurl'];?><?php echo rewrite('news.php?more=1');?>"><strong>企业新闻</strong></a></div></div>
		<div class="box_body li_dot f_gray">
		<?php echo tag("table=news&condition=status=3 and level>0&pagesize=".$DT['page_comnews']."&datetype=2&order=addtime desc&target=_blank");?>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>

		<?php if($DT['page_special']) { ?>
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['11']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['11']['linkurl'];?>"><strong>最新专题</strong></a></div></div>
		<div class="box_body li_dot f_gray">
		<?php echo tag("moduleid=11&condition=status=3&pagesize=".$DT['page_special']."&datetype=2&order=addtime desc&target=_blank");?>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>

		<?php if($DT['page_quote']) { ?>
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['7']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['7']['linkurl'];?>"><strong>行情报价</strong></a></div></div>
		<div class="box_body li_dot f_gray">
		<?php echo tag("moduleid=7&condition=status=3&pagesize=".$DT['page_quote']."&datetype=2&order=addtime desc&target=_blank");?>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>

		<?php if($DT['page_info']) { ?>
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['22']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['22']['linkurl'];?>"><strong>招商代理</strong></a></div></div>
		<div class="box_body li_dot f_gray">
		<?php echo tag("moduleid=22&condition=status=3&pagesize=".$DT['page_info']."&datetype=2&order=addtime desc&target=_blank");?>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>

		<?php if($DT['page_video']) { ?>
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['14']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['14']['linkurl'];?>"><strong>推荐视频</strong></a></div></div>
		<div class="box_body f_gray video">
		<?php echo tag("moduleid=14&condition=status=3 and level>0&pagesize=".$DT['page_video']."&datetype=2&order=addtime desc&target=_blank");?>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>

		<?php if($DT['page_know']) { ?>		
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['10']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['10']['linkurl'];?>"><strong>行业知道</strong></a></div></div>
		<div class="box_body li_dot f_gray">
		<?php $tags=tag("moduleid=10&condition=status=3 and process>0&pagesize=".$DT['page_know']."&order=addtime desc&template=null");?>
		<ul>
		<?php if(is_array($tags)) { foreach($tags as $t) { ?>
		<li><span class="f_r"><?php echo timetodate($t['addtime'], 2);?></span><?php if($t['credit']) { ?><span class="know_credit"><?php echo $t['credit'];?></span> <?php } ?><a href="<?php echo $t['linkurl'];?>" target="_blank" title="<?php echo $t['alt'];?>"><?php echo $t['title'];?></a></li>
		<?php } } ?>
		</ul>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>
		<?php if($DT['page_down']) { ?>		
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['15']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['15']['linkurl'];?>"><strong>资料下载</strong></a></div></div>
		<div class="box_body f_gray">
		<?php echo tag("moduleid=15&condition=status=3&pagesize=".$DT['page_down']."&target=_blank&order=addtime desc&template=list-down");?>
		</div>
		<div class="b10">&nbsp;</div>
		<?php } ?>


<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['15']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['15']['linkurl'];?>"><strong>最新招标任务</strong></a></div></div>
		<div class="box_body f_gray">
		<?php $data = file_get_contents('http://localhost/destoon/KPPW/control/admin/plu.php?do=previewtag&tagid=7');?>
                <ul>
                <?php echo $data?>
                </ul>
		</div>
		<div class="b10">&nbsp;</div>




		<?php if($DT['page_vote']) { ?>
		<div class="box_head_1"><div><span class="f_r"><a href="<?php echo extendurl('vote');?>">更多..</a></span><a href="<?php echo extendurl('vote');?>"><strong>投票调查</strong></a></div></div>
		<div class="box_body"><?php echo tag("table=vote&condition=level>0&pagesize=".$DT['page_vote']."&order=addtime desc&template=list-vote");?></div>
		<div class="b10">&nbsp;</div>
		<?php } ?>
	</div>
</div>
<?php if($DT['page_logo'] || $DT['page_text']) { ?>
<div class="m">
	<div class="tab_head">
	<ul>
		<li class="tab_2"><a href="<?php echo extendurl('link');?>">友情链接</a></li>
		<li class="tab_1"><a href="<?php echo extendurl('link');?><?php echo rewrite('index.php?action=reg');?>">申请链接</a></li>
	</ul>
	</div>
	<div class="box_body">
	<?php if($DT['page_logo']) { ?>
	<?php echo tag("table=link&condition=status=3 and level>0 and thumb<>'' and username=''&pagesize=".$DT['page_logo']."&order=listorder desc,itemid desc&template=list-link&cols=9");?>
	<?php } ?>
	<?php if($DT['page_text']) { ?>
	<?php echo tag("table=link&condition=status=3 and level>0 and thumb='' and username=''&pagesize=".$DT['page_text']."&order=listorder desc,itemid desc&template=list-link&cols=9");?>
	<?php } ?>
	</div>
</div>
<?php } ?>
<script type="text/javascript">
var curls = ['<?php echo $MODULE['5']['linkurl'];?>','<?php echo $MODULE['6']['linkurl'];?>','<?php echo $MODULE['4']['linkurl'];?>'];
var member_myurl = '<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>';
</script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/index.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/quote.js"></script>
<?php $tags=tag("table=announce&condition=1&pagesize=3&datetype=2&order=listorder desc,addtime desc&template=null");?>
<script type="text/javascript">
var announcetitle = new Array(); 
var announcehref = new Array(); 
<?php if($tags) { ?>
<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
announcetitle[<?php echo $i;?>] = '[<?php echo timetodate($t['addtime'], 2);?>] <?php echo str_replace("'", "\'", $t['title']);?>';
announcehref[<?php echo $i;?>] = '<?php echo $t['linkurl'];?>';
<?php } } ?>
<?php } else { ?>
announcetitle[0] = '暂无公告';
announcehref[0] = DTPath;
<?php } ?>
showannounce();
</script>
<?php include template('footer');?>