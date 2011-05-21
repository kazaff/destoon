<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
if(isset($map_height) && $map_height) {
?>
<div style="height:<?php echo $map_height;?>px;margin:auto;overflow:hidden;" id="myMap"></div>
<script type="text/javascript" src="http://api.51ditu.com/js/maps.js"></script>
<script type="text/javascript">
window.onload = function() {
	var map=new LTMaps("myMap");
	map.addControl(new LTSmallMapControl());
	var point=new LTPoint(<?php echo $map;?>);
	map.centerAndZoom(point, 3);
	var marker = new LTMarker(point,new LTIcon('<?php echo DT_SKIN;?>image/map_point.gif',[20,20],[12,12]));map.addOverLay(marker);
	var text = new LTMapText(marker);text.setLabel( "<div style=\"padding:3px;\"; title=\"<?php echo $COM['address'];?>\"><?php echo $COM['company'];?></div>" );
	map.addOverLay(text);
}
</script>
<?php 
	} else { 
?>
<tr>
<td class="tl">公司地图标注</td>
<td class="tr">
<input type="hidden" name="setting[map]" id="map" value="<?php echo $map;?>"/>
<script type='text/javascript' src='http://api.51ditu.com/js/maps.js'></script>
<script type='text/javascript' src='http://api.51ditu.com/js/search.js'></script>
<script type='text/javascript' src='http://api.51ditu.com/js/ezmarker.js'></script>
<script type='text/javascript'>
var ez=new LTEZMarker('ez');
var point=new LTPoint(<?php echo $map ? $map : '11640969,3989945';?>);
ez.setSearch(true, '');
ez.setDefaultView(point, <?php echo $map ? 3 : 10;?>);
ez.setPlaceList(false);
LTEvent.addListener(ez,'mark',setMap);
function setMap(point,zoom){
var point=point.getLongitude().toString()+','+point.getLatitude().toString();
$('map').value=point;
}
</script>
&nbsp;&nbsp;
提示：打开地图后，请将地图放大至街道比例
</td>
</tr>
<?php } ?>