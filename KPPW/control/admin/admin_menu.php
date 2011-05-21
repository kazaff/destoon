<?php


$grouplist_arr = Cache_ext_Class::getGroupList();

require_once $template_obj->template('control/admin/tpl/admin_'.$do);