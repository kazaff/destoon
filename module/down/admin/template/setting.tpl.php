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
<td class="tl">默认缩略图[宽X高]</td>
<td>
<input type="text" size="3" name="setting[thumb_width]" value="<?php echo $thumb_width;?>"/>
X
<input type="text" size="3" name="setting[thumb_height]" value="<?php echo $thumb_height;?>"/> px
</td>
</tr>

<tr>
<td class="tl">自动截取内容至简介</td>
<td><input type="text" size="3" name="setting[introduce_length]" value="<?php echo $introduce_length;?>"/> 字符</td>
</tr>
<tr>
<td class="tl">编辑器工具按钮</td>
<td>
<select name="setting[editor]">
<option value="Default"<?php if($editor == 'Default') echo ' selected';?>>全部</option>
<option value="Destoon"<?php if($editor == 'Destoon') echo ' selected';?>>精简</option>
<option value="Simple"<?php if($editor == 'Simple') echo ' selected';?>>简洁</option>
<option value="Basic"<?php if($editor == 'Basic') echo ' selected';?>>基础</option>
</select>
</td>
</tr>
<tr>
<td class="tl">信息排序方式</td>
<td>
<input type="text" size="50" name="setting[order]" value="<?php echo $order;?>" id="order"/>
<select onchange="if(this.value) $('order').value=this.value;">
<option value="">请选择</option>
<option value="addtime desc"<?php if($order == 'addtime desc') echo ' selected';?>>添加时间</option>
<option value="edittime desc"<?php if($order == 'edittime desc') echo ' selected';?>>更新时间</option>
<option value="itemid desc"<?php if($order == 'itemid desc') echo ' selected';?>>信息ID</option>
</select>
</td>
</tr>
<tr>
<td class="tl">列表或搜索主字段</td>
<td><input type="text" size="80" name="setting[fields]" value="<?php echo $fields;?>"/><?php tips('此项可在一定程度上提高列表或搜索效率，请勿随意修改以免导致SQL错误');?></td>
</tr>
<tr>
<td class="tl">下载内容远程图片</td>
<td>
<input type="radio" name="setting[save_remotepic]" value="1"  <?php if($save_remotepic) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[save_remotepic]" value="0"  <?php if(!$save_remotepic) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">清除内容链接</td>
<td>
<input type="radio" name="setting[clear_link]" value="1"  <?php if($clear_link) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[clear_link]" value="0"  <?php if(!$clear_link) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">内容关联链接</td>
<td>
<input type="radio" name="setting[keylink]" value="1"  <?php if($keylink) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[keylink]" value="0"  <?php if(!$keylink) echo 'checked';?>/> 关闭
&nbsp;&nbsp;
<a href="?file=keylink&item=<?php echo $moduleid;?>" target="_blank" class="t">[管理链接]</a>
</td>
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
<td class="tl">全文搜索</td>
<td>
<input type="radio" name="setting[fulltext]" value="1" <?php if($fulltext==1){ ?>checked <?php } ?>/> LIKE&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fulltext]" value="2" <?php if($fulltext==2){ ?>checked <?php } ?>/> MATCH&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fulltext]" value="0" <?php if($fulltext==0){ ?>checked <?php } ?>/> 关闭
<?php tips('此项会增加服务器负担，请根据需要和服务器配置决定是否开启。MATCH模式需要MySQL 4以上版本，且需要在MySQL的my.ini添加ft_min_word_len=1才能支持2个汉字的中文搜索。如果不能设置可以使用LIKE模式，但是效率会低于MATCH模式。<br/>开启MATCH模式请在数据库维护里执行以下SQL添加全文索引<br/>ALTER TABLE `'.$table_data.'` ADD FULLTEXT (`content`);<br/>全文索引占用一定数据空间，如果不开启MATCH模式可以执行以下语句删除索引<br/>ALTER TABLE `'.$table_data.'` DROP INDEX `content`;');?></td>
</tr>
<tr>
<td class="tl">级别中文别名</td>
<td>
<input type="text" name="setting[level]" style="width:98%;" value="<?php echo $level;?>"/>
<br/>用 | 分隔不同别名 依次对应 1|2|3|4|5|6|7|8|9 级 <?php echo level_select('post[level]', '提交后点此预览效果');?>
</td>
</tr>
<tr>
<td class="tl">PHP读取文件限制</td>
<td><input type="text" size="5" name="setting[readsize]" value="<?php echo $readsize;?>"/> M <?php tips('对于同服务器上的文件，用php读取方式下载不会暴露文件的真实地址，但是读取大文件比较耗费服务器资源<br/>超过此限制大小的文件，将不再用php读取方式下载<br/>填0表示从不用php读取方式下载');?></td>
</tr>
<tr>
<td class="tl">允许上传下载的文件类型</td>
<td><input type="text" name="setting[upload]" size="60" value="<?php echo $upload;?>"/></td>
</tr>

<tr>
<td class="tl">首页推荐信息数量</td>
<td><input type="text" size="3" name="setting[page_irec]" value="<?php echo $page_irec;?>"/></td>
</tr>

<tr>
<td class="tl">首页分类信息数量</td>
<td><input type="text" size="3" name="setting[page_icat]" value="<?php echo $page_icat;?>"/></td>
</tr>

<tr>
<td class="tl">列表信息分页数量</td>
<td><input type="text" size="3" name="setting[pagesize]" value="<?php echo $pagesize;?>"/></td>
</tr>

<tr>
<td class="tl">内容图片最大宽度</td>
<td><input type="text" size="3" name="setting[max_width]" value="<?php echo $max_width;?>"/> px</td>
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
<td class="tl">内容页Title(网页标题)</td>
<td><input name="setting[seo_title_show]" type="text" id="seo_title_show" value="<?php echo $seo_title_show;?>" style="width:98%;"><br/> 
<?php echo seo_title('seo_title_show', array('showtitle', 'catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'delimiter'));?>
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
<tr>
<td class="tl">内容页是否生成html</td>
<td>
<input type="radio" name="setting[show_html]" value="1"  <?php if($show_html){ ?>checked <?php } ?> onclick="$('show_html').style.display='';$('show_php').style.display='none';"/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[show_html]" value="0"  <?php if(!$show_html){ ?>checked <?php } ?> onclick="$('show_html').style.display='none';$('show_php').style.display='';"/> 否
</td>
</tr>
<tbody id="show_html" style="display:<?php echo $show_html ? '' : 'none'; ?>">
<tr>
<td class="tl">HTML内容页文件名前缀</td>
<td><input name="setting[htm_item_prefix]" type="text" id="htm_item_prefix" value="<?php echo $htm_item_prefix;?>" size="10"></td>
</tr>
<tr>
<td class="tl">HTML内容页地址规则</td>
<td><?php echo url_select('setting[htm_item_urlid]', 'htm', 'item', $htm_item_urlid);?></td>
</tr>
</tbody>
<tr id="show_php" style="display:<?php echo $show_html ? 'none' : ''; ?>">
<td class="tl">PHP内容页地址规则</td>
<td><?php echo url_select('setting[php_item_urlid]', 'php', 'item', $php_item_urlid);?></td>
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
<td class="tl">允许浏览下载内容</td>
<td><?php echo group_checkbox('setting[group_show][]', $group_show);?></td>
</tr>
<tr>
<td class="tl">允许下载文件</td>
<td><?php echo group_checkbox('setting[group_contact][]', $group_contact);?></td>
</tr>
<tr>
<td class="tl">允许搜索下载</td>
<td><?php echo group_checkbox('setting[group_search][]', $group_search);?></td>
</tr>
<tr>
<td class="tl">允许设置标题颜色</td>
<td><?php echo group_checkbox('setting[group_color][]', $group_color);?></td>
</tr>
<tr>
<td class="tl">允许上传文件</td>
<td><?php echo group_checkbox('setting[group_upload][]', $group_upload);?></td>
</tr>
<tr>
<td class="tl">留言启用验证码</td>
<td>
<input type="radio" name="setting[captcha_message]" value="2"  <?php if($captcha_message == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_message]" value="1"  <?php if($captcha_message == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_message]" value="0"  <?php if($captcha_message == 0) echo 'checked';?>> 全部关闭
</td>
</tr>
<tr>
<td class="tl">留言启用验问题</td>
<td>
<input type="radio" name="setting[question_message]" value="2"  <?php if($question_message == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_message]" value="1"  <?php if($question_message == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_message]" value="0"  <?php if($question_message == 0) echo 'checked';?>> 全部关闭
</td>
</tr>

<tr>
<td class="tl">审核发布信息</td>
<td>
<input type="radio" name="setting[check_add]" value="2"  <?php if($check_add == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check_add]" value="1"  <?php if($check_add == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check_add]" value="0"  <?php if($check_add == 0) echo 'checked';?>> 全部关闭
</td>
</tr>
<tr>
<td class="tl">发布信息启用验证码</td>
<td>
<input type="radio" name="setting[captcha_add]" value="2"  <?php if($captcha_add == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_add]" value="1"  <?php if($captcha_add == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_add]" value="0"  <?php if($captcha_add == 0) echo 'checked';?>> 全部关闭
</td>
</tr>
<tr>
<td class="tl">发布信息启用验问题</td>
<td>
<input type="radio" name="setting[question_add]" value="2"  <?php if($question_add == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_add]" value="1"  <?php if($question_add == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_add]" value="0"  <?php if($question_add == 0) echo 'checked';?>> 全部关闭
</td>
</tr>

<tr>
<td class="tl">会员是否收费</td>
<td>
<input type="radio" name="setting[fee_mode]" value="1"  <?php if($fee_mode == 1) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fee_mode]" value="0"  <?php if($fee_mode == 0) echo 'checked';?>> 全部启用
</td>
</tr>
<tr>
<td class="tl">会员收费使用</td>
<td>
<input type="radio" name="setting[fee_currency]" value="money"  <?php if($fee_currency == 'money') echo 'checked';?>/> <?php echo $DT['money_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fee_currency]" value="credit"  <?php if($fee_currency == 'credit') echo 'checked';?>/> <?php echo $DT['credit_name'];?>
</td>
</tr>
<tr>
<td class="tl">发布信息收费</td>
<td><input type="text" size="5" name="setting[fee_add]" value="<?php echo $fee_add;?>"/> <?php echo $fee_currency == 'money' ? $DT['money_unit'] : $DT['credit_unit'];?>/条</td>
</tr>
<tr>
<td class="tl">下载文件收费</td>
<td><input type="text" size="5" name="setting[fee_view]" value="<?php echo $fee_view;?>"/> <?php echo $fee_currency == 'money' ? $DT['money_unit'] : $DT['credit_unit'];?>/条</td>
</tr>
<tr>
<td class="tl">收费有效时间</td>
<td><input type="text" size="5" name="setting[fee_period]" value="<?php echo $fee_period;?>"/> 分钟 <?php tips('如果支付时间超过有效时间，系统将重新收费<br/>填零表示不重复收费');?></td>
</tr>
</table>
<div class="tt"><?php echo $DT['credit_name'];?>规则</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">发布下载奖励</td>
<td>
<input type="text" size="5" name="setting[credit_add]" value="<?php echo $credit_add;?>"/>
</td>
</tr>
<tr>
<td class="tl">信息被删除扣除</td>
<td>
<input type="text" size="5" name="setting[credit_del]" value="<?php echo $credit_del;?>"/>
</td>
</tr>
<tr>
<td class="tl">信息设置颜色扣除</td>
<td>
<input type="text" size="5" name="setting[credit_color]" value="<?php echo $credit_color;?>"/>
</td>
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