<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

require_once $template_obj->template('control/admin/tpl/admin_'.$do);