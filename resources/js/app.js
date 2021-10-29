(function($){

    var app = {
        onReady: function(){
            app.customDropdown();
        },	
        onLoad: function(){
            $(document).foundation();
            app.utils();
        },


		utils: function(){
            
            $('.navbar .btn-user').click(function(){
                $('#header').toggleClass('show-account');
                $('#header').removeClass('show-classes');
                $('#header').removeClass('show-menu');
            });
            
            $('.navbar .btn-classes').click(function(){
                $('#header').toggleClass('show-classes');
                $('#header').removeClass('show-account');
                $('#header').removeClass('show-menu');
            });

            $(window).scroll(function() {                
                var sticky = false;
                var top = $(window).scrollTop();
                    
                if ( top > 0 ) {
                    $('.sticky').addClass('is-stuck');
                    $('.sticky').removeClass('is-anchored');
                    sticky = true;
                } else {
                        $('.sticky').addClass('is-anchored');
                        $('.sticky').removeClass('is-stuck');
                }      
            });

            $('.border').each(function(){

                var img_width = $(this).find('img').attr('width');
                $(this).attr('style', 'max-width:' + img_width + 'px');
            });

            //smooth scroll
            $('a[href^="#"]').on('click',function (e) {
                e.preventDefault();
                var target = this.hash;
                var $target = $(target);
                
                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top -120
                }, 900, 'swing');
            });
            
        },

        customDropdown: function() {
            $('.custom_dropdown > li').hover(function(){
                $(this).addClass('hover');
            }, function(){
                $(this).removeClass('hover');
            })

            $('.custom_dropdown > li').click(function(){
                $(this).toggleClass('hover');
            });

            
        }
        
        
    }


    document.addEventListener('DOMContentLoaded', app.onReady);
    window.addEventListener('load', app.onLoad);

})(jQuery);
