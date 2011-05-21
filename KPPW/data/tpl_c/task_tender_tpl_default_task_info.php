<?php Template_Class::subtplcheck('task/tender/tpl/default/task_info', '1303811244', 'task/tender/tpl/default/task_info');?><?php $page_title=$task_info['task_title'].' - '.$_K['html_title'].' - '.$page_description=Func_comm_class::cutstr($task_info[task_desc],50) ?><?php if($inajax) { ?>
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

<link href="<?=SKIN_PATH?>/css/main.css" rel="stylesheet" type="text/css"/>
<script src="<?=$_K['siteurl']?>/resource/js/keke.js" type="text/javascript"></script>
<script type="text/javascript" src="resource/js/script_city.js"></script>

<div id="content">
    <div class="task_info_bg"><div class="task_info">
   	  <div class="task_info_tit">
   	  	<ul>
   	  		<li class="fl_l"><strong>您当前的位置</strong>：
<a href="index.php?do=task_list&model_id=<?=$model_info['model_id']?>"><?=$model_info['model_name']?></a> 
<?php if($indus_p_id) { ?>
>  <a href="index.php?do=search_list&indus_pid=<?=$indus_p_id?>&model_id=<?=$model_info['model_id']?>"><?=$indus_arr[$indus_p_id]['indus_name']?></a>  
<?php } ?>
  	<?php if($task_info['indus_id']) { ?>
>  <a href="index.php?do=search_list&indus_id=<?=$task_info['indus_id']?>&model_id=<?=$model_info['model_id']?>"><?=$indus_arr[$task_info['indus_id']]['indus_name']?></a> 
<?php } ?>
</li>
<li class="fl_r">
    	<a href="javascript:;" id="task_favor"><img src="<?=SKIN_PATH?>/img/task_favorites.gif"/>收藏任务</a> </li></ul></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
             	<td colspan="2" class="task_title font14">
<?=$task_info['task_title']?> 	
<?php if($task_info['isvip']==1) { ?>
&nbsp;<img src="<?=SKIN_PATH?>/img/vip2.gif" align="absmiddle"/>
<?php } ?>
<?php if($task_info['istop']==1) { ?>
&nbsp;<img src="<?=SKIN_PATH?>/img/jian.gif" align="absmiddle"/>
<?php } ?>
  </td>
    
</tr>
             <tr>
                 <td width="26%" valign="top">
                 <ul class="task_details_left">
                    <li><strong>任务价格</strong>：<span class="red"><strong>￥<?=$tender_cash_rule[$task_info['task_cash_coverage']]['cove_desc']?></strong></span></li>
                    <?php if($task_info['city']) { ?><strong>限定城市</strong>：<?=$task_info['city']?><?php } ?>
                    <li><strong>任务编号</strong>：<?=$task_info['task_id']?></li>
                    <li><strong>招标开始</strong>：<?php echo date('Y-m-d H:i:s',$task_info[start_time]); ?></li>
                    <li><strong>招标结束</strong>：<?php echo date('Y-m-d H:i:s',$task_info[end_time]); ?></li>
<li><strong>任务状态</strong>：<font color="red" ><?=$tender_status_arr[$task_info['task_status']]?></font></li>

<?php if($task_info['task_status']==3) { ?>
<li><strong>中标会员</strong>：<?=$is_selected['0']['username']?></li>
<?php } ?>

<?php if($task_info['task_status']==7) { ?>
<li><strong>中标会员</strong>：<?=$is_selected['0']['username']?></li>
<li><strong>成交金额</strong>：￥<?=$is_selected['0']['quote']?> 元</li>
<?php } ?>


                 </ul>                 
</td>
                 <td width="46%" valign="top" >

<?php if($task_info['task_status']==2) { ?>
<div class="task_tender"></div>
<?php } elseif($task_info['task_status']==3 ||$task_info['task_status']==4) { ?>
<div class="task_tender2"></div>
<?php } elseif($task_info['task_status']==5) { ?>
<div class="task_tender3"></div>
<?php } elseif($task_info['task_status']==7) { ?>
<div class="task_tender3"></div>
<?php } ?>

<div class="t_c">
<?php if($task_info['task_status']==7) { ?>
<span class="font14 red ico_true">任务已经圆满结束！</span>
<input type="button" class="task_btn2"  value="查看中标稿件" onclick="location.href='index.php?do=task&task_id=<?=$task_id?>&view=bid#t_work_list'"/>
<?php } elseif($task_info['task_status']==2) { ?>
<input type="button" class="task_btn"  value="我要投标" onclick="bid_tander();"/> 
<?php } elseif($task_info['task_status']==3) { ?>
<span class="font14 ico_true">选标完成，任务工作中！</span>
<input type="button" class="task_btn"  value="任务评论" onclick="<?php if($tender_config['is_open_zb']!=1) { ?>showDialog('操作无效，管理员已关闭悬赏模式!', 'alert', '操作失败提示','',0);<?php } else { ?><?php if($uid) { ?>showWindow('a_comment1', 'index.php?do=task_op&op=workcomment&comment_type=1&task_id=<?=$task_info['task_id']?>&obj_id=<?=$task_info['task_id']?>');<?php } else { ?>showDialog('您还没有登录，无法进行此操作', 'alert', '登录提示','',0);return false<?php } ?><?php } ?>"/>
<?php } elseif($task_info['task_status']==4) { ?>
<span class="font14 ico_true">工作完成！</span>
<input type="button" class="task_btn"  value="任务评论" onclick="<?php if($tender_config['is_open_zb']!=1) { ?>showDialog('操作无效，管理员已关闭悬赏模式!', 'alert', '操作失败提示','',0);<?php } else { ?><?php if($uid) { ?>showWindow('a_comment1', 'index.php?do=task_op&op=workcomment&comment_type=1&task_id=<?=$task_info['task_id']?>&obj_id=<?=$task_info['task_id']?>');<?php } else { ?>showDialog('您还没有登录，无法进行此操作', 'alert', '登录提示','',0);return false<?php } ?><?php } ?>"/>
<?php } elseif($task_info['task_status']==0) { ?>
<span class="font14 ico_true">未付款任务！</span>
<?php } elseif($task_info['task_status']==1) { ?>
<span class="font14 ico_true">该任务正在等待审核！</span>
<?php } elseif($task_info['task_status']==5) { ?>
<span class="font14 red ico_true">发标者确认任务完成！</span>
<?php } elseif($task_info['task_status']==6) { ?>
<span class="font14 ico_true">该任务已被冻结！</span>
<?php } ?>

<?php if($task_info['task_status']==3&&$uid==$is_selected['0']['uid']) { ?>
<input type="button" class="task_btn2"  value="确认工作完成" onclick="location.href='index.php?do=task&task_id=<?=$task_id?>&view=bid&ac=task_status4'"/>
<?php } elseif($task_info['task_status']==4&&$uid==$task_info['uid']) { ?>
<input type="button" class="task_btn2"  value="确认任务完成" onclick="location.href='index.php?do=task&task_id=<?=$task_id?>&view=bid&ac=task_status7'"/>
<?php } ?>
</div>
</td>
               <td width="28%" rowspan="3" valign="top">
                    <div class="Posted_by">
                        <dl><dt class="font14">任务发布者</dt>
                        <dd class="Posted_by_gut">
                       	  <span class="img_t">
                       	  	<a href="index.php?do=space&member_id=<?=$task_info['uid']?>">
<img src="data/uploads/member/small_<?php echo $task_info[uid]; ?>.jpg" class="pic_small" onerror="this.src='resource/img/avgdefaultsmall.jpg'" />
</a>
</span>
                        <a href="index.php?do=space&member_id=<?=$task_info['uid']?>" class="c030"><strong><?=$task_info['username']?></strong></a>  <?php if($space_info['isvip']==1) { ?><img src="<?=SKIN_PATH?>/img/truename.gif" align="absmiddle" title="VIP认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/untruename.gif" title="VIP认证未通过"/><?php } ?>&nbsp;
  <?php if($space_info['email_auth']==1) { ?><img src="<?=SKIN_PATH?>/img/mail.gif" align="absmiddle" title="Email认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/unmail.gif" title="Email认证未通过"/><?php } ?>&nbsp;
  <?php if($space_info['enterprise_auth']==1) { ?><img src="<?=SKIN_PATH?>/img/ico_cert_ent_1.gif" align="absmiddle" title="企业认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/ico_cert_ent_0.gif" title="企业认证未通过"/><?php } ?>&nbsp;&nbsp;
  <?php if($space_info['realname_auth']==1) { ?><img src="<?=SKIN_PATH?>/img/ico_cert_name_1.gif" align="absmiddle" title="身份证认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/ico_cert_name_0.gif" title="身份证认证未通过"/><?php } ?>&nbsp;&nbsp;
  <?php if($space_info['bank_auth']==1) { ?><img src="<?=SKIN_PATH?>/img/ico_cert_bank_1.gif" align="absmiddle" title="银行认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/ico_cert_bank_0.gif" title="银行认证未通过"/><?php } ?>&nbsp;&nbsp;  		  <br/>                       
      雇主信誉：<?php $g_m_score_value = Func_comm_class::get_mark_level($space_info['g_m_credit_value'],2);echo $g_m_score_value[pic]; ?>
  
  <br/>
    雇主好评率：
  	<?php if($space_info['seller_good_rate']) { ?><?=$space_info['seller_good_rate']?><?php } else { ?>0<?php } ?>	 
  <ul>
  	<li>发标次数：<?=$space_info['pub_num']?></li>
  	<li>注册时间：<?php echo date('Y-m-d',$space_info[reg_time]); ?></li>
  	<li>客服电话：<?=$kf_phone?></li>
  </ul>
                          
  <p>
  <a id="a_msg" href="index.php?do=message&to_uid=<?=$space_info['uid']?>&task_id=<?=$task_info['task_id']?>" onclick="<?php if($uid) { ?>showWindow('a_msg', this.href);<?php } else { ?>showDialog('您还没有登录，无法进行此操作', 'alert', '登录提示','',0);return false<?php } ?>"  title="给我留言">给我留言</a>
                       
  </dd>
                        </dl>
                    </div> 
<div class="Posted_by2">
                        <dl><dt class="font14">威客<?=$kf_info['uid']?>号客服</dt>
                        <dd class="Posted_by_gut">
                       	  <span class="img_t">
                       	  	<a href="javascript:;">
<img src="data/uploads/member/small_<?php echo $kf_info[uid]; ?>.jpg" class="pic_small" onerror="this.src='resource/img/avgdefaultsmall.jpg'" />
</a>
</span>
                          <a href="javascript:;" class="c030"><strong><?=$kf_info['username']?></strong></a><br/>                       
        <br> 
 客服电话：<strong><?=$kf_info['phone']?></strong>
 		  		  
  <ul>
  	<li><font color="red">建议直接来电快速解决您的问题</font></li>
</ul>
                          <p>
                          <a id="a_msg" href="index.php?do=task_op&op=workcomment&comment_type=5&task_id=<?=$task_info['task_id']?>" onclick="<?php if($uid) { ?><?php if($uid!=$task_info['uid']) { ?>showWindow('a_comment5', this.href);<?php } else { ?>showDialog('操作无效，您不能给自己留言', 'alert', '登录提示','',0);return false;<?php } ?><?php } else { ?>showDialog('您还没有登录，无法进行此操作', 'alert', '登录提示','',0);return false;<?php } ?>"  title="站内短信">站内短信</a>
                          <a target="_blank" href="http://wpa.qq.com/msgrd?v=1&uin=<?=$kf_info['qq']?>&site=qq&menu=yes">QQ联系</a>
  </p>
                        </dd>
                        </dl>
                    </div> 
               
 </td>
             </tr>
             
             <tr>
               <td colspan="2" valign="top">
               	
                <div id="task_mode">
                    <ul style="border-right:1px solid #cfe2f6;">
                    <p><strong><img src="<?=SKIN_PATH?>/img/icon_1.gif" align="absmiddle"/>中标模式</strong></p>
                    
                    <p>招标模式采用自由投标的方式 ，雇主可通过本系统选择中标者，但任务内容的执行和付款由双方线下完成。</p>
                    <p></p>
                    </ul>
                    <ul>
                    <p><strong><img src="<?=SKIN_PATH?>/img/icon_2.gif" align="absmiddle"/>赏金声明</strong></p>
                    <p>招标模式赏金不通过网站支付，由线下自行支付。</p></ul>
                </div>               </td>
             </tr>
         </table>
       
    </div></div> <!--task_info_bg_E--> 
    
     <div class="task_info_tit">
    	<a href="index.php?do=task&task_id=<?=$task_info['task_id']?>&view=demand#t_work_list"><h3 <?php if($view=='demand') { ?>class="now"<?php } ?> id="tab_cont3_1" >任务需求</h3></a>
<a href="index.php?do=task&task_id=<?=$task_info['task_id']?>&view=bid#t_work_list"><h3 <?php if($view=='bid') { ?>class="now"<?php } ?> id="tab_cont3_2" >查看投标</h3></a>
<a href="index.php?do=task&task_id=<?=$task_info['task_id']?>&view=comment#t_work_list"><h3 <?php if($view=='comment') { ?>class="now"<?php } ?> id="tab_cont3_3" >查看留言</h3></a>
<a href="index.php?do=task&task_id=<?=$task_info['task_id']?>&view=favorable#t_work_list"><h3 <?php if($view=='favorable') { ?>class="now"<?php } ?> id="tab_cont3_4" >信用评价</h3></a>
<span class="fl_r">任务结束时间: <?php echo date('Y-m-d H:i:s',$task_info[end_time]); ?></span></div>
    <div class="task_info_bg" id="t_work_list">
    
    	<?php if($view=='demand') { ?>
    	<div class="task_info" id="div_cont3_1">
    		<?=$task_info['task_desc']?>
<br><br><br>
    	<?php if($file_list) { ?><p>
    	<strong>任务附件：
    	<?php if(is_array($file_list)) { foreach($file_list as $file) { ?>
    	<a target="_blank" href="<?=$file['file_save_name']?>"><font color="red"><?=$file['file_name']?></font></a>&nbsp;&nbsp;&nbsp;
    	<?php } } ?>
    	</strong>
    	</p>
    	<?php } ?>
    	
    	</div>
<?php } ?>
<?php if($view=='bid') { ?>
   	   <div class="work_input_d">
 	<ul>
 		<li class="fl_l">
 	<input type="button" value="所有投标" class="input_btn3" onclick="location.href='index.php?do=task&task_id=<?=$task_id?>&view=<?=$view?>&bidtype=1#t_work_list'"/> 
<input type="button" value="VIP会员投标" class="input_btn3" onclick="location.href='index.php?do=task&task_id=<?=$task_id?>&view=<?=$view?>&bidtype=2#t_work_list'"/>
<input type="button" value="团队投标" class="input_btn3" onclick="location.href='index.php?do=task&task_id=<?=$task_id?>&view=<?=$view?>&bidtype=3#t_work_list'"/>
 </li>　
 <li class="fl_r">
 	<form action="index.php?do=task&view=bid&task_id=<?=$task_id?>#t_work_list" method="post">
 		
 	<input type="text" name="txt_username" size="12" class="input_txt" /> 
 	<select>
 		<option>作者</option>
</select> 
  <select onchange="location.href=this.value">
  	<option value="index.php?do=task&task_id=<?=$task_id?>&view=bid&bidtype=<?=$bidtype?>&ord=asc#t_work_list">按时间升序</option>
 		<option <?php if($ord=='desc') { ?>selected="selected"<?php } ?> value="index.php?do=task&task_id=<?=$task_id?>&view=bid&bidtype=<?=$bidtype?>&ord=desc#t_work_list">按时间降序</option>
  </select>
  <input type="submit" value="搜索" class="input_btn" />
</form>
  </li>
  </ul>
</div>
    <div class="task_info2 p_0">
   	  <div class="task_work_d">
   	  	
<?php if(is_array($bid_arr)) { foreach($bid_arr as $key => $value) { ?>

       	<dl class="task_work_d_tit">
       		<dt class="w20">
       			<strong>投标编号：<?=$value['bid_id']?>号</strong>
</dt>
<dt class="w80">
<strong>时间:</strong>
<span class="f60"> 
<?php echo date('Y/m/d H:i:s',$value[bid_time]); ?>
</span>
<!--
<strong>　　评论</strong>
<span class="f60"> 23 </span>条　　
<strong>投票</strong>
<span class="f60"> 56 </span>　　
<input type="button" value="选为入围" class="span_btn" /> -->
<?php if($uid == $task_info['uid']&&$task_info['task_status']==2) { ?>
<input type="button" value="选为中标" class="span_btn" onclick="location.href='index.php?do=task&task_id=<?=$task_id?>&view=<?=$view?>&ac=select_bid&bid_id=<?=$value['bid_id']?>'"  />
<?php } ?>
 <?php if(($basic_config['mark_start_status']==1)||($basic_config['mark_start_status']==3&&$task_info['task_status']==7)) { ?>
  <?php if($value['bid_status']==1) { ?>
  <?php if($uid==$task_info['uid']) { ?>
  	<?php if(!$value['mark_status']) { ?>
  		<input type="button" class="span_btn"  value="对投稿者评分" id="buyer_mark" onclick="showWindow('buyer_mark', 'index.php?do=mark&task_id=<?=$task_info['task_id']?>&work_id=<?=$value['work_id']?>&user_type=2&to_uid=<?=$value['uid']?>&task_type=<?=$do?>');" />
  	<?php } ?>
  <?php } elseif($uid==$value['uid']) { ?>
  <?php if(!$value['mark_status']) { ?>
 	 <input type="button" class="span_btn"  value="对发布者评分" id="seller_mark" onclick="showWindow('seller_mark', 'index.php?do=mark&task_id=<?=$task_info['task_id']?>&work_id=0&user_type=1&to_uid=<?=$task_info['uid']?>&task_type=<?=$do?>');"/>
          <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } ?>
</dt>
</dl>
          <dl class="task_work_d_bg <?php if($key==1) { ?>task_work_d_bgcf3<?php } ?>">
           	  <dd class="w20">
               	  <ul><li>
               	  	<img src="<?=SKIN_PATH?>/img/task_work_p.gif"/>
<a href="index.php?do=space&member_id=<?=$value['uid']?>"><?=$value['username']?></a><?php if($value['title']) { ?>&nbsp;<a href="index.php?do=space&view=studio_index&member_id=<?=$value['uid']?>"><font color="#ff6600">[<?=$value['title']?>工作室]</font></a><?php } ?></li>
                    <li class="t_c">
<img src="data/uploads/member/middle_<?php echo $value[uid]; ?>.jpg" class="pic_middle" onerror="this.src='resource/img/avgdefaultmiddle.jpg'" />
</li>
                      <li>认证状态：<?php if($value['isvip']==1) { ?><img src="<?=SKIN_PATH?>/img/truename.gif" align="absmiddle" title="VIP认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/untruename.gif" title="VIP认证未通过"/><?php } ?>&nbsp;
  <?php if($value['email_auth']==1) { ?><img src="<?=SKIN_PATH?>/img/mail.gif" align="absmiddle" title="Email认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/unmail.gif" title="Email认证未通过"/><?php } ?>&nbsp;
  <?php if($value['enterprise_auth']==1) { ?><img src="<?=SKIN_PATH?>/img/ico_cert_ent_1.gif" align="absmiddle" title="企业认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/ico_cert_ent_0.gif" title="企业认证未通过"/><?php } ?>&nbsp;&nbsp;
  <?php if($value['realname_auth']==1) { ?><img src="<?=SKIN_PATH?>/img/ico_cert_name_1.gif" align="absmiddle" title="身份证认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/ico_cert_name_0.gif" title="身份证认证未通过"/><?php } ?>&nbsp;&nbsp;
  <?php if($value['bank_auth']==1) { ?><img src="<?=SKIN_PATH?>/img/ico_cert_bank_1.gif" align="absmiddle" title="银行认证已通过"><?php } else { ?><img src="<?=SKIN_PATH?>/img/ico_cert_bank_0.gif" title="银行认证未通过"/><?php } ?>&nbsp;&nbsp;</li>

                    <li>用户头衔：<?php $exp_value = Func_comm_class::get_experience_level($value[experience_value]);echo $exp_value[title]; ?></li>
                    <li>经验等级：<?php echo $exp_value[pic]; ?></li>
<li>威客信誉：<?php $w_m_score_value = Func_comm_class::get_mark_level($value[w_m_credit_value],1);echo $w_m_score_value[pic]; ?></li>
<li>威客好评率：<?php if($value['buyer_good_rate']) { ?><?=$value['buyer_good_rate']?><?php } else { ?>0<?php } ?></li>
<li>中标次数：<?php if($value['accepted_num']) { ?><?=$value['accepted_num']?><?php } else { ?>0<?php } ?></li>

 </ul>
              </dd>
              <dd class="w80">
              	<?php if($value['bid_status']==1) { ?>
              	<div class="task_4"></div>
<?php } ?>
              	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="t_c tab_line">
                  <tr>
                    <th width="25%">报价</th>
                    <th width="25%">工作周期</th>
                    <th width="25%">所在地</th>
                    <th width="25%">投标时间</th>
                  </tr>
                  <tr>
                    <td><span class="f60"><strong> <?=$value['quote']?> </strong></span>元</td>
                    <td><?=$value['cycle']?>天</td>
                    <td><?=$value['area']?></td>
                    <td><?php echo date('Y-m-d H:i',$value[bid_time]); ?></td>
                  </tr>
                </table>
              <p><?=$value['message']?></p>
              </dd>
          </dl>
          <?php } } ?>
        </div>
    </div>
   <div class="Npage"><div class="fl_r">
          <?=$bid_pages['page']?>
    </div>
  </div>
<?php } ?>
    	
<?php if($view=='comment') { ?>
<div class="task_info" id="div_cont3_3" >

<?php if(( $task_info['task_status']==7) || ($task_info['task_status']==2 && $reward_config['is_comment']==1)) { ?>
<?php if(is_array($comment_arr)) { foreach($comment_arr as $key => $value) { ?>
<?php if($value['comment_type']==1) { ?>
<div class="p_10 cer <?php if($key==0) { ?>mtask_work_msg_list<?php } ?>">
<?php if($value['p_id']) { ?>
<p class="img_t">&nbsp;&nbsp;</p><p class="img_t">&nbsp;&nbsp;</p>
<?php } ?>
    	<p class="img_t">
    		<a href="index.php?do=space&member_id=<?=$value['uid']?>">
    			<img src="data/uploads/member/small_<?php echo $value[uid]; ?>.jpg" class="pic_small" onerror="this.src='resource/img/avgdefaultsmall.jpg'" />
</a>
</p>
<p class="f60"><a href="index.php?do=space&member_id=<?=$value['uid']?>"><?=$value['username']?></a></p>
<p><strong>
<?php if($value['comment_type']==1) { ?>
任务交流<?php if($value['p_id']) { ?>[回复]<?php } ?>
<?php } elseif($value['comment_type']==2) { ?>
任务举报
<?php } ?>: </strong>
<?=$value['content']?>
<br>
<span class="c999">日期: <?php echo date('Y-m-d H:i:s',$value[on_time]); ?></span>
<?php if($uid ==$task_info['uid']) { ?>
<?php if($value['uid']!=$uid) { ?>
<a id="a_commentt" href="index.php?do=task_op&op=workcomment&comment_type=1&task_id=<?=$task_info['task_id']?>&obj_id=<?=$task_info['task_id']?>&p_id=<?=$value['comment_id']?>" onclick="showWindow('a_commentt', this.href,'get',0);"><font color="red">[回复]</font></a>
<?php } ?>
<?php } ?>
</p>
   		</div>
<?php } ?>
<?php } } ?>
    <div class="Npage"><div class="fl_r">
          <?=$comment_pages['page']?>
    </div>
<?php } ?>
    	</div>
<?php } ?>
<?php if($view=='favorable') { ?>
<div class="task_info" id="div_cont3_4" >
<form action="" method="#t_work_list">
<input type="hidden" name="task_id" value="<?=$task_info['task_id']?>">
<input type="hidden" name="do" value="<?=$do?>">
<input type="hidden" name="view" value="<?=$view?>">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="pj_table">
                  <tr>
                    <th width="60">
                    <select name="slt_mark_type" onchange="this.form.submit();">
                        <option  selected="selected"  value="">全部评价</option>
                        <option  value="1" <?php if($slt_mark_type==1) { ?>selected="selected"<?php } ?>>好评</option>
                        <option  value="2" <?php if($slt_mark_type==2) { ?>selected="selected"<?php } ?>>中评</option>
                        <option  value="3" <?php if($slt_mark_type==3) { ?>selected="selected"<?php } ?>>差评</option>
                    </select>
                    </th>
                    <th>
                    <select name="slt_mark_content" onchange="this.form.submit();">
                        <option  value="1" <?php if($slt_mark_content==1) { ?>selected="selected"<?php } ?>>有内容评价</option>
                        <option  value="2" <?php if($slt_mark_content==2) { ?>selected="selected"<?php } ?>>无内容评价</option>
                    </select>
 <select name="slt_mark_from" onchange="this.form.submit();">
                        <option  value="1" <?php if($slt_mark_from==1) { ?>selected="selected"<?php } ?>>来自威客的评价</option>
                        <option  value="2" <?php if($slt_mark_from==2) { ?>selected="selected"<?php } ?>>来自雇主的评价</option>
                    </select>
                    </th>
<th width="150">评论者</th>
                  </tr>
  <?php if(is_array($mark_log_arr)) { foreach($mark_log_arr as $key => $value) { ?>
  <tr>
            <td>
            	<?php if($value['mark_status']==1) { ?>
            	<img src="<?=SKIN_PATH?>/img/ico_p1.gif"/>好评
<?php } elseif($value['mark_status']==2) { ?>
<img src="<?=SKIN_PATH?>/img/ico_p2.gif"/>中评
<?php } elseif($value['mark_status']==3) { ?>
<img src="<?=SKIN_PATH?>/img/ico_p3.gif"/>差评
<?php } else { ?>
<img src="<?=SKIN_PATH?>/img/ico_p1.gif"/>好评
<?php } ?>
</td>
            <td><p><?=$value['mark_content']?> </p>
            <span class="c999">[<?php echo date('Y-m-d H:i:s',$value[mark_time]); ?>]</span></td>
            <td><a href="index.php?do=space&uid=<?=$value['by_uid']?>" target="_blank"><?=$value['by_username']?></a></td>
          </tr>
  <?php } } ?>
  <tr>
  	<td colspan="4"><?=$mark_log_pages['page']?></td>
  </tr>
  </table>
  </form>
  </div>
<?php } ?>
</div> <!--task_info2_bg_E-->



    <div class="task_con_tit">
    	<dl><dt class="font14">会员常见问题</dt><dd><a href="javascript:;" class="hide_a">收缩此栏目</a>　 <a href="#top">返回顶部</a></dd></dl>
    </div>
    <div class="p_10"><ul>
      <?php Loaddata_Class::readtag(会员常见问题) ?>
    </ul></div>  
    

    <div class="task_con_tit">
    	<dl><dt class="font14">任务流程图</dt><dd><a href="javascript:;" class="hide_a">收缩此栏目</a>　 <a href="#top">返回顶部</a></dd></dl>
    </div>
    <div class="t_c"><img src="<?=SKIN_PATH?>/img/task_process.gif" width="791" height="114" /></div>
    
</div><!--content_E-->
<div class="clear"></div>
<script type="text/javascript" src="resource/js/xheditor/xheditor.js"></script>
<script type="text/javascript" >

$(function(){
$(".hide_a").click(function(){
$(this).parent().parent().parent().next().slideToggle('slow');
})
$("#task_favor").click(function(){
var uid =  parseInt('<?=$uid?>')+0;
if(uid == '' || isNaN(uid))
{
showDialog('您还没有登录，无法进行此操作', 'alert', '登录提示','',0);return false;
}else{
var url = "index.php?do=task";
$.ajax( {
type : "POST",
url : url,
cache : false,
async : false,
data : "ajax=favor&task_id=<?=$task_id?>&task_title=<?=$task_info['task_title']?>",
dataType : "json",
error : function(json) {
showDialog('系统繁忙，请稍后再试!', 'alert', '错误提示','',0);return false;
},
success : function(json) {
if (json.status == 0) {
 showDialog('此任务您已经收藏过了!', 'alert', '错误提示','',1);return false;
} 
else if(json.status == -1)
{
showDialog('您所在的用户组不能收藏该类型任务！!', 'notice', '信息提示','',1);return false;
}
else {
showDialog('此任务您已经收藏成功！!', 'notice', '信息提示','',1);return false;
}
}
});
}
})
})

function bid_tander(){
var uid = '<?=$uid?>';
var task_uid = '<?=$task_info['uid']?>';
var is_open_zb = '<?=$tender_config['is_open_zb']?>';
var is_bid = '<?=$is_bid?>';

if(is_open_zb!=1){
showDialog('操作无效，管理员已关闭招标模式!', 'alert', '操作失败提示','',0);return false;
}else{
if(uid==''){

showDialog('您还没有登录，无法进行此操作', 'alert', '登录提示','',0);return false;
}else{
if(uid==task_uid){
showDialog('操作无效，用户不能自己发布的任务进行投标!', 'alert', '操作失败提示','',0);return false;
}else if(is_bid>0){
showDialog('操作无效，您已经进行过一次投标，请勿重复操作!', 'alert', '操作失败提示','',0);return false;
}else{
showWindow('a_comment7', 'index.php?do=task_op&op=taskbid&comment_type=7&task_id=<?=$task_info['task_id']?>&obj_id=<?=$task_info['task_id']?>','get','1','','initedit()');
return false;
}
}

}
}
function initedit(){

editor = $("#system-create-location").xheditor({tools:'simple',internalScript:false,internalStyle:false,width:440,height:230,upLinkUrl:'index.php?do=ajax_upload&task_id=&type=link',upImgUrl:"index.php?do=ajax_upload&task_id=<?=$task_id?>",upImgExt:"jpg,jpeg,gif,png"});
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
<?php } ?><?php Template_Class::ob_out();?>