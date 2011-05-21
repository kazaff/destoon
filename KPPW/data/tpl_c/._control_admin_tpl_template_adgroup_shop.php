<?php Template_Class::subtplcheck('./control/admin/tpl/template_adgroup_shop', '1303712433', './control/admin/tpl/template_adgroup_shop');?><div class="imgScroll">
<ul class="imgScrollCon" id="imgScrollCon" >
<?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
<li><a title="<?=$value['ad_content']?>" target="_blank" href="<?=$value['ad_url']?>"><img src="<?=$value['ad_file']?>"></a></li>
<?php } } ?>
</ul>
</div>
<ul class="mrwm_slist">
<?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
<li <?php if(!$key) { ?>class="select"<?php } ?>><?=$value['ad_content']?></li>
<?php } } ?>
</ul>

<script>
$(function(){
var len = $(".mrwm_slist > li").length;
var index = 0;
$(".mrwm_slist li").mouseover(function(){
   index =   $(".mrwm_slist li").index(this);
   showImg(index);
});
//滑入 停止动画，滑出开始动画.
$('#barScroll').hover(function(){
     if(MyTime){
     clearInterval(MyTime);
     }
},function(){
     MyTime = setInterval(function(){
       showImg(index)
     index++;
     if(index==len){index=0;}
     } , 2000);
});
//自动开始
var MyTime = setInterval(function(){
   showImg(index)
   index++;
   if(index==len){index=0;}
} , 2000);
})
// Demo1 : 关键函数：通过控制top ，来显示不通的幻灯片
function showImg(i){
  //$("#imgScrollCon").stop(true,false).animate({left : -750*i},800);
   $(".imgScrollCon li").eq(i).show().siblings().hide();
   $(".mrwm_slist li")
    .eq(i).addClass("select")
    .siblings().removeClass("select");
}
</script>
<?php Template_Class::ob_out();?>