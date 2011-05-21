/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
function Print(i) {if(isIE) {window.print();} else {var i = i ? i : 'content'; var w = window.open('','',''); w.opener = null; w.document.write('<div style="width:630px;">'+$(i).innerHTML+'</div>'); w.window.print();}}
function addFav(t) {document.write('<a href="'+window.location.href+'" title="'+document.title+'" rel="sidebar" onclick="window.external.addFavorite(this.href, this.title);return false;">'+t+'</a>');}
function Album(id, s) {
	for(var i=0; i<3; i++) {$('t_'+i).className = i==id ? 'ab_on' : 'ab_im';}
	$('abm').innerHTML = '<img src="'+s+'" onload="if(this.width>240){this.width=240;}" onclick="PAlbum(this);" onmouseover="SAlbum(this.src);" onmouseout="HAlbum();" id="DIMG"/>';
}
function SAlbum(s) {
	if(s.indexOf('nopic240.gif') != -1) return;
	s = s.substring(0, s.length-8-ext(s).length);
	$('imgshow').innerHTML = '<img src="'+s+'" onload="if(this.width<240){HAlbum();}else if(this.width>630){this.width=630;}"/>';
	Ds('imgshow');
}
function PAlbum(o) {if(o.src.indexOf('nopic240.gif')==-1) View(o.src);}
function HAlbum() {Dh('imgshow');}
function Dsearch() {
	if($('destoon_kw').value.length < 1 || $('destoon_kw').value == L['keyword_message']) {
		$('destoon_kw').value = '';
		window.setTimeout(function(){$('destoon_kw').value = L['keyword_message'];}, 500);
		return false;
	}
}
function View(s) {window.open(DTPath+'extend/view.php?img='+s);}
function setModule(n, i) {
	$('destoon_moduleid').value = i;
	$('destoon_search_m').href = DTPath+'search.php?moduleid='+i;
	$('destoon_select').value = n;
	Dh('search_module');
	searchid = i;
	setKW();
}
function setKW() {makeRequest('action=keyword&mid='+searchid, AJPath, '_setKW');}
function _setKW() {if(xmlHttp.readyState==4 && xmlHttp.status==200) {if(xmlHttp.responseText) $('search_word').innerHTML = '<strong>'+L['popular_search_terms']+'</strong> ' + xmlHttp.responseText;}}
function setTip(w) {Dh('search_tips'); $('destoon_kw').value = w; $('destoon_search').submit();}
var tip_word = '';
function STip(w) {
	if(w.length < 2) {$('search_tips').innerHTML = ''; Dh('search_tips'); return;}
	if(w == tip_word) {return;} else {tip_word = w;}
	makeRequest('action=tipword&mid='+searchid+'&word='+w, AJPath, '_STip');
}
function _STip() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			Ds('search_tips'); $('search_tips').innerHTML = xmlHttp.responseText + '<label onclick="Dh(\'search_tips\');">'+L['search_tips_close']+'&nbsp;&nbsp;</label>';
		} else {
			$('search_tips').innerHTML = ''; Dh('search_tips');
		}
	}
}
function SCTip(k) {
	var o = $('search_tips');
	if(o.style.display == 'none') {
		if(o.innerHTML != '') Ds('search_tips');
	} else {
		if(k == 13) {$('destoon_search').submit(); return;}
		$('destoon_kw').blur();
		var d = o.getElementsByTagName('div'); var l = d.length; var n, p; var c = w = -2;
		for(var i=0; i<l; i++) {if(d[i].className == 'search_t_div_2') c = i;}
		if(c == -2) {
			n = 0; p = l-1;
		} else if(c == 0) {
			n = 1; p = -1;
		} else if(c == l-1) {
			n = -1; p = l-2; 
		} else {
			n = c+1; p = c-1;
		}
		w = k == 38 ? p : n;
		if(c >= 0) d[c].className = 'search_t_div_1';
		if(w >= 0) d[w].className = 'search_t_div_2';
		if(w >= 0) {var r = d[w].innerHTML.split('>'); $('destoon_kw').value = r[2];} else {$('destoon_kw').value = tip_word;}
	}
}
function setFModule(id) {
	var name = $('foot_search_m_'+id).innerHTML;
	$('foot_moduleid').value = id;
	var ss = $('foot_search_m').getElementsByTagName('span');
	for(var i=0;i<ss.length;i++) {if(ss[i].id == 'foot_search_m_'+id) {ss[i].className = 'f_b';} else {ss[i].className = '';}}
}
function Fsearch() {
	if($('foot_kw').value.length < 1 || $('foot_kw').value == L['keyword_message']) {
		$('foot_kw').value = ''; window.setTimeout(function(){$('foot_kw').value = L['keyword_message'];}, 500); return false;
	}
}
function user_login() {
	if(!$('user_name').value.match(/^[a-z0-9@\.]{3,}$/)) {$('user_name').focus(); return false;}
	if($('user_pass').value == 'password' || $('user_pass').value.length < 4) {$('user_pass').focus(); return false;}
}
function player(u, w, h, p, a) {
	var w = w ? w : 480;
	var h = h ? h : 400;
	var e = t = c = '';
	if(p == 0) {
		e = 'swf';
	} else if(p == 1) {
		e = 'wma';
	} else if(p == 2) {
		e = 'rm';
	} else {
		e = ext(u);
	}
	if(e == 'rm' || e == 'rmvb' || e == 'ram') {
		t = 'audio/x-pn-realaudio-extend';
	} else if(e == 'wma' || e == 'wmv') {
		t = 'application/x-mplayer2';
		c = 'controls="imagewindow,controlpanel,statusbar"';
	} else {
		if(u.indexOf('.flv')>0 && u.indexOf('?')==-1) u = DTPath+'file/flash/flvplayer.swf?vcastr_file='+u+'&BufferTime=3&IsAutoPlay='+(a ? '1' : '0');
		t = 'application/x-shockwave-flash';
		c = 'quality="high" extendspage="http://get.adobe.com/flashplayer/" allowfullscreen="true"';//wmode="transparent"
	}
	return '<embed src="'+u+'" width="'+w+'" height="'+h+'" type="'+t+'" autostart="'+(a ? 'true' : 'false')+'" '+c+'></embed>';
}
function show_comment(u, m, i) {document.write('<iframe src="'+u+'comment.php?mid='+m+'&itemid='+i+'" name="destoon_comment" id="des'+'toon_comment" style="width:99%;height:0px;" scrolling="no" frameborder="0"></iframe>');}
function show_answer(u, i) {document.write('<iframe src="'+u+'answer.php?itemid='+i+'" name="destoon_answer" id="des'+'toon_answer" style="width:100%;height:0px;" scrolling="no" frameborder="0"></iframe>');}
var sell_n = 0;
function sell_tip(o, i) {
	if(o.checked) {sell_n++; $('item_'+i).style.backgroundColor='#F1F6FC';} else {$('item_'+i).style.backgroundColor='#FFFFFF'; sell_n--;}
	if(sell_n < 0) sell_n = 0;
	if(sell_n > 1) {
		var aTag = o; var leftpos = toppos = 0;
		do {aTag = aTag.offsetParent; leftpos	+= aTag.offsetLeft; toppos += aTag.offsetTop;
		} while(aTag.offsetParent != null);
		var X = o.offsetLeft + leftpos - 10;
		var Y = o.offsetTop + toppos - 70;
		$('sell_tip').style.left = X + 'px';
		$('sell_tip').style.top = Y + 'px';
		o.checked ? Ds('sell_tip') : Dh('sell_tip');
	} else {
		Dh('sell_tip');
	}
}
function img_tip(o, i) {
	if(i) {
		if(i.indexOf('nopic.gif') == -1 && i.indexOf('.thumb.') != -1) {
			var s = i.split('.thumb.'); var aTag = o; var leftpos = toppos = 0;
			do {aTag = aTag.offsetParent; leftpos	+= aTag.offsetLeft; toppos += aTag.offsetTop;
			} while(aTag.offsetParent != null);
			var X = o.offsetLeft + leftpos + 90;
			var Y = o.offsetTop + toppos - 20;
			$('img_tip').style.left = X + 'px';
			$('img_tip').style.top = Y + 'px';
			Ds('img_tip');
			Inner('img_tip', '<img src="'+s[0]+'" onload="if(this.width<200) {Dh(\'img_tip\');}else if(this.width>300){this.width=300;}$(\'img_tip\').style.width=this.width+\'px\';"/>')
		}
	} else {
		Dh('img_tip');
	}
}