<?php defined('IN_DESTOON') or exit('Access Denied');?><?php if($tags) { ?>
<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
<a href="<?php echo $t['linkurl'];?>"<?php if($target) { ?> target="<?php echo $target;?>"<?php } ?><?php if($class) { ?> class="<?php echo $class;?>"<?php } ?> title="<?php echo $t['alt'];?>"><?php echo $t['title'];?></a>
<?php } } ?>
<?php } else { ?>
暂无
<?php } ?>