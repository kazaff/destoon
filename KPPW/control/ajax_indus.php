<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$indus_c_arr = Cache_ext_Class::gettabledata ( 'witkey_industry', "indus_pid= $indus_pid", '', NULL );

foreach ( $indus_c_arr as $row ) {
	$option .= '<option value=' . $row [indus_id] . '>' . $row [indus_name] . '</option>';
}
echo $option;
die ();