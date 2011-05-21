/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
var product_Interval = setInterval('attach_catid()', 500);
function attach_catid() {
	if($('catid_1').value != product_catid) {
		product_catid = $('catid_1').value
		if(product_catid != 0) load_product();
	}
}
function load_product() {makeRequest('action=product&product_title='+product_title+'&product_extend='+product_extend+'&product_catid='+product_catid+'&product_pid='+product_pid, AJPath, 'into_product');}
function into_product() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		$('load_product').innerHTML = xmlHttp.responseText;
		if(xmlHttp.responseText == '') {$('pid').value = product_pid = 0; $('load_product_option').innerHTML = xmlHttp.responseText; Dh('load_product_option_tr');}
	}
}
function load_product_option(pid, name, idx) {
	product_pid = pid;
	if(name && pid && $('tag').value != name) $('tag').value = name;
	try {
		if($('u0').value == '') {
			$('u0').value = $('product_unit').options[idx].innerHTML;
			var unit = $('product_unit').options[idx].innerHTML ? $('product_unit').options[idx].innerHTML : $('uu').value;
			$('u1').innerHTML = $('u2').innerHTML = $('u3').innerHTML = unit;
		}
	} catch(e) {}
	makeRequest('action=product_option&product_itemid='+product_itemid+'&pid='+product_pid, AJPath, 'into_product_option');
}
function into_product_option() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		$('pid').value = product_pid;
		if(xmlHttp.responseText) {
			Ds('load_product_option_tr'); $('load_product_option').innerHTML = xmlHttp.responseText;
		} else {
			$('load_product_option').innerHTML = xmlHttp.responseText; Dh('load_product_option_tr');
		}
	}
}