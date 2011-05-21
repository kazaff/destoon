<?php
header("Content-Type: text/html;charset=utf-8");
$data = file_get_contents('http://localhost/destoon/KPPW/control/admin/plu.php?do=previewtag&tagid=7');
?>
<style type="text/css">
ul{
	list-style:none; 
	margin:0; 
	padding:0;			
}
li{
	line-height:25px;
}
a{
	color:#09C;
}
</style>
<ul>
<?=$data?>
</ul>