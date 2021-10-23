$(function(){
    $("#backtoblog2 a").html("Back to Main Page");
    $("#backtoblog2 a").show();
    $("#login h1 a").attr("href","https://www.mybizniche.com/phoenix-web-design/");
    $("#login h1 a").attr("target","_blank");
    $("#rememberme").customCheckbox();
 });
 
 $.fn.customCheckbox = function(){
     var s = $(this);
 
     $(s).each(function(i,val){
         $(this).click(function(e){
             $(this).closest('label').removeClass("active");
             check($(this));
         });
         $(this).closest('label').addClass("mbn-custom-checkbox");
         reset($(this));
     });
 
     function reset(s){
         $(s).closest('label').removeClass("active");
         $(s).each(function(i,val){
             check($(this));
         });
     }
    
     function check(r){
         
         if($(r).prop("checked")==true){
             console.log(r);
           $(r).parent().addClass("active");
         }else{
             $(r).parent().removeClass("active");
         }
     }
 }