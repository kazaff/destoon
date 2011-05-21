<?php defined('IN_DESTOON') or exit('Access Denied');?><input name="password" type="password" class="inp" style="width:140px;" id="password"<?php if(isset($password)) { ?> value="<?php echo $password;?>"<?php } ?>/>&nbsp;
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/keyboard.js"></script>
<img src="<?php echo DT_SKIN;?>image/keyboard.gif" title="密码键盘" alt="" class="c_p" onclick="_k('password', 'kb', this);"/>
<div id="kb" style="display:none;"></div>
<?php if($DT['md5_pass'] && ($action != 'login' || ($action == 'login' && !$MOD['passport']))) { ?>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/md5.js"></script>
<script type="text/javascript">init_md5();</script>
<?php } ?>