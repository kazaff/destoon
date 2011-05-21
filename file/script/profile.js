/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
function check_mode(c, m) {
	var mode_num = 0; var e = $('com_mode').getElementsByTagName('input');	
	for(var i=0; i<e.length; i++) {if(e[i].checked) mode_num++;}
	if(mode_num > m) {confirm(lang(L['max_mode'], [m])); c.checked = false;}
}
function addop(id, v, t) {var op = document.createElement("option"); op.value = v; op.text = t; $(id).options.add(op);}
function delop(id) {
	var s = -1;
	for(var i = 0; i < $(id).options.length; i++) {if($(id).options[i].selected) {s = i; break;}}
	if(s == -1) {alert(L['choose_category']); $(id).focus();} else {$(id).remove(s);}
}
function addcate(m) {
	var v = $('catid_1').value; var l = $('cates').options.length;
	if(l >= m) {alert(lang(L['max_cate'], [m])); return;}
	for(var i = 0; i < l; i++) {if($('cates').options[i].value == v) {alert(L['category_chosen']); return;}}
	var e = $('cate').getElementsByTagName('select'); var c = s = '';
	for(var i = 0; i < e.length; i++) {if(e[i].value) {s = e[i].options[e[i].selectedIndex].innerHTML; c += s + '/'; s = '';}}
	if(c) {c = c.replace('&amp;', '&'); c = c.substring(0, c.length-1); addop('cates', v, c); $('catid').value = $('catid').value ? $('catid').value+v+',' : ','+v+',';} else {alert(L['choose_category']);}
}
function delcate() {
	var s = -1;
	for(var i = 0; i < $('cates').options.length; i++) {if($('cates').options[i].selected) {s = i; break;}}
	if(s == -1) {alert(L['choose_category']); $('cates').focus();} else {$('catid').value = $('catid').value.replace(','+$('cates').options[s].value+',', ','); $('cates').remove(s);}
}