<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">获取会员号码列表</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="make" value="1"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">数据表 <span class="f_red">*</span></td>
<td><input type="text" size="50" name="tb" id="tb" value="<?php echo $DT_PRE;?>member"/></td>
</tr>
<tr>
<td class="tl">字段名 <span class="f_red">*</span></td>
<td><input type="text" size="20" name="field" id="field" value="mobile"/></td>
</tr>
<tr>
<td class="tl">SQL条件语句 <span class="f_red">*</span></td>
<td class="f_gray"><input type="text" size="60" name="sql" id="sql" value="groupid>4"/>
<select onchange="mk(this.value);">
<option value="member|groupid>4|mobile">常用SQL语句</option>
<option value="member|logintime<<?php echo $DT_TIME;?>-3600*24*30|mobile">30天未登录会员</option>
<option value="member|regtime<<?php echo $DT_TIME;?>-3600*24*365|mobile">注册时间超过1年</option>
<option value="member|message>10|mobile">未读站内信超过10封</option>
<option value="member|money>1000|mobile">帐户可用<?php echo $DT['money_name'];?>多余1000<?php echo $DT['money_unit'];?></option>
<option value="member|locking>1000|mobile">帐户锁定<?php echo $DT['money_name'];?>多余1000<?php echo $DT['money_unit'];?></option>
<option value="member m,company c|m.userid=c.userid and c.vip>6|m.mobile"><?php echo VIP;?>指数大于6的企业</option>
<option value="member m,company c|m.userid=c.userid and c.totime><?php echo $DT_TIME;?>|m.mobile"><?php echo VIP;?>服务过期的企业</option>
<option value="member m,company c|m.userid=c.userid and c.totime><?php echo $DT_TIME;?>-3600*24*30|m.mobile"><?php echo VIP;?>服务30天内过期的企业</option>
<option value="member m,company c|m.userid=c.userid and c.validated=1|m.mobile">资料通过认证的企业</option>
<option value="member m,company c|m.userid=c.userid and c.domain!=''|m.mobile">绑定了顶级域名的的企业</option>
<?php foreach($GROUP as $k=>$v) { 
	if($v['groupid'] != 3) { 
?>
<option value="member|groupid=<?php echo $v['groupid'];?>|mobile"><?php echo $v['groupname'];?></option>
<?php 
	}
} 
?>
</select>
<br/>如果仅提取已通过验证的手机号码，可以加and vmobile>0 例如 groupid=6 and vmobile>0
<script type="text/javascript">
function mk(v) {
	var pre = '<?php echo $DT_PRE;?>';
	var arr = v.split("|");
	if(arr[0]) $('tb').value = pre+arr[0].replace(/,/, ','+pre);
	if(arr[1]) $('sql').value = arr[1];
	if(arr[2]) $('field').value = arr[2];
}
</script>
</td>
</tr>
<tr>
<td class="tl">每轮提取数目 <span class="f_red">*</span></td>
<td><input type="text" size="5" name="num" value="1000"/></td>
</tr>
<tr>
<td class="tl">保存文件名</td>
<td class="f_gray"><input type="text" size="20" id="title" name="title"/><br/>可填中文(如果服务器支持)，不填则系统自动生成</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(4);</script>
</body>
</html>