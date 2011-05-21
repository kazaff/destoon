<?php Template_Class::subtplcheck('tpl/default/index', '1303866330', 'tpl/default/index');?><?php $page_title='首页 - '.$_K['html_title'] ?><?php if($inajax) { ?>
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
<link href="<?=SKIN_PATH?>/css/index.css" rel="stylesheet" type="text/css"/>
<link href="<?=SKIN_PATH?>/css/dangdang.css" rel="stylesheet" type="text/css"/>
<div id="content">
    <div class="main_o">
        <div class="main_d_1">
            <dl>
                <dt>
                    <span id="tab_cont_1" class="h3_now" onmouseover="swaptab('cont','h3_now','',3,1)">网站公告</span>
                    <span id="tab_cont_2" onmouseover="swaptab('cont','h3_now','',3,2)">中标通知</span>
                    <span id="tab_cont_3" onmouseover="swaptab('cont','h3_now','',3,3)">提现公告</span>
                </dt>
                <dd class="linko" id="div_cont_1">
                    <?php Loaddata_Class::readtag(首页_公告) ?>
                </dd>
                <dd class="linko" id="div_cont_2" style="display:none;">
                    <ul>
                        <?php Loaddata_Class::readfeed(9,'work_accept',0,0,'index_work_accept','',0) ?>
                    </ul>
                </dd>
                <dd class="linko" id="div_cont_3" style="display:none;">
                    <ul>
                        <?php Loaddata_Class::readfeed(9,'withdraw',0,0,'index_withdraw','',0) ?>
                    </ul>
                </dd>
            </dl>
        </div>
        <!--main_d_1_E-->
        <div class=ddindex_content_lz id=__E_lunzhuan>
            <div id=lantern>
                <div id=lanternMain>
                    <div id=lanternImg>
                    </div>
                </div>
                <div style="border-top: #ffffff 1px solid; float: left; border-bottom: #ffffff 1px solid">
                    <img onclick=Lantern.moveprevious(); src="<?=SKIN_PATH?>/img/images/index_banner_lz_02_left.gif">
                </div>
                <div id=lanternNavy>
                </div>
                <div style="border-top: #ffffff 1px solid; float: left; border-bottom: #ffffff 1px solid">
                    <img onclick=Lantern.movenext(); src="<?=SKIN_PATH?>/img/images/index_banner_lz_02_right.gif">
                </DIV>
            </div>
        </div><!--轮换图片_E-->
        <div class="main_d_2">
            <div class="dt">
                <h3><a href="index.php?do=release">发布任务</a></h3>
                <h3><a href="index.php?do=task_list&model_id=1">我要赚钱</a></h3>
            </div>
            <dl>
                <dd>
                    进行中的任务：<span class="red"><strong><?=$witkeyinfo['tasknowcount']?></strong></span>
                    个
                    <br/>
                    共发布任务：<span class="red"><strong><?=$witkeyinfo['taskallcount']?></strong></span>
                    个<br/>
                   悬赏总金额：<span class="red"><strong>￥<?=$witkeyinfo['taskcash']?></strong></span>
                    元
                </dd>
                <dd>
                    注册用户：<span class="red"><strong><?=$witkeyinfo['userallcount']?></strong></span>
                    名
                    <br/>
                    VIP：<span class="red"><strong><?=$witkeyinfo['uservipcount']?></strong></span>
                    名
                    <br/>
                    团队：<span class="red"><strong><?=$witkeyinfo['userteamcount']?></strong></span>
                    个 
                </dd>
                <dd class="main_d_2_p0">
                    <h3></h3><br />QQ：3838438<br />电话：027-8888 8888
                </dd>
            </dl>
        </div>
        <!--main_d_2_E-->
    </div>
    <!--main_o_E-->
    <div class="clear">
    </div>
    <div class="advo ff_mt_10">
        <img src="<?=SKIN_PATH?>/img/adv.gif" width="960" height="80" />
    </div>
    <div class="main_left">
        <div class="main_d_task">
            <div class="main_d_task_tit">
                <h4>任务大厅</h4>
                <span><a href="index.php?do=task_list&model_id=1" class="c030">进入悬赏大厅(<?=$witkeyinfo['taskrewardnowcount']?>个项目正在进行中)</a></span>
                <a href="index.php?do=release" class="post_task_a"></a>
            </div>
            <dl>
                <dd class="main_d_task_gut">
                    <ul>
                        <li>
                            <form action="index.php" method="get" target="_blank" enctype="application/x-www-form-urlencoded">
                                <input type="hidden" name="do" value="search_list">关键字<input type="text" name="txt_search_title" class="task_txt" size="20"/> 　
                                <select name="slt_indus_pid" class="input_slt" id="fl" style="width:92px">
                                    <option value="">全部</option>
                                    <?php if(is_array($indus_p_arr)) { foreach($indus_p_arr as $key => $value) { ?>
                                    <option value="<?=$value['indus_id']?>"><?=$value['indus_name']?></option>
                                    <?php } } ?>
                                </select>
                                任务类型
                                <select name="slt_task_model_id" class="input_slt" id="zt" style="width:82px">
                                    <option value="">全部</option>
                                    <?php if(is_array($model_list)) { foreach($model_list as $model) { ?>
                                     <option value="<?=$model['model_id']?>"><?=$model['model_name']?></option>
                                    <?php } } ?>
                                </select>
                                　剩余时间<input type="text" name="txt_left_day" class="task_txt" size="5"/>天内　<input type="submit" value="" class="task_sub"/>&nbsp;<input type="button" value="" class="task_sub_g" onclick="location.href='index.php?do=search'"/>
                                </form>
                            </li>
                            
                            <li class="main_d_task_gut_tag">
                                <strong>热门标签：</strong>
                                <?php Loaddata_Class::readtag(首页热门标签) ?>
                            </li>
                           <li class="main_d_task_gut_tag">
                                <strong>剩余时间：</strong>
                                <a href="index.php?do=search_list&txt_left_day=1">24小时以内</a>
                                <a href="index.php?do=search_list&txt_left_day=3">3天之内</a>
                                <a href="index.php?do=search_list&txt_left_day=7">7天之内</a>
                                <a href="index.php?do=search_list&txt_left_day=30">30天之内</a>
                            </li>
                            <li class="main_d_task_gut_tag">
                                <strong>发布时间：</strong>
                                <a href="index.php?do=search_list&txt_pub_day=1">24小时以内</a>
                                <a href="index.php?do=search_list&txt_pub_day=3">3天之内</a>
                                <a href="index.php?do=search_list&txt_pub_day=7">7天之内</a>
                                <a href="index.php?do=search_list&txt_pub_day=30">30天之内</a>
                            </li>

<li></li>
                            </ul>
                            <dl>
                            	
                                <dd class="post_task_tab_dt">
                                <?php $t_m_l=1;$model_count = count($model_list)+1; ?>
                                <?php if(is_array($model_list)) { foreach($model_list as $model) { ?>
                                <h3 id="tab_cont2_<?=$t_m_l?>" <?php if($t_m_l<2) { ?>class="post_task_tab_now"<?php } ?> onclick="swaptab('cont2','post_task_tab_now','',<?=$model_count?>,<?=$t_m_l?>)"><a href="javascript:void(0)">最新<?php echo str_replace("任务","",$model[model_name]); ?></a></h3>
                                <?php $t_m_l++; ?>
                                <?php } } ?>
                                    <h3 id="tab_cont2_<?=$t_m_l?>" onclick="swaptab('cont2','post_task_tab_now','',<?=$model_count?>,<?=$t_m_l?>)"><a href="javascript:void(0)">任务推荐</a></h3>
                                
                                </dd>
                                <?php $t_m_l=1;$model_count = count($model_list)+1; ?>
                                <?php if(is_array($model_list)) { foreach($model_list as $model) { ?>
                                <dd id="div_cont2_<?=$t_m_l?>" <?php if($t_m_l>1) { ?>style="display:none;"<?php } ?> class="main_d_task_list">
                                    <ul class="w50 fl_l">
                                       <?php if(is_array($new_task_list[$model['model_id']])) { foreach($new_task_list[$model['model_id']] as $key => $value) { ?>
                                       <?php if($key==20) { ?></ul><ul class="w50 fl_l"><?php } ?>
                                       <LI> <SPAN class=f60>
                                       <?php if(in_array($value['task_mode'],array(1,2,3))) { ?>
￥<?=$value['task_cash']?>
<?php } else { ?>
￥<?=$tender_cash_rule[$value['task_cash_coverage']]['cove_desc']?>
<?php } ?>
</SPAN>元 
<A href="index.php?do=task&task_id=<?=$value['task_id']?>"><?=$value['task_title']?></A> 
</LI>
                                       <?php } } ?> 
                                    </ul>
                                </dd>
                                <?php $t_m_l++; ?>
                                <?php } } ?>
                                 
                                 <dd id="div_cont2_<?=$t_m_l?>" style="display:none;" class="main_d_task_list">
                                    <ul class="w50 fl_l">
                                         <?php Loaddata_Class::readtag(首页最新推荐任务) ?>
                                    </ul>
                                </dd>
                                
                               
                            </dl>
                        </dd>
                        </dl>
                    </div>
                    <!--main_d_task_E-->
                    <div class="clear">
                    </div>
                    <div class="main_d_3">
                        <dl>
                            <dt>
                                <span class="tit_03a fl_l">最新资讯</span>
                                <a href="index.php?do=news_list" class="fl_r i_more">>>更多</a>
                            </dt>
                            <dd class="linko main_d_3_gut">
                                <ul>
                                    <?php Loaddata_Class::readtag(首页最新资讯) ?>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <div class="main_d_3 ml_10">
                        <dl>
                            <dt>
                                <span class="tit_03a fl_l">成功案例</span>
                                <a href="index.php?do=case_list" class="fl_r i_more">>>更多</a>
                            </dt>
                            <dd class="linko main_d_3_gut">
                                <ul>
                                    <?php Loaddata_Class::readtag(首页成功案例) ?>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    </div>
                    <!--main_left_E-->
                    <div class="main_right">
                        <div class="main_d_r">
                            <dl>
                                <dt>
                                    <span class="tit_03a fl_l">任务分类</span>
                                    <a href="index.php?do=search" class="fl_r i_more">>>更多</a>
                                </dt>
                                <dd class="main_d_r_tag">
                                    <?php Loaddata_Class::readtag(首页分类) ?>
                                </dd>
                            </dl>
                        </div>
                        <div class="main_d_r">
                            <dl>
                                <dt>
                                    <span class="tit_03a fl_l">推广任务</span>
                                    <a href="index.php?do=search_list&page_size=20&is_prom=1" class="fl_r i_more">>>更多</a>
                                </dt>
                                <dd class="main_d_r2_gut">
                                    <ul>
                                        <?php Loaddata_Class::readtag(首页推广任务) ?>
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <div class="main_d_r">
                            <dl>
                                <dt>
                                    <span class="tit_03a fl_l">快到期任务</span>
                                    <a href="index.php?do=search_list&page_size=20&slt_order=3" class="fl_r i_more">>>更多</a>
                                </dt>
                                <dd class="main_d_r2_gut">
                                    <ul>
                                        <?php Loaddata_Class::readtag(首页快到期任务) ?>
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <div class="main_d_r">
                            <dl>
                                <dt>
                                    <span class="tit_03a fl_l">英雄榜</span>
                                    <span class="fl_r"><h6 class="main_d_r_h6" id="tab_cont3_1" onmouseover="swaptab('cont3','main_d_r_h6','',3,1)">本周</h6><h6 id="tab_cont3_2" onmouseover="swaptab('cont3','main_d_r_h6','',3,2)">本月</h6><h6 id="tab_cont3_3" onmouseover="swaptab('cont3','main_d_r_h6','',3,3)">全部</h6></span>
                                </dt>
                                <dd class="main_d_r_num" id="div_cont3_1">
                                    <?php if(is_array($hero_week)) { foreach($hero_week as $value) { ?>
                                    <ul>
                                        <li>
                                            <a href="index.php?do=space&member_id=<?=$value['uid']?>" class="c030"><?=$value['username']?></a>
                                            注册于<?php echo date('Y-m-d',$value['reg_time']); ?>
                                        </li>
                                        <li>
                                            中标：<?=$value['count']?>次   共获：<span class="red"><?=$value['cash']?></span>元
                                        </li>
                                    </ul>
                                    <?php } } ?>
                                </dd>
                                <dd class="main_d_r_num" id="div_cont3_2" style="display:none;">
                                    <?php if(is_array($hero_month)) { foreach($hero_month as $value) { ?>
                                    <ul>
                                        <li>
                                            <a href="index.php?do=space&member_id=<?=$value['uid']?>" class="c030"><?=$value['username']?></a>
                                            注册于<?php echo date('Y-m-d',$value['reg_time']); ?>
                                        </li>
                                        <li>
                                            中标：<?=$value['count']?>次   共获：<span class="red"><?=$value['cash']?></span>元
                                        </li>
                                    </ul>
                                    <?php } } ?>
                                </dd>
                                <dd class="main_d_r_num" id="div_cont3_3" style="display:none;">
                                    <?php if(is_array($hero_all)) { foreach($hero_all as $value) { ?>
                                    <ul>
                                        <li>
                                            <a href="index.php?do=space&member_id=<?=$value['uid']?>" class="c030"><?=$value['username']?></a>
                                            注册于<?php echo date('Y-m-d',$value['reg_time']); ?>
                                        </li>
                                        <li>
                                            中标：<?=$value['count']?>次   共获：<span class="red"><?=$value['cash']?></span>元
                                        </li>
                                    </ul>
                                    <?php } } ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <!--main_right_E-->
                    <div class="clear">
                    </div>
                    <div class="main_bot">
                        <div class="main_bot_d main_bot_d1">
                            <ul class="w50 fl_l linko">
                                <?php Loaddata_Class::readtag(首页客户帮助) ?>
                            </ul>
                        </div>
                        <div class="main_bot_d main_bot_d2">
                            <ul class="w50 fl_l linko">
                                <?php Loaddata_Class::readtag(首页服务商家帮助) ?>
                            </ul>
                        </div>
                        <div class="main_bot_d main_bot_d3">
                            <ul class="w50 fl_l linko">
                                <?php Loaddata_Class::readtag(首页交易安全保障) ?>
                            </ul>
                        </div>
                    </div>
                    <!--main_bot_E-->
                    <div class="clear">
                    </div>
                    <fieldset class="flink">
                        <legend>
                            <span class="tit_03a">友情链接</span>
                        </legend>
                        <?php if(is_array($link_arr)) { foreach($link_arr as $key => $value) { ?><a href="<?=$value['link_url']?>" target="_blank"><?=$value['link_name']?></a>
                        <?php } } ?>
                    </fieldset>
                </div>
                <!--content_E-->
                <div class="clear">
                </div>
                <?php Loaddata_Class::adgroup(首页幻灯,index) ?>
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