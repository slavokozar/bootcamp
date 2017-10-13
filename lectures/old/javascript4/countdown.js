$.fn.countdown = function(options){
    this.each(function(){
        var countdown = $(this);

        var settings = $.extend({
            'secs' : true,
            'mins' : true,
            'hrs' : true,
            'days' : true,
            'date' : '2017, 6, 3'
        }, options);

        var date_countdown = new Date(settings.date);

        function showTime(){
            var date_now = new Date();

            var diff = date_countdown.getTime() - date_now.getTime();

            var secs = diff / 1000;
            var mins = secs / 60;
            var hrs = mins / 60;
            var days = hrs / 24;

            days = Math.floor(days);
            hrs = Math.floor(hrs - (days * 24));
            mins = Math.floor(mins - ((days * 24 + hrs) * 60));
            secs = Math.floor(secs - (((days * 24 + hrs) * 60) + mins) * 60);

            countdown.empty();
            if(settings.days) countdown.append('<h1>'+ days +'</h1>');

            if(settings.hrs) countdown.append('<h1>'+ hrs +'</h1>');

            if(settings.mins) countdown.append('<h1>'+ mins +'</h1>');

            if(settings.secs) countdown.append('<h1>'+ secs +'</h1>');
        }

        showTime();
        var interval = setInterval(function(){
            showTime();
        }, 1000);

        countdown.data('interval', interval);
    });

    return this;
};

$.fn.stopdown = function(){
    this.each(function(){
        var interval = $(this).data('interval');
        clearInterval(interval);
    });
    return this;
}



