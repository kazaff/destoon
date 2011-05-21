<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($_admin == 1) { ?>
<form action="?">
<div class="tt">统计报表</div>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<select name="mid">
<?php
	foreach($MODULE as $m) {
	if(!in_array($m['moduleid'], array(1,3,4)) && !$m['islink']) {
?>
<option value="<?php echo $m['moduleid'];?>"<?php echo $mid == $m['moduleid'] ? ' selected' : ''?>><?php echo $m['name'];?></option>
<?php } } ?>
</select>&nbsp;
<select name="year">
<option value="0">选择年</option>
<?php for($i = date("Y"); $i >= 2000; $i--) { ?>
<option value="<?php echo $i;?>"<?php echo $i == $year ? ' selected' : ''?>><?php echo $i;?>年</option>
<?php } ?>
</select>&nbsp;
<select name="month">
<option value="0">选择月</option>
<?php for($i = 1; $i < 13; $i++) { ?>
<option value="<?php echo $i;?>"<?php echo $i == $month ? ' selected' : ''?>><?php echo $i;?>月</option>
<?php } ?>
</select>&nbsp;
<input type="submit" value="生成报表" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<?php
	if($year && $month && $mid) {
	$tb = get_table($mid);
	$fd = 'addtime';
	$ym = $year.'-'.$month;
	if($mid == 2) $fd = 'regtime';
	$C = array();
	$T = 0;
	$d = date('t', strtotime($ym.'-1'));
	for($i = 1; $i <= $d; $i++) {
		$f = strtotime($ym.'-'.$i.' 00:00:00');
		$t = strtotime($ym.'-'.$i.' 23:59:59');
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$tb} WHERE `$fd`>=$f AND `$fd`<=$t");
		$C[$i] = $r['num'];
		$T += $r['num'];
	}
?>
<div class="tt"><?php echo $MODULE[$mid]['name'];?> <?php echo $year;?>年<?php echo $month;?>月统计报表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="100">日期</th>
<th width="100">数量</th>
<th>百分比</th>
</tr>
<?php foreach($C as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="">
<td><?php echo $k;?></td>
<td><?php echo $v;?></td>
<td><script type="text/javascript">perc(<?php echo $v;?>,<?php echo $T;?>,'90%');</script></td>
</tr>
<?php }?>
</table>
<?php
	} else if($year && $mid) {
	$tb = get_table($mid);
	$fd = 'addtime';
	$ym = $year;
	if($mid == 2) $fd = 'regtime';
	$C = array();
	$T = 0;
	for($i = 1; $i < 13; $i++) {		
		$f = strtotime($ym.'-'.$i.'-1 00:00:00');
		$d = date('t', $f);
		$t = strtotime($ym.'-'.$i.'-'.$d.' 23:59:59');
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$tb} WHERE `$fd`>=$f AND `$fd`<=$t");
		$C[$i] = $r['num'];
		$T += $r['num'];
	}
?>
<div class="tt"><?php echo $MODULE[$mid]['name'];?> <?php echo $year;?>年统计报表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="100">月份</th>
<th width="100">数量</th>
<th>百分比</th>
</tr>
<?php foreach($C as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="">
<td><a href="?action=<?php echo $action;?>&mid=<?php echo $mid;?>&year=<?php echo $year;?>&month=<?php echo $k;?>"><?php echo $k;?></a></td>
<td><?php echo $v;?></td>
<td><script type="text/javascript">perc(<?php echo $v;?>,<?php echo $T;?>,'90%');</script></td>
</tr>
<?php }?>
</table>
<?php } else { ?>
<div class="tt">统计概况</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><a href="?moduleid=2&file=ask" class="t">待受理客服中心</a></td>
<td>&nbsp;<a href="?moduleid=2&file=ask&status=0"><span id="ask"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?moduleid=2&file=charge" class="t">待受理在线充值</a></td>
<td>&nbsp;<a href="?moduleid=2&file=charge&status=0"><span id="charge"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?moduleid=2&file=cash" class="t">待受理资金提现</a></td>
<td>&nbsp;<a href="?moduleid=2&file=cash&status=0"><span id="cash"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?moduleid=2&file=trade&status=5" class="t">待受理会员交易</a></td>
<td>&nbsp;<a href="?moduleid=2&file=trade"><span id="trade"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
</tr>

<tr>
<td class="tl"><a href="?moduleid=3&file=spread&action=check" class="t">待审核排名推广</a></td>
<td>&nbsp;<a href="?moduleid=3&file=spread&action=check"><span id="spread"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?moduleid=3&file=guestbook" class="t">待回复网站留言</a></td>
<td>&nbsp;<a href="?moduleid=3&file=guestbook"><span id="guestbook"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?moduleid=3&file=comment&action=check" class="t">待审核评论</a></td>
<td>&nbsp;<a href="?moduleid=3&file=comment&action=check"><span id="comment"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?moduleid=3&file=link&action=check" class="t">待审核友情链接</a></td>
<td>&nbsp;<a href="?moduleid=3&file=link&action=check"><span id="link"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
</tr>

<tr>
<td class="tl"><a href="?moduleid=2&file=news&action=check" class="t">待审核公司新闻</a></td>
<td>&nbsp;<a href="?moduleid=2&file=news&action=check"><span id="news"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?moduleid=2&file=credit&action=check" class="t">待审核荣誉资质</a></td>
<td>&nbsp;<a href="?moduleid=2&file=credit&action=check"><span id="credit"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?moduleid=2&file=link&action=check" class="t">待审核公司链接</a></td>
<td>&nbsp;<a href="?moduleid=2&file=link&action=check"><span id="comlink"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?file=keyword&status=2" class="t">待审核搜索关键词</a></td>
<td>&nbsp;<a href="?file=keyword&status=2"><span id="keyword"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
</tr>


<tr>
<td class="tl"><a href="?moduleid=3&file=ad&action=list&job=check" class="t">待审广告购买</a></td>
<td>&nbsp;<a href="?moduleid=3&file=ad&action=list&job=check"><span id="ad"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl"><a href="?moduleid=10&file=answer&action=check" class="t">待审核知道回答</a></td>
<td>&nbsp;<a href="?moduleid=10&file=answer&action=check"><span id="answer"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
<td class="tl">&nbsp;</td>
<td>&nbsp;</td>
<td class="tl">&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td class="tl"><a href="?moduleid=2" class="t">会员</a></td>

<td width="10%">&nbsp;<a href="?moduleid=2"><span id="member"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>

<td class="tl"><a href="?moduleid=2&file=grade&action=check" class="t">会员升级申请</a></td>

<td width="10%">&nbsp;<a href="?moduleid=2&file=grade&action=check"><span id="member_vip"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>

<td class="tl"><a href="?moduleid=2&action=check" class="t">待审核</a></td>

<td width="10%">&nbsp;<a href="?moduleid=2&action=check"><span id="member_check"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>


<td class="tl"><a href="?moduleid=2&action=add" class="t">今日新增</a></td>

<td width="10%">&nbsp;<a href="?moduleid=2"><span id="member_new"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
</tr>


<?php
foreach ($MODULE as $m) {
	if($m['moduleid'] < 5 || $m['islink']) continue;
?>

<?php 
if($m['moduleid'] == 9) $m['name'] = '招聘';
?>

<tr>
<td class="tl"><a href="<?php echo $m['linkurl'];?>" class="t" target="_blank"><?php echo $m['name'];?></a></td>

<td>&nbsp;<a href="?moduleid=<?php echo $m['moduleid'];?>"><span id="m_<?php echo $m['moduleid'];?>"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>

<td class="tl"><a href="?moduleid=<?php echo $m['moduleid'];?>" class="t">已发布</a></td>

<td>&nbsp;<a href="?moduleid=<?php echo $m['moduleid'];?>"><span id="m_<?php echo $m['moduleid'];?>_1"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>

<td class="tl"><a href="?moduleid=<?php echo $m['moduleid'];?>&action=check" class="t">待审核</a></td>

<td>&nbsp;<a href="?moduleid=<?php echo $m['moduleid'];?>&action=check"><span id="m_<?php echo $m['moduleid'];?>_2"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>

<td class="tl"><a href="?moduleid=<?php echo $m['moduleid'];?>&action=add" class="t">今日新增</a></td>

<td>&nbsp;<a href="?moduleid=<?php echo $m['moduleid'];?>"><span id="m_<?php echo $m['moduleid'];?>_3"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
</tr>


<?php
if($m['moduleid'] == 9) {
	$m['name'] = '简历';
?>
<tr>
<td class="tl"><a href="<?php echo $m['linkurl'];?>" class="t" target="_blank"><?php echo $m['name'];?></a></td>

<td>&nbsp;<a href="?moduleid=<?php echo $m['moduleid'];?>&file=resume"><span id="m_resume"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>

<td class="tl"><a href="?moduleid=<?php echo $m['moduleid'];?>&file=resume" class="t">已发布</a></td>

<td>&nbsp;<a href="?moduleid=<?php echo $m['moduleid'];?>&file=resume"><span id="m_resume_1"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>

<td class="tl"><a href="?moduleid=<?php echo $m['moduleid'];?>&file=resume&action=check" class="t">待审核</a></td>

<td>&nbsp;<a href="?moduleid=<?php echo $m['moduleid'];?>&file=resume&action=check"><span id="m_resume_2"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>

<td class="tl"><a href="?moduleid=<?php echo $m['moduleid'];?>&file=resume&action=add" class="t">今日新增</a></td>

<td>&nbsp;<a href="?moduleid=<?php echo $m['moduleid'];?>"><span id="m_resume_3"><img src="admin/image/count.gif" width="10" height="10" alt="正在统计"/></span></a></td>
</tr>

<?php } ?>

<?php
}
?>
</table>
<?php } ?>
<?php } ?>
<script type="text/javascript">Menuon(1);</script>
<?php if($_admin == 1) {?>
<script type="text/javascript" src="?action=counter"></script>
<?php } ?>
</body>
</html>