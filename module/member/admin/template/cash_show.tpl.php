<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">申请详单</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">会员名</td>
<td><?php echo $item['username'];?> <a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?username=<?php echo $item['username'];?>" target="_blank" class="t">[主页]</a></td>
</tr>
<tr>
<td class="tl">提现金额</td>
<td class="f_red"><strong><?php echo $item['amount'];?></strong></td>
</tr>
<tr>
<td class="tl">手续费</td>
<td class="f_blue"><strong><?php echo $item['fee'];?></strong></td>
</tr>
<tr class="on">
<td class="tl">收款方式</td>
<td><?php echo $item['bank'];?></td>
</tr>
<tr>
<td class="tl">收款帐号</td>
<td><?php echo $item['account'];?></td>
</tr>
<tr>
<td class="tl">收款人</td>
<td><?php echo $item['truename'];?></td>
</tr>
<tr>
<td class="tl">手机</td>
<td><?php echo $member['mobile'];?></td>
</tr>
<?php if($member['qq']) { ?>
<tr>
<td class="tl">QQ</td>
<td><a href="tencent://message/?uin=<?php echo $member['qq'];?>&Site=<?php echo $DT['sitename'];?>&Menu=yes"><img src="http://wpa.qq.com/pa?p=1:<?php echo $member['qq'];?>:17" width="25" height="17" title="点击QQ交谈/留言" alt=""/></a> <?php echo $member['qq'];?></td>
</tr>
<?php } ?>
<?php if($member['msn']) { ?>
<tr>
<td class="tl">MSN</td>
<td><a href="msnim:chat?contact=<?php echo $member['msn'];?>"><img src="<?php echo DT_SKIN;?>image/msnchat.gif" width="25" height="17" title="点击MSN交谈/留言" alt=""/></a> <?php echo $member['msn'];?></td>
</tr>
<?php } ?>
<tr>
<td class="tl">申请时间</td>
<td><?php echo $item['addtime'];?></td>
</tr>
<tr>
<td class="tl">申请IP</td>
<td><?php echo $item['ip'];?> 来自 <?php echo ip2area($item['ip']);?></td>
</tr>
<tr class="on">
<td class="tl">受理结果</td>
<td><?php echo $_status[$item['status']];?></td>
</tr>
<tr>
<td class="tl">原因及备注</td>
<td><?php echo $item['note'];?></td>
</tr>
<tr>
<td class="tl">受理人</td>
<td><?php echo $item['editor'];?></td>
</tr>
<tr>
<td class="tl">受理时间</td>
<td><?php echo $item['edittime'];?></td>
</tr>
</table>
<div class="sbt"><input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></div>
<script type="text/javascript">Menuon(2);</script>
</body>
</html>