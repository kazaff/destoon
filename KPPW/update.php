<?php

require 'app_comm.php';

$res = 0;

$res += db_factory::execute("update ".TABLEPRE."witkey_industry set indus_type=1 where indus_type = 2");



die ("success£¬total $res data rows changeed¡£");


