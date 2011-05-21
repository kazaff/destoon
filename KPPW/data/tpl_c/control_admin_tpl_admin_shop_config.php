<?php Template_Class::subtplcheck('control/admin/tpl/admin_shop_config', '1303712546', 'control/admin/tpl/admin_shop_config');?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>">
<title>商城配置管理</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script src="tpl/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="tpl/js/css.js"></script>
<script type="text/javascript" src="tpl/js/form_and_validation.js"></script>

<body>
            <div class="main">
            <div class="w_80 m_c">
                <div id="select1">
                    <div class="tab_t">
                        <h3 class="sel" id="tab_cont_1" onclick="swaptab('cont','sel','',3,1)">商城配置管理</h3>
                        <h4></h4>
                        <h3 id="tab_cont_2" onclick="swaptab('cont','sel','',3,2)">商城权限配置</h3>
                        <h4></h4>
                    </div>
                    <div class="gut">
                    <div class="<?php if($op=='config'||!$op) { ?>block<?php } else { ?>none<?php } ?>" id="div_cont_1">
                    	<ul>
                            <li>
    <form action="index.php?do=<?=$do?>&view=<?=$view?>&op=config" method="post" enctype="multipart/form-data" enctype="multipart/form-data">
    <input type="hidden" name="hdn_config_id" value="<?=$config_id?>">
<table width="96%" height="200" border="0" cellspacing="0" cellpadding="0" class="tab_m t_l">
   <tr>
   		  <td class="t_r">商城是否启用：</td>
    <td>
    	<input <?php if(!$shop_is_close) { ?>checked="checked"<?php } ?> type="radio" name="rdo_shop_is_close" value="0" >启用
<input <?php if($shop_is_close) { ?>checked="checked"<?php } ?> type="radio" name="rdo_shop_is_close" value="1" >禁用
    </td>
  </tr>
  <tr>
  <td class="t_r">服务交易收费比例：</td>
    <td>
    	<input type="text" name="txt_service_prorate" value="<?=$service_prorate?>">%
(0 为不收费)
    </td>
  </tr>

   <tr id="tr_indus" >
    <td class="t_r">作品下载收费比例：</td>
        <td>
       	    <input type="text" name="txt_down_prorate" value="<?=$down_prorate?>" class="input_t">%
(0 为不收费)
        </td>
  </tr>
 
   <tr>
    <td class="t_r">商品最小成交总金额：</td>
    <td>
<input type="text" name="txt_service_min_amount" value="<?=$service_min_amount?>" class="input_t" maxlength="5">元
(0 为不限制)	
</td>

      </tr>
   <tr>
    <td class="t_r">商品每阶段最小金额：</td>
        <td>
        	<input type="text" name="txt_step_min_amount" value="<?=$step_min_amount?>" class="input_t" maxlength="5">元
        (0为不限制)
        </td>
  </tr>
 
  <tr>
  	<td width="30%"></td>
  	<td>&nbsp;&nbsp;&nbsp;&nbsp;
 
<input type="submit" name="sbt_edit" class="input_but" value="<?php if($config_id) { ?>编辑保存<?php } else { ?>创建配置<?php } ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="sbt_goback" class="input_but" value="返回上一步" onclick="javascript:history.go(-1);" >
</td>
  </tr>
    </table>
 </form>
                            </li>
                        </ul>
                    	</div>
                    	
                    	<div class="<?php if($op=='rule') { ?>block<?php } else { ?>none<?php } ?>" id="div_cont_2">
                    		<table width="96%" height="200" border="0" cellspacing="0" cellpadding="0" class="tab_m t_l">
                    		<tr>
<th width="15%" class="bg1" colspan="1">用户组：</th>
<?php if(is_array($task_rule_menu['shop'])) { foreach($task_rule_menu['shop'] as $k => $rule) { ?>
<th class="bg1"><?=$rule['0']?></th>
<?php } } ?>
<th>编辑</th>
</tr>
<?php if(is_array($score_rule)) { foreach($score_rule as $score) { ?>
<tr>
<td><?=$score['unit_title']?></td>
<?php if(is_array($task_rule_menu['shop'])) { foreach($task_rule_menu['shop'] as $k => $rule) { ?>
<td><?php if($rule['1']&&$rule_list[$k]['score_'.$score['score_rule_id']]>0) { ?><?=$rule_list[$k]['score_'.$score['score_rule_id']]?>次<?php } elseif($rule_list[$k]['score_'.$score['score_rule_id']]<0) { ?>禁用<?php } else { ?>允许<?php } ?></td>
<?php } } ?>
<td><a href="index.php?do=rule&view=group_rule&type=score&score_id=<?=$score['score_rule_id']?>&edonly=shop">编辑</a></td>
</tr>
<?php } } ?>
<tr><td class="bg1" colspan="<?php echo count($task_rule_menu['shop'])+2; ?>"><b>特殊会员组</b></td></tr>
<tr>
<td>vip用户</td>
<?php if(is_array($task_rule_menu['shop'])) { foreach($task_rule_menu['shop'] as $k => $rule) { ?>
<td><?php if($rule['1']&&$rule_list[$k]['vip']>0) { ?><?=$rule_list[$k]['vip']?>次<?php } elseif($rule_list[$k]['vip']<0) { ?>禁用<?php } else { ?>允许<?php } ?></td>
<?php } } ?>
<td><a href="index.php?do=rule&view=group_rule&type=auth&auth=vip&edonly=shop">编辑</a></td>
</tr>
                    		<tr>
<td>实名认证用户</td>
<?php if(is_array($task_rule_menu['shop'])) { foreach($task_rule_menu['shop'] as $k => $rule) { ?>
<td><?php if($rule['1']&&$rule_list[$k]['realname']>0) { ?><?=$rule_list[$k]['realname']?>次<?php } elseif($rule_list[$k]['realname']<0) { ?>禁用<?php } else { ?>允许<?php } ?></td>
<?php } } ?>
<td><a href="index.php?do=rule&view=group_rule&type=auth&auth=realname&edonly=shop">编辑</a></td>
</tr>
<tr>
<td>企业认证用户</td>
<?php if(is_array($task_rule_menu['shop'])) { foreach($task_rule_menu['shop'] as $k => $rule) { ?>
<td><?php if($rule['1']&&$rule_list[$k]['enterprise']>0) { ?><?=$rule_list[$k]['enterprise']?>次<?php } elseif($rule_list[$k]['enterprise']<0) { ?>禁用<?php } else { ?>允许<?php } ?></td>
<?php } } ?>
<td><a href="index.php?do=rule&view=group_rule&type=auth&auth=enterprise&edonly=shop">编辑</a></td>
</tr>
<tr>
<td>email认证用户</td>
<?php if(is_array($task_rule_menu['shop'])) { foreach($task_rule_menu['shop'] as $k => $rule) { ?>
<td><?php if($rule['1']&&$rule_list[$k]['email']>0) { ?><?=$rule_list[$k]['email']?>次<?php } elseif($rule_list[$k]['email']<0) { ?>禁用<?php } else { ?>允许<?php } ?></td>
<?php } } ?>
<td><a href="index.php?do=rule&view=group_rule&type=auth&auth=email&edonly=shop">编辑</a></td>
</tr>
<tr>
<td>银行认证用户</td>
<?php if(is_array($task_rule_menu['shop'])) { foreach($task_rule_menu['shop'] as $k => $rule) { ?>
<td><?php if($rule['1']&&$rule_list[$k]['bank']>0) { ?><?=$rule_list[$k]['bank']?>次<?php } elseif($rule_list[$k]['bank']<0) { ?>禁用<?php } else { ?>允许<?php } ?></td>
<?php } } ?>
<td><a href="index.php?do=rule&view=group_rule&type=auth&auth=bank&edonly=shop">编辑</a></td>
</tr>
                    		</table>
                        </div>
                    </div>
                    
                </div>
                <br>
            </div>
       </div>
       <script src="../../resource/js/keke.js" type="text/javascript"></script>


<script type="text/javascript">
function show_indus(banner_type){
if(banner_type==1){
$("#tr_indus").hide();
}else{
$("#tr_indus").show();
}

}
</script>
</body>
</html><?php Template_Class::ob_out();?>