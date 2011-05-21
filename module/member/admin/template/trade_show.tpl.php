<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">交易详情</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">流水号</td>
<td><?php echo $item['itemid'];?></td>
</tr>
<tr>
<td class="tl">商品或服务</td>
<td>
<?php if($item['linkurl']) { ?>
<a href="<?php echo $item['linkurl'];?>" target="_blank">
<?php } ?>
<?php echo $item['title'];?>
<?php if($item['linkurl']) { ?>
</a>
<?php } ?>
</td>
</tr>
<?php if($item['thumb']) { ?>
<tr>
<td class="tl">缩略图</td>
<td><img src="<?php echo $item['thumb'];?>"/></td>
</tr>
<?php } ?>
<tr>
<td class="tl">卖家</td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?username=<?php echo $item['seller'];?>" target="_blank" class="t"><?php echo $item['seller'];?></a></td>
</tr>
<tr>
<td class="tl">买家</td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?username=<?php echo $item['buyer'];?>" target="_blank" class="t"><?php echo $item['buyer'];?></a></td>
</tr>
<tr>
<td class="tl">邮编</td>
<td><?php echo $item['buyer_postcode'];?></td>
</tr>
<tr>
<td class="tl">地址</td>
<td><?php echo $item['buyer_address'];?></td>
</tr>
<tr>
<td class="tl">收货人</td>
<td><?php echo $item['buyer_name'];?></td>
</tr>
<tr>
<td class="tl">电话</td>
<td><?php echo $item['buyer_phone'];?></td>
</tr>
<tr>
<td class="tl">下单时间</td>
<td><?php echo $item['addtime'];?></td>
</tr>
<tr>
<td class="tl">更新时间</td>
<td><?php echo $item['updatetime'];?></td>
</tr>
<tr>
<td class="tl">备注说明</td>
<td><?php echo $item['note'];?></td>
</tr>
<tr>
<td class="tl">金额</td>
<td class="f_red"><?php echo $item['amount'];?></td>
</tr>
<?php if($item['fee']) { ?>
<tr>
<td class="tl"><?php echo $item['fee_name'];?></td>
<td class="f_blue"><?php echo $item['fee'];?></td>
</tr>
<?php } ?>
<tr>
<td class="tl">总额</td>
<td class="f_red f_b"><?php echo $item['money'];?></td>
</tr>
<tr>
<td class="tl">物流类型</td>
<td><?php echo $item['send_type'];?></td>
</tr>
<tr>
<td class="tl">物流号码</td>
<td><?php echo $item['send_no'];?></td>
</tr>
<tr>
<td class="tl">发货时间</td>
<td><?php echo $item['send_time'];?></td>
</tr>
<tr>
<td class="tl">交易状态</td>
<td><?php echo $_status[$item['status']];?></td>
</tr>
<?php if($item['buyer_reason']) { ?>
<tr>
<td class="tl">买家理由或证据</td>
<td><?php echo $item['buyer_reason'];?></td>
</tr>
<?php } ?>
<?php if($item['refund_reason']) { ?>
<tr>
<td class="tl">操作理由或证据</td>
<td><?php echo $item['refund_reason'];?></td>
</tr>
<tr>
<td class="tl">操作人</td>
<td><?php echo $item['editor'];?></td>
</tr>
<tr>
<td class="tl">操作时间</td>
<td><?php echo $item['updatetime'];?></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></div>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>