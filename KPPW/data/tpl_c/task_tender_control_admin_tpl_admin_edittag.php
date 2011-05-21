<?php Template_Class::subtplcheck('task/tender/control/admin/tpl/admin_edittag', '1303866364', 'task/tender/control/admin/tpl/admin_edittag');?><form method="post" action="index.php?do=tpl&view=edit_tag&rdo_tag_type=1&rdo_task_type=<?=$model['model_id']?>&tagid=<?=$tagid?>">
<dl><dt>标签模式：</dt><dd>
<?=$model['model_name']?>标签
</dd></dl>
<dl><dt>任务状态：</dt><dd>
<select name="slt_task_status">
    <option <?php if(!$taginfo['task_status']) { ?>selected="selected"<?php } ?> value="0">全部</option>
    <option <?php if($taginfo['task_status']==2) { ?>selected="selected"<?php } ?> value="2">进行中的任务</option>
<option <?php if($taginfo['task_status']==3) { ?>selected="selected"<?php } ?> value="3">公示中的任务</option>
<option <?php if($taginfo['task_status']==4) { ?>selected="selected"<?php } ?> value="4">投票中的任务</option>
<option <?php if($taginfo['task_status']==7) { ?>selected="selected"<?php } ?> value="7">结束的任务</option>
</select>
</dd></dl>
<dl><dt>标签名：</dt><dd>
<input type="text" name="txt_tagname" value="<?=$taginfo['tagname']?>">用,分隔(此项设置会导致下拉列表失效)
</dd></dl>
<dl><dt>行业;</dt><dd>
<select name="slt_task_indus_id">
    <option value="0">请选择</option>
    <?php echo indusfenglei_select(0,0,$taginfo[task_indus_id]); ?>
</select>
</dd></dl>
<dl><dt>多个行业</dt><dd>
<input type="text" name="txt_task_indus_ids" value="<?=$taginfo['task_indus_ids']?>">用,分隔(此项设置会导致下拉列表失效)
</dd></dl>
<dl><dt>发布时间：</dt><dd>
<input type="text" onclick="showcalendar(event, this, 1)" name="txt_start_time1" value="<?php if($taginfo['start_time1']) { ?><?php echo date('Y-m-d H:i',$taginfo[start_time1]); ?><?php } ?>">之后
<input type="text" onclick="showcalendar(event, this, 1)" name="txt_start_time2" value="<?php if($taginfo['start_time2']) { ?><?php echo date('Y-m-d H:i',$taginfo[start_time2]); ?><?php } ?>">之前
</dd></dl>
<dl><dt>到期时间：</dt><dd>
<input type="text" onclick="showcalendar(event, this, 1)" name="txt_end_time1" value="<?php if($taginfo['end_time1']) { ?><?php echo date('Y-m-d H:i',$taginfo[end_time1]); ?><?php } ?>">之后
<input type="text" onclick="showcalendar(event, this, 1)" name="txt_end_time2" value="<?php if($taginfo['end_time2']) { ?><?php echo date('Y-m-d H:i',$taginfo[end_time2]); ?><?php } ?>">之前
</dd></dl>
<dl><dt>剩余时间：</dt><dd>
<input type="text" size="3" name="txt_left_day" value="<?=$taginfo['left_day']?>">天
<input type="text" size="3" name="txt_left_hour" value="<?=$taginfo['left_hour']?>">小时  之内 
</dd></dl>
<dl><dt>任务金额：</dt><dd>
<input type="text" size="3" name="txt_task_cash1" value="<?=$taginfo['task_cash1']?>">元 以上
<input type="text" size="3" name="txt_task_cash2" value="<?=$taginfo['task_cash2']?>">元 以下
</dd></dl>
<dl><dt>发布者：</dt><dd>
<input type="text" name="txt_username" value="<?=$taginfo['username']?>">
</dd></dl>
<dl><dt>任务编号：</dt><dd>
<input type="text" name="txt_task_ids" value="<?=$taginfo['task_ids']?>"> 用,分隔(此条件会导致其它查询条件失效)
</dd></dl>
<dl><dt>置顶规则：</dt><dd>
<input type="radio" <?php if($taginfo['open_is_top']==1) { ?>checked=checked<?php } ?> name="rdo_open_is_top" value="1">有效 
<input type="radio" <?php if(!$taginfo['open_is_top']) { ?>checked=checked<?php } ?> name="rdo_open_is_top" value="0">无效 
</dd></dl>
<dl><dt>排序方式：</dt><dd>
<select name="slt_task_order">
<option <?php if(!$taginfo['listorder']) { ?>selected="selected"<?php } ?> value="0">默认</option>
<option <?php if($taginfo['listorder']==1) { ?>selected="selected"<?php } ?> value="1">编号倒序</option>
<option <?php if($taginfo['listorder']==2) { ?>selected="selected"<?php } ?> value="2">编号正序</option>
<option <?php if($taginfo['listorder']==3) { ?>selected="selected"<?php } ?> value="3">金额倒序</option>
<option <?php if($taginfo['listorder']==4) { ?>selected="selected"<?php } ?> value="4">金额正序</option>
<option <?php if($taginfo['listorder']==5) { ?>selected="selected"<?php } ?> value="5">推广金额倒序</option>
<option <?php if($taginfo['listorder']==6) { ?>selected="selected"<?php } ?> value="6">推广金额正序</option>
<option <?php if($taginfo['listorder']==7) { ?>selected="selected"<?php } ?> value="7">发布时间倒序</option>
<option <?php if($taginfo['listorder']==8) { ?>selected="selected"<?php } ?> value="8">发布时间正序</option>
<option <?php if($taginfo['listorder']==9) { ?>selected="selected"<?php } ?> value="9">结束时间倒序</option>
<option <?php if($taginfo['listorder']==10) { ?>selected="selected"<?php } ?> value="10">结束时间正序</option>
</select>
</dd></dl>
<dl><dt>读取条数：</dt><dd>
<input type="text" size="3" name="txt_loadcount" value="<?=$taginfo['loadcount']?>">
</dd></dl>
<dl><dt>模板：</dt><dd>
control/admin/tpl/template_tag_<input type="text" name="txt_tplname" id="txt_tplname" value="<?=$taginfo['tplname']?>">.htm 
<input type="button" class="input_but" value="编辑模板" onclick="edittpl()" />
</dd></dl>
<dl><dt>缓存时间：</dt><dd>
<input type="text" size="3" name="txt_cache_time" value="<?=$taginfo['cache_time']?>">秒为单位,留空为不缓存
</dd></dl>
<dl><dt>&nbsp;</dt><dd><input type="submit" name="submit" value="保存配置" id="submit_save" class="input_but"></dd></dl>
</form><?php Template_Class::ob_out();?>