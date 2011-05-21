<?php defined('IN_DESTOON') or exit('Access Denied');?><div class="m">
	<div class="b10">&nbsp;</div>
	<div class="foot_search">
		<div class="foot_search_m" id="foot_search_m">
		<?php if(is_array($MODULE)) { foreach($MODULE as $m) { ?><?php if($m['ismenu'] && !$m['islink']) { ?><span id="foot_search_m_<?php echo $m['moduleid'];?>" onclick="setFModule(<?php echo $m['moduleid'];?>)" class="<?php if($m['moduleid']==$searchid) { ?>f_b<?php } else { ?><?php } ?>"><?php echo $m['name'];?></span> | <?php } ?><?php } } ?>
		</div>
		<div>
		<form id="foot_search" action="<?php echo DT_PATH;?>search.php" onsubmit="return Fsearch();">
		<input type="hidden" name="moduleid" value="<?php echo $searchid;?>" id="foot_moduleid"/>
		<input type="text" name="kw" class="foot_search_i" id="foot_kw" value="<?php if($kw) { ?><?php echo $kw;?><?php } else { ?>请输入关键词<?php } ?>" onfocus="if(this.value=='请输入关键词') this.value='';"/>&nbsp;&nbsp;
		<input type="submit" class="foot_search_s" id="foot_search_s" value="搜索"/>
		</form>
		</div>
	</div>
	<div class="b10">&nbsp;</div>
</div>
<div class="m">
	<div class="foot">
		<div>
		<a href="<?php echo DT_PATH;?>">网站首页</a>
		<?php echo tag("table=webpage&condition=item=1&order=listorder desc,itemid desc&template=list-webpage");?>
		| <a href="<?php echo DT_PATH;?>sitemap/">网站地图</a>
		<?php if(extend_setting('link_enable')) { ?> | <a href="<?php echo extendurl('link');?>">友情链接</a><?php } ?>
		<?php if(extend_setting('guestbook_enable')) { ?> | <a href="<?php echo extendurl('guestbook');?>">网站留言</a><?php } ?>
		<?php if(extend_setting('ad_enable')) { ?> | <a href="<?php echo extendurl('ad');?>">广告服务</a><?php } ?>
		<?php if($DT['icpno']) { ?>
		| <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $DT['icpno'];?></a>
		<?php } ?>
		</div>
		<?php echo $DT['copyright'];?><br/><span id="powered"><a href="http://www.destoon.com" target="_blank"><strong>Powered by Destoon <?php echo DT_VERSION;?></strong></a></span>
	</div>
</div>
<script type="text/javascript">
	document.write('<script type="text/javascript" src="<?php echo DT_PATH;?>api/task.js.php?<?php echo $destoon_task;?>&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<?php include template('stats', 'chip');?>
<div style="width:100%;color:#900;text-align:center">本页一共有<strong style="color:blue"><?=$db->querynum?></strong>次数据库操作！</div>
<div id="gotop">返回顶部</div>
<script type="text/javascript">
BackTop=function(btnId){
	var isChrome = window.navigator.userAgent.indexOf("Chrome") !== -1;
	var btn=document.getElementById(btnId);
        var tooltip = document.getElementById('tooltip');
	var d=isChrome?document.body:document.documentElement;
	window.onscroll=set;
	btn.onclick=function (){
		btn.style.display="none";
		window.onscroll=null;
		this.timer=setInterval(function(){
			d.scrollTop-=Math.ceil(d.scrollTop*0.1);
			if(d.scrollTop==0) clearInterval(btn.timer,window.onscroll=set);
		},10);
	};
	function set(){
                btn.style.display=d.scrollTop?'block':"none";
                if(tooltip.getBoundingClientRect().top < 0){
			tooltip.style.position = 'fixed';
			tooltip.style.top = '0';			
		}
                if(d.scrollTop==0){tooltip.style.position='';}
        }
};
BackTop('gotop');
</script>
<style>
#gotop {
	width:12px;
	height:50px;
	background:#fff;
	position:fixed;
	bottom:100px;
	right:15px;
	display:none;
	cursor:pointer;
	font-size:14px;
	line-height:12px;
	font-size:12px;
	color:#F60;
}
#tooltip{
width:100%;
}
</style>
</body>
</html>