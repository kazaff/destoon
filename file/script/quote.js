/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
function quote_search() {if($('quote_kw').value.length < 2 || $('quote_kw').value == L['quote_value']) {$('quote_kw').value = ''; window.setTimeout(function(){$('quote_kw').value = L['quote_value'];}, 500); return false;}}
var stopscroll = false;
var scrollElem = $("quote_0");
var marqueesHeight = scrollElem.style.height;
scrollElem.onmouseover = new Function('stopscroll = true');
scrollElem.onmouseout  = new Function('stopscroll = false');
var preTop = 0; var currentTop = 0; var stoptime = 0;
var leftElem = $("quote_1");
function init_srolltext() {scrollElem.scrollTop = 0; setInterval('scrollUp()', 15);}
function scrollUp(){
	if(stopscroll) return;
	currentTop += 1;
	if(currentTop == 21) {
		stoptime += 1; currentTop -= 1;
		if(stoptime == 100) {currentTop = 0; stoptime = 0;}
	} else {
		preTop = scrollElem.scrollTop; scrollElem.scrollTop += 1;
		if(preTop == scrollElem.scrollTop) {scrollElem.scrollTop = 0; scrollElem.scrollTop += 1;}
	}
}
if(leftElem.scrollHeight > Number(scrollElem.style.height.replace('px', ''))/2) scrollElem.appendChild(leftElem.cloneNode(true));
init_srolltext();