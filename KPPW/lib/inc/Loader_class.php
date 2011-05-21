<?php

class Loader_class {
	static function __autoload($class_name) {
		$file1 = S_ROOT . './model/' . $class_name . '.php';
		$file2 = S_ROOT . './lib/inc/' . $class_name . '.php';
		$file3 = S_ROOT . './lib/helper/' . $class_name . '.php';
		$file4 = S_ROOT . './lib/sys/' . $class_name . '.php';
		if (file_exists ( $file1 )) {
			require_once ($file1);
		}
		if (file_exists ( $file2 )) {
			require_once ($file2);
		}
		if (file_exists ( $file3 )) {
			require_once ($file3);
		}
		if (file_exists ( $file4 )) {
			require_once ($file4);
		}
		
		require_once S_ROOT . './base/db_factory/db_factory.php';
		
		$model_arr = Cache_ext_Class::gettabledata ( "witkey_model", ' model_status=1', '', NULL );
		foreach ( $model_arr as $value ) {
			$dir = $value ['model_code'];
			$f1 = S_ROOT . './task/' . $dir . '/lib/' . $class_name . '.php';
			$f2 = S_ROOT . './task/' . $dir . '/model/' . $class_name . '.php';
			if (file_exists ( $f1 )) {
				require_once ($f1);
			}
			if (file_exists ( $f2 )) {
				require_once ($f2);
			}
		}
	}
}

?>