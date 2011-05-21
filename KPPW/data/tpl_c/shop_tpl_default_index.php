<?php Template_Class::subtplcheck('shop/tpl/default/index', '1303712433', 'shop/tpl/default/index');?><?php $page_title = '威客商城 - '.$_K['html_title'] ?>
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
<link href="shop/tpl/default/css/index_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="shop/tpl/default/js/scroll.js"></script>
<div id="top"></div>
<div class="header">
      <div class="top_nav">
      		<div class="width_layer">
                <ul class="class_nav">
                    <?php $nav_count = 0; ?>
                    <?php if(is_array($nav_list)) { foreach($nav_list as $nav) { ?>
            <?php if($nav['ishide']!=3&&$nav_count<=6) { ?>
            	 <li><a class="map" href="<?=$nav['nav_url']?>"><span><?=$nav['nav_title']?></span></a></li>
            	<?php if(++$nav_count ==3 ) { ?><li><a class="logo" href="shop.php"><span>威客商城</span></a></li><?php } ?>
            <?php } ?>
            <?php } } ?>
                    
                </ul>
            </div>

            <div class="search_box">
            	<div class="tab">
                	<!-- <a id="tab_cont0_1" class="select" onClick="swaptab('cont0','select','',2,1)" title="店铺名称" href='javascript:void(0);'><span>店铺名称</span></a> -->
                    <a id="tab_cont0_2" class="select" onClick="swaptab('cont0','select','',2,2)" title="商品名称" href='javascript:void(0);'><span>商品名称</span></a>
                </div>
                <div class="tab_con">
                	<div id="div_cont0_1" style="display:block;">
                    	<form action="shop.php?do=shop_list" method="post">
                       	  	<input class="txt" name="txt_keyword" type="text" />
                        	<input type="submit" class="btn" value=" " />
                        </form>
                    </div>
                    <div id="div_cont0_2" style="display:none;">
                    	<form action="shop.php?do=service_list" method="post">
                        	<input class="txt" name="txt_keyword" type="text" />
                        	<input type="submit" class="btn" value=" " />
                        </form>
                    </div>
                </div>    
                <div class="wykd">
<?php if($shop_info) { ?><a href="index.php?do=user&view=service_add">发布商品</a><?php } else { ?><a href="index.php?do=user&view=create_shop">我要开店</a><?php } ?>
</div>
      		</div>

      </div>
</div>
<div class="content">
    <div class="width_layer">
        <div class="tab_nav">
          <ul>
          	<li><h2 id="renwu" class="rw_class">商品分类</h2></li>
            <?php if(is_array($indus_arr)) { foreach($indus_arr as $key => $value) { ?>
<li><a id="tab<?php echo $key+1 ?>" fd="<?=$value['indus_id']?>"  title="<?=$value['indus_name']?>" href='javascript:void(0);'><span><?=$value['indus_name']?></span></a></li>
<?php } } ?>
            <li><a href="shop.php?do=service_list">查看所有商品>></a></li>
          </ul>
      </div>
  <script type="text/javascript">
  	$(function(){
var tt;
var obj;
$(".tab_nav li a").mouseover(function(){

fd = $(this).attr('fd');
$("#con_tab_1").data('id',fd);
obj = $(this);
$(obj).parent().parent().find('a').each(function(i,n){
$(n).removeClass('select');
})
$(obj).addClass('select');
if(fd){
  window.clearTimeout(tt);
   
  if(typeof($(this).data('mydata')) != 'undefined'){
  	sub_show($(this).data('mydata'),fd);
  }else{
  	$("#con_tab_1").html("<img src='resource/img/loading.gif'>加载中......");
url = "index.php?do=shop&ajax=get_service&indus_id="+fd+"&aaa="+new Date().getTime();
$.getJSON(url,function(data){
$(obj).data('mydata',data);
sub_show(data,fd);
})
  }

   }
}).mouseleave(function(){

obj = $(this);
fd = $(this).attr('fd');
if(fd){
window.clearTimeout(tt);
tt = window.setTimeout(function(){
$("#con_tab_1").hide();
$(obj).removeClass('select');	
},200);
}
})
$("#con_tab_1").mousemove(function(){
window.clearTimeout(tt);
tt = window.setTimeout(function(){$("#con_tab_1").show();},200);
}).mouseleave(function(){
window.clearTimeout(tt);
tt = window.setTimeout(function(){
$("#con_tab_1").hide();
$(obj).removeClass('select');
},200);
})
 
})

function sub_show(data,fd){
 
var s_hmtl = "<dl>";
s_hmtl +="<dt>";
s_hmtl +="<strong>详细分类</strong>";
s_hmtl +="<ul>";
var k=1;
$.each(data.data.indus,function(i,n){
s_hmtl += '<li><a target="_blank" href=shop.php?do=service_list&indus_id='+n.indus_id+'>'+n.indus_name+'</a></li>';
if((k++)%2==0){
s_hmtl += '</ul><ul>';
}
})
s_hmtl +="</ul>";
s_hmtl +="</dt>";
s_hmtl +="<dd>";
s_hmtl +="<strong>推荐商品：</strong>";
$.each(data.data.service,function(i,n){
s_hmtl +='<p><em>￥'+n.price+'元</em><a title="'+n.title+'" target="_blank" href="shop.php?do=service_info&sid='+n.service_id+'">'+n.title+'</a></p>';
})
s_hmtl +='<p><a class="more" target="_blank" href="shop.php?do=service_list&indus_id='+fd+'">更多商品&gt;&gt;</a></p>';
s_hmtl +="</dd>";
s_hmtl +="</dl>";
 $("#con_tab_1").html(s_hmtl).show();
}

  	/*动态*/
        $(document).ready(function(){
            $("#scrollDiv").Scroll({line:2,speed:1000,timer:3000});
        });

  </script>
      <div class="nav_content">
          <div id="con_tab_1" class="submenu" style="display:none;">
          </div>
      </div>
      
      <div class="right_side">
        <div class="adv_show" style="margin-bottom:10px;">
           <!--广告图片-->          
     		<div id="barScroll" class="mrwm_slide mt10">
     		<?php Loaddata_Class::adgroup(商城幻灯,shop) ?>
  		</div>
        </div>
      </div>
       <script type="text/javascript">
       
       	$(function(){
    		var len = $(".mrwm_slist2 > li").length;
    		var index = 0;
    		$(".mrwm_slist2 li").mouseover(function(){
    		   index =   $(".mrwm_slist2 li").index(this);
    		   showImg2(index);
    		});
    		//滑入 停止动画，滑出开始动画.
    		$('#barScroll2').hover(function(){
    		     if(MyTime){
    		     clearInterval(MyTime);
    		     }
    		},function(){
    		     MyTime = setInterval(function(){
    		       showImg2(index)
    		     index++;
    		     if(index==len){index=0;}
    		     } , 2000);
    		});
    		//自动开始
    		var MyTime = setInterval(function(){
    		   showImg2(index)
    		   index++;
    		   if(index==len){index=0;}
    		} , 2000);
    		})
    		// Demo1 : 关键函数：通过控制top ，来显示不通的幻灯片
    		function showImg2(i){
    		  //$("#imgScrollCon2").stop(true,false).animate({left : -750*i},800);
    		   $(".imgScrollCon2 li").eq(i).show().siblings().hide();
    		   $(".mrwm_slist2 li")
    		    .eq(i).addClass("select")
    		    .siblings().removeClass("select");
    		}

       	$(function(){
    		var len = $(".mrwm_slist3 > li").length;
    		var index = 0;
    		$(".mrwm_slist3 li").mouseover(function(){
    		   index =   $(".mrwm_slist3 li").index(this);
    		   showImg3(index);
    		});
    		//滑入 停止动画，滑出开始动画.
    		$('#barScroll3').hover(function(){
    		     if(MyTime){
    		     clearInterval(MyTime);
    		     }
    		},function(){
    		     MyTime = setInterval(function(){
    		       showImg3(index)
    		     index++;
    		     if(index==len){index=0;}
    		     } , 2000);
    		});
    		//自动开始
    		var MyTime = setInterval(function(){
    		   showImg3(index)
    		   index++;
    		   if(index==len){index=0;}
    		} , 2000);
    		})
    		// Demo1 : 关键函数：通过控制top ，来显示不通的幻灯片
    		function showImg3(i){
    		  //$("#imgScrollCon3").stop(true,false).animate({left : -750*i},800);
    		   $(".imgScrollCon3 li").eq(i).show().siblings().hide();
    		   $(".mrwm_slist3 li")
    		    .eq(i).addClass("select")
    		    .siblings().removeClass("select");
    		}

       	$(function(){
    		var len = $(".mrwm_slist4 > li").length;
    		var index = 0;
    		$(".mrwm_slist4 li").mouseover(function(){
    		   index =   $(".mrwm_slist4 li").index(this);
    		   showImg4(index);
    		});
    		//滑入 停止动画，滑出开始动画.
    		$('#barScroll4').hover(function(){
    		     if(MyTime){
    		     clearInterval(MyTime);
    		     }
    		},function(){
    		     MyTime = setInterval(function(){
    		       showImg4(index)
    		     index++;
    		     if(index==len){index=0;}
    		     } , 2000);
    		});
    		//自动开始
    		var MyTime = setInterval(function(){
    		   showImg4(index)
    		   index++;
    		   if(index==len){index=0;}
    		} , 2000);
    		})
    		// Demo1 : 关键函数：通过控制top ，来显示不通的幻灯片
    		function showImg4(i){
    		  //$("#imgScrollCon4").stop(true,false).animate({left : -750*i},800);
    		   $("#imgScrollCon4 li").eq(i).show().siblings().hide();
    		   $(".mrwm_slist4 li")
    		    .eq(i).addClass("select")
    		    .siblings().removeClass("select");
    		}
       </script>
      
      <div class="clear"></div>
      
      <!-- 1111111111111111 -->
      <link href="shop/tpl/<?=$_K['template']?>/css/shop.css" rel="stylesheet" type="text/css" />
<div class="box">
<div class="shangcheng">
   	  <div class="tuijian">
       	  <div class="t_top">
          	<strong>商城推荐</strong>
          </div>
            <div class="t_content">
            	<ul>
                	<li><?php Loaddata_Class::ad(104) ?></li>
                    <li><?php Loaddata_Class::ad(105) ?></li>
                    <li><?php Loaddata_Class::ad(106) ?></li>
                </ul>
          </div>
      </div>
      <div class="dongtai">
        	<div class="dt">
            <div class="d_top"></div>
               <div class="d_content">
    <div class="cont">
                   <div id="scrollDiv">
                       <ul>
                    <?php if(is_array($feedlist)) { foreach($feedlist as $feed) { ?>
<li><em>·</em><?=$feed['title']?> &nbsp;&nbsp;<?php echo Func_comm_class::gmdate($feed['feed_time']) ?></li>
           			<?php } } ?>
                   </ul>
                   </div>
               </div>     
          </div>
            </div>
            <div class="zy">
            	<div class="zy_left">
               	  <div class="zy_top"><strong>商城公告</strong></div>
                  <div class="zy_content">
                    	<ul>
                        	<?php Loaddata_Class::readtag(商城_公告) ?>
                        </ul>
                  </div>
                </div>
                <div class="zy_right">
                	<div class="zy_top"><strong>最新成交</strong></div>
                    <div class="zy_content">
                    	<ul>
                    	<?php if(is_array($order_list)) { foreach($order_list as $v) { ?>
                    	<li><strong>￥<?=$v['count_cash']?>元</strong><a href="index.php?do=space&memberid=<?=$v['buy_uid']?>"><?=$v['buy_username']?></a>购买了<a target="_blank" title="网吧协会官方网站" href="shop.php?do=service_info&sid=<?=$v['service_id']?>"><?=$v['title']?></a></li>             
                	<?php } } ?>
                        	
                        </ul>
                    </div>
                </div>
            </div>
      </div>
        <div class="contact">
        	<div class="a1"><?php if($shop_info) { ?><a href="index.php?do=user&view=service_add"><img src="shop/tpl/<?=$_K['template']?>/img/pic4.jpg" width="219" height="56" /></a><?php } else { ?><a href="index.php?do=user&view=create_shop"><img src="shop/tpl/<?=$_K['template']?>/img/pic4.jpg" width="219" height="56" /></a><?php } ?></div>
            <div class="a2"><a href="index.php?do=release&model_id=1"> <img src="shop/tpl/<?=$_K['template']?>/img/pci5.jpg" width="219" height="56" /></a></div>
            <div class="a3"><a href="index.php?do=search_list"> <img src="shop/tpl/<?=$_K['template']?>/img/pic6.jpg" width="219" height="56" /></a></div>
            <div class="a4"><ul><li>&nbsp;</li><li>QQ :0101001</li><li>电话:3838438</li></ul></div>
        </div>
    </div>
    
    <div class="dianpu">
    	<div class="dp_left">
        	<div class="dp_s"><strong>&nbsp;&nbsp;&nbsp;店铺排行榜</strong></div>
            <div class="dp_x">
            	<div class="xxk">
                	<a id="tab_contq_1" class="select" onClick="swaptab('contq','select','',2,1)"><span>个人店铺</span></a>
                    <a id="tab_contq_2" onClick="swaptab('contq','select','',2,2)"><span>企业店铺</span></a>
       		   </div>
              <div class="paihang" id="div_contq_1">
              <?php if(is_array($hotp_shop_list)) { foreach($hotp_shop_list as $sp) { ?>
                	<ul>
                    	<li><span><a href="shop.php?do=shop&shop_id=<?=$sp['shop_id']?>" style="color: red;"><?php if($sp['shop_name']) { ?><?php echo Func_comm_class::cutstr($sp['shop_name'],20); ?><?php } else { ?><?=$sp['username']?><?php } ?></a></span> &nbsp;信用值：<?=$sp['w_m_credit_value']?><img src="shop/tpl/<?=$_K['template']?>/img/jiantou.jpg" width="9" height="11" /></li>
                        <li style="height:20px;line-height:20px;overflow:hidden;">主营范围：<?php $rg = explode(',',$sp['service_range']) ?><?php if(is_array($rg)) { foreach($rg as $r) { ?><a href="shop.php?do=service_list&indus_id=<?=$r?>"><?=$indus_all[$r]['indus_name']?></a><?php } } ?></li>
                    </ul>
              <?php } } ?>
              </div>
              <div class="paihang" id="div_contq_2" style="display: none;">
              <?php if(is_array($hote_shop_list)) { foreach($hote_shop_list as $sp) { ?>
                	<ul>
                    	<li><span><a href="shop.php?do=shop&shop_id=<?=$sp['shop_id']?>" style="color: red;"><?php if($sp['shop_name']) { ?><?php echo Func_comm_class::cutstr( $sp['shop_name'],22) ?> <?php } else { ?><?=$sp['username']?><?php } ?></a></span> &nbsp;信用值：<?=$sp['w_m_credit_value']?><img src="shop/tpl/<?=$_K['template']?>/img/jiantou.jpg" width="9" height="11" /></li>
                        <li>主营范围：<?php $rg = explode(',',$sp['service_range']) ?><?php if(is_array($rg)) { foreach($rg as $r) { ?><a href="shop.php?do=service_list&indus_id=<?=$r?>"><?=$indus_all[$r]['indus_name']?></a><?php } } ?></li>
                    </ul>
              <?php } } ?>
              </div>
            </div>
        </div>
        <div class="dp_right">
        	<div class="dp_top"><strong>&nbsp;&nbsp;最新商品</strong></div>
          <div class="dp_content">
                <div class="dp_pic">
                	<ul id="div_contx_1">
                		<?php if(is_array($new_list)) { foreach($new_list as $value) { ?>
                    	<li>
                    	<a class="img" href="shop.php?do=service_info&sid=<?=$value['service_id']?>"><img src="<?php if($value['pic']) { ?><?=$value['pic']?><?php } else { ?>shop/tpl/default/img/def_service.jpg<?php } ?>" onerror="this.src='shop/tpl/default/img/def_service.jpg'" width="165" height="124" /></a>
                    	<span><font style="color: #bd0000">￥<?=$value['price']?></font> <a href="shop.php?do=service_info&sid=<?=$value['service_id']?>"><?=$value['title']?></a></span>
                    	<span class="s2"><a href="index.php?do=space&member_id=<?=$value['uid']?>"><?=$value['username']?></a>发布于 <?php echo Func_comm_class::gmdate($value['on_time']) ?></span>
                    	</li>
                        <?php } } ?>
                    </ul>
                   
                </div>
          </div>
        </div>
    </div>
    
    <div class="shangpin">
    	<div class="sp_left">
        
        	<div class="sp_top"><strong>成交排行</strong></div>
  		    <div class="sp_content">
                <ul>
                	<?php if(is_array($top_sale_list)) { foreach($top_sale_list as $k => $zp) { ?>
            	<li><img src="shop/tpl/<?=$_K['template']?>/img/<?php echo $k+1 ?>.jpg" width="17" height="14" /><span>共￥<?=$zp['totalcash']?></span><a href="shop.php?do=service_info&sid=<?=$zp['service_id']?>"> <?=$zp['title']?></a></li>
                <?php } } ?>
                </ul>
              
          </div>
        </div>
      <div class="sp_center">
        	<div class="sp_top"><strong>热门作品</strong></div>
            <div class="sp_content">
        		<ul>
        		<?php if(is_array($hot_zp_list)) { foreach($hot_zp_list as $k => $zp) { ?>
            	<li><img src="shop/tpl/<?=$_K['template']?>/img/<?php echo $k+1 ?>.jpg" width="17" height="14" /><span>￥<?=$zp['price']?></span><a href="shop.php?do=service_info&sid=<?=$zp['service_id']?>"> <?=$zp['title']?></a></li>
                <?php } } ?>
            </ul>
            </div>
        
      </div>
      <div class="sp_right">
        
        <div class="sp_top"><strong>热门服务</strong></div>
        <div class="sp_content">
           <ul>
            	<?php if(is_array($hot_fw_list)) { foreach($hot_fw_list as $k => $zp) { ?>
            	<li><img src="shop/tpl/<?=$_K['template']?>/img/<?php echo $k+1 ?>.jpg" width="17" height="14" /><span>￥<?=$zp['price']?></span><a href="shop.php?do=service_info&sid=<?=$zp['service_id']?>"><?=$zp['title']?></a></li>
                <?php } } ?>
            </ul>             
        </div>
            
      </div>
    </div>
</div>
<div class="clear"></div>
      
   <div class="main_bot">
                    <div class="main_bot_d main_bot_d1">
                        <ul class="w50 fl_l linko">
                          <?php if(is_array($buyer_help_arr)) { foreach($buyer_help_arr as $v) { ?>  
   <li><a href="index.php?do=help_info&art_id=1099&menu_id=<?=$v['art_id']?>" target="_blank"><?=$v['art_title']?></a></li> 
  <?php } } ?>   
                        </ul>
                     </div>
                     <div class="main_bot_d main_bot_d2">
                         <ul class="w50 fl_l linko">
                            <?php if(is_array($saler_help_arr)) { foreach($saler_help_arr as $v) { ?>  
   <li><a href="index.php?do=help_info&art_id=1099&menu_id=<?=$v['art_id']?>" target="_blank"><?=$v['art_title']?></a></li> 
  <?php } } ?> 
                         </ul>
                     </div>
                    <div class="main_bot_d main_bot_d3">
                          <ul class="w50 fl_l linko">
                            <?php if(is_array($faq_help_arr)) { foreach($faq_help_arr as $v) { ?>  
   	<li><a href="index.php?do=help_info&art_id=1099&menu_id=<?=$v['art_id']?>" target="_blank"><?=$v['art_title']?></a></li> 
  <?php } } ?> 
                          </ul>
                    </div>
     </div>
   
</div>
</div>

<script type="text/javascript" src="resource/js/jquery.lazyload.js">
$(function() {          
    $("img:below-the-fold").lazyload({
        placeholder : "resource/img/grey.gif", 
        event : "sporty",
effect : "fadeIn"

    });
});
$(window).bind("load", function() { 
    var timeout = setTimeout(function() {$("img").trigger("sporty")}, 5000);
}); 
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