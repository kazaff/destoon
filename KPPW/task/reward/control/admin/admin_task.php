<?php


if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}

$views = array('list','config','edit','task','op');

$view = in_array($view,$views)?$view:"list";



require "model_$view.php";
