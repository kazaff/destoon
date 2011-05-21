<?php
	
	
	$_SESSION ['uid'] = "";
	$_SESSION ['username'] = "";
	$_SESSION['auid']="";
	$_SESSION['user_info']="";
	if (isset ( $_COOKIE ['user_login'] )) {
		setcookie ( 'user_login', '' );
	}
	
	if (isset ( $_COOKIE ['prom_cke'] )) {
		setcookie ( 'prom_cke', '' );
	}
	?>
<script> parent.location.href="index.php?do=login" </script>
