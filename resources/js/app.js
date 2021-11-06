 

(function($){
    var app = {
        onReady: function(e){
            app.customDropdown();
        },	
        onLoad: function(e){
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

            var header = $('header.et-l--header');

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

                if ( top > 0 ) {                    
                    header.removeClass('is-top').addClass('is-stick');
                } else {
                    header.removeClass('is-stick').addClass('is-top');
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
           
            //get hash of location
            var current_loc = window.location.href;
            var home_url = window.location.origin;
            var new_link = '';


            $('.nav-cta a').each(function(e){

                if (current_loc.indexOf("vinyl")) {
                    new_link = `${home_url}/vinyl-flooring/#contact`;
                    $('.nav-cta a').attr('href', new_link);
                    
                }
                else if (current_loc.indexOf("dustless")){
                    new_link = `${home_url}/dustless-tile-removal/#contact`;
                    $('.nav-cta a').attr('href', new_link);
                }
               //e.stopPropagation();

               console.log(new_link);
               $(this).click(function(e){

                window.location.href = new_link;
                e.stopPropagation();
                e.preventDefault();
               });
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
