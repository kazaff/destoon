/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
function clear_tag() {
	var html = FCKXHTML(FCKID);
	if(html == '') return;
	var leng = html.length;
	if(leng < 100) return;
	if(!isIE && html.indexOf('mso-') != -1 && html.indexOf('<o:p>') != -1) {//Clear MS Word
		html = html.replace(/<o:p>\s*<\/o:p>/g, '');
		html = html.replace(/<o:p>.*?<\/o:p>/g, '&nbsp;');
		html = html.replace( /\s*mso-[^:]+:[^;"]+;?/gi, '');
		html = html.replace( /\s*MARGIN: 0cm 0cm 0pt\s*;/gi, '');
		html = html.replace( /\s*MARGIN: 0cm 0cm 0pt\s*"/gi, "\"");
		html = html.replace( /\s*TEXT-INDENT: 0cm\s*;/gi, '');
		html = html.replace( /\s*TEXT-INDENT: 0cm\s*"/gi, "\"");
		html = html.replace( /\s*TEXT-ALIGN: [^\s;]+;?"/gi, "\"");
		html = html.replace( /\s*PAGE-BREAK-BEFORE: [^\s;]+;?"/gi, "\"");
		html = html.replace( /\s*FONT-VARIANT: [^\s;]+;?"/gi, "\"");
		html = html.replace( /\s*tab-stops:[^;"]*;?/gi, '');
		html = html.replace( /\s*tab-stops:[^"]*/gi, '');
		html = html.replace( /\s*face="[^"]*"/gi, '');
		html = html.replace( /\s*face=[^ >]*/gi, '');
		html = html.replace( /\s*FONT-FAMILY:[^;"]*;?/gi, '');
		html = html.replace(/<(\w[^>]*) class=([^ |>]*)([^>]*)/gi, "<$1$3");
		html = html.replace( /<(\w[^>]*) style="([^\"]*)"([^>]*)/gi, "<$1$3");
		html = html.replace( /\s*style="\s*"/gi, '');
		html = html.replace( /<SPAN\s*[^>]*>\s*&nbsp;\s*<\/SPAN>/gi, '&nbsp;');
		html = html.replace( /<SPAN\s*[^>]*><\/SPAN>/gi, '');
		html = html.replace(/<(\w[^>]*) lang=([^ |>]*)([^>]*)/gi, "<$1$3");
		html = html.replace( /<SPAN\s*>(.*?)<\/SPAN>/gi, '$1');
		html = html.replace( /<FONT\s*>(.*?)<\/FONT>/gi, '$1');
		html = html.replace(/<\\?\?xml[^>]*>/gi, '');
		html = html.replace(/<\/?\w+:[^>]*>/gi, '');
		html = html.replace(/<\!--.*?-->/g, '');
		html = html.replace( /<(U|I|STRIKE)>&nbsp;<\/\1>/g, '&nbsp;');
		html = html.replace( /<H\d>\s*<\/H\d>/gi, '');
		html = html.replace( /<(\w+)[^>]*\sstyle="[^"]*DISPLAY\s?:\s?none(.*?)<\/\1>/ig, '');
		html = html.replace( /<(\w[^>]*) language=([^ |>]*)([^>]*)/gi, "<$1$3");
		html = html.replace( /<(\w[^>]*) onmouseover="([^\"]*)"([^>]*)/gi, "<$1$3");
		html = html.replace( /<(\w[^>]*) onmouseout="([^\"]*)"([^>]*)/gi, "<$1$3");
		html = html.replace( /<H(\d)([^>]*)>/gi, '<h$1>');
		html = html.replace( /<(H\d)><FONT[^>]*>(.*?)<\/FONT><\/\1>/gi, '<$1>$2<\/$1>');
		html = html.replace( /<(H\d)><EM>(.*?)<\/EM><\/\1>/gi, '<$1>$2<\/$1>');
		html = html.replace( /<PRE\s*[^>]*>(.*?)<\/PRE>/gi, '<p>$1</p>');
	}
	html = html.replace(/<(\w[^>]*) class=([^ |>]*)([^>]*)/gi, "<$1$3");
	html = html.replace(/<(\w[^>]*) id=([^ |>]*)([^>]*)/gi, "<$1$3");
	html = html.replace(/ on([a-z]+)=([\'|\"]?)(.*?)([\'|\"]?)/gi, '');
	html = html.replace( /<IFRAME\s*[^>]*>([\s\S]*?)<\/IFRAME>/gi, '');
	html = html.replace( /<SCRIPT\s*[^>]*>([\s\S]*?)<\/SCRIPT>/gi, '');
	html = html.replace( /<FORM\s*[^>]*>([\s\S]*?)<\/FORM>/gi, '');	
	html = html.replace( /<STYLE\s*[^>]*>([\s\S]*?)<\/STYLE>/gi, '');		
	html = html.replace( /<META\s*[^>]*>([\s\S]*?)<\/META>/gi, '$1');		
	html = html.replace(/<\!--([\s\S]*?)-->/g, '');
	html = html.replace( /<LINK\s*[^>]*>/gi, '');
	html = html.replace( /<P\s*[^>]*>\s*&nbsp;\s*<\/P>/gi, '');
	html = html.replace( /<DIV\s*[^>]*>\s*&nbsp;\s*<\/DIV>/gi, '');
	if(html.length != leng) try { FCKeditorAPI.GetInstance(FCKID).SetData(html); } catch(e) {}
}
var clearTime = setTimeout(function(){var clearInter = setInterval('clear_tag()', 1000);},10000);