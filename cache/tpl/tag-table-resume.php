<?php defined('IN_DESTOON') or exit('Access Denied');?><table cellpadding="3" cellspacing="3" width="100%">
<?php if(is_array($tags)) { foreach($tags as $t) { ?>
	<tr>
		<td width="200" align="left">&nbsp;<a href="<?php echo $t['linkurl'];?>" target="_blank" title="<?php echo $t['truename'];?>"><?php echo $t['truename'];?>(<?php if($t['gender']==1) { ?>男<?php } else { ?>女<?php } ?>)</a></td>
		<td align="left"><?php echo $CATEGORY[$t['catid']]['catname'];?></td>
		<td width="100" align="center">
		<?php if($t['minsalary'] && $t['maxsalary']) { ?>
			<?php echo $t['minsalary'];?>-<?php echo $t['maxsalary'];?><?php echo $DT['money_unit'];?>/月
		<?php } else if($t['minsalary']) { ?>
			<?php echo $t['minsalary'];?><?php echo $DT['money_unit'];?>/月以上
		<?php } else if($t['maxsalary']) { ?>
			<?php echo $t['maxsalary'];?><?php echo $DT['money_unit'];?>/月以内
		<?php } else { ?>
			面议
		<?php } ?>
		</td>
		<td width="80" align="center"><?php echo area_pos($t['areaid'], '', 1);?></td>
	</tr>
<?php } } ?>	
</table>