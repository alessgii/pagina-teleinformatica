$(document).ready(function () {
    $('.navbar').each(function (index, elemento) {
        $(this).css({
            'top': '-200px'
        });

        $(this).animate({
            top: '0'
        }, 2000 + (index * 500));
    });

    $('.navbar-nav .nav-link').on('click', function(){
        $('.navbar-collapse').collapse('hide');
    });

    if ($(window).width() > 500) {
        $('header .descripcionInicio').css({
            opacity: 0,
            marginTop: 0
        });

        $('header .descripcionInicio').animate({
            opacity: 1,
            marginTop: '10%'
        }, 1500);

        $('.caja').css({
            opacity: 0,
            marginTop: 0
        });

        $('.caja').animate({
            opacity: 1,
            marginTop: '-20%'
        }, 1500);
    }

    $('#btn-contenido').on('click', function (e) {
        e.preventDefault();
        var destino = $('#pag_princi').offset().top;
        $('html, body').animate({ scrollTop: destino }, 500);
    });

    $('#btn-galeria').on('click', function (e) {
        e.preventDefault();
        var destino = $('#galeria').offset().top;
        $('html, body').animate({ scrollTop: destino }, 500);
    });

    $('#btn-noticias').on('click', function (e) {
        e.preventDefault();
        var destino = $('#noticias').offset().top;
        $('html, body').animate({ scrollTop: destino }, 500);
    });

    $('#btn-contacto').on('click', function (e) {
        e.preventDefault();
        var destino = $('#contacto').offset().top;
        $('html, body').animate({ scrollTop: destino }, 500);
    });



    var $elementos = $('.pag_princi');

    $elementos.css({
        opacity: 0,
        marginTop: '0%'
    });

    var observador = new IntersectionObserver(function (entradas, elObservador) {
        entradas.forEach(function (entrada) {

            if (entrada.isIntersecting) {

                $(entrada.target).animate({
                    opacity: 1,
                    marginTop: '20%'
                }, 1500);

                elObservador.unobserve(entrada.target);
            }
        });
    }, {
        rootMargin: '0px',
        threshold: 0.3 
    });

    $elementos.each(function () {
        observador.observe(this);
    });

    $('#btn-dark-mode').on('click', function(e) {
        e.preventDefault();
        
        $('body').toggleClass('dark-mode');
        
        var icono = $(this).find('i');
        
        if($('body').hasClass('dark-mode')){
            icono.removeClass('fa-moon-o').addClass('fa-sun-o');
            $(this).html('<i class="fa fa-sun-o"></i> Modo Claro');
        } else {
            icono.removeClass('fa-sun-o').addClass('fa-moon-o');
            $(this).html('<i class="fa fa-moon-o"></i> Modo Oscuro');
        }
    });

});