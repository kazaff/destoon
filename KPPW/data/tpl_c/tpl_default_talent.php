<?php Template_Class::subtplcheck('tpl/default/talent', '1303700216', 'tpl/default/talent');?><?php $page_title = '人才库 - '.$_K['html_title'] ?><?php if($inajax) { ?>
<?php ob_end_clean();
ob_start();
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: application/xml; charset=".$_K['charset']);
echo '<?xml version="1.0" encoding="'.$_K['charset'].'" ?>'; ?>

<root><![CDATA[
    <h3 class="flb"><em><?=$title?></em><span><a href="javascript:;" class="flbc" onClick="hideWindow('<?=$handlekey?>');" title="close">关闭</a></span></h3>
<?php } else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>">
<title><?=$page_title?></title>
<meta name="keywords" content="<?=$page_keyword?>">
<meta name="description" content="<?=$page_description?>">
<meta name="generator" content="客客出品 <?=KEKE_VERSION?>" />
<meta name="author" content="kekezu" />
<meta name="copyright" content="powered by kekezu 2010-2018 kekezu Inc." />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<link href="<?=SKIN_PATH?>/css/base.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="resource/js/jquery.js"></script>
</head>
    <body>
        <div id="append_parent">
        </div>
        <div id="ajaxwaitid">
        </div>
         
        <div id="tool" class="w960">
            <ul id="top_menu">
                <li class="w50 fl_l"><?php if($uid) { ?>您好，<font color="red"><a href="index.php?do=user" style="color:red;"><?=$username?>！</a></font>&nbsp;&nbsp;&nbsp;<a href="index.php?do=user&view=message_list"><?php if($messagecount) { ?><img src="<?=SKIN_PATH?>/img/message.gif">&nbsp;短消息(<?=$messagecount?>)</a><?php } else { ?>短消息</a><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?do=logout">退出</a>
 <?php } else { ?>
  您好，欢迎来到<?=$_K['website_name']?>! 　
 <a href="index.php?do=login" id="alogin">请登录</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?do=register" id="aregister">免费注册</a>
 <?php } ?>

                </li>
                <li class="w50 fl_r">
                	<div> 
                   <h6 class="h6_1">
                   		<span></span><a href="index.php?do=user" >我的客客 </a> 
                   </h6>
                   <p class="p4">
                   		<!--
                   	<?php if($shop_info) { ?>
<a href="shop.php?do=shop&shop_id=<?=$shop_info['shop_id']?>" target="_blank">我的店铺</a><br>
<?php } ?>
<?php if(is_array($model_list)) { foreach($model_list as $model) { ?>
                   <a href="index.php?do=user&view=release_task&model_id=<?=$model['model_id']?>">我发布的<?=$model['model_name']?></a><br>
                   <?php } } ?>
<u></u>
<?php if(is_array($model_list)) { foreach($model_list as $model) { ?>
 <a href="index.php?do=user&view=join_task&model_id=<?=$model['model_id']?>">我参加的<?=$model['model_name']?></a><br>
 <?php } } ?>
<a href="index.php?do=user&view=collect_task">我收藏的任务</a><br>
-->
  <strong>雇主</strong>
  	<span>
  		<a href="index.php?do=release">发布悬赏任务</a>
  		<a href="index.php?do=release">发布招标任务</a>
  		<a href="index.php?do=release">发布雇佣任务</a>
  	</span>
  <strong class="wk">威客</strong>
  	<span>
  		<a href="index.php?do=task_list&model_id=1">参加悬赏任务</a>
  		<a href="index.php?do=task_list&model_id=2">参加招标任务</a>
  		<a href="index.php?do=task_list&model_id=6">参加雇佣任务</a>
  		<a href="index.php?do=user&view=collect_task">收藏的任务</a>
  		<a href="index.php?do=user&view=studio">我的工作室</a>
  	</span>
  <strong class="mj">买家</strong>
  	<span>
  		<a href="index.php?do=user&view=service_list">已发布的需求</a>
  		<a href="index.php?do=user&view=buy_service">已买入的服务</a>
<?php if($shop_info) { ?>
<a href="shop.php?do=shop&shop_id=<?=$shop_info['shop_id']?>" target="_blank">我的店铺</a><br>
<?php } ?>
  	</span>
   </p>
  
   </div>
                    <i>&nbsp;</i>
                    <h6 class="h6_3"><a href="index.php?do=release">发布任务</a></h6>
                    <i>&nbsp;</i>
                    <h6 class="h6_4"><a href="index.php?do=user&view=service_add">发布商品</a></h6>
                    <i>&nbsp;</i>
                    <div>
<h6 class="h6_2"><span></span><a href="#"> 网站导航 </a></h6>
<p class="p3">
<a href="index.php?do=release">任务发布</a>
<a href="index.php?do=user&view=cash">在线充值</a><br>
<?php if(is_array($model_list)) { foreach($model_list as $model) { ?>
<a href="index.php?do=task_list&model_id=<?=$model['model_id']?>"><?=$model['model_name']?></a>
<?php } } ?><br>
   </p>
   </div>
                    <i>&nbsp;</i>
                    <h6 class="h6_5"><a href="index.php?do=help">帮助中心</a></h6>
                    <!-- 
                    <i>&nbsp;</i>
                    <h6><a href="#" onClick="setHomepage('<?=$_K['siteurl']?>')">设为首页</a></h6>
                     -->
                 	<?php if($_SESSION['user_info']['group_id']) { ?>
<i>&nbsp;</i>
                    <h6><a href="keke">[系统管理]</a></h6>
<?php } else { ?>
<i>&nbsp;</i>
                    <h6><a href="#" onClick="addFav('<?=$_K['website_name']?>','<?=$_K['siteurl']?>');">加入收藏</a></h6>
<?php } ?>
                </li>
            </ul>
        </div>
        <!--tool_E-->
<div id="top" class="w960">
            <h3 class="logo"><a href="<?=$_K['siteurl']?>"><img src="<?=$basic_config['web_logo']?>" alt="<?=$_K['website_name']?>"/></a></h3>
            <div class="top_search">
            	<form method="get" action="index.php">
            		<input type="hidden" name="do" value="search_list" name="frm_search_list" id="frm_search_list">
                <div class="searchIndex">
                    <ul id="header_search">
                        <li id="tab_search_1" onClick="swaptab('search','on','',2,1)" class="on">
                            任务标题
                        </li>
                        <li id="tab_search_2" onClick="swaptab('search','on','',2,2)">
                            任务编号
                        </li>
                    </ul>
                </div>
                <div class="s_area">
                    <input type="text" class="s_a_txt" id="div_search_1" name="txt_search_title"  value="请输入任务标题" onfocus="this.value=''">
<input type="text" class="s_b_txt" id="div_search_2" name="txt_search_id"  value="请输入任务编号" onfocus="this.value=''" style="display:none;">
<input type="submit" class="s_a_sub" value="" onClick="frm_search_list.submit();"/>
<a href="index.php?do=search" target="_blank" class="s_a_adv c030">高级<br/>搜索</a>
                </div>
</form>
            </div>
            <p class="top_phone">
                <b><?=$_K['kf_phone']?></b>7×24 小时免费服务热线
            </p>
        </div>
<script type="text/javascript">
$(function(){
$("#div_search_1").click(function(){
if($(this).val()=="请输入任务标题") $(this).val("");
}).blur(function(){
if($(this).val()=='') $(this).val("请输入任务标题");
})
$("#div_search_2").click(function(){
if($(this).val()=="请输入任务编号") $(this).val("");
}).blur(function(){
if($(this).val()=='') $(this).val("请输入任务编号");
})
})
</script>      
        <!--top_E-->
        <div id="nav">
            <div class="nav">
            <?php if(is_array($nav_list)) { foreach($nav_list as $nav) { ?>
            <?php if($nav['ishide']!=2) { ?>
            <?php if($navid++) { ?><i></i><?php } ?>
            <a href="<?=$nav['nav_url']?>" <?php if($nav['newwindow']) { ?>target="_blank"<?php } ?> <?php if($nav_active_index == $nav['nav_style']&&$nav_active_index) { ?> class="nav_active"><?php } ?></><?=$nav['nav_title']?></a>
            <?php } ?>
            <?php } } ?>
            </div>
          
            <div class="nav_news">
                站长诚信为本 威客会员至上 周一至周五每天19：00后兑现威客提现款 周六周日不定期参照执行 敬请广大威客会员关注支持！
            </div>
        </div>


<?php } ?>
<link href="<?=SKIN_PATH?>/css/talent.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="resource/js/script_city.js"></script>
<div class="main">
    <div class="width_layer">
        <div class="left_side">
       	  <div class="search">
           	<div class="search_btn">
                	<a href="index.php?do=talent_list">威客人才库</a>
                    <a href="#tab_cont3_1">威客工作室</a>
            </div>
                <div class="search_box">
                <form action="index.php" method="get">
                	<input type="hidden" name="do" value="talent_list">
                	<ul>
                	  <li><b>行业分类:</b>
                          <select style="width:80px"  name="slt_indus_pid" id="slt_indus_pid" onchange="show_indus(this.value);">
<option value=""> 请选择父行业 </option>
<?php if(is_array($indus_p_arr)) { foreach($indus_p_arr as $key => $value) { ?>
<option value="<?=$value['indus_id']?>"><?=$value['indus_name']?></option>
<?php } } ?>
  </select> 
<select style="width:80px" name="slt_indus_id" id="slt_indus_id" >
<option value="">请选择子行业 </option>
</select>
                      </li>
                	  <li><b>地区分类:</b>
                      		<script type="text/javascript">
<!--
showprovince('slt_province', 'slt_city','');
showcity('slt_city', '', 'slt_province', '');
//-->
</script>
                      </li>
                	  <li><b>实名认证:</b>
                      		<label for="ckb_vip_auth"><input type="checkbox" name="ckb_vip_auth" id="ckb_vip_auth"  >VIP认证</label>
<label for="ckb_realname_auth"><input type="checkbox" name="ckb_realname_auth" id="ckb_realname_auth"  >身份证认证</label>
<label for="ckb_email_auth"><input type="checkbox" name="ckb_email_auth" id="ckb_email_auth"  >邮箱认证</label>
<label for="ckb_enterprise_auth"><input type="checkbox" name="ckb_enterprise_auth" id="ckb_enterprise_auth"  >企业认证</label>
                      </li>
                      <li class="key">
                        <input class="txt_box" name="txt_search_title"  type="text"  />
                        <input name="" type="image" src="<?=SKIN_PATH?>/img/sreach_box_btn.gif" />
                      </li>
              	  </ul>
                </form>
           	  </div>
          </div>
            <div class="show">
            	<?php Loaddata_Class::adgroup(人才广告,talent) ?>
            </div>
            
            <div class="clear"></div>
            
            <div class="pep">
            	<div class="title">
                	<span><?=$basic_config['website_name']?>有<b class="red"><?=$telent_wk_count?></b>个<b class="red">人才</b>，完成了<b class="red"><?=$telent_case_count?></b>个任务</span>
                    <h2>人才展示</h2>
                </div>
                <div class="content">
                	<div class="tab">
                    	<span><a href="index.php?do=talent_list">&raquo;更多</a></span>
<?php $key_c = 1; ?>
<?php if(is_array($indus_p_arr)) { foreach($indus_p_arr as $key => $values) { ?>
<a id="tab_cont_<?=$key_c?>" <?php if($key_c==1) { ?> class="select" <?php } ?> sid="<?=$key_c?>" fd="<?=$values['indus_id']?>" onClick="swtab(this);swaptab('cont','select','',<?php echo count($indus_p_arr) ?>,<?php echo $key_c++ ?>)" title="<?=$values['indus_name']?>" href='javascript:;'><span><?=$values['indus_name']?></span></a>
<?php } } ?>
                      
                    </div>
                    <div class="tab_content">
                    	<?php $key_c = 1; ?>
                    	<?php if(is_array($indus_p_arr)) { foreach($indus_p_arr as $key => $v) { ?>
<div id="div_cont_<?=$key_c?>" style="display:<?php if($key_c==1) { ?>block<?php } else { ?>none<?php } ?>;">
                        	<?php if($key_c++ ==1) { ?>
<dl class="margin_r_two">
                            	<dt class="title">新创建的工作室</dt>
                                <?php if(is_array($studio_arr)) { foreach($studio_arr as $v) { ?>
<dd>
                                	<ul>
                                   	  <li class="img_box">
                                   	  	<?php if($v['logo']) { ?>
<img src="<?=$v['logo']?>" width="55" height="55"/>
<?php } else { ?>
<img src="data/uploads/member/small_<?=$v['uid']?>.jpg" title="<?=$v['username']?>" width="55" height="55" class="pic_small" onerror="this.src='resource/img/avgdefaultsmall.jpg'" />
<?php } ?>
</li>
                                        <li><a href="index.php?do=space&view=studio_index&member_id=<?=$v['uid']?>"><?=$v['title']?></a></li>
                                        <li>用户成员 共有<b class="red"><?=$v['members']?></b>人</li>
                                        <li class="tech">技能：<a href="<?=$v['indus_id']?>"><?=$v['indus_name']?></a></li>
                                    </ul>
                                </dd>
<?php } } ?>
                              
                            </dl>
                            
                            <dl>
                            	<dt class="title">新加入的人才</dt>
                                <dd>
                                	<ul>
                                		<?php if(is_array($talent_arr)) { foreach($talent_arr as $v) { ?>
                                        <li>
                                            <a class="type" href="index.php?do=space&member_id=<?=$v['uid']?>"><?=$v['username']?></a>
                                            <span><?=$indus_p_arr[$v['indus_pid']]['indus_name']?>/<?=$v['indus_name']?></span>
                                        </li>
<?php } } ?>
                                    </ul>
                                </dd>
                            </dl>
                        
                        <div class="clear"></div>
                        <div class="show_case">
                        	<div class="title">
                                <h2>新案例</h2>
                            </div>
                            <div class="content">
                            <ul>
                            	<?php if(is_array($talent_top_arr)) { foreach($talent_top_arr as $v) { ?>
                            	<li>
                            	<A class="hn" hideFocus title="<?=$v['task_title']?>" 
style="FONT-WEIGHT: bold; COLOR: #390; hide-focus: true" 
href="index.php?do=task&task_id=<?=$v['task_id']?>" 
target=_blank><?=$v['task_title']?></A>悬赏：<FONT 
color=#ff0000>￥<B><?=$v['task_cash']?></B></FONT><BR>中标威客：<A hideFocus style="hide-focus: true" 
href="index.php?do=space&member_id=<?=$v['uid']?>" target=_blank><FONT 
color=green><?=$v['username']?></FONT></A><BR><A hideFocus title="index.php?do=task&task_id=<?=$v['task_id']?>"
style="hide-focus: true" 
href="index.php?do=task&task_id=<?=$v['task_id']?>" target=_blank><FONT 
color=#ff6600>点击查看详情&gt;&gt;</FONT></A> 
                            	</li>
                            	 <?php } } ?>
                            	
                            	
                            	
                               
                            </ul>
                            	
                            </div>
                         </div>
                         <?php } ?>
                        </div>
<?php } } ?>

                    </div>
                </div>
            </div>
            
            
        </div>
        <div class="right_side">
        	<div class="new_info">
            	<div class="title">
                    <span><!-- <a href="#">&raquo;更多</a> --></span>
                    <h2>最新用户动态</h2>
                </div>
                <div class="content">
                	
                	<ul>
                    	<?php Loaddata_Class::readfeed(8,'',0,0,'user_talent','',0) ?>
                    </ul>
                </div>
            </div>
            
            <div class="task">
            	<div class="title">
                    <span><a href="index.php?do=talent_list">&raquo;更多</a></span>
                    <h2>人才分类</h2>
                </div>
              <div class="content">
                	<dl>
                	  <?php if(is_array($indus_p_arr)) { foreach($indus_p_arr as $key => $values) { ?>
<dt><?=$values['indus_name']?></dt>
<dd>
<?php if(is_array($indus_c_arr)) { foreach($indus_c_arr as $key => $value) { ?>
<?php if($value['indus_pid']==$values['indus_id']) { ?>
<a href="index.php?do=talent_list&slt_indus_id=<?=$value['indus_id']?>"><?=$value['indus_name']?></a>
<?php } ?>
<?php } } ?>
</dd>
   <?php } } ?>  
                    </dl>
                </div>
            </div>
            
        </div>
        <div class="clear"></div>
        
         <div class="hot_pep">
        	<div class="title">
                    <span><!-- <a href="#">&raquo;更多</a> --></span>
                    <a id="tab_cont3_1" class="select" onClick="swaptab('cont3','select','',2,1)" href='javascript:void(0);'><span>优秀威客工作室</span></a>
                    <a id="tab_cont3_2"  onClick="swaptab('cont3','select','',2,2)" href='javascript:void(0);'><span>优秀威客人才</span></a>             
            </div>
            <div class="content">
            	<div id="div_cont3_1" style="display:block;">
                	<ul>
                	<?php if(is_array($nd_t_studio_arr)) { foreach($nd_t_studio_arr as $s) { ?>
                   	  	<li>
                   	  	  <p><a target="_blank" href="index.php?do=space&view=studio_index&member_id=<?=$s['uid']?>"><img src="data/uploads/member/small_<?=$s['uid']?>.jpg" width="80" height="112"/></a></p>
                          <p><a target="_blank" href="index.php?do=space&view=studio_index&member_id=<?=$s['uid']?>"><?=$s['title']?></a></p>
                        </li>
                    <?php } } ?>
                    
                    </ul>
                </div>
            	<div id="div_cont3_2" style="display:none;">
                    <?php if(is_array($nd_t_user_arr)) { foreach($nd_t_user_arr as $s) { ?>
                   	  	<li class="d2">
                   	  	  <p><a target="_blank" href="index.php?do=space&member_id=<?=$s['uid']?>"><img src="data/uploads/member/middle_<?php echo $task_info[uid]; ?>.jpg" class="pic_middle" onerror="this.src='resource/img/avgdefaultmiddle.jpg'" /></a></p>
                          <p><a target="_blank" href="index.php?do=space&member_id=<?=$s['uid']?>"><?=$s['username']?></a></p>
                        </li>
                    <?php } } ?>
                </div>
            </div>
        </div>
        
    </div>
</div>
<script type="text/javascript">
$(function(){
$(".txt_box").focus(function(){
$(this).val('');
}).blur(function(){
if($(this).val()=='请输入关键字' || $(this).val()==''){
$(this).val('请输入关键字');
}
})
})
function show_indus(indus_pid){
$.post("index.php?do=ajax_indus",{indus_pid:indus_pid},function(data){
var str_data = data;
if(trim(str_data)==''){
$("#slt_indus_id").html('<option value="-1"> 请选择子行业 </option>');
}else{
$("#slt_indus_id").html(str_data);
}
});
}

function swtab(obj){
 
indus_pid = $(obj).attr('fd');
sid = $(obj).attr('sid');
url = "index.php?do=talent&ajax=1&indus_pid="+indus_pid;
if($(obj).data('mydata') != null){ 
  sub_show($(obj).data('mydata'),sid);
  
}else{
$.getJSON(url,function(json){
$(obj).data('mydata',json.data);	
sub_show(json.data,sid);
})
 }
}
function sub_show(data,id){

var obj = $("#div_cont_"+id);
indus_name=  $("#tab_cont_"+id).html();
shtml = "<dl class=\"margin_r_two\">";
shtml += "<dt class=\"title\">新创建的工作室</dt>";
$.each(data.studio_arr,function(i,n){
shtml+= "<dd><ul>";
shtml+= "<li class=\"img_box\">";
if(n.logo){
shtml+= "<img src=\""+n.logo+"\" width=\"55\" height=\"55\"/>";
}else{
shtml+="<img src=\"data/uploads/member/small_"+n.uid+".jpg\" title=\""+n.username+"\" width=\"55\" height=\"55\" class=\"pic_small\" onerror=\"this.src='resource/img/avgdefaultsmall.jpg'\" />";
}
shtml+= "<li><a href=\"index.php?do=space&view=studio_index&member_id="+n.uid+"\">"+n.title+"</a></li>";
shtml+="<li>用户成员 共有<b class=\"red\">"+n.members+"</b>人</li>";
shtml+="<li class=\"tech\">技能：<a href=\""+n.indus_id+"\">"+n.indus_name+"</a></li>";
shtml+="</ul></dd>";
})
shtml+="</dl>";
shtml+="<dl>";
shtml+="<dt class=\"title\">新加入的人才</dt>";
shtml+="<dd><ul>";
$.each(data.talent_arr,function(i,n){
shtml+= "<li>";
            shtml+=" <a class=\"type\" href=\"index.php?do=space&member_id="+n.uid+"\">"+n.username+"</a>";
            shtml+="  <span>"+indus_name+"/"+n.indus_name+"</span>";
            shtml+=" </li>";
})					   
            shtml+="</ul></dd>";
shtml+="</dl>";                
            shtml+="<div class=\"clear\"></div>";            
            shtml+="<div class=\"show_case\">";            
            shtml+="<div class=\"title\">";
shtml+="<h2>新案例</h2>";            
            shtml+="</div>";            	
            shtml+="<div class=\"content\">";
shtml+="<ul>";                    
            $.each(data.talent_top_arr,function(i,n){
            	shtml+="<li><A class=\"hn\" hideFocus title=\""+n.task_title+"\" ";
            	shtml+="style=\"FONT-WEIGHT: bold; COLOR: #390; hide-focus: true\" ";
            	shtml+="href=\"index.php?do=task&task_id="+n.task_id+"\" ";
            	shtml+="target=_blank>"+n.task_title+"</A>悬赏：<FONT ";
            	shtml+="color=#ff0000>￥<B>"+n.task_cash+"</B></FONT><BR>中标威客：<A hideFocus style=\"hide-focus: true\" ";
            	shtml+="href=\"index.php?do=space&member_id="+n.uid+"\" target=_blank><FONT ";
            	shtml+="color=green>"+n.username+"</FONT></A><BR><A hideFocus title=\"index.php?do=task&task_id="+n.task_id+"\"";
            	shtml+="href=\"index.php?do=task&task_id="+n.task_id+"\" target=_blank><FONT ";
            	shtml+="color=#ff6600>点击查看详情&gt;&gt;</FONT></A> </li>";
})                
            shtml+= "</ul>";               
            shtml+= "</div>";
shtml+= "</div>";            
           $(obj).html(shtml);              
}

 


</script>
<?php if($inajax) { ?>
<?php $s = ob_get_contents();
ob_end_clean();
$s = preg_replace("/([\\x01-\\x08\\x0b-\\x0c\\x0e-\\x1f])+/", ' ', $s);
$s = str_replace(array(chr(0), ']]>'), array(' ', ']]&gt;'), $s); ?>
<?=$s?>
]]>
</root>
<?php exit; ?>
<?php } else { ?>
<script src="resource/js/keke.js" type="text/javascript"></script>
<div id="footer">
<div class="foot_tag"><a href="#top" class="foot_top"></a><a href="index.php" class="foot_home"></a></div>
    <ul><li class="fnav">
    	<a href="index.php?do=footer&art_id=1128">关于我们</a>
| <a href="index.php?do=footer&art_id=1129">免责声明</a>
| <a href="index.php?do=footer&art_id=1130">支付方式</a> 
| <a href="index.php?do=footer&art_id=1131">联系方式</a> 
| <a href="index.php?do=footer&view=customerservice">客服中心</a> 
| <a href="javascript:void(0);" id="map" onclick="showWindow('map','index.php?do=map');">网站地图</a></li>
<li>Powered by <b><font color="blue"><a href="http://www.kekezu.com" target="_blank"><?=P_NAME?><?=KEKE_VERSION?></a></font></b>  &copy;2010 </li>
<li>服务热线：<?=$_K['phone']?>(呼叫中心技术支持) </li>
<li>公司名称：<?=$_K['company']?>,地址：<?=$_K['address']?>,邮编：<?=$_K['postcode']?>
    <li> <?=$_K['filing']?>&nbsp;&nbsp;&nbsp;<?=$_K['stats_code']?></li></ul>
</div><!--footer_E-->
<?php if($exec_time_traver) { ?>
<script>
$.get('js.php?op=time');
</script>
<?php } ?>

</body>
</html>
<?php } ?>
<?php Template_Class::ob_out();?>