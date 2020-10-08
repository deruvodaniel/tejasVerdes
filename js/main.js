$(function(){
    
    
    // Ocultando la Navegación al hacer click
    $('div.menu-nav ul li a').on('click', function(){
        $('#nav').removeClass('show');
    });

    // Achicando barra FIXEDTOP
    $('div.menu-hamburguesa a').on('click', function(){
        $('.logo img').animate({'height': '3rem'}, 1000);
    });
    
    var dataForm = {};

    

    
      
    $('.js_send_button').on('click', function(e){
        e.preventDefault();

        dataForm.name = $('#nombre').val();
        dataForm.apellido = $('#apellido').val();
        dataForm.tel = $('#tel').val();
        dataForm.mail = $('#mail').val();
        dataForm.msg = $('#msg').val();

        console.log(dataForm);
        $.ajax({
            method: "POST",
            url: "enviar.php",
            data: dataForm
          })
            .done(function( response ) {
              console.log(response);
            })
            .fail(function(error){
                console.log(error);
            });
    });
        


});