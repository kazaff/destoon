/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
var cid = 0; var cmids = [5,6,4];
function catalog(id) {
	try {
		$('catalog').style.visibility = 'hidden'; $('catalog_'+cid).className = 'catalog_li'; $('catalog_'+id).className = 'catalog_on';
		makeRequest('mid='+cmids[id]+'&action=catalog', AJPath, '_catalog');
		if(id < 2) $('iadd').href = member_myurl+'?action=add&mid='+cmids[id];
		cid = id; window.setTimeout(function(){$('catalog').style.visibility = 'visible';}, 200);		
	} catch(e){}
}
function _catalog() {if(xmlHttp.readyState==4 && xmlHttp.status==200) {$('catalog').innerHTML = xmlHttp.responseText;}}
var index_timeout, index_l = '';
function index_timer(l) {
	index_timeout = setTimeout(
	function() {
		if(index_l) $('index_'+index_l).className = 'catalog_letter_li';
		index_l = l;
		$('index_'+l).className = 'catalog_letter_on';
		Ds('catalog_index');
		$('catalog_index').className = 'catalog_index';
		makeRequest('moduleid='+cmids[cid]+'&action=letter&cols=5&letter='+l, AJPath, 'index_show');
	} ,200);
}
function index_out() {clearTimeout(index_timeout);}
function index_show() {if(xmlHttp.readyState==4 && xmlHttp.status==200) {$('catalog_index').innerHTML = xmlHttp.responseText+'<div onclick="index_hide()" title="'+L['close_letter']+'">&nbsp;</div>';}}
function index_hide() {
	if(index_l) $('index_'+index_l).className = 'catalog_letter_li';
	$('catalog_index').innerHTML = ''; Dh('catalog_index'); index_out();
}
function index_leave(o, e) {
	if(e.currentTarget) {
		if(typeof(HTMLElement) != "undefined") {
			HTMLElement.prototype.contains = function(obj) {
				if(obj==this) return true; 
				while(obj=obj.parentNode) {if(obj==this) return true;}
				return false; 
			}
		}
		if(o.contains(e.relatedTarget)) return;
	} else {
		if(o.contains(e.toElement)) return;
	}
	setTimeout(index_hide, 200);
}
var ipages = new Array(); var istr = '';
ipages['sell'] = ipages['buy'] = 1;
function ipage(str, type) {
	var page = 0;
	if(type == '+') page = ipages[str] + 1; else page = ipages[str] - 1;
	if(page < 1) {ipages[str] = 1; return false;}
	ipages[str] = page; istr = 'i'+str;
	$(istr).innerHTML = '<div class="loading">&nbsp;</div>';
	makeRequest('action=ipage&job='+str+'&page='+page, AJPath, '_ipage');	
}
function _ipage() {if(xmlHttp.readyState==4 && xmlHttp.status==200) {$(istr).innerHTML = xmlHttp.responseText ? xmlHttp.responseText : '<center>'+L['last_page']+'</center>';}}
var announceTime = 10000; 
var TextTime = 20; 
var announcei = 0;
var txti = 0;
var txttimer;
var announcetimer;
function showannounce() {
	var endstr = "_"
	hwannouncetr = announcetitle[announcei];
	announcelink = announcehref[announcei];
	if(txti==(hwannouncetr.length-1)){endstr="";}
	if(txti>=hwannouncetr.length){
		clearInterval(txttimer);
		clearInterval(announcetimer);
		announcei++;
		if(announcei>=announcetitle.length) announcei = 0
		announcetimer = setInterval("showannounce()",announceTime);
		txti = 0;
		return;
	}
	clearInterval(txttimer);
	$("printAnnounce").href=announcelink;
	$("printAnnounce").innerHTML = hwannouncetr.substring(0,txti+1)+endstr;
	txti++;
	txttimer = setInterval("showannounce()",TextTime);
}