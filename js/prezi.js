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
            console.log(e.key);
            if(e.key == "PageDown" || e.key == "ArrowDown" || e.key == "ArrowRight"){
                console.log('down');
                if(page < ($sections.length -1))
                $('html, body').animate({
                    scrollTop: $sections.eq(page).next().offset().top
                }, 300);
            }else if(e.key == "PageUp" || e.key == "ArrowUp" || e.key == "ArrowLeft"){
                console.log('up');
                if(page > 0)
                $('html, body').animate({
                    scrollTop: $sections.eq(page).prev().offset().top
                }, 300);
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