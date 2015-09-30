(function(onLoad) {
    try {
	
        window.addEventListener('load', onLoad, false);
    } catch (e) {
        window.attachEvent('onload', onLoad);
    }
})(function() {
    var tags = ["img","input"];
    for( var i=0, len=tags.length; i<len; i++ ) {
        var on = function() {
            this.src = this.src.replace('_off.', '_on.');
        };
        var off  = function() {
            this.src = this.src.replace('_on.', '_off.');
        };
        var el = document.getElementsByTagName(tags[i]);
        for (var j=0, len2=el.length; j<len2; j++) {
            var attr = el[j].getAttribute('src');
            if (!el[j].src.match(/_off\./)&&attr) continue;
            el[j].onmouseover = on;
            el[j].onmouseout  = off;
        }
    }
});