<?php defined('IN_DESTOON') or exit('Access Denied');?><?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
<?php echo load('vote_'.$t['itemid'].'.htm');?>
<?php } } ?>