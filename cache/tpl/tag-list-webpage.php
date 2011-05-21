<?php defined('IN_DESTOON') or exit('Access Denied');?><?php if(is_array($tags)) { foreach($tags as $k => $t) { ?>
| <a href="<?php if($t['domain']) { ?><?php echo $t['domain'];?><?php } else { ?><?php echo $t['linkurl'];?><?php } ?>"><?php echo $t['title'];?></a> 
<?php } } ?>