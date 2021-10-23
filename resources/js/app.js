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
                var getTop = $('.courses_results').offset().top;
                if ($(this).scrollTop() > getTop){  
                    $('.filter_sticky').addClass("active");
                }
                else{
                    $('.filter_sticky').removeClass("active");
                }
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
