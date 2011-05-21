<?php defined('IN_DESTOON') or exit('Access Denied');?><?php if(in_array($moduleid, explode(',', get_module_setting(3, 'comment_module')))) { ?>
<div id="comment_div" style="display:;">
	<div class="left_head"><span class="f_r"><a href="<?php echo extendurl('comment');?><?php echo rewrite('index.php?mid='.$moduleid.'&itemid='.$itemid);?>">共<span id="comment_count">0</span>条 [查看全部]</a>&nbsp;&nbsp;</span>相关评论</div>
	<div class="c_b">
	<script type="text/javascript">show_comment('<?php echo $MODULE['3']['linkurl'];?>', <?php echo $moduleid;?>, <?php echo $itemid;?>);</script>
	</div>
</div>
<?php } ?>