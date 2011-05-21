<?php

 

class Cache_Class {
	var $ci;
	var $path;
	var $contents;
	var $filename;
	var $expires;
	var $created;
	var $dependencies;
	var $mp_cache_dir = "data/data_cache/";
	var $cache_expiration = 0;
 
	function __construct() {
		$this->reset ();
 
		

		$this->path = S_ROOT.'./'.$this->mp_cache_dir;  
		$default_expires = $this->cache_expiration;  
		if ($default_expires !== FALSE && $default_expires > 0)
			$this->default_expires = time () + $default_expires;
		else
			$this->default_expires = NULL;
		if ($this->path == '')
			return FALSE;
	}
	
 
	function reset() {
		$this->contents = NULL;
		$this->name = NULL;
		$this->expires = NULL;
		$this->created = NULL;
		$this->dependencies = array ();
	}
	
 
	function set_name($name) {
		$this->reset ();
		$this->filename = $name;
		return $this;
	}
	function get_name() {
		return $this->filename;
	}
	
 
	function set_contents($contents) {
		$this->contents = $contents;
		return $this;
	}
	function get_contents() {
		return $this->contents;
	}
	
 
	function set_dependencies($dependencies) {
		if (is_array ( $dependencies ))
			$this->dependencies = $dependencies;
		else
			$this->dependencies = array ($dependencies );
			
		 
		return $this;
	}
	function add_dependencies($dependencies) {
		if (is_array ( $dependencies ))
			$this->dependencies = array_merge ( $this->dependencies, $dependencies );
		else
			$this->dependencies [] = $dependencies;
			
		 
		return $this;
	}
	function get_dependencies() {
		return $this->dependencies;
	}
	
	 
	function set_expires($expires) {
		$this->expires = time () + $expires;
		return $this;
	}
	function get_expires() {
		return $this->expires;
	}
	
	 
	function get_created($created) {
		return $this->created;
	}
	
 
	function get($filename = NULL, $use_expires = TRUE) {
		
		global  $_K;
		if ($_K['is_debug'])
		{
			return false;
		}
		
 
		if ($filename !== NULL) {
			$this->reset ();
			$this->filename = $filename;
		}
		
 
		if (! is_dir ( $this->path ) or ! is_writable ( $this->path )) {
			return FALSE;
		}
		
 
		$filepath = $this->path . $this->filename . '.cache';
		
		 
		if (! @file_exists ( $filepath )) {
			return FALSE;
		}
		
 
		if (! $fp = @fopen ( $filepath, "rb" )) {
			return FALSE;
		}
		
 
		flock ( $fp, LOCK_SH );
		
 
		if (filesize ( $filepath ) > 0) {
			$this->contents = unserialize ( fread ( $fp, filesize ( $filepath ) ) );
		} else {
			$this->contents = NULL;
		}
		
 
		flock ( $fp, LOCK_UN );
		fclose ( $fp );
		
 
		if ($use_expires && ! empty ( $this->contents ['__mp_cache_expires'] ) && $this->contents ['__mp_cache_expires'] < time ()) {
			$this->delete ( $filename );
			return FALSE;
		}
		
 
		foreach ( $this->contents ['__mp_cache_dependencies'] as $dep ) {
			$cache_created = filemtime ( $this->path . $this->filename . '.cache' );
			
		 
			if (! file_exists ( $this->path . $dep . '.cache' ) or filemtime ( $this->path . $dep . '.cache' ) > $cache_created) {
				$this->delete ( $filename );
				return FALSE;
			}
		}
		
	 
		$this->expires = (isset ( $this->contents ['__mp_cache_expires'] ) ? $this->contents ['__mp_cache_expires'] : NULL);
		$this->dependencies = (isset ( $this->contents ['__mp_cache_dependencies'] ) ? $this->contents ['__mp_cache_dependencies'] : NULL);
		$this->created = (isset ( $this->contents ['__mp_cache_created'] ) ? $this->contents ['__mp_cache_created'] : NULL);
		
		 
		$this->contents = $this->contents ['__mp_cache_contents'];
		
 
		return $this->contents;
	}
	
 
	function write($contents = NULL, $filename = NULL, $expires = NULL, $dependencies = array()) {
 
		
		if ($contents !== NULL) {
			$this->reset ();
			$this->contents = $contents;
			$this->filename = $filename;
			if ($expires !== NULL)
				$this->expires = time () + $expires;
			$this->dependencies = $dependencies;
		}
		
 
		$this->contents = array ('__mp_cache_contents' => $this->contents );
		
 
		if (! is_dir ( $this->path ) or ! is_writable ( $this->path )) {
			return "error";
		}
 
		$subdirs = explode ( '/', $this->filename );
 
		if (count ( $subdirs ) > 1) {
			array_pop ( $subdirs );
			$test_path = $this->path . implode ( '/', $subdirs );
			
 
			if (! @file_exists ( $test_path )) {
				// create non existing dirs, asumes PHP5
				if (! @mkdir ( $test_path, 0777, TRUE ))
					return "生成失败";
			}
		}
		
 
		$cache_path = $this->path . $this->filename . '.cache';
		if (! @file_exists ( $cache_path )) {
			
 
			@fopen ( $cache_path, "rb" );
 
		} else {
			chmod ( $cache_path, 0777 );
		}
		
 
		if (! $fp = @fopen ( $cache_path, "w+" )) {
 
			return "Unable to write MP_cache file1: " . $cache_path;
		}
		
 
		$this->contents ['__mp_cache_created'] = time ();
		$this->contents ['__mp_cache_dependencies'] = $this->dependencies;
		
 
		if (! empty ( $this->expires ) && $this->expires > time ()) {
			$this->contents ['__mp_cache_expires'] = $this->expires;
		}  
		elseif (! empty ( $this->default_expires ) && $this->expires !== 0) {
			$this->contents ['__mp_cache_expires'] = $this->default_expires;
		}
		
 
		if (flock ( $fp, LOCK_EX )) {
			$sccs = fwrite ( $fp, serialize ( $this->contents ) );
			flock ( $fp, LOCK_UN );
		} else {
 
			return "Unable to write MP_cache file2: " . $cache_path;
			;
		}
		fclose ( $fp );
		@chmod ( $cache_path, 0777 );
		
 
		$this->reset ();
	}
	
 
	 function delete($filename = NULL) {
		if ($filename !== NULL)
			$this->filename = $filename;
		
		$file_path = $this->path . $this->filename . '.cache';
		
		if (file_exists ( $file_path )){
			chmod($file_path,0777);
			unlink ( $file_path );
		}
			
			
			
 
		$this->reset ();
	}
 
	function delete_all($dirname = '') {
		if (empty ( $this->path ))
			return FALSE;
			
		
		if (file_exists ( $this->path . $dirname ))
		     $this->deldir($this->path.$dirname);
		
		$this->reset ();
	}
	function deldir($dir='') {
		$files = glob ( $dir . '*', GLOB_MARK );
		foreach ( $files as $file ) {
			if (substr ( $file, - 1 ) == '/'){
				chmod($file,0755);
				deldir ( $file );
			}else{
				chmod($file,0755);
				unlink ( $file );
			}
		}
		
 
	
	}
	


}

 
class Cache {
	public static function set($filename) {
		$cache = new Cache_Class ( );
		return $cache->set_name ( $filename );
	}
	
	public static function get($filename, $use_expires = TRUE) {
		$cache = new Cache_Class ( );
		return $cache->get ( $filename, $use_expires );
	}
	
	public static function write($contents, $filename, $expires = NULL, $dependencies = array()) {
		$cache = new Cache_Class ( );
		return $cache->write ( $contents, $filename, $expires, $dependencies );
	}
	
	public static function delete($filename) {
		$cache = new Cache_Class ( );
		return $cache->delete ( $filename );
	}
	
	public static function delete_all($dirname = '') {
		$cache = new Cache_Class ( );
		return $cache->delete_all ( $dirname );
	}
}