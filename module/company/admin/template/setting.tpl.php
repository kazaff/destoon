<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
$menus = array (
    array('基本设置'),
    array('SEO设置'),
    array('权限收费'),
    array('定义字段', '?file=fields&tb='.$table),
    array('模板管理', '?file=template&dir='.$module),
);
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="tab" id="tab" value="<?php echo $tab;?>"/>
<div id="Tabs0" style="display:">
<div class="tt">基本设置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">信息排序方式</td>
<td>
<input type="text" size="50" name="setting[order]" value="<?php echo $order;?>" id="order"/>
<select onchange="if(this.value) $('order').value=this.value;">
<option value="">请选择</option>
<option value="vip desc"<?php if($order == 'vip desc') echo ' selected';?>><?php echo VIP;?>级别</option>
<option value="userid desc"<?php if($order == 'userid desc') echo ' selected';?>>会员ID</option>
</select>
</td>
</tr>
<tr>
<td class="tl">列表或搜索主字段</td>
<td><input type="text" size="80" name="setting[fields]" value="<?php echo $fields;?>"/><?php tips('此项可在一定程度上提高列表或搜索效率，请勿随意修改以免导致SQL错误');?></td>
</tr>
<tr>
<td class="tl">内容分表</td>
<td>
<input type="radio" name="setting[split]" value="1"  <?php if($split) echo 'checked';?> onclick="Ds('split_b');Dh('split_a');confirm('提示:开启之前必须先拆分内容\n\n此设置比较关键，开启后建议不要再关闭');"/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[split]" value="0"  <?php if(!$split) echo 'checked';?> onclick="Ds('split_a');Dh('split_b');confirm('提示:关闭之前必须先合并内容');"/> 关闭
&nbsp;&nbsp;
<span style="display:none;" id="split_a">
<a href="?file=split&mid=<?php echo $moduleid;?>&action=merge" target="_blank" class="t" onclick="return confirm('确定要合并内容吗？合并成功之后请立即关闭内容分表\n\n建议在合并之前备份一次数据库');">[合并内容]</a>
</span>
<span style="display:none;" id="split_b">
<a href="?file=split&mid=<?php echo $moduleid;?>" target="_blank" class="t" onclick="return confirm('确定要拆分内容吗？合并成功之后请立即开启内容分表\n\n建议在拆分之前备份一次数据库');">[拆分内容]</a>
</span>
&nbsp;<?php tips('如果开启内容分表，内容表将根据id号50万数据创建一个分区<br/>如果你的数据少于50万，则不需要开启，当前最大id为'.$maxid.'，'.($maxid > 500000 ? '建议开启' : '无需开启').'<br/>如果需要开启，请先点拆分内容，然后保存设置<br/>如果需要关闭，请先点合并内容，然后保存设置<br/>此项一旦开启，请不要随意关闭，以免出现未知错误，同时全文搜索将关闭');?>
<input type="hidden" name="maxid" value="<?php echo $maxid;?>"/>
</td>
</tr>
<tr>
<td class="tl">公司主页显示评论</td>
<td>
<input type="radio" name="setting[comment]" value="1"  <?php if($comment){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment]" value="0"  <?php if(!$comment){ ?>checked <?php } ?>/> 关闭 </td>
</tr>
<tr>
<td class="tl">公司主页信息链接到主站</td>
<td>
<input type="radio" name="setting[homeurl]" value="1"  <?php if($homeurl){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[homeurl]" value="0"  <?php if(!$homeurl){ ?>checked <?php } ?>/> 关闭 </td>
</tr>
<tr>
<td class="tl">资料未完善公司主页</td>
<td>
<input type="radio" name="setting[openall]" value="1"  <?php if($openall){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[openall]" value="0"  <?php if(!$openall){ ?>checked <?php } ?>/> 关闭 </td>
</tr>
<tr>
<td class="tl"><?php echo VIP;?>指数计算规则</td>
<td>
	<table cellpadding="3" cellspacing="1" width="400" bgcolor="#E5E5E5" style="margin:5px;">
	<tr align="center">
	<td>项目</td>
	<td>值</td>
	<td>最大值</td>
	</tr>
	<tr align="center">
	<td>会员组<?php echo VIP;?>指数</td>
	<td>相等</td>
	<td><input type="text" size="2" name="setting[vip_maxgroupvip]" value="<?php echo $vip_maxgroupvip;?>"/></td>
	</tr>
	<tr align="center">
	<td>企业资料认证</td>
	<td><input type="text" size="2" name="setting[vip_cominfo]" value="<?php echo $vip_cominfo;?>"/></td>
	<td><?php echo $vip_cominfo;?></td>
	</tr>
	<tr align="center">
	<td>VIP年份（单位：值/年）</td>
	<td><input type="text" size="2" name="setting[vip_year]" value="<?php echo $vip_year;?>"/></td>
	<td><input type="text" size="2" name="setting[vip_maxyear]" value="<?php echo $vip_maxyear;?>"/></td>
	</tr>
	<tr align="center">
	<td>5张以上资质证书</td>
	<td><input type="text" size="2" name="setting[vip_credit]" value="<?php echo $vip_credit;?>"/></td>
	<td><?php echo $vip_credit;?></td>
	</tr>
	</table>
	<span class="f_gray">&nbsp;&nbsp;所有数值均为整数。<?php echo VIP;?>指数满分10分，故最大值之和应等于10</span>
</td>
</tr>
<tr>
<td class="tl">级别中文别名</td>
<td>
<input type="text" name="setting[level]" style="width:98%;" value="<?php echo $level;?>"/>
<br/>用 | 分隔不同别名 依次对应 1|2|3|4|5|6|7|8|9 级 <?php echo level_select('post[level]', '提交后点此预览效果');?>
</td>
</tr>

<tr>
<td class="tl">首页名企推荐数量</td>
<td><input type="text" size="3" name="setting[page_irec]" value="<?php echo $page_irec;?>"/></td>
</tr>

<tr>
<td class="tl">首页最新<?php echo VIP;?>数量</td>
<td><input type="text" size="3" name="setting[page_ivip]" value="<?php echo $page_ivip;?>"/></td>
</tr>

<tr>
<td class="tl">首页企业新闻数量</td>
<td><input type="text" size="3" name="setting[page_inews]" value="<?php echo $page_inews;?>"/></td>
</tr>

<tr>
<td class="tl">首页最新加入数量</td>
<td><input type="text" size="3" name="setting[page_inew]" value="<?php echo $page_inew;?>"/></td>
</tr>

<tr>
<td class="tl">列表信息分页数量</td>
<td><input type="text" size="3" name="setting[pagesize]" value="<?php echo $pagesize;?>"/></td>
</tr>


<tr>
<td class="tl">按分类浏览列数</td>
<td><input type="text" size="3" name="setting[page_subcat]" value="<?php echo $page_subcat;?>"/></td>
</tr>

</table>
</div>

<div id="Tabs1" style="display:none">
<div class="tt">SEO优化</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">模块首页Title(网页标题)</td>
<td><input name="setting[seo_title_index]" type="text" id="seo_title_index" value="<?php echo $seo_title_index;?>" style="width:98%;"><br/> 
常用变量：<?php echo seo_title('seo_title_index', array('modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?><br/>
支持页面PHP变量，例如{$MOD[name]}表示模块名称
</td>
</tr>
<tr>
<td class="tl">Meta Keywords<br/>(网页关键词)</td>
<td><textarea name="setting[seo_keywords]" cols="60" rows="3" id="seo_keywords"><?php echo $seo_keywords;?></textarea></td>
</tr>
<tr>
<td class="tl">Meta Description<br/>(网页描述)</td>
<td><textarea name="setting[seo_description]" cols="60" rows="3" id="seo_description"><?php echo $seo_description;?></textarea></td>
</tr>
<tr>
<td class="tl">列表页Title(网页标题)</td>
<td><input name="setting[seo_title_list]" type="text" id="seo_title_list" value="<?php echo $seo_title_list;?>" style="width:98%;"><br/> 
<?php echo seo_title('seo_title_list', array('catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?>
</td>
</tr>
<tr>
<td class="tl">搜索页Title(网页标题)</td>
<td><input name="setting[seo_title_search]" type="text" id="seo_title_search" value="<?php echo $seo_title_search;?>" style="width:98%;"><br/> 
<?php echo seo_title('seo_title_search', array('kw', 'areaname', 'catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?>
</td>
</tr>
<tr>
<td class="tl">首页是否生成html</td>
<td>
<input type="radio" name="setting[index_html]" value="1"  <?php if($index_html){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[index_html]" value="0"  <?php if(!$index_html){ ?>checked <?php } ?>/> 否
</td>
</tr>
<tr>
<td class="tl">列表页是否生成html</td>
<td>
<input type="radio" name="setting[list_html]" value="1"  <?php if($list_html){ ?>checked <?php } ?> onclick="$('list_html').style.display='';$('list_php').style.display='none';"/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[list_html]" value="0"  <?php if(!$list_html){ ?>checked <?php } ?> onclick="$('list_html').style.display='none';$('list_php').style.display='';"/> 否
</td>
</tr>
<tbody id="list_html" style="display:<?php echo $list_html ? '' : 'none'; ?>">
<tr>
<td class="tl">HTML列表页文件名前缀</td>
<td><input name="setting[htm_list_prefix]" type="text" id="htm_list_prefix" value="<?php echo $htm_list_prefix;?>" size="10"></td>
</tr>
<tr>
<td class="tl">HTML列表页地址规则</td>
<td><?php echo url_select('setting[htm_list_urlid]', 'htm', 'list', $htm_list_urlid);?><?php tips('提示:规则列表可在./api/url.inc.php文件里自定义');?></td>
</tr>
</tbody>
<tr id="list_php" style="display:<?php echo $list_html ? 'none' : ''; ?>">
<td class="tl">PHP列表页地址规则</td>
<td><?php echo url_select('setting[php_list_urlid]', 'php', 'list', $php_list_urlid);?></td>
</tr>
</table>
</div>


<div id="Tabs2" style="display:none">
<div class="tt">权限收费</div>
<table cellpadding="2" cellspacing="1" class="tb">

<tr>
<td class="tl">允许浏览模块首页</td>
<td><?php echo group_checkbox('setting[group_index][]', $group_index);?></td>
</tr>
<tr>
<td class="tl">允许浏览分类列表</td>
<td><?php echo group_checkbox('setting[group_list][]', $group_list);?></td>
</tr>

<tr>
<td class="tl">允许搜索信息</td>
<td><?php echo group_checkbox('setting[group_search][]', $group_search);?></td>
</tr>

<tr>
<td class="tl">允许查看公司主页联系方式</td>
<td><?php echo group_checkbox('setting[group_contact][]', $group_contact);?></td>
</tr>

<tr>
<td class="tl">允许查看公司主页采购列表</td>
<td><?php echo group_checkbox('setting[group_buy][]', $group_buy);?></td>
</tr>

<tr>
<td class="tl">允许在公司主页留言</td>
<td><?php echo group_checkbox('setting[group_message][]', $group_message);?></td>
</tr>

<tr>
<td class="tl">允许在公司主页询盘</td>
<td><?php echo group_checkbox('setting[group_inquiry][]', $group_inquiry);?></td>
</tr>

<tr>
<td class="tl">允许在公司主页报价</td>
<td><?php echo group_checkbox('setting[group_price][]', $group_price);?></td>
</tr>

</table>
</div>
<div class="sbt">
<input type="submit" name="submit" value="确 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="展 开" id="ShowAll" class="btn" onclick="TabAll();" title="展开/合并所有选项"/>
</div>
</form>
<script type="text/javascript">
var tab = <?php echo $tab;?>;
var all = <?php echo $all;?>;
function TabAll() {
	var i = 0;
	while(1) {
		if($('Tabs'+i) == null) break;
		$('Tabs'+i).style.display = all ? (i == tab ? '' : 'none') : '';
		i++;
	}
	$('ShowAll').value = all ? '展 开' : '合 并';
	all = all ? 0 : 1;
}
window.onload=function() {
	if(tab) Tab(tab);
	if(all) {all = 0; TabAll();}
}
</script>
</body>
</html>