 $(function () {
        var $sections = $('section');
        var count = $sections.length; 
        for(var i = 0; i < count; i++){
            $($sections[i]).find('.footer').html(
                '<a href="prev">&lt;&lt;</a>'+
                '&nbsp;'+
                '<span class="pagination">'+ (i + 1) + '/' + count +'</span>'+
                '&nbsp;'+
                '<a href="next">&gt;&gt;</a>'
            );
        }

        $(document).keydown(function(e) {
            var page = Math.round($(document).scrollTop() / $('section').height());
            var $sections = $('section');
            if(e.keyCode == 39){
                if(page < ($sections.length -1))
                $('html, body').animate({
                    scrollTop: $sections.eq(page).next().offset().top
                }, 500);
            }else if(e.keyCode == 37){
                if(page > 0)
                $('html, body').animate({
                    scrollTop: $sections.eq(page).prev().offset().top
                }, 500);
            }
        });

        $('.footer a').click(function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            var $section = $(this).closest('section');
            
            if(href == 'next'){
                $('html, body').animate({
                    scrollTop: $section.next().offset().top
                }, 500);
            }else if(href == "prev"){
                $('html, body').animate({
                    scrollTop: $section.prev().offset().top
                }, 500);
            }
            
            
        });
        
    });