<?php
 

$_K['i'] = 0;
$_K['gzipcompress'] = 0;
$_K['inajax'] = $inajax?$inajax:0;
$_K['block_search'] = $_K['block_replace'] = array(); 

class Template_Class{

static function parse_template($tpl) {
	global $_K;

 
	$sub_tpls = array($tpl);

	$tplfile = S_ROOT.'./'.$tpl.'.htm';
	$objfile = S_ROOT.'./data/tpl_c/'.str_replace('/','_',$tpl).'.php';
 
	if(!file_exists($tplfile)) {
		$tpl = str_replace('/'.$_K['template'].'/', '/default/', $tpl);
		$tplfile = S_ROOT.'./'.$tpl.'.htm';
	 
	}
	$template = Template_Class::sreadfile($tplfile);
	if(empty($template)) {
		exit("Template file : $tplfile Not found or have no access!");
	}

	 
	$template = preg_replace("/\<\!\-\-\{template\s+([a-z0-9_\/]+)\}\-\-\>/ie", "Template_Class::readtemplate('\\1')", $template);
 
	$template = preg_replace("/\<\!\-\-\{template\s+([a-z0-9_\/]+)\}\-\-\>/ie", "Template_Class::readtemplate('\\1')", $template);
 
	$template = preg_replace("/\<\!\-\-\{tag\s+([^!@#$%^&*(){}<>?,.\'\"\+\-\;\":~`]+)\}\-\-\>/ie", "Template_Class::readtag('\\1')", $template);
 
	$template = preg_replace("/\<\!\-\-\{showad\((.+?)\)\}\-\-\>/ie", "Template_Class::showad('\\1')", $template);
 
	$template = preg_replace("/\<\!\-\-\{showads\((.+?),(.+?)\)\}\-\-\>/ie", "Template_Class::showads('\\1','\\2')", $template);
	
 
	$template = preg_replace("/\<\!\-\-\{loadfeed\((.+?)\)\}\-\-\>/ie", "Template_Class::loadfeed('\\1')", $template);
 
 
 
	$template = preg_replace("/\<\!\-\-\{date\((.+?)\)\}\-\-\>/ie", "Template_Class::datetags('\\1')", $template);
 
	$template = preg_replace("/\<\!\-\-\{userpic\((.+?),(.+?)\)\}\-\-\>/ie", "Template_Class::userpic('\\1','\\2')", $template);
 
	$template = preg_replace("/\<\!\-\-\{eval\s+(.+?)\s*\}\-\-\>/ies", "Template_Class::evaltags('\\1')", $template);

 
 
	$var_regexp = "((\\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)(\[[a-zA-Z0-9_\-\.\"\'\[\]\$\x7f-\xff]+\])*)";
	$template = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $template);
	$template = preg_replace("/([\n\r]+)\t+/s", "\\1", $template);
	$template = preg_replace("/(\\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\.([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/s", "\\1['\\2']", $template);
	$template = preg_replace("/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s", "<?=\\1?>", $template);
	$template = preg_replace("/$var_regexp/es", "Template_Class::addquote('<?=\\1?>')", $template);
	$template = preg_replace("/\<\?\=\<\?\=$var_regexp\?\>\?\>/es", "Template_Class::addquote('<?=\\1?>')", $template);
 
	$template = preg_replace("/\{elseif\s+(.+?)\}/ies", "Template_Class::stripvtags('<?php } elseif(\\1) { ?>','')", $template);
	$template = preg_replace("/\{else\}/is", "<?php } else { ?>", $template);
 
	for($i = 0; $i < 6; $i++) {
		$template = preg_replace("/\{loop\s+(\S+)\s+(\S+)\}(.+?)\{\/loop\}/ies", "Template_Class::stripvtags('<?php if(is_array(\\1)) { foreach(\\1 as \\2) { ?>','\\3<?php } } ?>')", $template);
		$template = preg_replace("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}(.+?)\{\/loop\}/ies", "Template_Class::stripvtags('<?php if(is_array(\\1)) { foreach(\\1 as \\2 => \\3) { ?>','\\4<?php } } ?>')", $template);
		$template = preg_replace("/\{if\s+(.+?)\}(.+?)\{\/if\}/ies", "Template_Class::stripvtags('<?php if(\\1) { ?>','\\2<?php } ?>')", $template);
	}
 
	$template = preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/s", "<?=\\1?>", $template);
	
 
	if(!empty($_K['block_search'])) {
		$template = str_replace($_K['block_search'], $_K['block_replace'], $template);
	}
	
	 
	$template = preg_replace("/ \?\>[\n\r]*\<\? /s", " ", $template);
	
	 
	$template = "<?php Template_Class::subtplcheck('".implode('|', $sub_tpls)."', '{$_K['timestamp']}', '$tpl');?>$template<?php Template_Class::ob_out();?>";
	
	$template = preg_replace("/\{lang\:(\w+)\}/ie", "lang('\\1')", $template);
 
	if(!Template_Class::swritefile($objfile, $template)) {
		exit("File: $objfile can not be write!");
	}
}

static function addquote($var) {
	return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var));
}

static function striptagquotes($expr) {
	$expr = preg_replace("/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr);
	$expr = str_replace("\\\"", "\"", preg_replace("/\[\'([a-zA-Z0-9_\-\.\x7f-\xff]+)\'\]/s", "[\\1]", $expr));
	return $expr;
}

static function evaltags($php) {
	global $_K;

	$_K['i']++;
	$search = "<!--EVAL_TAG_{$_K['i']}-->";
	$_K['block_search'][$_K['i']] = $search;
	$_K['block_replace'][$_K['i']] = "<?php ".Template_Class::stripvtags($php)." ?>";
	
	return $search;
}

function datetags($parameter) {
	global $_K;
	$_K['i']++;
	$search = "<!--DATE_TAG_{$_K['i']}-->";
	$_K['block_search'][$_K['i']] = $search;

	$_K['block_replace'][$_K['i']] = "<?php echo date($parameter); ?>";
	return $search;
}

 
function showad($adid)
{
	global $_K;
	
	$content = '<!--{eval Loaddata_Class::ad('.$adid.')}-->';
	return $content;
	
}

 
function showads($adname,$tpl)
{
	global $_K;
	$content = '<!--{eval Loaddata_Class::adgroup('.$adname.','.$tpl.')}-->';
	return $content;
}


 
function userpic($uid,$size) {
	global $_K;
	
	if(!in_array($size,array('big','middle','small')))
	{
		$size = 'small';
	}
	$hz = '.jpg';
	$r = '<img src="data/uploads/member/'.$size.'_'.'<!--{eval echo '.$uid.';}-->'.'.jpg" class="pic_'.$size.'" onerror="this.src=\'resource/img/avgdefault'.$size.'.jpg\'" />';
	
	return $r;
}

static function stripvtags($expr, $statement='') {
	$expr = str_replace("\\\"", "\"", preg_replace("/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr));
	$statement = str_replace("\\\"", "\"", $statement);
	return $expr.$statement;
}

static function readtemplate($name) {
	global $_K;
	
	$tpl = Template_Class::strexists($name,'/')?$name:"{$_K['tpl_path']}/{$_K['template']}/$name";
	$tplfile = S_ROOT.'./'.$tpl.'.htm';
	
	$sub_tpls[] = $tpl;
	
	if(!file_exists($tplfile)) {
		$tplfile = str_replace('/'.$_K['template'].'/', '/default/', $tplfile);
	}
	$content = trim(Template_Class::sreadfile($tplfile));
	return $content;
}

static function readtag($name)
{
	$tag_arr = Cache_ext_Class::gettaglist();
	$tag_info = $tag_arr[$name];
	if ($tag_info['tag_type']==5){
		$content = $tag_info['code'];
	}
	else{
		$content = '<!--{eval Loaddata_Class::readtag('.$name.')}-->';
	}
	
	return $content;
	
}

static function loadfeed($name) {
	$content = '<!--{eval Loaddata_Class::readfeed('.$name.')}-->';
	return $content;

}

 
static function sreadfile($filename) {
	$content = '';
	if(function_exists('file_get_contents')) {
		@$content = file_get_contents($filename);
	} else {
		if(@$fp = fopen($filename, 'r')) {
			@$content = fread($fp, filesize($filename));
			@fclose($fp);
		}
	}
	return $content;
}

 
static function swritefile($filename, $writetext, $openmod='w') {
	if(@$fp = fopen($filename, $openmod)) {
		flock($fp, 2);
		fwrite($fp, $writetext);
		fclose($fp);
		return true;
	} else {
	 
		return false;
	}
}
 
static function strexists($haystack, $needle) {
	return !(strpos($haystack, $needle) === FALSE);
}

static function template($name) {
	global $_K;
 
		 
		
		if(Template_Class::strexists($name,'/')) {
			$tpl = $name;
		} else {
		 
			$tpl = $_K['tpl_path']."/{$_K['template']}/$name";
		}
		$objfile = S_ROOT.'./data/tpl_c/'.str_replace('/','_',$tpl).'.php';
		if(!file_exists($objfile)||$_K['is_debug']) {
 
			Template_Class::parse_template($tpl);
		}
 
	return $objfile;
}
 
static function subtplcheck($subfiles, $mktime, $tpl) {
	global $_K;

	if($_K['tplrefresh'] && ($_K['tplrefresh'] == 1 || mt_rand(1, $_K['tplrefresh']) == 1)) {
		$subfiles = explode('|', $subfiles);
		foreach ($subfiles as $subfile) {
			$tplfile = S_ROOT.'./'.$subfile.'.htm';
			if(!file_exists($tplfile)) {
				$tplfile = str_replace('/'.$_K['template'].'/', '/default/', $tplfile);
			}
			@$submktime = filemtime($tplfile);
			if($submktime > $mktime) {
				Template_Class::parse_template($tpl);
				break;
			}
		}
	}
}

 
static function ob_out() {
	global $_K;

	$content = ob_get_contents();
	$preg_searchs = $preg_replaces = $str_searchs = $str_replaces = array();
     
    if($_K['is_rewrite']==1) {
		$preg_searchs[] = "/\<a href\=\"index\.php\?(.+?)\#(\w+)\"/ie";
		$preg_searchs[] = "/\<a href\=\"index\.php\"/i";
		$preg_searchs[] = "/\<a href\=\"shop\.php\"/i";
		$preg_searchs[] = "/\<a href\=\"http\:\/\/(.*)\/index\.php\?(.+?)\#(\w+)\"/ie";
		$preg_searchs[] = "/\<a href\=\"index\.php\?(.+?)\"/ie"; 
		$preg_searchs[] = "/\<a href\=\"shop\.php\?(.+?)\"/ie";
		
		$preg_replaces[] = 'Template_Class::rewrite_url(\'index-\',\'\\1\',\'\\2\')';
		$preg_replaces[] = '<a href="index.html"';
		$preg_replaces[] = '<a href="shop.html"';
		$preg_replaces[] = 'Template_Class::rewrite_url(\'http://\\1/index-\',\'\\2\',\'\\3\')';
		$preg_replaces[] = 'Template_Class::rewrite_url(\'index-\',\'\\1\')';
		$preg_replaces[] = 'Template_Class::rewrite_url(\'shop-\',\'\\1\')';
		
	}
	if($_K['linkguide']) {
		$preg_searchs[] = "/\<a href\=\"http\:\/\/(.+?)\"/ie";
		$preg_replaces[] = 'iframe_url(\'\\1\')';
	}

	if($_K['inajax']) {
		$preg_searchs[] = "/([\x01-\x09\x0b-\x0c\x0e-\x1f])+/";
		$preg_replaces[] = ' ';

		$str_searchs[] = ']]>';
		$str_replaces[] = ']]&gt;';
	}

	if($preg_searchs) {
		$content = preg_replace($preg_searchs, $preg_replaces, $content);
	}
	if($str_searchs) {
		$content = trim(str_replace($str_searchs, $str_replaces, $content));
	}

	Template_Class::obclean();
	if($_K['inajax']) {
		xml_out($content);
	} else{
		if($_K['charset']) {
			@header('Content-Type: text/html; charset='.$_K['charset']);
		}
		echo $content;
	}
}
static function obclean() {
	global $_K;

	ob_end_clean();
	if (GZIP && function_exists('ob_gzhandler')) {
		ob_start('ob_gzhandler');
	} else {
		ob_start();
	}
}  
static function rewrite_url($pre, $para,$hot='') {
	$para = str_replace(array('&','='), array('-', '-'), $para);
	$hot = $hot?"#".$hot:'';
	return '<a href="'.$pre.$para.'.html'.$hot.'"';
}
static function xml_out($content) {
	global $_K;
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
	@header("Pragma: no-cache");
	@header("Content-type: application/xml; charset=$_K[charset]");
	echo '<'."?xml version=\"1.0\" encoding=\"$_K[charset]\"?>\n";
	echo"<root><![CDATA[".trim($content)."]]></root>";
	exit();
}

}
?>