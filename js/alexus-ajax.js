$(function() {
	ajaxConvertLinks();
});
function ajaxConvertLinks() {
	$("a").each(function() {
		var link=$(this).attr("href");
		if( link==undefined || link.indexOf("mailto:")!=-1 || link.indexOf("#")!=-1 || $(this).attr("target")!=undefined) return;

		if($(this).attr("href").indexOf(document.location.hostname)!=-1  ||  link.indexOf("http://")==-1) {
			$(this).unbind("click",ajaxLinkHandler);
			$(this).click(ajaxLinkHandler);
		}			
	});
}
function ajaxLinkHandler() {
	ajaxGoToPage( $(this).attr("href") );
	return false;
}
function ajaxGoToPage(url) {
	ajaxShowLoading();
	$.get(url+'?alexus-ajax=y', function(data) {
		var page=data.split("[AJAX-PAGE-CONTENT]");
		var page_info=$.parseJSON(page[0]);
		processAjaxData({
			'html':page[1],
			pageTitle:page_info.PAGE_TITLE
		}, url);
		ajaxConvertLinks();
		ajaxHideLoading();	
	});
}
function ajaxShowLoading() {
	$("body").append('<div class="fancybox-overlay fancybox-overlay-fixed" style="width: auto; height: auto; display: block;"></div>');
	$.fancybox.showLoading();
}
function ajaxHideLoading() {
	$(".fancybox-overlay").remove();
	$.fancybox.hideLoading();
}
function processAjaxData(response, urlPath){
     document.getElementById("alexus-ajax").innerHTML = response.html;
     document.title = response.pageTitle;
     window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
 }
 window.onpopstate = function(e){
    if(e.state){
        document.getElementById("alexus-ajax").innerHTML = e.state.html;
        document.title = e.state.pageTitle;
    }
};