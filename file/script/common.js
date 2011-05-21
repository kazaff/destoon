/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
var isIE = (document.all && window.ActiveXObject && !window.opera) ? true : false;
var isChrome = navigator.userAgent.indexOf('Chrome') != -1;
var DMURL = document.location.protocol+'//'+location.hostname+(location.port ? ':'+location.port : '')+'/';
var AJPath = (DTPath.indexOf('://') == -1 ? DTPath : (DTPath.indexOf(DMURL) == -1 ? DMURL : DTPath))+'ajax.php';
if(isIE) try {document.execCommand("BackgroundImageCache", false, true);} catch(e) {}
var xmlHttp;
var Try = {
	these: function() {
		var returnValue;
		for (var i = 0; i < arguments.length; i++) {var lambda = arguments[i]; try {returnValue = lambda(); break;} catch (e) {}}
		return returnValue;
	}
}
function makeRequest(queryString, php, func, method) {
	xmlHttp = Try.these(
		function() {return new XMLHttpRequest()},
		function() {return new ActiveXObject('Msxml2.XMLHTTP')},
		function() {return new ActiveXObject('Microsoft.XMLHTTP')}
	);	
	method = (typeof method == 'undefined') ? 'post' : 'get';
	if(func) xmlHttp.onreadystatechange = eval(func);
	xmlHttp.open(method, method == 'post' ? php : php+'?'+queryString, true);
	xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlHttp.send(method == 'post' ? queryString : null);
}
function $(ID) {return document.getElementById(ID);}
function Ds(i) {$(i).style.display = '';}
function Dh(i) {$(i).style.display = 'none';}
function Df(i) {$(i).focus();}
var tID=0;
function Tab(ID) {
	var tTab = $('Tab'+tID); var tTabs = $('Tabs'+tID); var Tab = $('Tab'+ID); var Tabs = $('Tabs'+ID);
	if(ID!=tID)	{tTab.className='tab'; Tab.className='tab_on'; tTabs.style.display='none'; Tabs.style.display=''; tID = ID; try{$('tab').value=ID;}catch(e){}}
}
function checkall(f, t) {
	var t = t ? t : 1;
	for(var i = 0; i < f.elements.length; i++) {
		var e = f.elements[i];
		if(e.type != 'checkbox') continue;
		if(t == 0) e.checked = false;
		if(t == 1) e.checked = e.checked ? false : true;
		if(t == 2) e.checked = true;	
	}
}
function stoinp(s, i, p) {
	var p = p ? p : ','; var arr = $(i).value.split(p);
	for (var i=0; i<arr.length; i++){if(s == arr[i]) return;}
	$(i).value += $(i).value ? p+s : s;
}
function select_op(i, v) {
	var o = $(i);
	for(var i=0; i<o.options.length; i++) {if(o.options[i].value == v) {o.options[i].selected=true;break;}}
}
function Dmsg(str, i, s, t) {
	var t = t ? t : 5000; var s = s ? true : false;
	try{if(s){window.scrollTo(0,0);}$('d'+i).innerHTML = '<img src="'+SKPath+'image/check_error.gif" width="12" height="12" align="absmiddle"/> '+str+sound('tip');$(i).focus();}catch(e){}
	window.setTimeout(function(){$('d'+i).innerHTML = '';}, t);
}
function Inner(i, s) {try {$(i).innerHTML = s;}catch(e){}}
function confirmURI(m, f) {if(confirm(m)) Go(f);}
function Go(u) {window.location = u;}
function showmsg(m, t) {
	var t = t ? t : 5000; var s = m.indexOf(L['str_delete']) != -1 ? 'delete' : 'ok';
	try{$('msgbox').style.display = '';$('msgbox').innerHTML = m+sound(s);window.setTimeout('closemsg();', t);}catch(e){}
}
function closemsg() {try{$('msgbox').innerHTML = '';$('msgbox').style.display = 'none';}catch(e){}}
function sound(f) {return '<div style="float:left;"><embed src="'+DTPath+'file/flash/'+f+'.swf" quality="high" type="application/x-shockwave-flash" height="0" width="0" hidden="true"/></div>';}
function Eh(t) {
	var t = t ? t : 'select';
	if(isIE) {
		var arVersion = navigator.appVersion.split("MSIE"); var IEversion = parseFloat(arVersion[1]);		
		if(IEversion >= 7 || IEversion < 5) return;
		var ss = document.body.getElementsByTagName(t);					
		for(var i=0;i<ss.length;i++) {ss[i].style.visibility = 'hidden';}
	}
}
function Es(t) {
	var t = t ? t : 'select';
	if(isIE) {
		var arVersion = navigator.appVersion.split("MSIE"); var IEversion = parseFloat(arVersion[1]);		
		if(IEversion >= 7 || IEversion < 5) return;
		var ss = document.body.getElementsByTagName(t);					
		for(var i=0;i<ss.length;i++) {ss[i].style.visibility = 'visible';}
	}
}
function FCKLen(i) {
	var i = i ? i : 'content';
	var o = FCKeditorAPI.GetInstance(i);
	var d = o.EditorDocument;
	var l ;
	if(document.all) {
		l = d.body.innerText.length;
	} else {
		var r = d.createRange(); r.selectNodeContents(d.body); l = r.toString().length;
	}
	return l;
}
function FCKXHTML(i) {
	var i = i ? i : 'content';
	return FCKeditorAPI.GetInstance(i).GetXHTML(true);
}
function Tb(d, t, p, c) {
	for(var i=1; i<=t; i++) {
		if(d == i) {$(p+'_t_'+i).className = c+'_2'; Ds(p+'_c_'+i);} else {$(p+'_t_'+i).className = c+'_1'; Dh(p+'_c_'+i);}
	}
}
function is_captcha(v) {
	if(v == L['str_captcha']) return false;
	if(v.match(/^[a-z0-9A-Z]{1,}$/)) {
		return v.match(/^[a-z0-9A-Z]{4,}$/);
	} else {
		return v.length > 1;
	}
}
function ext(v) {return v.substring(v.lastIndexOf('.')+1, v.length);}
function set_cookie(n, v, d) {
	var e = ''; 
	var f = d ? d : 365;
	e = new Date((new Date()).getTime() + f * 86400000);
	e = "; expires=" + e.toGMTString();
	document.cookie = CKPrex + n + "=" + v + ((CKPath == "") ? "" : ("; path=" + CKPath)) + ((CKDomain =="") ? "" : ("; domain=" + CKDomain)) + e; 
}
function get_cookie(n) {
	var v = ''; var s = CKPrex + n + "=";
	if(document.cookie.length > 0) {
		o = document.cookie.indexOf(s);
		if(o != -1) {	
			o += s.length;
			end = document.cookie.indexOf(";", o);
			if(end == -1) end = document.cookie.length;
			v = unescape(document.cookie.substring(o, end));
		}
	}
	return v;
}
function del_cookie(n) {var e = new Date((new Date()).getTime() - 1 ); e = "; expires=" + e.toGMTString(); document.cookie = CKPrex + n + "=" + escape("") +";path=/"+ e;}
function lang(s, a) {for(var i = 0; i < a.length; i++) {s = s.replace('{V'+i+'}', a[i]);} return s;}
document.onkeydown = function(e) {
	var k = typeof e == 'undefined' ? event.keyCode : e.keyCode;
	if(k == 37) {
		try{if($('destoon_previous').value && typeof document.activeElement.name == 'undefined')Go($('destoon_previous').value);}catch(e){}
	} else if(k == 39) {
		try{if($('destoon_next').value && typeof document.activeElement.name == 'undefined')Go($('destoon_next').value);}catch(e){}
	} else if(k == 38 || k == 40 || k == 13) {
		try{if($('search_tips').style.display != 'none' || $('search_tips').innerHTML != ''){SCTip(k);return false;}}catch(e){}
	} else if(k == 27) {
		try{if($('Dtop') != null) cDialog();}catch(e){}
	}
}