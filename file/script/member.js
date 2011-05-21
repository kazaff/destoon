/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
function m(i) { try { $(i).className = 'tab_on'; } catch(e) {} }
function s(i) { try { $(i).className = 'side_b'; } catch(e) {} }
function v(i) { if($(i).className == 'side_a') $(i).className = 'side_c'; }
function t(i) { if($(i).className == 'side_c') $(i).className = 'side_a'; }
function c(i, s) {
	var s = s ? '_'+s : '';
	if($('I_'+i).src.indexOf('arrow_c') == -1) {
		$('I_'+i).src = 'image/arrow_c'+s+'.gif'; Ds('D_'+i);
	} else {
		$('I_'+i).src = 'image/arrow_o'+s+'.gif'; Dh('D_'+i);
	}
	for(var j = 0; j < 4; j++) {
		if(j != i) {
			try {$('I_'+j).src = 'image/arrow_o'+s+'.gif'; Dh('D_'+j);} catch(e) {}
		}
	}
}
var n = 1
function o() {
	for(var j = 0; j < 4; j++) {
		if(n == 1) {
			try {$('I_'+j).src = 'image/arrow_c.gif'; Ds('D_'+j);} catch(e) {} 
		} else {
			try {$('I_'+j).src = 'image/arrow_o.gif'; Dh('D_'+j);} catch(e) {}
		}
	}
	if(n ==1) { n = 0; } else { n = 1; }
}
function oh(o) {
	if(o.className == 'side_h') {
		o.className = 'side_s';Dh('side');
	} else {
		o.className = 'side_h';Ds('side');
	}
}
function sh(c) {
	if($('head_kw').value == L['keyword_value'] || $('head_kw').value.length < 1) {
		alert(L['keyword_message']);
		$('head_kw').focus();
		return false;
	}
	if(c) $('head_sh').submit();
}