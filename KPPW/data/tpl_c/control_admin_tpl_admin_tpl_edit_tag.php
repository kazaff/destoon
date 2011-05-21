<?php Template_Class::subtplcheck('control/admin/tpl/admin_tpl_edit_tag', '1303866364', 'control/admin/tpl/admin_tpl_edit_tag');?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>">
<title>标签编辑</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script src="tpl/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="tpl/js/css.js"></script>
<script type="text/javascript" src="tpl/js/form_and_validation.js"></script>
<script type="text/javascript" src="../../resource/js/xheditor/xheditor.js"></script>

<body>
<div id="append_parent"></div>
<style>
.gut dl{width: 100%;display: block;border-bottom: 1px solid #d6dccc;line-height: 25px;clear: both;margin: 0;padding: 0;}
.gut dt{width: 30%;text-align: right;float: left;background: #f4f5f2;border-right:1px solid #d6dccc;}
.gut dd{width: 68%;text-align: left;float: left;margin-left: 10px;}
#select1 .block {display:block;padding:0px;}
</style>


            <input type="hidden" name="do" value="<?=$do?>">
            <div class="main">
            <div class="w_80 m_c">
                <div id="select1">
                    <div class="tab_t">
                    	<?php $the_tag_s = 1; ?>
                    	<h3 <?php if($taginfo['tag_type']==1&&!$taginfo['task_type']||!$taginfo) { ?>class="sel"<?php } ?> id="tab_cont_<?php echo $the_tag_s; ?>" onclick="swaptab('cont','sel','',<?=$tag_type_size?>,<?php echo $the_tag_s++; ?>)">所有任务</h3>
                        <h4></h4>
                    	<?php if(is_array($model_list)) { foreach($model_list as $model) { ?>
                    	<h3 <?php if((!$the_tag_s&&!$taginfo['tag_type'])||($taginfo['tag_type']==1&&$taginfo['task_type']==$model['model_id'])) { ?>class="sel"<?php } ?> id="tab_cont_<?php echo $the_tag_s; ?>" onclick="swaptab('cont','sel','',<?=$tag_type_size?>,<?php echo $the_tag_s++; ?>)"><?=$model['model_name']?></h3>
                        <h4></h4>
                        <?php } } ?>
                    	<h3 <?php if($taginfo['tag_type']==3&&$taginfo['cat_type']==1) { ?>class="sel"<?php } ?> id="tab_cont_<?php echo $the_tag_s; ?>" onclick="swaptab('cont','sel','',<?=$tag_type_size?>,<?php echo $the_tag_s++; ?>)">任务分类</h3>
                        <h4></h4>
                        <h3 <?php if($taginfo['tag_type']==3&&$taginfo['cat_type']==2) { ?>class="sel"<?php } ?>  id="tab_cont_<?php echo $the_tag_s; ?>" onclick="swaptab('cont','sel','',<?=$tag_type_size?>,<?php echo $the_tag_s++; ?>)">文章分类</h3>
                        <h4></h4>
                        <h3 <?php if($taginfo['tag_type']==2) { ?>class="sel"<?php } ?> id="tab_cont_<?php echo $the_tag_s; ?>" onclick="swaptab('cont','sel','',<?=$tag_type_size?>,<?php echo $the_tag_s++; ?>)">文章</h3>
                        <h4></h4>
                        <h3 <?php if($taginfo['tag_type']==4) { ?>class="sel"<?php } ?> id="tab_cont_<?php echo $the_tag_s; ?>" onclick="swaptab('cont','sel','',<?=$tag_type_size?>,<?php echo $the_tag_s++; ?>)">自定义sql</h3>
                        <h4></h4>
                        <h3 <?php if($taginfo['tag_type']==5) { ?>class="sel"<?php } ?> id="tab_cont_<?php echo $the_tag_s; ?>" onclick="swaptab('cont','sel','',<?=$tag_type_size?>,<?php echo $the_tag_s++; ?>)">自定义代码</h3>
                        <h4></h4>
                    </div>
                    <div class="gut">

<?php $the_tag_s = 1; ?>
<div class="<?php if($taginfo['tag_type']==1&&!$taginfo['task_type']||!$taginfo) { ?>block<?php } else { ?>none<?php } ?>" id="div_cont_<?php echo $the_tag_s++; ?>">             	
<form method="post" action="index.php?do=tpl&view=edit_tag&rdo_tag_type=1&tagid=<?=$tagid?>">
<dl><dt>标签模式：</dt><dd>
通用任务标签
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
<dl><dt>发布者：</dt><dd>
<input type="text" name="txt_username" value="<?=$taginfo['username']?>">
</dd></dl>
<dl><dt>任务编号：</dt><dd>
<input type="text" name="txt_task_ids" value="<?=$taginfo['task_ids']?>"> 用,分隔(此条件会导致其它查询条件失效)
</dd></dl>
<dl><dt>排序方式：</dt><dd>
<select name="slt_task_order">
<option <?php if(!$taginfo['listorder']) { ?>selected="selected"<?php } ?> value="0">默认</option>
<option <?php if($taginfo['listorder']==1) { ?>selected="selected"<?php } ?> value="1">编号倒序</option>
<option <?php if($taginfo['listorder']==2) { ?>selected="selected"<?php } ?> value="2">编号正序</option>
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
</form>
<div style="clear: both;"></div>
</div>

                    	<?php if(is_array($model_list)) { foreach($model_list as $model) { ?>
                    	<div class="<?php if((!$the_tag_s&&!$taginfo['tag_type'])||($taginfo['tag_type']==1&&$taginfo['task_type']==$model['model_id'])) { ?>block<?php } else { ?>none<?php } ?>" id="div_cont_<?php echo $the_tag_s++; ?>">
<?php require_once $template_obj->template ('task/'.$model['model_dir'].'/control/admin/tpl/admin_edittag'); ?>
                        </div>
                    	<?php } } ?>
                    	
                    	<div class="<?php if($taginfo['tag_type']==3&&$taginfo['cat_type']==1) { ?>block<?php } else { ?>none<?php } ?>" id="div_cont_<?php echo $the_tag_s++; ?>">
                    	<form method="post" action="index.php?do=tpl&view=edit_tag&rdo_tag_type=3&rdo_cat_type=1&tagid=<?=$tagid?>">
                    	<dl><dt>标签模式：</dt><dd>
任务分类标签
                    	</dd></dl>
                    	<dl><dt>标签名：</dt><dd>
<input type="text" name="txt_tagname" value="<?=$taginfo['tagname']?>">用,分隔(此项设置会导致下拉列表失效)
</dd></dl>
                    	<dl><dt>调用分类：</dt><dd>
                    	<select name="slt_task_indus_id">
        				<option value="0">请选择</option>
        				<?php echo indusfenglei_select(0,0,$taginfo[task_indus_id]); ?>
        				</select> 多个分类请在下一行输入编号
                    	</dd></dl>
                    	<dl><dt>多个分类：</dt><dd><input type="text" name="txt_cat_cat_ids" value="<?=$taginfo['cat_cat_ids']?>">用,分隔(此项设置会导致下拉列表失效)
                    	</dd></dl>
<dl><dt>读取设置：</dt><dd>
<input type="checkbox" name="cat_loadsub" <?php if($taginfo['cat_loadsub']) { ?>checked="checked"<?php } ?> value="1">读取子分类
<input type="checkbox" <?php if($taginfo['cat_onlyrecommend']) { ?>checked="checked"<?php } ?> name="cat_onlyrecommend" value="1">只读推荐分类
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
                    	</form>
                    	</div>
                    	
                    	<div class="<?php if($taginfo['tag_type']==3&&$taginfo['cat_type']==2) { ?>block<?php } else { ?>none<?php } ?>" id="div_cont_<?php echo $the_tag_s++; ?>">
<form method="post" action="index.php?do=tpl&view=edit_tag&rdo_tag_type=3&rdo_cat_type=2&tagid=<?=$tagid?>">
                    	<dl><dt>标签模式：</dt><dd>
文章分类标签
                    	</dd></dl>
                    	<dl><dt>标签名：</dt><dd>
<input type="text" name="txt_tagname" value="<?=$taginfo['tagname']?>">用,分隔(此项设置会导致下拉列表失效)
</dd></dl>
                    	<dl><dt>调用分类：</dt><dd>
                    	<select name="slt_art_cat_id">
        		<option value="0">请选择</option>
        		<?php echo articlefenglei_select(0,0,$taginfo[art_cat_id]); ?>
        		</select>多个分类请在这里输入编号
                    	</dd></dl>
                    	<dl><dt>多个分类：</dt><dd><input type="text" name="txt_cat_cat_ids" value="<?=$taginfo['cat_cat_ids']?>">用,分隔(此项设置会导致下拉列表失效)
                    	</dd></dl>
<dl><dt>读取设置：</dt><dd>
<input type="checkbox" name="cat_loadsub" <?php if($taginfo['cat_loadsub']) { ?>checked="checked"<?php } ?> value="1">读取子分类
<input type="checkbox" <?php if($taginfo['cat_onlyrecommend']) { ?>checked="checked"<?php } ?> name="cat_onlyrecommend" value="1">只读推荐分类
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
                    	</form>
                        </div>
                        
                        
                        <div class="<?php if($taginfo['tag_type']==2) { ?>block<?php } else { ?>none<?php } ?>" id="div_cont_<?php echo $the_tag_s++; ?>">
<form method="post" action="index.php?do=tpl&view=edit_tag&rdo_tag_type=2&tagid=<?=$tagid?>">
                    	<dl><dt>标签模式：</dt><dd>
文章标签
                    	</dd></dl>
                    	<dl><dt>标签名：</dt><dd>
<input type="text" name="txt_tagname" value="<?=$taginfo['tagname']?>">用,分隔(此项设置会导致下拉列表失效)
</dd></dl>
<dl><dt>调用分类：</dt><dd>
                    	<select name="slt_art_cat_id">
        		<option value="0">请选择</option>
        		<?php echo articlefenglei_select(0,0,$taginfo[art_cat_id]); ?>
        		</select>多个分类请在这里输入编号
                    	</dd></dl>
                    	<dl><dt>多个分类：</dt><dd><input type="text" name="txt_cat_cat_ids" value="<?=$taginfo['cat_cat_ids']?>">用,分隔(此项设置会导致下拉列表失效)
                    	</dd></dl>
<dl><dt>发布时间：</dt><dd>
<input type="text" onclick="showcalendar(event, this, 1)" name="txt_art_time1" value="<?php if($taginfo['art_time1']) { ?><?php echo date('Y-m-d H:i',$taginfo[art_time1]); ?><?php } ?>">之后
<input type="text" onclick="showcalendar(event, this, 1)" name="txt_art_time2" value="<?php if($taginfo['art_time2']) { ?><?php echo date('Y-m-d H:i',$taginfo[art_time2]); ?><?php } ?>">之前
                    	</dd></dl>
                    	<dl><dt>文章编号：</dt><dd>
<input type="text" name="txt_art_ids" value="<?=$taginfo['art_ids']?>"> 用,分隔(此条件会导致其它查询条件失效)
                    	</dd></dl>
                    	<dl><dt>文章属性：</dt><dd>
<input type="checkbox" <?php if($taginfo['art_iscommend']) { ?>checked="checked"<?php } ?> name="ckb_art_iscommend" value="1"> 是否推荐
<input type="checkbox" <?php if($taginfo['art_hasimg']) { ?>checked="checked"<?php } ?> name="ckb_art_hasimg" value="1"> 是否有图
                    	</dd></dl>
                    	<dl><dt>排序方式：</dt><dd>
<select name="slt_art_order">
        		<option <?php if(!$taginfo['listorder']) { ?>selected="selected"<?php } ?> value="0">默认</option>
        		<option <?php if($taginfo['listorder']==1) { ?>selected="selected"<?php } ?> value="1">编号倒序</option>
<option <?php if($taginfo['listorder']==2) { ?>selected="selected"<?php } ?> value="2">编号正序</option>
<option <?php if($taginfo['listorder']==3) { ?>selected="selected"<?php } ?> value="3">发布时间倒序</option>
<option <?php if($taginfo['listorder']==4) { ?>selected="selected"<?php } ?> value="4">发布时间正序</option>
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
                    	</form>
                        </div>
                        
                        <div class="<?php if($taginfo['tag_type']==4) { ?>block<?php } else { ?>none<?php } ?>" id="div_cont_<?php echo $the_tag_s++; ?>">
<form method="post" action="index.php?do=tpl&view=edit_tag&rdo_tag_type=4&tagid=<?=$tagid?>">
                    	<dl><dt>标签模式：</dt><dd>
自定义sql
                    	</dd></dl>
                    	<dl><dt>标签名：</dt><dd>
<input type="text" name="txt_tagname" value="<?=$taginfo['tagname']?>">用,分隔(此项设置会导致下拉列表失效)
</dd></dl>
                    	<dl><dt style="height: 330px;">sql语句：</dt><dd>
                    	<div class="field" style="margin-left:-10px;*margin-left:0">
        	<textarea  rows="18" name="tar_custom_sql"  style="width:80%;height:300px;"><?=$taginfo['tag_sql']?></textarea>
</div>
                    	</dd></dl>
                    	<dl><dt>模板：</dt><dd>
control/admin/tpl/template_tag_<input type="text" name="txt_tplname" id="txt_tplname" value="<?=$taginfo['tplname']?>">.htm 
<input type="button" class="input_but" value="编辑模板" onclick="edittpl()" />
                    	</dd></dl>
                    	<dl><dt>缓存时间：</dt><dd>
<input type="text" size="3" name="txt_cache_time" value="<?=$taginfo['cache_time']?>">秒为单位,留空为不缓存
                    	</dd></dl>
      
                    	<dl><dt>&nbsp;</dt><dd><input type="submit" name="submit" value="保存配置" id="submit_save" class="input_but"></dd></dl>
                    	</form>

                        </div>
                        
                        <div class="<?php if($taginfo['tag_type']==5) { ?>block<?php } else { ?>none<?php } ?>" id="div_cont_<?php echo $the_tag_s++; ?>">
<form method="post" action="index.php?do=tpl&view=edit_tag&rdo_tag_type=5&tagid=<?=$tagid?>">
                    	<dl><dt>标签模式：</dt><dd>
自定义代码
                    	</dd></dl>
                    	<dl><dt>标签名：</dt><dd>
<input type="text" name="txt_tagname" value="<?=$taginfo['tagname']?>">用,分隔(此项设置会导致下拉列表失效)
</dd></dl>
                    	<dl><dt style="height: 330px;">html代码：</dt><dd>
                    	<div class="field" style="margin-left:-10px;*margin-left:0">
        	<textarea  rows="18" name="tar_custom_code" id="system-create-location" class="f-textarea editor" style="width:80%;height:300px;"><?=$taginfo['code']?></textarea>
</div>
                    	</dd></dl>
                    	<dl><dt>&nbsp;</dt><dd><input type="submit" name="submit" value="保存配置" id="submit_save" class="input_but"></dd></dl>
                    	</form>

                        </div>
                        
                    </div>
                    
                </div>
                <br>
                
            </div>
       </div>


<script src="../../resource/js/keke.js" type="text/javascript"></script>
<script type="text/javascript" src="../../resource/js/script_calendar.js"></script>
<script>
function edittpl()
{
var url = "index.php?do=tpl&view=edit_tagtpl&tplname="+$('#txt_tplname').val();
window.open(url);
}


</script>


</body>
</html><?php Template_Class::ob_out();?>