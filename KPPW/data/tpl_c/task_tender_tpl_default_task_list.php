<?php Template_Class::subtplcheck('task/tender/tpl/default/task_list', '1303808853', 'task/tender/tpl/default/task_list');?><?php $page_title=$indus_info['indus_name'].'招标任务列表 - '.$_K['html_title'] ?><?php if($inajax) { ?>
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

<div id="content">
    <div class="main_left">
        <div class="main_d_task">
            <div class="main_d_task_tit">
                <h4><?=$model_info['model_name']?></h4><span><?php if($indus_c_arr[$indus_id]['indus_pid']) { ?><a href="javascript:;" class="c030"><?=$indus_c_arr[$indus_c_arr[$indus_id]['indus_pid']]['indus_name']?></a> > <?php } ?><?php if($indus_id) { ?><a href="javascript:;" class="c030"><?=$indus_c_arr[$indus_id]['indus_name']?></a><?php } ?></span><a href="index.php?do=release&model_id=<?=$model_id?>" class="post_task_a"></a>
            </div>
            <dl>
            	<form action="index.php" method="get" name="frm_tender_list" id="frm_tender_list">
            		<input type="hidden" name="do" value="task_list">
            		<input type="hidden" name="view" value="<?=$view?>">
            		<input type="hidden" name="model_id" value="<?=$model_id?>">
<input type="hidden" name="indus_id" value="<?=$indus_id?>">
<input type="hidden" name="page_size" value="<?=$page_size?>">
            <dd class="main_d_task_gut">
                <div class="main_d_task_sort">
                	<strong>排序方式：</strong>

<?php if($slt_order=='2') { ?>
<a href="index.php?do=<?=$do?>&view=<?=$view?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?>&page_size=<?=$page_size?>&slt_order=1&model_id=<?=$model_id?>">招标价格↓</a>
<?php } else { ?>
<a href="index.php?do=<?=$do?>&view=<?=$view?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?>&page_size=<?=$page_size?>&slt_order=2&model_id=<?=$model_id?>">招标价格↑</a>
<?php } ?>

<?php if($slt_order=='4') { ?>
<a href="index.php?do=<?=$do?>&view=<?=$view?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?>&page_size=<?=$page_size?>&slt_order=3&model_id=<?=$model_id?>">剩余时间↓</a> 
<?php } else { ?>
<a href="index.php?do=<?=$do?>&view=<?=$view?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?>&page_size=<?=$page_size?>&slt_order=4&model_id=<?=$model_id?>">剩余时间↑</a>
<?php } ?>

<select style="width:120px;" name="slt_order" onchange="frm_tender_list.submit();">
<option value=''>默认排序</option>
<option value="1" <?php if($slt_order=='1') { ?>selected="selected"<?php } ?>>价格 从高到低</option>
<option value="2" <?php if($slt_order=='2') { ?>selected="selected"<?php } ?>>价格 从低到高</option>
<option value="3" <?php if($slt_order=='3') { ?>selected="selected"<?php } ?>>剩余时间 从多到少</option>
<option value="4" <?php if($slt_order=='4') { ?>selected="selected"<?php } ?>>剩余时间 从少到多</option>
</select>　
招标金额：
 <select  style="width:120px;" name="slt_cash_cove" onchange="frm_tender_list.submit();">
 <option value=''>请选择金额范围</option>
 	<?php if(is_array($cash_rule_arr)) { foreach($cash_rule_arr as $key => $value) { ?>
<option value="<?=$value['cash_rule_id']?>" <?php if($slt_cash_cove==$value['cash_rule_id']) { ?>selected<?php } ?>><?=$value['cove_desc']?></option>
<?php } } ?>
 </select>
 条数:
 <a href="index.php?do=task_list&page_size=20&view=<?=$view?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?><?php if($slt_order) { ?>&slt_order=<?=$slt_order?><?php } ?>&model_id=<?=$model_id?>">20</a>
 <a href="index.php?do=task_list&page_size=40&view=<?=$view?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?><?php if($slt_order) { ?>&slt_order=<?=$slt_order?><?php } ?>&model_id=<?=$model_id?>">40</a>
 <a href="index.php?do=task_list&page_size=80&view=<?=$view?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?><?php if($slt_order) { ?>&slt_order=<?=$slt_order?><?php } ?>&model_id=<?=$model_id?>">80</a></div>
                <dl><dd class="post_task_tab_dt">
                	<a href="index.php?do=<?=$do?>&view=all<?php if($slt_order) { ?>&slt_order=<?=$slt_order?><?php } ?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?>&model_id=<?=$model_id?>"><h3 <?php if($view=='all' or $view=='' ) { ?>class="post_task_tab_now"<?php } ?>>所有任务</h3></a>
<a href="index.php?do=<?=$do?>&view=proceed<?php if($slt_order) { ?>&slt_order=<?=$slt_order?><?php } ?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?>&model_id=<?=$model_id?>"><h3 <?php if($view=='proceed') { ?>class="post_task_tab_now"<?php } ?>>正在进行</h3></a>
<a href="index.php?do=<?=$do?>&view=over<?php if($slt_order) { ?>&slt_order=<?=$slt_order?><?php } ?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?>&model_id=<?=$model_id?>"><h3 <?php if($view=='over') { ?>class="post_task_tab_now"<?php } ?>>已结束</h3></a>
<a href="index.php?do=<?=$do?>&view=vip<?php if($slt_order) { ?>&slt_order=<?=$slt_order?><?php } ?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?>&model_id=<?=$model_id?>"><h3 <?php if($view=='vip') { ?>class="post_task_tab_now"<?php } ?>>VIP任务</h3></a>
<a href="index.php?do=<?=$do?>&view=commend<?php if($slt_order) { ?>&slt_order=<?=$slt_order?><?php } ?><?php if($slt_cash_cove) { ?>&slt_cash_cove=<?=$slt_cash_cove?><?php } ?>&model_id=<?=$model_id?>"><h3 <?php if($view=='commend') { ?>class="post_task_tab_now"<?php } ?>>推荐任务</h3></a>
</dd>
                <dd class="main_d_task_list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="task_table t_c">
                  <tr>
                    <th width="50">No.ID</th>
                    <th class="title">任务标题</th>
                    <th width="60">报名人数</th>
                    <th width="110">金额范围</th>
                    <th width="80">结束时间</th>
                    
                  </tr>
  
  <?php if(is_array($task_arr)) { foreach($task_arr as $key => $value) { ?>
                  <tr>
                    <td>#<?=$value['task_id']?></td>
                    <td class="title">
                    	<a href="index.php?do=task&task_id=<?=$value['task_id']?>" target="_blank">
                    		<?php echo(Func_comm_class::cutstr($value[task_title],40)); ?>
<?php if($value['isvip']==1) { ?>
&nbsp;<img src="<?=SKIN_PATH?>/img/vip2.gif" align="absmiddle"/>
<?php } ?>
<?php if($value['istop']==1) { ?>
&nbsp;<img src="<?=SKIN_PATH?>/img/jian.gif" align="absmiddle"/>
<?php } ?>
</a>
</td>
                    <td><?=$value['sign_num']?></td>
                    <td><em>
                    		 <?=$cash_rule_arr[$value['task_cash_coverage']]['cove_desc']?>
</em>
</td>
                    <td>
                    <?php if($value['task_status']==7) { ?>
任务已结束
<?php } else { ?>
<?=$value['remaining_time']?>
<?php } ?>
</td>
                  </tr>
                 <?php } } ?>
                </table>
                
              </dd></dl>
              <div class="Npage">
              	<?=$pages['page']?>
                   <!-- <span>1 / 10 页</span>
                    <span><<上一页</span>
                    <a href="#" class="Nnow">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a><a href="#">8</a><a href="#">9</a><a href="#">10</a>
                    <span>下一页>></span>-->
              </div>
            </dd>
                
            </dl>
        </div><!--main_d_task_E-->
        
        <div class="clear"></div>
        
        
    </div><!--main_left_E-->
    
    <div class="main_right">
    	<div class="mb_10"><a href="index.php?do=release&model_id=<?=$model_id?>"><img src="<?=SKIN_PATH?>/img/reward.png"/></a></div>
        <div class="mb_10"><a href="index.php?do=task_list&model_id=<?=$model_id?>"><img src="<?=SKIN_PATH?>/img/earn.png"/></a></div>
  		<div class="main_d_r">
        	<dl><dt class="main_d_r_tit font14">任务分类</dt>
            <dd class="main_d_r_tag">
            	<?php if(is_array($indus_p_arr)) { foreach($indus_p_arr as $key => $values) { ?>
<h4 class="font14"><?=$values['indus_name']?> </h4>
<?php if(is_array($indus_c_arr)) { foreach($indus_c_arr as $key => $value) { ?>
<?php if($value['indus_pid']==$values['indus_id']) { ?>
<a <?php if($indus_id==$value['indus_id']) { ?>style="color: #fe8b2f"<?php } ?> href="index.php?do=<?=$do?>&indus_id=<?=$value['indus_id']?>&model_id=<?=$model_id?>"><?=$value['indus_name']?></a>
<?php } ?>
<?php } } ?>
<?php } } ?>  
            </dd></dl>
        </div>
        
        

  </div><!--main_right_E-->
    
</form>
</div><!--content_E-->
<div class="clear"></div>

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