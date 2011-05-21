<?php defined('IN_DESTOON') or exit('Access Denied');?><table width="100%" cellspacing="0">
<?php if($CATALOG) { ?>
<?php if(is_array($CATALOG)) { foreach($CATALOG as $i => $c) { ?>
<?php if($i%$cols==0) { ?><tr><?php } ?>
<td width="<?php echo $precent;?>%"><a href="<?php echo $MOD['linkurl'];?><?php echo $c['linkurl'];?>" target="_blank"><span><?php echo set_style($c['catname'], $c['style']);?></span></a></td>
<?php if($i%$cols==$cols-1) { ?></tr><?php } ?>
<?php } } ?>
<?php } else { ?>
<tr><td>没有拼音字母 <strong><?php echo $letter;?></strong> 开头的类目</td></tr>
<?php } ?>
</table>