var Marquee = function(j,s,w) {
    var self = this;
    var jTarget = j;
    var strText = s;
    var intWidth = w;
    var intPaddingLeft = 60;
    var jText,intTextWidth;
    var update = function() {
        intPaddingLeft -= 1;
        if (intPaddingLeft < -intTextWidth) {
            intPaddingLeft += intTextWidth;
        }
        jText.css({'left':intPaddingLeft + 'px'});
    };
    var setup = function() {
        jText = $('<div class="scrollingtext"></div>').text(strText);
        jTarget
            .append(jText)
            .append($('<div class="fader"></div>').html('&nbsp;'))
            .append($('<div class="fader left"></div>').html('&nbsp;'));
        intTextWidth = $(jTarget).find('.scrollingtext').width();
        jTarget.width(intWidth);
        jText.text(strText + " " + strText);
        update();
    };
    setup();
    setInterval(update,30);
    return self;
};

strLoremIpsum = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut...";

jQuery(function($) {
    myMarquee = new Marquee($('div#marquee'),strLoremIpsum,960);
});