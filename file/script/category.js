/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
var cat_id;
function load_category(catid, id) {
	cat_id = id; category_catid[id] = catid;
	makeRequest('action=category&category_title='+category_title[id]+'&category_moduleid='+category_moduleid[id]+'&category_extend='+category_extend[id]+'&category_deep='+category_deep[id]+'&cat_id='+cat_id+'&catid='+catid, AJPath, 'into_category');
}
function into_category() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		$('catid_'+cat_id).value = category_catid[cat_id];
		if(xmlHttp.responseText) $('load_category_'+cat_id).innerHTML = xmlHttp.responseText;
	}
}