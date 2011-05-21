<?php Template_Class::subtplcheck('task/reward/control/admin/tpl/model_list', '1303811210', 'task/reward/control/admin/tpl/model_list');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>main</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script src="tpl/js/jquery.js" type="text/javascript"></script>
<script src="tpl/js/common.js" type="text/javascript"></script>

<body>

<form method="get" action="index.php" id="frm_art_search">
<input type="hidden" name="do" value="model">
<input type="hidden" name="model_id" value="<?=$model_id?>">
<input type="hidden" name="view" value="<?=$view?>">
<div class="main">
<div class="v_search">
      　行业：<select name="slt_indus_id">
      	<option value="" selected="selected">所有</option>
<?php if(is_array($indus_option_arr)) { foreach($indus_option_arr as $v) { ?>
 <?=$v?>
<?php } } ?>
</select>　
任务状态：
<select name="status">
<option value="0" <?php if(!$status) { ?>selected="selected"<?php } ?>>所有</option>
<option value="n" <?php if($status==n) { ?>selected="selected"<?php } ?>>未付款</option>
<option value="1" <?php if($status==1) { ?>selected="selected"<?php } ?>>待审核</option>
<option value="2" <?php if($status==2) { ?>selected="selected"<?php } ?>>进行中</option>
<option value="3" <?php if($status==3) { ?>selected="selected"<?php } ?>>公示中</option>
<option value="4" <?php if($status==4) { ?>selected="selected"<?php } ?>>投票中</option>
<option value="5" <?php if($status==5) { ?>selected="selected"<?php } ?>>失败的</option>
<option value="6" <?php if($status==6) { ?>selected="selected"<?php } ?>>冻结的</option>
<option value="7" <?php if($status==7) { ?>selected="selected"<?php } ?>>结束的</option>
<option value="10" <?php if($status==10) { ?>selected="selected"<?php } ?>>审核失败的</option>
</select>

任务编号：
<input type="text" class="input_t" size="12" name="txt_task_id" value="<?=$txt_task_id?>" onkeyup="clearstr(this);">
剩余时间：
<input type="text" size="3" maxlength="3"  name='txt_leftday' value="<?=$txt_leftday?>">天
<input type="text" size="3" maxlength="3"  name='txt_lefthour' value="<?=$txt_lefthour?>">小时　
<input type="submit" name="sbt_search" value="查询" class="input_but"/>
    </div>
 	<div class="div_tit_a">
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=0" <?php if(!$status) { ?>style="color:red"<?php } ?>>所有的</a> | 
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=n" <?php if($status=='n') { ?>style="color:red"<?php } ?>>未付款</a> | 
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=1" <?php if($status=='1') { ?>style="color:red"<?php } ?>>待审核</a> | 
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=2" <?php if($status=='2') { ?>style="color:red"<?php } ?>>进行中</a> | 
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=3" <?php if($status=='3') { ?>style="color:red"<?php } ?>>公示中</a> | 
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=4" <?php if($status=='4') { ?>style="color:red"<?php } ?>>投票中</a> | 
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=5" <?php if($status=='5') { ?>style="color:red"<?php } ?>>失败的</a> | 
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=6" <?php if($status=='6') { ?>style="color:red"<?php } ?>>冻结的</a> | 
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=7" <?php if($status=='7') { ?>style="color:red"<?php } ?>>结束的</a> | 
 	<a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=10" <?php if($status=='10') { ?>style="color:red"<?php } ?>>审核失败</a></div>
  <div id="change">
  		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_list t_c">
          <tr>
            <th width="65" align="left">ID( <a href="index.php?do=task&view=rewardlist&status=<?=$status?>&txt_task_id=<?=$txt_task_id?>&slt_indus_id=<?=$slt_indus_id?>&txt_leftday=<?=$txt_leftday?>&txt_lefthour=<?=$txt_lefthour?>&order=1"><img src="tpl/img/m_up.gif" /></a> / <a href="index.php?do=task&view=rewardlist&status=<?=$status?>&txt_task_id=<?=$txt_task_id?>&slt_indus_id=<?=$slt_indus_id?>&txt_leftday=<?=$txt_leftday?>&txt_lefthour=<?=$txt_lefthour?>&order=2"><img src="tpl/img/m_down.gif" /></a> )</th>
            <th width="25%" class="motif">任务标题</th>
<th>任务状态</th>
<th>所属行业</th>
<th>发布者</th>
<th>发布时间( <a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=<?=$status?>&txt_task_id=<?=$txt_task_id?>&slt_indus_id=<?=$slt_indus_id?>&txt_leftday=<?=$txt_leftday?>&txt_lefthour=<?=$txt_lefthour?>&order=3"><img src="tpl/img/m_up.gif" /></a> / <a href="index.php?do=task&view=rewardlist&status=<?=$status?>&txt_task_id=<?=$txt_task_id?>&slt_indus_id=<?=$slt_indus_id?>&txt_leftday=<?=$txt_leftday?>&txt_lefthour=<?=$txt_lefthour?>&order=4"><img src="tpl/img/m_down.gif" /></a> )</th>
<th>过期时间( <a href="index.php?do=model&model_id=<?=$model_id?>&view=list&status=<?=$status?>&txt_task_id=<?=$txt_task_id?>&slt_indus_id=<?=$slt_indus_id?>&txt_leftday=<?=$txt_leftday?>&txt_lefthour=<?=$txt_lefthour?>&order=5"><img src="tpl/img/m_up.gif" /></a> / <a href="index.php?do=task&view=rewardlist&status=<?=$status?>&txt_task_id=<?=$txt_task_id?>&slt_indus_id=<?=$slt_indus_id?>&txt_leftday=<?=$txt_leftday?>&txt_lefthour=<?=$txt_lefthour?>&order=6"><img src="tpl/img/m_down.gif" /></a> )</th>
<?php if($status==1) { ?>
<th width="55">审核</th>
<?php } ?>
<th width="55">编辑</th>
<th width="55">删除</th>
          </tr>
  <?php if(is_array($task_arr)) { foreach($task_arr as $key => $value) { ?>
<tr>
<td align="left">
<input type="checkbox" name="ckb[]" id="cbk_selected" value="<?=$value['task_id']?>"> <?=$value['task_id']?>
</td>
<td align="left">
<a href="../../index.php?do=task&task_id=<?=$value['task_id']?>" target="_blank"><?php echo(Func_comm_class::cutstr($value[task_title],45)); ?></a>
</td>
<td>
<?php if(!$value['task_status']) { ?>未付款<?php } ?>
<?php if($value['task_status']==1) { ?>待审核<?php } ?>
<?php if($value['task_status']==2) { ?>进行中<?php } ?>
<?php if($value['task_status']==3) { ?>公示中<?php } ?>
<?php if($value['task_status']==4) { ?>投票中<?php } ?>
<?php if($value['task_status']==5) { ?>失败的<?php } ?>
<?php if($value['task_status']==6) { ?>冻结的<?php } ?>
<?php if($value['task_status']==7) { ?>结束的<?php } ?>
<?php if($value['task_status']==10) { ?>审核失败的<?php } ?>
</td>
<td>
<?=$indus_arr[$value['indus_id']]['indus_name']?>
</td>
<td>
<?=$value['username']?>
</td>
<td>
<?php echo date('y-m-d H:i',$value[start_time]); ?>
</td>
<td>
<?php echo date('y-m-d H:i',$value[end_time]); ?>
</td>
<?php if($status==1) { ?>
<td><a href="index.php?do=model&model_id=<?=$model_id?>&view=task&op=setstatus1&task_id=<?=$value['task_id']?>"><img src="tpl/img/ico/wand.png" align="absmiddle"/> 审核</a></td>
<?php } ?>
<?php if($status==7) { ?>
<td><a href="index.php?do=case&view=add&txt_task_id=<?=$value['task_id']?>"><img src="tpl/img/ico/wand.png" align="absmiddle"/> 设为案例</a></td>
<?php } ?>
<td>
<a href="index.php?do=model&model_id=<?=$model_id?>&view=edit&task_id=<?=$value['task_id']?>&r_indus_id=<?=$slt_indus_id?>&r_status=<?=$status?>&r_task_id=<?=$txt_task_id?>&r_leftday=<?=$txt_leftday?>&r_lefthour=<?=$txt_lefthour?>"><img src="tpl/img/ico/edit.png" align="absmiddle"/> 
编辑
</a>
</td>
<td>
<a href="index.php?do=model&model_id=<?=$model_id?>&view=task&op=del&task_id=<?=$value['task_id']?>&r_indus_id=<?=$slt_indus_id?>&r_status=<?=$status?>&r_task_id=<?=$txt_task_id?>&r_leftday=<?=$txt_leftday?>&r_lefthour=<?=$txt_lefthour?>" onclick="return confirm('确定要删除么?')"><img src="tpl/img/ico/delete.gif" align="absmiddle"/> 
删除
</a>
</td>
</tr>
<?php } } ?>
           <tr>
            <th colspan="4" align="left"><input type="checkbox" id="checkbox" onclick="checkall()"> 
全选　
<input type="submit" name="sbt_action" value="批量审批" class="input_but" />
<input type="submit" name="sbt_action" value="批量冻结" class="input_but" />
<input type="submit" name="sbt_action" value="批量恢复" class="input_but" />
<input type="submit" name="sbt_action" value="批量删除" class="input_but" />
</th>
<th colspan="5">
<div class="page">
<?=$pages['page']?>&nbsp;
</div>
</th>
          </tr>
        </table>
</div>
  <script src="tpl/js/css.js" type="text/javascript"></script>
    </div>
</form>
<script>
function showpl(){
$('#sbt_del').show();
$('#slt_action').show();
}
</script>
</body>
</html><?php Template_Class::ob_out();?>