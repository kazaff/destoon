<?php
if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
$type = $type?$type:"front";

require "admin_user_{$type}.php";


