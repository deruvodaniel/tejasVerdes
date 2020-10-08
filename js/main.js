$(function(){
    'use strict';
    
    // Ocultando la Navegación al hacer click
    $('div.menu-nav ul li a').on ('click', function(){
        $('#nav').removeClass('show');
    });

    // Achicando barra FIXEDTOP
    $('div.menu-hamburguesa a').on ('click', function(){
        $('.logo img').animate({'height': '3rem'}, 1000);
    });
    
      
    
        


});