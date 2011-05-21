<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
class upload {
    var $file;
    var $file_name;
    var $file_size;
    var $file_type;
	var $file_error;
    var $savename;
    var $savepath;
	var $saveto;
    var $fileformat = '';
    var $overwrite = false;
    var $maxsize;
    var $ext;
    var $errmsg = errmsg;
	var $userid;
	var $image;
	var $uptime = 0;
	var $adduserid = true;

    function upload($_file, $savepath, $savename = '', $fileformat = '') {
		global $DT, $_userid;
		foreach($_file as $file) {
			$this->file = $file['tmp_name'];
			$this->file_name = $file['name'];
			$this->file_size = $file['size'];
			$this->file_type = $file['type'];
			$this->file_error = $file['error'];
		}
		$this->userid = $_userid;
		$this->ext = file_ext($this->file_name);
		$this->fileformat = $fileformat ? $fileformat : $DT['uploadtype'];
		$this->maxsize = $DT['uploadsize'] ? $DT['uploadsize']*1024 : 2048*1024;
		$this->savepath = $savepath;
		$this->savename = $savename;
    }

	function uploadfile() {
		include load('include.lang');
        if($this->file_error == UPLOAD_ERR_PARTIAL || $this->file_error == UPLOAD_ERR_NO_FILE || $this->file_error == UPLOAD_ERR_INI_SIZE || $this->file_error == UPLOAD_ERR_FORM_SIZE) return $this->_($L['upload_failed'].' ('.$this->file_error.')');
		if($this->maxsize > 0 && $this->file_size > $this->maxsize) return $this->_($L['upload_size_limit'].' ('.intval($this->maxsize/1024).'Kb)');
        if(!$this->is_allow()) return $this->_($L['upload_not_allow']);
        $this->set_savepath($this->savepath);
        $this->set_savename($this->savename);
        if(!is_writable(DT_ROOT.'/'.$this->savepath)) return $this->_($L['upload_unwritable']);
		if(!copy($this->file, DT_ROOT.'/'.$this->saveto) && !move_uploaded_file($this->file, DT_ROOT.'/'.$this->saveto)) return $this->_($L['upload_failed']);
		$this->image = $this->is_image();
		if(DT_CHMOD) @chmod(DT_ROOT.'/'.$this->saveto, DT_CHMOD);
        return true;
	}

    function is_allow() {
		if(!$this->fileformat) return false;
		if(!preg_match("/^(".$this->fileformat.")$/i", $this->ext)) return false;
		if(preg_match("/^(php|phtml|php3|php4|jsp|exe|dll|cer|shtml|shtm|asp|asa|aspx|asax|cgi|fcgi|pl)$/i", $this->ext)) return false;
		return true;
    }

    function is_image() {
        return preg_match("/^(jpg|jpeg|gif|png|bmp)$/i", $this->ext);
    }

    function set_savepath($savepath) {
		$savepath = str_replace("\\", "/", $savepath);
	    $savepath = substr($savepath, -1) == "/" ? $savepath : $savepath."/";
        $this->savepath = $savepath;
    }

    function set_savename($savename) {
		global $DT_TIME;
        if($savename) {
            $this->savename = $this->adduserid ? str_replace('.'.$this->ext, $this->userid.'.'.$this->ext, $savename) : $savename;
        } else {
			$this->uptime = $DT_TIME;
            $name = date('H-i-s', $this->uptime).'-'.rand(10, 99);
            $this->savename = $this->adduserid ? $name.'-'.$this->userid.'.'.$this->ext : $name.'.'.$this->ext;
        }
		$this->saveto = $this->savepath.$this->savename;		
        if(!$this->overwrite && is_file(DT_ROOT.'/'.$this->saveto)) {
			$i = 1;
			while($i) {
				$saveto = str_replace('.'.$this->ext, '('.$i.').'.$this->ext, $this->saveto);
				if(is_file(DT_ROOT.'/'.$saveto)) {
					$i++;
					continue; 
				} else {
					$this->saveto = $saveto; 
					break;
				}
			}
        }
    }
	
	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>