<?php Template_Class::subtplcheck('./control/admin/tpl/template_adgroup_talent', '1303700216', './control/admin/tpl/template_adgroup_talent');?><div class="inc">
    <ul class="img" id="img">
        <?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
        <li style="display: list-item;">
            <a target="_blank" title="<?=$value['ad_content']?>" href="<?=$value['ad_url']?>"><img src="<?=$value['ad_file']?>" width="387" height="215"></a>
        </li>
<?php } } ?>
    </ul>
    <ul class="tag" id="tag">
        <?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
        <li >
            <?=$value['ad_content']?>
        </li>
        <?php } } ?>
    </ul>
</div>
<script type="text/javascript">
    $(function(){
        var len = $("#tag > li").length;
        var index = 0;
        $("#tag li").mouseover(function(){
            index = $("#tag li").index(this);
            showImg(index);
        });
        
        $('#inc').hover(function(){
            if (MyTime) {
                clearInterval(MyTime);
            }
        }, function(){
            MyTime = setInterval(function(){
                showImg(index)
                index++;
                if (index == len) {
                    index = 0;
                }
            }, 3000);
        });
         
        var MyTime = setInterval(function(){
            showImg(index)
            index++;
            if (index == len) {
                index = 0;
            }
        }, 3000);
    })
    function showImg(i){
        //$("#img li").stop(true,false).animate({left : -387*i},800);
        $("#img li").eq(i).show().siblings().hide();
        $("#tag li").eq(i).addClass("select").siblings().removeClass("select");
    }
</script>
<?php Template_Class::ob_out();?>