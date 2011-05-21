<?php defined('IN_DESTOON') or exit('Access Denied');?><script type="text/javascript">
var pics='<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?><?php if($i) { ?>|<?php } ?><?php echo $t['thumb'];?><?php } } ?>';
var links='<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?><?php if($i) { ?>|<?php } ?><?php echo $t['linkurl'];?><?php } } ?>';
var texts='<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?><?php if($i) { ?>|<?php } ?><?php echo $t['alt'];?><?php } } ?>';
document.write('<embed src="<?php echo DT_PATH;?>file/flash/focus.swf" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent" width="<?php echo $width;?>" height="<?php echo $height;?>" menu="false"  FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'"></embed>');
</script>