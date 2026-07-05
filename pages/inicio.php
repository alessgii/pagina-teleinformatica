<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/inicio.css">

<p class="descripcionInicio">
    El programa educativo de Ingeniería en Teleinformática se presenta como una opción de
    vanguardia
    para la formación profesional de los estudiantes.
</p>

<!-- Carrusel de imagenes -->
<div class="carrusel">
    <div class="row">
        <div class="col">
            <div id="slideshow" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" class=>
                    <div class="carousel-item active">
                        <img src="public/img/inicio/alumnosintel.jpeg" class="w-100 imgCarrusel">
                    </div>
                    <div class="carousel-item">
                        <img src="public/img/inicio/carrera.jpg" class="w-100 imgCarrusel">
                    </div>
                    <div class="carousel-item">
                        <img src="public/img/inicio/tallermantenimiento.jpeg" class="w-100 imgCarrusel">
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#slideshow"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slideshow"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide #1">
                        </button>
                        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="1" class="active"
                            aria-current="true" aria-label="Slide #2">
                        </button>
                        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="2" class="active"
                            aria-current="true" aria-label="Slide #3">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del carrusel -->

<section class="main">
    <div class="pag_princi" id="pag_princi">
        <!-- Tarjetas de acceso directo -->
        <div class="row">
            <!-- Tarjeta: perfil de la carrera -->
            <div class="col-sm-3">
                <div class="caja">
                    <div class="cont1">
                        <a href="#" class="link_titulo_pag_princi">
                            <div class="contenedor_imagenes">
                                <img class="img_perfil" src="public/img/inicio/perfil.png" alt="">
                                <img class="img_hoverPer" src="public/img/inicio/perfilLight.png" alt="">
                            </div>
                            <p class="titulo_pag_princi">Perfil de la carrera</p>
                            <p class="desc_pag_princi">Sobre la carrera de Ing. Teleinformática</p>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta: malla curricular -->
            <div class="col-sm-3">
                <div class="caja">
                    <div class="cont1">
                        <a href="index.php?page=malla_curricular" class="link_titulo_pag_princi">
                            <div class="contenedor_imagenes">
                                <img class="img_vis" src="public/img/inicio/vision.png" alt="">
                                <img class="img_hoverVis" src="public/img/inicio/visionLight.png" alt="">
                            </div>
                            <p class="titulo_pag_princi">Visualización curricular</p>
                            <p class="desc_pag_princi">¡Consulta nuestras materias!</p>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta: consulta de horario -->
            <div class="col-sm-3">
                <div class="caja">
                    <div class="cont1">
                        <a href="index.php?page=consulta_de_horarios" class="link_titulo_pag_princi">
                            <div class="contenedor_imagenes">
                                <img class="img_hora" src="public/img/inicio/horario.png" alt="">
                                <img class="img_hoverHor" src="public/img/inicio/horarioLight.png" alt="">
                            </div>
                            <p class="titulo_pag_princi">Horarios de clases</p>
                            <p class="desc_pag_princi">Mira nuestros horarios de clases</p>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta: directorio academico -->
            <div class="col-sm-3">
                <div class="caja">
                    <div class="cont1">
                        <a href="#" class="link_titulo_pag_princi">
                            <div class="contenedor_imagenes">
                                <img class="img_dir" src="public/img/inicio/directorio.png" alt="">
                                <img class="img_hoverDir" src="public/img/inicio/directorioLight.png" alt="">
                            </div>
                            <p class="titulo_pag_princi">Directorio académico</p>
                            <p class="desc_pag_princi">¿Quieres saber sobre nuestros docentes?</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seccion de galeria -->
    <section class="galeria" id="galeria">
        <p class="titulo-galeria">
            Galería
        </p>
        <div class="foto">
            <img src="public/img/inicio/img1.jpeg" class="fotoGal" alt="">
        </div>
        <div class="foto">
            <img src="public/img/inicio/img2.jpeg" class="fotoGal" alt="">
        </div>
        <div class="foto">
            <img src="public/img/inicio/img3.jpeg" class="fotoGal" alt="">
        </div>
        <div class="foto">
            <img src="public/img/inicio/img4.jpeg" class="fotoGal" alt="">
        </div>
        <div class="foto">
            <img src="public/img/inicio/img5.jpeg" class="fotoGal" alt="">
        </div>
        <div class="foto">
            <img src="public/img/inicio/img6.jpeg" class="fotoGal" alt="">
        </div>
    </section>
    <!-- Fin de secccion galeria -->


    <!-- Seccion de noticias -->
    <section class="noticias" id="noticias">
        <div class="contenedor-noticias">
            <h3>Noticias</h3>
            <div class="row">
                <div class="col-sm-6">
                    <div class="noticia">
                        <div class="noticia1">
                            <p>
                                Se gana el torneo de minisumo
                            </p>
                            <div class="img_noticias">
                                <img src="public/img/inicio/ganminisumo.jpeg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="noticia">
                        <div class="noticia1">
                            <p>INTEL y Mecatrónica juntos</p>
                            <div class="img_noticias">
                                <img src="public/img/inicio/ingenierias.jpeg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="noticiaImportante">
                        <div class="noticia1">
                            <p>Se anuncia el periodo ordinario y el periodo extraordinario</p>
                            <div class="img_noticias">
                                <img src="public/img/inicio/fechas_Calif.jpeg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Termina seccion de noticias -->


    <!-- Seccion de contacto -->
    <section class="contacto" id="contacto">
        <div class="contenedor-cotacto">
            <h3>Contacto</h3>
            <h6>¡Envía tus preguntas!</h6>
            <form class="formulario">
                <input type="text" placeholder="Nombre" name="nombre" required>
                <input type="email" placeholder="Correo" name="correo" required>
                <textarea name="mensaje" placeholder="Mensaje" required></textarea>
                <input type="submit" name="boton">
            </form>
        </div> <!--Fin div class="contenedor-contacto"-->
    </section> <!--Fin section class="contacto"-->
    <!-- Termina seccion de contacto -->


</section>

<!-- Fin section.main -->
<script src="public/js/bootstrap/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="public/js/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="public/js/inicio.js"></script>