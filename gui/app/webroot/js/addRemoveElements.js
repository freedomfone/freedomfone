/* This script and many more are available free online at
The JavaScript Source!! http://javascript.internet.com
Created by: Dustin Diaz | http://www.dustindiaz.com/ */
var Dom = {
    get: function(el) {
	if (typeof el === 'string') {
	    return document.getElementById(el);
	} else {
	    return el;
	}
    },
    add: function(el, dest) {
	var el = this.get(el);
	var dest = this.get(dest);
	dest.appendChild(el);
    },
    remove: function(el) {
	var el = this.get(el);
	el.parentNode.removeChild(el);
    }
};
var Event = {
    add: function() {
	if (window.addEventListener) {
	    return function(el, type, fn) {
		Dom.get(el).addEventListener(type, fn, false);
	    };
	} else if (window.attachEvent) {
	    return function(el, type, fn) {
		var f = function() {
		    fn.call(Dom.get(el), window.event);
		};
		Dom.get(el).attachEvent('on' + type, f);
	    };
	}
    }()
};
Event.add(window, 'load', function() {
	var i = 0;


	Event.add('add-element', 'click', function() {
		var el = document.createElement('p');
				el.innerHTML = '<table cellspacing=0 class="blue"><tr class="blue"><td>Option </td><td><input type="text" id = "Vote'+ i +'Chtext value= "" name="data[Vote][][chtext]"></td></tr></table>';


	Dom.add(el, 'content');
		Event.add('remove-element', 'click', function(e) {
			//Dom.remove(el);
		    });
	    });
    });
