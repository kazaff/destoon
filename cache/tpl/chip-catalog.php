<?php defined('IN_DESTOON') or exit('Access Denied');?>		<?php $CATEGORY = cache_read('category-'.$mid.'.php');?>
		<table width="100%" cellspacing="0" cellspacing="0">
		<?php $child = get_maincat(0, $CATEGORY, 1);?>
		<?php if(is_array($child)) { foreach($child as $i => $c) { ?>
		<?php if($i%2==0) { ?><tr<?php if($i%4==2) { ?> bgcolor="#FAFCFE"<?php } ?>><?php } ?>
		<td valign="top" width="50%" onmouseover="this.style.backgroundColor='#E2F0FB';" onmouseout="this.style.backgroundColor='';">
		<p>
			<a href="<?php echo $MODULE[$mid]['linkurl'];?><?php echo $c['linkurl'];?>" target="_blank" class="px15"><strong><?php echo set_style($c['catname'], $c['style']);?></strong></a>
			<?php if($c['child']) { ?>
			<?php $sub = get_maincat($c['catid'], $CATEGORY, 2);?>
			<?php if(is_array($sub)) { foreach($sub as $j => $s) { ?><?php if($j < 5) { ?> <a href="<?php echo $MODULE[$mid]['linkurl'];?><?php echo $s['linkurl'];?>" target="_blank"><strong><?php echo set_style($s['catname'], $s['style']);?></strong></a><?php } ?><?php } } ?>
			<?php } ?>
		</p>
		<?php if($c['child']) { ?>
		<?php $sub = get_maincat($c['catid'], $CATEGORY, 1);?>
			<ul>
			<?php if(is_array($sub)) { foreach($sub as $j => $s) { ?>
			<li><a href="<?php echo $MODULE[$mid]['linkurl'];?><?php echo $s['linkurl'];?>" target="_blank" class="g"><?php echo set_style($s['catname'], $s['style']);?></a></li>
			<?php } } ?>
			<?php if($j>8) { ?><li><a href="<?php echo $MODULE[$mid]['linkurl'];?><?php echo $c['linkurl'];?>" target="_blank" class="g">更多</a></li><?php } ?>
			</ul>
			<div class="c_b"></div>
		<?php } ?>
		</td>
		<?php if($i%2==1) { ?></tr><?php } ?>
		<?php } } ?>
		</table>