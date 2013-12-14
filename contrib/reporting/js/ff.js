
	$(function() {
		$.fn.jqplotToImage =
		function(x_offset, y_offset) {
			var baseOffset = 0;
			if ($(this).width() == 0 || $(this).height() == 0) {
				return null;
			}
			var newCanvas = document.createElement("canvas");
			newCanvas.width = $(this).outerWidth() + Number(x_offset);
			newCanvas.height = $(this).outerHeight() + Number(y_offset);
	
			if (!newCanvas.getContext) return null;
	
			var newContext = newCanvas.getContext("2d"); 
			newContext.textAlign = 'left';
			newContext.textBaseline = 'top';
			
			
	
			function _jqpToImage(el, x_offset, y_offset) {
				var tagname = el.tagName.toLowerCase();
				var p = $(el).position();
				var css = getComputedStyle(el);
				var left = x_offset + p.left + parseInt(css.marginLeft) + parseInt(css.borderLeftWidth) + parseInt(css.paddingLeft);
				var top = y_offset + p.top + parseInt(css.marginTop) + parseInt(css.borderTopWidth)+ parseInt(css.paddingTop);
				if($(el).hasClass('jqplot-title')){
					var text = $(el).childText();
					newContext.font = 'normal 20px Arial';
					newContext.fillText(text, left+50, top);
					var metrics = newContext.measureText(text);
					
				}else if ((tagname == 'div' || tagname == 'span') && !$(el).hasClass('jqplot-highlighter-tooltip')) {
					$(el).children().each(function() {
						_jqpToImage(this, left, top);
					});
					
					var text = $(el).childText();
	
					if (text) {
						var metrics = newContext.measureText(text);
						newContext.font = 'normal 10px Arial';
						
						newContext.fillText(text, left, top);
						
						
						// For debugging.
						//newContext.strokeRect(left, top, $(el).width(), $(el).height());
					}
				}
				else if (tagname == 'canvas') {
					newContext.drawImage(el, left, top);
				}else if (tagname=='table'){
					var legendOffsetX=100;
					var legendOffsetY=50;
					var swatchOffset=5;
					var labelOffset=5;
					$(el).children().each(function() {
						newContext.strokeStyle = $(el).css('border-top-color');
						newContext.strokeRect(
								legendOffsetX,
								legendOffsetY,
								$(el).width(),$(el).height()
						);
						newContext.fillStyle = $(el).css('background-color');
						newContext.fillRect(
								legendOffsetX,
								legendOffsetY,
								$(el).width(),$(el).height()
						);
						$(el).find("div.jqplot-table-legend-swatch").each(function() {
																																			 
							newContext.fillStyle = $(this).css('border-top-color');
							newContext.fillRect(
								legendOffsetX+5,
								legendOffsetY+swatchOffset,
								$(this).parent().width(),$(this).parent().height()
							);
							swatchOffset=swatchOffset+15;
						});
						$(el).find("td.jqplot-table-legend").each(function() {
								if($(this).text()){																							 	
									var offset = $(this).offset();
									newContext.font = [$(this).css('font-style'), $(this).css('font-size'), $(this).css('font-family')].join(' ');
									newContext.fillStyle = $(this).css('color');
									var txt = $.trim($(this).text());
									newContext.fillText(txt, legendOffsetX+25, legendOffsetY+labelOffset);
									labelOffset = labelOffset+15;
								}
						});
					});
					
				}
				
			}
			$(this).children().each(function() {
				_jqpToImage(this, x_offset, y_offset);
																																			 
			});
			
			
			return newCanvas;
		};
	
		$.fn.css2 = jQuery.fn.css;
		$.fn.css = function() {
			if (arguments.length) return jQuery.fn.css2.apply(this, arguments);
			return window.getComputedStyle(this[0]);
		};
	
		// Returns font style as abbreviation for "font" property.
		$.fn.getComputedFontStyle = function() {
			var css = this.css();
			var attr = ['font-style', 'font-weight', 'font-size', 'font-family'];
			var style = [];
	
			for (var i=0 ; i < attr.length; ++i) {
				var attr = String(css[attr[i]]);
	
				if (attr && attr != 'normal') {
					style.push(attr);
				}
			}
			return style.join(' ');
		}
	
		$.fn.childText =
			function() {
				return $(this).contents().filter(function() {
					return this.nodeType == 3;  // Node.TEXT_NODE not defined in I7
				}).text();
			};
			// add the legend
    
	
	});
	
	var strDownloadMime = "image/octet-stream";
	
	var saveAsPNG= function(title, type) {
		var oCanvas = $('#chartdiv').jqplotToImage(50, 0); 
		var oScaledCanvas = oCanvas;
		var strData = oScaledCanvas.toDataURL("image/png");
		saveFile(strData, title, type);
	}
	var saveFile = function(strData, title, type) {
		 $.post("saveImg.php", { img: strData, title: title, type: type},
		 function(data) {
			 window.location= 'download.php?getfile='+data;
		 });
	}
	function getLineheight(obj) {
    var lineheight;
    if (obj.css('line-height') == 'normal') {
        lineheight = obj.css('font-size');
    } else {
        lineheight = obj.css('line-height');
    }
    return parseInt(lineheight.replace('px',''));
}

function getTextAlign(obj) {
    var textalign = obj.css('text-align');
    if (textalign == '-webkit-auto') {
        textalign = 'left';
    }
    return textalign;
}

function printAtWordWrap(context, text, x, y, fitWidth, lineheight) {
    var textArr = [];
    fitWidth = fitWidth || 0;

    if (fitWidth <= 0) {
        textArr.push(text);
    }
    
    var words = text.split(' ');
    var idx = 1;
    while (words.length > 0 && idx <= words.length) {
        var str = words.slice(0, idx).join(' ');
        var w = context.measureText(str).width;
        if (w > fitWidth) {
            if (idx == 1) {
                idx = 2;
            }
            textArr.push(words.slice(0, idx - 1).join(' '));
            words = words.splice(idx - 1);
            idx = 1;
        } else {
            idx++;
        }
    }
    if (words.length && idx > 0) {
        textArr.push(words.join(' '));
    }
    if (context.textAlign == 'center') {
        x += fitWidth/2;
    }
    if (context.textBaseline == 'middle') {
        y -= lineheight/2;
    } else if(context.textBaseline == 'top') {
        y -= lineheight;
    }
    for (idx = textArr.length - 1; idx >= 0; idx--) {
        var line = textArr.pop();
        if (context.measureText(line).width > fitWidth && context.textAlign == 'center') {
            x -= fitWidth/2;
            context.textAlign = 'left';
            context.fillText(line, x, y + (idx+1) * lineheight);
            context.textAlign = 'center';
            x += fitWidth/2;
        } else {
            context.fillText(line, x, y + (idx+1) * lineheight);
        }
    }
}
$(document).ready(function() {
	$('.printGraph').click(function(){
		window.print() ;
	});
	
	var dateRangeContext = $('.dateInputRange');
	if (dateRangeContext.length != 0) {
		setGranularity();
	}
	$('.dateRange').change(function(){
		setGranularity();
	});
	
	function setGranularity(){
		var fromDate = $('#fromDate').val();
		var toDate = $('#toDate').val();
		var days = mydiff(fromDate, toDate, "days");
		var suggestedGranularity = "monthly";
		if(days<=31){
			suggestedGranularity = "daily";
		}else if(days<=210){
			suggestedGranularity = "weekly";
		}
		$('.grainy input[value="'+suggestedGranularity+'"]').attr('checked', 'checked');
		
		$('.grainy .disabled').remove();
		
		if(days<8){
			$('.grainy input[value="weekly"]').attr('disabled', true);
			$('.weekly').append('<span class="disabled"> - Too few days, please increase range over 7 days</span>');
		}
		if(days<32){
			$('.grainy input[value="monthly"]').attr('disabled', true);
			$('.monthly').append('<span class="disabled"> - Too few days, please increase range over 31 days</span>');
			$('.grainy input[value="daily"]').removeAttr('disabled');
			$('.daily .disabled').remove();
		}
		if(days>31){
			$('.grainy input[value="daily"]').attr('disabled', true);
			$('.daily').append('<span class="disabled"> - Too many days, please reduce to below 31</span>');
			$('input[name="granularity"][value="monthly"]').removeAttr('disabled');
			$('.monthly .disabled').remove();
		}
		if(days<211){
			$('.grainy input[value="weekly"]').removeAttr('disabled');
			$('.weekly .disabled').remove();
		}
		if(days>210){
			$('.grainy input[value="weekly"]').attr('disabled', true);
			$('.weekly').append('<span class="disabled"> - Too many weeks, please reduce to below 30</span>');
		}
		
		
		
		
		
		
		
		
	}
	function mydiff(date1,date2,interval) {
    var second=1000, minute=second*60, hour=minute*60, day=hour*24, week=day*7;
    date1 = new Date(date1);
    date2 = new Date(date2);
    var timediff = date2 - date1;
    if (isNaN(timediff)) return NaN;
    switch (interval) {
        case "years": return date2.getFullYear() - date1.getFullYear();
        case "months": return (
            ( date2.getFullYear() * 12 + date2.getMonth() )
            -
            ( date1.getFullYear() * 12 + date1.getMonth() )
        );
        case "weeks"  : return Math.floor(timediff / week);
        case "days"   : return Math.floor(timediff / day); 
        case "hours"  : return Math.floor(timediff / hour); 
        case "minutes": return Math.floor(timediff / minute);
        case "seconds": return Math.floor(timediff / second);
        default: return undefined;
    }
}
		
});