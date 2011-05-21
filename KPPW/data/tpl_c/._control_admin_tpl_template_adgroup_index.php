<?php Template_Class::subtplcheck('./control/admin/tpl/template_adgroup_index', '1303866330', './control/admin/tpl/template_adgroup_index');?>

<script type="text/javascript" src="<?=SKIN_PATH?>/js/dangdang.js" ></script>

    <script type=text/javascript>
             document.lanterninfo=function(){
             Lanterninfo=new Array();
             Lanterninfo=[       
<?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
<?php if($key) { ?>,<?php } ?>
['<?=$value['ad_file']?>','<?=$value['ad_content']?>','<?=$value['ad_url']?>']
<?php } } ?>
               ];
               
               return Lanterninfo;
           } 
           Lantern.info=new Array();
           Lantern.info=document.lanterninfo();
           Lantern.init();
</script><?php Template_Class::ob_out();?>