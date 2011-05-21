/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
function $(i) {return document.getElementById(i);}
function Go(u) {window.location.href = u;}
function ext(v) {return v.substring(v.lastIndexOf('.')+1, v.length);}
function lang(s, a) {for(var i = 0; i < a.length; i++) {s = s.replace('{V'+i+'}', a[i]);} return s;}
function Album(id, s) {
	for(var i=0; i<3; i++) {$('t_'+i).className = i==id ? 'ab_on' : 'ab_im';}
	$('abm').innerHTML = '<img src="'+s+'" onload="if(this.width>240){this.width=240;}" onclick="PAlbum(this);" onmouseover="SAlbum(this.src);" onmouseout="HAlbum();" id="DIMG"/>';
}
function SAlbum(s) {
	if(s.indexOf('nopic240.gif') != -1) return;
	s = s.substring(0, s.length-8-ext(s).length);
	$('imgshow').innerHTML = '<img src="'+s+'" onload="if(this.width<240){HAlbum();}else if(this.width>400){this.width=400;}"/>';
	$('imgshow').style.display = '';
}
function PAlbum(o) {if(o.src.indexOf('nopic240.gif')==-1) window.open(DTPath+'extend/view.php?img='+o.src);}
function HAlbum() {$('imgshow').style.display = 'none';}
function check_kw() {if($('kw').value == L['keyword_value'] || $('kw').value.length<2) {alert(L['keyword_message']); $('kw').focus(); return false;}}
function show_date() {
	var dt_day = dt_month = dt_weekday = '';
	var dt_week = [L['Sunday'], L['Monday'], L['Tuesday'], L['Wednesday'], L['Thursday'], L['Friday'], L['Saturday']];
	dt_today = new Date();
	dt_weekday = dt_today.getDay();
	dt_month = dt_today.getMonth()+1;
	dt_day = dt_today.getDate();
	document.write(lang(L['show_date'], [dt_month, dt_day, dt_week[dt_weekday]]));
}
function ImgZoom(i, m) {
	var m = m ? m : 550; var w = i.width;
	if(w < m) return;
	var h = i.height;
	i.title = L['click_open'];
	i.onclick = function (e) {window.open(DTPath+'extend/view.php?img='+i.src);}
	i.height = parseInt(h*m/w);
	i.width = m;
}
document.onkeydown = function(e) {
	var k = typeof e == 'undefined' ? event.keyCode : e.keyCode;
	if(k == 37) {
		try{if($('destoon_previous').value && typeof document.activeElement.name == 'undefined')Go($('destoon_previous').value);}catch(e){}
	} else if(k == 39) {
		try{if($('destoon_next').value && typeof document.activeElement.name == 'undefined')Go($('destoon_next').value);}catch(e){}
	}
}