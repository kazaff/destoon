<?php defined('IN_DESTOON') or exit('Access Denied');?><script type="text/javascript">
var config='5|0xFFFFFF|0x333333|80|0xFAFAFA|0x333333|0x000000';
var files='<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?><?php if($i) { ?>|<?php } ?><?php echo $t['thumb'];?><?php } } ?>';
var links='<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?><?php if($i) { ?>|<?php } ?><?php echo $t['linkurl'];?><?php } } ?>';
var texts='<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?><?php if($i) { ?>|<?php } ?><?php echo $t['alt'];?><?php } } ?>';
document.write('<embed src="<?php echo DT_PATH;?>file/flash/slide.swf" wmode="opaque" FlashVars="config='+config+'&bcastr_flie='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'& menu="false" quality="high" width="<?php echo $width;?>" height="<?php echo $height;?>" type="application/x-shockwave-flash" extendspage="http://get.adobe.com/flashplayer/"></embed>');
</script>