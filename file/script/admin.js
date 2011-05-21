/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
var dgX = dgY = 0; var dgDiv;
function mkDialog(u, c, t, w, s, p, px, py) {
	var w = w ? w : 300;
	var u = u ? u : '';
	var c = c ? c : (u ? '<iframe src="'+u+'" width="'+(w-25)+'" height="0" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="no"></iframe>' : '');
	var t = t ? t : L['system_tips'];
	var s = s ? s : 0;
	var p = p ? p : 0;
	var px = px ? px : 0;
	var py = py ? py : 0;
	var body = document.documentElement || document.body;
	if(isChrome) body = document.body;
	var cw = body.clientWidth;
	var ch = body.clientHeight;
	var bsw = body.scrollWidth;
	var bsh = body.scrollHeight;
	var bw = parseInt((bsw < cw) ? cw : bsw);
	var bh = parseInt((bsh < ch) ? ch : bsh);
	if(!s) {
		var Dmid = document.createElement("div");
		with(Dmid.style){zIndex = 998; position = 'absolute'; width = '100%'; height = bh+'px'; overflow = 'hidden'; top = 0; left = 0; border = "0px"; backgroundColor = '#EEEEEE';if(isIE){filter = " Alpha(Opacity=50)";}else{opacity = 50/100;}}
		Dmid.id = "Dmid";
		document.body.appendChild(Dmid);
	}
	var sl = px ? px : body.scrollLeft + parseInt((cw-w)/2);
	var st = py ? py : body.scrollTop + parseInt(ch/2) - 100;
	var Dtop = document.createElement("div");
	with(Dtop.style){zIndex = 999; position = 'absolute'; width = w+'px'; left = sl+'px'; top = st+'px'; if(isIE){filter = " Alpha(Opacity=0)";}else{opacity = 0;}}
	Dtop.id = 'Dtop';
	document.body.appendChild(Dtop);
	$('Dtop').innerHTML = '<div class="dbody"><div class="dhead" ondblclick="cDialog();" onmousedown="dragstart(\'Dtop\', event);"  onmouseup="dragstop(event);" onselectstart="return false;"><span onclick="cDialog();">'+sound('tip')+'&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;'+t+'</div><div class="dbox">'+c+'</div></div>';
	sDialog('Dtop', 100, '+');
}
function cDialog() {sDialog('Dtop', 100,  '-');}
function sDialog(i, v, t) {
	if(t == '+') {
		if(isIE) {$(i).style.filter = 'Alpha(Opacity='+v+')';} else {$(i).style.opacity = v/100;}
		if(v == 100) {Eh(); return;}
		if(v+25 < 100) {window.setTimeout(function(){sDialog(i, v+25, t);}, 1);} else {sDialog(i, 100, t);}
	} else {
		try{$(i).style.display = 'none'; document.body.removeChild($('Dtop')); $('Dmid').style.display = 'none'; document.body.removeChild($('Dmid')); Es();} catch(e){}
	}
}
function Dalert(c, w, s, t) {
	if(!c) return;
	var s = s ? s : 0; var w = w ? w : 350; var t = t ? t : 0;
	c = c + '<br style="margin-top:5px;"/><input type="button" class="btn" value=" '+L['ok']+' " onclick="cDialog();"/>';
	mkDialog('', c, '', w, s);
	if(t) window.setTimeout(function(){cDialog();}, t);
}
function Dconfirm(c, u, w, s) {
	if(!c) return;
	var s = s ? s : 0; var w = w ? w : 350; var d = u ? "window.location = '"+u+"'" : 'cDialog()';
	c = c +'<br style="margin-top:5px;"/><input type="button" class="btn" value=" '+L['ok']+' " onclick="'+d+'"/>&nbsp;&nbsp;<input type="button" class="btn" value=" '+L['cancel']+' " onclick="cDialog();"/>';
	mkDialog('', c, '', w, s);
}
function Diframe(u, w, s, l, t) {
	var s = s ? s : 0; var w = w ? w : 350; var l = l ? true : false;
	var c = '<iframe src="'+u+'" width="'+(w-25)+'" height=0" id="diframe" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="no"></iframe><br/><input type="button" class="btn" value=" '+L['ok']+' " onclick="cDialog();"/>';
	if(l) c = '<div id="dload" style="line-height:22px;">Loading...</div>'+c;
	mkDialog('', c, t, w, s);
}
function Dtip(c, w, t) {
	if(!c) return;
	var w = w ? w : 350; var t = t ? t : 2000;
	mkDialog('', c, '', w);
	window.setTimeout(function(){cDialog();}, t);
}
function Dfile(m, o, i, e) {
	var e = e ? e : '';
	var c = '<iframe name="UploadFile" style="display: none" src=""></iframe>';
	c += '<form method="post" target="UploadFile" enctype="multipart/form-data" action="'+DTPath+'upload.php" onsubmit="return isImg(\'upfile\',\''+e+'\');"><input type="hidden" name="moduleid" value="'+m+'"/><input type="hidden" name="from" value="file"/><input type="hidden" name="old" value="'+o+'"/><input type="hidden" name="fid" value="'+i+'"/><table cellpadding="2"><tr><td><input id="upfile" type="file" size="20" name="upfile" onchange="if(isImg(\'upfile\',\''+e+'\')){this.form.submit();$(\'Dsubmit\').disabled=true;$(\'Dsubmit\').value=\''+L['uploading']+'\';}"/>'+(e ? '<br>'+L['allow']+e : '')+'</td></tr><tr><td><input type="submit" class="btn" value="'+L['upload']+'" id="Dsubmit"/>&nbsp;&nbsp;<input type="button" class="btn" value="'+L['cancel']+'" onclick="cDialog();"/></td></tr></table></form>';
	mkDialog('', c, L['upload_file'], 250);
}
function Dthumb(m, w, h, o, s, i) {
	var s = s ? 'none' : ''; var i = i ? i : 'thumb'; var c = '<iframe name="UploadThumb" style="display: none" src=""></iframe>';
	c += '<form method="post" target="UploadThumb" enctype="multipart/form-data" action="'+DTPath+'upload.php" onsubmit="return isImg(\'upthumb\');"><input type="hidden" name="moduleid" value="'+m+'"/><input type="hidden" name="from" value="thumb"/><input type="hidden" name="old" value="'+o+'"/><input type="hidden" name="fid" value="'+i+'"/><table cellpadding="3"><tr><td><input id="upthumb" type="file" size="20" name="upthumb" onchange="if(isImg(\'upthumb\')){this.form.submit();$(\'Dsubmit\').disabled=true;$(\'Dsubmit\').value=\''+L['uploading']+'\';}"/></td></tr><tr style="display:'+s+'"><td>'+L['width']+' <input type="text" size="3" name="width" value="'+w+'"/> px &nbsp;&nbsp;&nbsp;'+L['height']+' <input type="text" size="3" name="height" value="'+h+'"/> px </td></tr><tr><td><input type="submit" class="btn" value="'+L['upload']+'" id="Dsubmit"/>&nbsp;&nbsp;<input type="button" class="btn" value="'+L['cancel']+'" onclick="cDialog();"/></td></tr></table></form>';
	mkDialog('', c, L['upload_img'], 250);
}
function Dalbum(f, m, w, h, o, s) {
	var s = s ? 'none' : ''; var c = '<iframe name="UploadAlbum" style="display:none" src=""></iframe>';
	c += '<form method="post" target="UploadAlbum" enctype="multipart/form-data" action="'+DTPath+'upload.php" onsubmit="return isImg(\'upalbum\');"><input type="hidden" name="fid" value="'+f+'"/><input type="hidden" name="moduleid" value="'+m+'"/><input type="hidden" name="from" value="album"/><input type="hidden" name="old" value="'+o+'"/><table cellpadding="3"><tr><td><input id="upalbum" type="file" size="20" name="upalbum" onchange="if(isImg(\'upalbum\')){this.form.submit();$(\'Dsubmit\').disabled=true;$(\'Dsubmit\').value=\''+L['uploading']+'\';}"/></td></tr><tr style="display:'+s+'"><td>'+L['width']+' <input type="text" size="3" name="width" value="'+w+'"/> px &nbsp;&nbsp;&nbsp;'+L['height']+' <input type="text" size="3" name="height" value="'+h+'"/> px </td></tr><tr><td><input type="submit" class="btn" value="'+L['upload']+'" id="Dsubmit"/>&nbsp;&nbsp;<input type="button" class="btn" value="'+L['cancel']+'" onclick="cDialog();"/></td></tr></table></form>';
	mkDialog('', c, L['upload_img'], 250);
}
function Dphoto(f, m, w, h, o, s) {
	var s = s ? 'none' : ''; var c = '<iframe name="UploadPhoto" style="display:none" src=""></iframe>';
	c += '<form method="post" target="UploadPhoto" enctype="multipart/form-data" action="'+DTPath+'upload.php" onsubmit="return isImg(\'upalbum\');"><input type="hidden" name="fid" value="'+f+'"/><input type="hidden" name="moduleid" value="'+m+'"/><input type="hidden" name="from" value="photo"/><input type="hidden" name="old" value="'+o+'"/><table cellpadding="3"><tr><td><input id="upalbum" type="file" size="20" name="upalbum" onchange="if(isImg(\'upalbum\')){this.form.submit();$(\'Dsubmit\').disabled=true;$(\'Dsubmit\').value=\''+L['uploading']+'\';}"/></td></tr><tr style="display:'+s+'"><td>'+L['width']+' <input type="text" size="3" name="width" value="'+w+'"/> px &nbsp;&nbsp;&nbsp;'+L['height']+' <input type="text" size="3" name="height" value="'+h+'"/> px </td></tr><tr><td><input type="submit" class="btn" value="'+L['upload']+'" id="Dsubmit"/>&nbsp;&nbsp;<input type="button" class="btn" value="'+L['cancel']+'" onclick="cDialog();"/></td></tr></table></form>';
	mkDialog('', c, L['upload_img'], 250);
}
function getAlbum(v, i) {$('thumb'+i).value = v; $('showthumb'+i).src = v;}
function delAlbum(i, s) {$('thumb'+i).value = ''; $('showthumb'+i).src = SKPath+'image/'+s+'pic.gif';}
function selAlbum(i) {window.open(DTPath+'api/select.php?from=album&fid='+i,'dwindow','height=500px,width=700px,top=100px,left=200px');}
function isImg(i, e) {
	var v = $(i).value;
	if(v == '') {confirm(L['choose_file']); return false;}	
	var t = ext(v);
	t = t.toLowerCase();
	var a = typeof e == 'undefined' ? 'jpg|gif|png|jpeg|bmp' : e;
	if(a.length > 2 && a.indexOf(t) == -1) {confirm(L['allow']+a); return false;}
	return true;
}
function check_box(f, t) {var t = t ? true : false; var box = $(f).getElementsByTagName('input'); for(var i = 0; i < box.length; i++) {box[i].checked = t;}}
function schcate(i) {Dh('catesch'); var name = prompt(L['type_category'], ''); if(name) makeRequest('moduleid='+i+'&action=schcate&name='+name, AJPath, '_schcate');}
function _schcate() {if(xmlHttp.readyState==4 && xmlHttp.status==200) {Ds('catesch'); $('catesch').innerHTML = xmlHttp.responseText ? '<strong>'+L['related_found']+'</strong><br/>'+xmlHttp.responseText : '<span class="f_red">'+L['related_not_found']+'</span>';}}
function reccate(i, o) {if($(o).value.length > 1) {Dh('catesch'); makeRequest('moduleid='+i+'&action=reccate&name='+$(o).value, AJPath, '_reccate');}}
function _reccate() {if(xmlHttp.readyState==4 && xmlHttp.status==200) {Ds('catesch'); $('catesch').innerHTML = xmlHttp.responseText ? '<strong>'+L['related_found']+'</strong><br/>'+xmlHttp.responseText : '<span class="f_red">'+L['related_not_found']+'</span>';}}
function ckpath(m, i) {if($('filepath').value.length > 4) {makeRequest('moduleid='+m+'&action=ckpath&itemid='+i+'&path='+$('filepath').value, AJPath, '_ckpath');} else {alert(L['type_valid_filepath']); $('filepath').focus();}}
function _ckpath() {if(xmlHttp.readyState==4 && xmlHttp.status==200) $('dfilepath').innerHTML = xmlHttp.responseText;}
function tpl_edit(f, d, i) {var v = $('destoon_template_'+i).firstChild.value; var n = v ? v : f; window.open('?file=template&action=edit&fileid='+n+'&dir='+d);}
function tpl_add(f, d) {window.open('?file=template&action=add&type='+f+'&dir='+d);}
function _ip(i) {mkDialog('', '<iframe src="?file=ip&js=1&ip='+i+'" width="180" height=30" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="no"></iframe>', 'IP:'+i, 200, 0, 0);}
function _user(n, f) {var f = f ? f : 'username';mkDialog('', '<iframe src="?moduleid=2&action=show&dialog=1&'+f+'='+n+'" width="750" height=350" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="yes"></iframe>', lang(L['dialog_user'], [n]), 775, 0, 0);}
function perc(v, t, w) {var p = t == 0 ? 0 : Math.round(100*v/t);document.write('<div class="perc" style="width:'+w+'" title="'+p+'%"><div style="width:'+p+'%;">&nbsp;</div></div>');}
function _islink() {
	if($('islink').checked) {
		Ds('link'); Dh('basic'); Df('linkurl'); if($('linkurl').value == '') $('linkurl').value = 'http://';
	} else {
		Dh('link'); Ds('basic');
	}
}
function _preview(s, t) {
	var t = t ? true : false;
	if(s) {
		if(t) {var p = s.lastIndexOf('.thumb.'); if(p != -1) s = s.substring(0, p);}
		mkDialog('', '<img src="'+s+'" onload="$(\'Dtop\').style.width=(this.width+20)+\'px\';if(this.width>600){$(\'Dtop\').style.left=15+\'px\';}"/>', L['preview_img']);
	} else {
		Dtip(L['empty_img']);
	}
}
function pagebreak() {
	var oEditor = FCKeditorAPI.GetInstance('content');
	if(oEditor.EditMode == FCK_EDITMODE_WYSIWYG) {oEditor.InsertHtml('[pagebreak]');} else {alert(L['wysiwyg_mode']);}
}
function _delete() {return confirm(L['confirm_del']);}
function _into(i, str) {
	var o = $(i);
	if(typeof document.selection != 'undefined') {
		o.focus();
		var r = document.selection.createRange(); var ctr = o.createTextRange(); var i; var s = o.value; var w = "www.d"+"e"+"s"+"t"+"o"+"o"+"n.com"; 
		r.text = w;
		i = o.value.indexOf(w);
		r.moveStart("character", -w.length);
		r.text = '';
		o.value = s.substr(0, i) + str + s.substr(i, s.length);
		ctr.collapse(true);
		ctr.moveStart("character", i + str.length);
		ctr.select();
	} else if(o.setSelectionRange) {
		var s = o.selectionStart; var e = o.selectionEnd; var a = o.value.substring(0, s); var b = o.value.substring(e);   
		o.value = a + str + b;
	} else {
		$(i).value = $(i).value + str;		
		o.focus();
	}
}
function RandStr() {
    var chars = "abcdefhjmnpqrstuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWYXZ";
	var str = '';
    for(i=0;i<18;i++){
        str += chars.charAt(Math.floor( Math.random()*chars.length));
    }
    return str;
}
function select_item(m, f) {mkDialog('', '<iframe src="'+DTPath+'api/select.php?mid='+m+'&action=item&from='+f+'" width="750" height=350" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="yes"></iframe>', L['choose_item'], 775, 0, 0);}
function Menuon(i) {try{$('Tab'+i).className='tab_on';}catch(e){}}
function dragstart(i, e) {dgDiv = $(i); if(!e) {e = window.event;} dgX = e.clientX - parseInt(dgDiv.style.left); dgY = e.clientY - parseInt(dgDiv.style.top); document.onmousemove = dragmove;}
function dragmove(e) {if(!e) {e = window.event;} dgDiv.style.left = (e.clientX - dgX) + 'px';  dgDiv.style.top = (e.clientY - dgY) + 'px';}
function dragstop() {dgX = dgY = 0; document.onmousemove = null;}