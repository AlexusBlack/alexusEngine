var ave={
	init:function() {
		$(".visual_editor").html('<ul class="nav nav-pills"><li class="active"><a href="#" class="visual_edit">Визуально</a></li><li><a href="#" class="html_edit">html</a></li><li><a href="#" class="insert_image">вставить картинку</a></li> </ul><div class="well editarea text" contenteditable="true"></div><div class="well editarea html" contenteditable="true"></div>');

		$(".visual_editor .visual_edit").click(ave.visualClickHandler);
		$(".visual_editor .html_edit").click(ave.htmlClickHandler);
		$(".visual_editor .editarea.html").blur(ave.htmlBlurHandler);
		$(".visual_editor .editarea.html").keyup(ave.caretMoveHandler);
	},
	set:function(el, data) {
		var editarea_text=$(el).find(".editarea.text");
		var editarea_html=$(el).find(".editarea.html");
		$(editarea_html).html(ave.xml_highlight(style_html(data)));
		$(editarea_text).html($(editarea_html).text());
	},
	get:function(el) {
		var editarea_text=$(el).find(".editarea.text");
		var editarea_html=$(el).find(".editarea.html");
		$(editarea_html).html(ave.xml_highlight(style_html($(editarea_text).html())));
		return $(editarea_html).text();
	},
	visualClickHandler:function() {
		if($(this).parent().hasClass("active")) return;
		var editarea_text=$(this).parent().parent().parent().find(".editarea.text");
		var editarea_html=$(this).parent().parent().parent().find(".editarea.html");
		
		$(editarea_html).html(ave.xml_highlight(style_html($(editarea_text).html())));
		$(editarea_text).html($(editarea_html).text());
		$(this).parent().parent().parent().find(".nav li").removeClass("active");
		$(this).parent().addClass("active");
		$(editarea_html).hide();
		$(editarea_text).show();
		return false;
	},
	htmlClickHandler:function() {
		if($(this).parent().hasClass("active")) return;
		var editarea_text=$(this).parent().parent().parent().find(".editarea.text");
		var editarea_html=$(this).parent().parent().parent().find(".editarea.html");

		$(editarea_html).html(ave.xml_highlight(style_html($(editarea_text).html())));
		$(this).parent().parent().parent().find(".nav li").removeClass("active");
		$(this).parent().addClass("active");
		$(editarea_html).show();
		$(editarea_text).hide();
		return false;
	},
	caretMoveHandler:function() {
		$(this).attr("caretpos", ave.getCaretPosition(this));
	},
	htmlBlurHandler:function() {
		$(this).html(ave.xml_highlight(style_html($(this).text())));
	},
	htmlspecialchars:function(str) {
	    if (str === undefined) return "";
	    return str.replace(/[<>"&]/g, function(match){
	        return (match == "<") ? "&lt;" :
	               (match == ">") ? "&gt;" :
	               (match == '"') ? "&quot;" :
	               (match == "&") ? "&amp;" : "";
	    });
	},
	xml_highlight:function(s) {
		return s.replace(/\n/g,"<br>");
		s=ave.htmlspecialchars(s);
		s=s.replace(/&lt;([\/]*)([\s\S]*)([\s]*)&gt;/mg, "<font color=\"#000000\">&lt;$1$2$3&gt;</font>"); 
		s=s.replace(/&lt;([\?])([\s\S]*?)([\?])&gt;/mg, "<font color=\"#800000\">&lt;$1$2$3&gt;</font>");
		s=s.replace(/&lt;([^\s\?\/\=])(.*?)([\[\s\/]|&gt;)/img, "&lt;<font color=\"#808000\">$1$2</font>$3"); 
		s=s.replace(/&lt;([\/])([^\s]*)([\s\]]*)&gt;/ig, "&lt;$1<font color=\"#808000\">$2</font>$3&gt;");
		s=s.replace(/([^\s]*?)\=(&quot;|')(.*)(&quot;|')/ig, "<font color=\"#800080\">$1</font>=<font color=\"#FF00FF\">$2$3$4</font>");
		s=s.replace(/&lt;([.\s]*?)(\[)([.\s]*?)(\])&gt;/ig, "&lt;$1<font color=\"#800080\">$2$3$4</font>&gt;");
		return s.replace(/\n/g,"<br>");
	},
	getCaretPosition:function(editableDiv) {
	    var caretPos = 0, containerEl = null, sel, range;
	    if (window.getSelection) {
	        sel = window.getSelection();
	        if (sel.rangeCount) {
	            range = sel.getRangeAt(0);
	            if (range.commonAncestorContainer.parentNode == editableDiv) {
	                caretPos = range.endOffset;
	            }
	        }
	    } else if (document.selection && document.selection.createRange) {
	        range = document.selection.createRange();
	        if (range.parentElement() == editableDiv) {
	            var tempEl = document.createElement("span");
	            editableDiv.insertBefore(tempEl, editableDiv.firstChild);
	            var tempRange = range.duplicate();
	            tempRange.moveToElementText(tempEl);
	            tempRange.setEndPoint("EndToEnd", range);
	            caretPos = tempRange.text.length;
	        }
	    }
	    return caretPos;
	}
};
function getCaretPosition(editableDiv) {
    var caretPos = 0, containerEl = null, sel, range;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.rangeCount) {
            range = sel.getRangeAt(0);
            if (range.commonAncestorContainer.parentNode == editableDiv) {
                caretPos = range.endOffset;
            }
        }
    } else if (document.selection && document.selection.createRange) {
        range = document.selection.createRange();
        if (range.parentElement() == editableDiv) {
            var tempEl = document.createElement("span");
            editableDiv.insertBefore(tempEl, editableDiv.firstChild);
            var tempRange = range.duplicate();
            tempRange.moveToElementText(tempEl);
            tempRange.setEndPoint("EndToEnd", range);
            caretPos = tempRange.text.length;
        }
    }
    return caretPos;
}