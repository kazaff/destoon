<?php Template_Class::subtplcheck('task/tender/control/admin/tpl/model_edit', '1303811282', 'task/tender/control/admin/tpl/model_edit');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>main</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script src="tpl/js/jquery.js" type="text/javascript"></script>
<script src="tpl/js/common.js" type="text/javascript"></script>
<script type="text/javascript" src="tpl/js/Css.js"></script>
<script type="text/javascript" src="tpl/js/form_and_validation.js"></script>
<script type="text/javascript" src="../../resource/js/xheditor/xheditor.js"></script>
<body>
<div id="append_parent"></div>
<form method="post"" action="index.php?do=model&view=edit&model_id=<?=$model_id?>&task_id=<?=$task_id?>&r_status=<?=$r_status?>&r_indus_id=<?=$r_indus_id?>&r_task_id=<?=$r_task_id?>&r_leftday=<?=$r_leftday?>&r_lefthour=<?=$r_lefthour?>" enctype="multipart/form-data">
<input type="hidden" name="is_submit" value="1"/>

<div class="main">
<div class="m_tit">
<ul><li class="m_tit_l"></li>
<li class="font14">编辑任务</li><li class="m_tit_r"></li>
</ul>
</div>
    <table width="96%" border="0" cellspacing="0" cellpadding="0" class="tab_m t_l">
      <tr>
      	<td width="30%" class="bg1 t_r">任务名</td>
<td><input type="text" class="input_t" name="txt_task_title" value="<?=$task_info['task_title']?>" maxlength="20" litit="required:true;len:4-50"  msg="任务名称不能为空，长度限制在4-50" msgArea="msg_task_title" /><b style="color:red"> *</b><span id="msn_task_title"></span></td>
      </tr>
  <tr>
      	<td width="30%" class="bg1 t_r">任务类型</td>
<td>招标任务</td>
      </tr>
  <tr>
      	<td width="30%" class="bg1 t_r">任务状态</td>
<td>
<?php if($task_info['task_status']==0) { ?>未付款<?php } ?>
<?php if($task_info['task_status']==1) { ?>审核中<?php } ?>
<?php if($task_info['task_status']==2) { ?>招标中<?php } ?>
<?php if($task_info['task_status']==3) { ?>进行中<?php } ?>
<?php if($task_info['task_status']==6) { ?>冻结的<?php } ?>
<?php if($task_info['task_status']==7) { ?>结束的<?php } ?>
<?php if($task_info['task_status']==10) { ?>审核失败的<?php } ?>
</td>
      </tr>
      <tr>
        <td class="bg1 t_r">行业：</td>
        <td><select name="slt_indus_id">
        <option value="0">顶级</option>
<?php if(is_array($indus_option_arr)) { foreach($indus_option_arr as $v) { ?>
 <?=$v?>
<?php } } ?>
</select>　
</td>
      </tr>
      <tr>
        <td class="bg1 t_r" colspan="1">图片上传：</td>
        <td colspan="3">
        	<input type="file" name="fle_task_pic" size="50">
        	<?php if($task_info['task_pic']) { ?><br><img src="<?=$_K['siteurl']?>/<?=$task_info['task_pic']?>"><?php } ?>
</td>
      </tr>
  <tr>
        <td width="30%" class="bg1 t_r">是否置顶：</td>
        <td><input type="radio" name="rdo_istop" <?php if($task_info['istop']) { ?>checked="checked"<?php } ?> value="1" />是  <input type="radio" name="rdo_istop" <?php if(!$task_info['istop']) { ?>checked="checked"<?php } ?> value="0" />否</td>
      </tr>
<tr>
        <td width="30%" class="bg1 t_r">描述：</td>
        <td>
        	<div class="field" style="margin-left:-10px;*margin-left:0">
        	<textarea  rows="18" name="txt_task_desc" id="tar_content"  style="width:80%;"><?=$task_info['task_desc']?></textarea>
</div>
</td>
     </tr>

    <tr>
        <td width="30%" class="bg1 t_r">任务附件：</td>
        <td> 
        <?php if($file_list) { ?>
        	<?php if(is_array($file_list)) { foreach($file_list as $file) { ?>
    		<a target="_blank" href="../../<?=$file['file_save_name']?>"><?=$file['file_name']?></a>&nbsp;&nbsp;&nbsp;
    		<?php } } ?>
<?php } else { ?>
暂无附件
<?php } ?>
 </td>
      </tr>
   <tr>
        <td width="30%" class="bg1 t_r">发布者：</td>
        <td><b><?=$task_info['username']?></b></td>
      </tr>
 <tr>
        <td width="30%" class="bg1 t_r">发布时间：</td>
        <td><input type="text" onclick="showcalendar(event, this, 1)" name="txt_start_time" value="<?php echo date('Y-m-d H:i',$task_info[start_time]); ?>"  ></td>
      </tr>
   <tr>
        <td width="30%" class="bg1 t_r">到期时间：</td>
        <td><input type="text" onclick="showcalendar(event, this, 1)" name="txt_end_time" value="<?php echo date('Y-m-d H:i',$task_info[end_time]); ?>"  ></td>
      </tr>
  <tr>
        <td width="30%" class="bg1 t_r">任务金额：</td>
        <td>
        	<select name='slt_cash_coverage'>
        	<?php if(is_array($cash_rule_arr)) { foreach($cash_rule_arr as $value) { ?>
<option <?php if($task_info['task_cash_coverage']==$value['cash_rule_id']) { ?>selected="selected"<?php } ?> value="<?=$value['cash_rule_id']?>"><?=$value['cove_desc']?></option>
<?php } } ?>
</select>
        </td>
      </tr>
  
   <tr>
         <td align="left" colspan="2">
        <div style="padding-left:300px;">
<input type="submit" name="sbt_edit" class="input_but"  value="保存编辑"/>
<?php if($task_info['task_status']==1) { ?><input type="button" name="sbt_edit" class="input_but" onclick="window.location.href='index.php?do=model&model_id=<?=$model_id?>&view=task&op=setstatus1&task_id=<?=$task_id?>'"  value="通过审核"/><?php } ?>
<?php if($task_info['task_status']==1) { ?><input type="button" name="sbt_edit" class="input_but" onclick="window.location.href='index.php?do=model&model_id=<?=$model_id?>&view=task&op=setstatus5&task_id=<?=$task_id?>'"  value="拒绝审核"/><?php } ?>
<?php if($task_info['task_status']==6) { ?><input type="button" name="sbt_edit" class="input_but" onclick="window.location.href='index.php?do=model&model_id=<?=$model_id?>&view=task&op=restore&task_id=<?=$task_id?>'"  value="解冻任务"/><?php } ?>
<?php if($task_info['task_status']==2||$task_info['task_status']==3) { ?><input type="button" name="sbt_edit" class="input_but" onclick="window.location.href='index.php?do=model&model_id=<?=$model_id?>&view=task&op=setstatus6&task_id=<?=$task_id?>'"  value="冻结任务"/><?php } ?>
<?php if($task_info['task_status']==0||$task_info['task_status']==7) { ?><input type="button" name="sbt_edit" class="input_but" onclick="window.location.href='index.php?do=model&model_id=<?=$model_id?>&view=task&op=del&task_id=<?=$task_id?>'"  value="删除任务"/><?php } ?>
       		<input type="button" name="rst_edit" class="input_but"  value="返回列表" onclick="location.href='index.php?do=model&model_id=<?=$model_id?>&view=list&slt_indus_id=<?=$r_indus_id?>&status=<?=$r_status?>&txt_task_id=<?=$r_task_id?>&txt_leftday=<?=$r_leftday?>&txt_lefthour=<?=$r_lefthour?>';"/>
</div>
        </td>
      </tr>
    </table>
    </div>
</form>
<script type="text/javascript" src="<?=$_K['siteurl']?>/resource/js/script_calendar.js"></script>
<script type="text/javascript">
var editor = $("#tar_content").xheditor({tools:'simple',internalScript:false,internalStyle:false,upImgUrl:"../../index.php?do=ajax_upload&type=admin&task_id=1",upImgExt:"jpg,jpeg,gif,png"});
</script>
</body>
</html><?php Template_Class::ob_out();?>