
$(function(){

    // Ocultando la Navegación al hacer click
    $('div.menu-nav ul li a').on('click', function(){
        $('#nav').removeClass('show');
    });

    // Achicando barra FIXEDTOP
    $('div.menu-hamburguesa a').on('click', function(){
        $('.logo img').animate({'height': '3rem'}, 1000);
        
    });

    //Validar Formulario

    var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    $('#enviar').click(function(){
        var nombre = $('#nombre').val();
        var tel = $('#tel').val();
        var mail = $('#mail').val();
        var msg = $('#msg').val();

        if(nombre == ""){
            $('#error1').fadeIn();
            return false;
        }else {
            $('#error1').fadeOut();
        }

        if(tel == ""){
            $('#error2').fadeIn();
            return false;
        }else {
            $('#error2').fadeOut();
        }

        if (mail == "" || !expr.test(mail)) {
            $("#error3").fadeIn();
            return false;
  
        }else {
            $('#error3').fadeOut();
        }

        if (msg == "" || !expr.test(msg)) {
            $("#error4").fadeIn();
            return false;
  
        }else {
            $('#error4').fadeOut();
        }



    });

    
    var dataForm = {};
      
    $('.js_send_button').on('click', function(e){
        e.preventDefault();

        $('#js-response-form').html('');

        dataForm.nombre = $('#nombre').val();
        dataForm.apellido = $('#apellido').val();
        dataForm.tel = $('#tel').val();
        dataForm.mail = $('#mail').val();
        dataForm.msg = $('#msg').val();

        if (!dataForm.nombre.length > 0 || !dataForm.tel.length > 0 || !dataForm.mail.length > 0 || !dataForm.msg.length > 0) {
            $('#js-response-form').html('Complete los campos obligatorios');
        } else {
                
            $.ajax({
                method: "POST",
                url: "enviar.php",
                data: dataForm
            })
                .done(function( response ) {
                
                var data = JSON.parse(response)
                $('#js-response-form').html(data.message);
                $('#send_form').fadeOut();

                
                })
                .fail(function(error){
                    
                    var data = JSON.parse(error)
                    $('#js-response-form').html(data.message);
                });
        }




        
    });
        


});