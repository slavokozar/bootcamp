$(function() {
    // Handler for .ready() called (DOM built, jQuery ready)


    $('.item-to-basket').click(function(e) {
        e.preventDefault();

        //create square element, keep reference for it in var plane
        var plane = $('<div style="background:green; width:50px; height:50px"></div>');
        //add plane element into dom -> makes it visible
        $('body').append(plane);

        //get clicked button
        var btn = $(e.target);
        var buttonCenter = elementCenter(btn);

        //position plane on center of button
        plane.css({
            'position':'absolute',
            'left': (buttonCenter.left - 25) + 'px',
            'top': (buttonCenter.top - 25) + 'px'
        });

        //get basket
        var basket = $('#basket');
        var basketCenter = elementCenter(basket);

        //animate plane to basket
        plane.animate({
            'left': (basketCenter.left - 25) + 'px',
            'top': (basketCenter.top - 25) + 'px'
        }, 500, function(){
            plane.remove();
            incBasket();
        });
    });

    //increment basket counter
    function incBasket(){
        var basketCount = $('#basket-count');
        var count = basketCount.text();

        //at the beginning we have empty counter
        if(count == '') count = 0;

        count = parseInt(count) + 1;

        basketCount.text(count);
    }


    function elementCenter(element){
        var pos = element.offset();

        //get position of corners
        var left = pos.left;
        var right = left + element.outerWidth();

        var top = pos.top;
        var bottom = top + element.outerHeight();

        //average
        var centerTop = (top + bottom) / 2;
        var centerLeft = (left + right) / 2;

        return {
            'left': centerLeft,
            'top': centerTop
        }
    }
});