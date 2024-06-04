<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Pagina principal | IoTProject v1.0.1 </title>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Icono -->
  <link href="Assets/Img/logo-sena.png" rel="icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet" />

  <!-- Library CSS Files -->
  <link href="Assets/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="Assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <link href="Assets/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- libreria de efecto de scroll -->
  <link href="Assets/node_modules/aos/dist/aos.css" rel="stylesheet" />
  <script src="Assets/node_modules/aos/dist/aos.js"></script>
  <!-- Swiper - libreria de  sliders -->
  <link href="Assets/node_modules/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <script src="Assets/node_modules/swiper/swiper-bundle.min.js"></script>
  <!-- Main CSS and JS Files -->
  <link href="Assets/Css/Styles.css" type="text/css" rel="stylesheet" />
  <script src="Assets/Js/Index.js"></script>
</head>

<body>
  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <div class="logos-position">
        <img src="Assets/Img/logo-sena.png" id="logo-sena" />
        <hr>
        <a class="logo text-center">
          <h1 class="riseL">Tecnoparque</h1>
          <h5 class="serviciosTec">Nodo Neiva</h5>
        </a>
      </div>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#hero">Inicio</a></li>
          <li><a href="#about">Acerca de</a></li>
          <li><a href="#faq">Preguntas frecuentes</a></li>
          <a href="<?php echo base_url() ?>inicio-sesion" class="boton-login">
            <p>Iniciar sesión</p>
          </a>
          <!-- <a href="Views/Login.php" class="boton-login">
            <p>Iniciar sesión</p>c
          </a> -->
        </ul>
      </nav>

      <!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
  </header>
  <!-- End Header -->
  <section id="hero" class="hero section-2-new">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-12 order-lg-1 d-flex flex-column justify-content-center text-center caption">
          <h2>Tecnoparque<span class="sub-botton"> Nodo Neiva </span></h2>
          <p class="sub-headerText">
            Soluciones IoT
          </p>
        </div>
      </div>
    </div>

    <div class="icon-boxes position-relative">
      <div class="container position-relative">
        <div class="row gy-4 mt-5">
          <div class="col-xl-4 col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-gear"></i></div>
              <h4 class="title">
                <a class="stretched-link">Linea de ingeniería y Diseño</a>
              </h4>
              <h6>
                <a class="stretched-link">Diseño de productos, desde la conceptual hasta la fabricación
                  funcionales de herramientas, maquinaria, y productos de consumo</a>
              </h6>
            </div>
          </div>

          <div class="col-xl-4 col-md-4 card-two" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-headset-vr"></i></div>
              <h2 class="title">
                <a class="stretched-link">Linea de Técnologias Virtuales</a>
              </h2>
              <h6>
                <a class="stretched-link">Desarrolo de sistemas informaticos, desarrollo y diseño de videojuegos,
                  producción de contenidos 2D y 3D, animación digital, realidad virtual y aumentada, inteligencia
                  artificial y computacional.
                </a>
              </h6>
            </div>
          </div>

          <div class="col-xl-4 col-md-4" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-broadcast-pin"></i></div>
              <h4 class="title">
                <a href="" class="stretched-link">Linea de Electronica y Telecomunicaciones</a>
              </h4>
              <h6>
                <a class="stretched-link">Automatización e instrumentación, diseño y fabricación de circuitos PCB,
                  sistemas de Energias Renovables,
                  microcontroladores ARM, internet de las cosas IoT.
                </a>
              </h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <main id="main">
    <!-- - - - - - - - -  About Us Section - - - - - - - -  -->
    <section id="about" class="about section-3-new">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Acerca del proyecto</h2>

          <p>Se ha creado un innovador dashboard diseñado específicamente para la visualización de variables atmosféricas. Este
            sistema está meticulosamente estructurado para facilitar su uso a cualquier talento en el Tecnoparque Nodo
            Neiva, brindando a los usuarios la capacidad de visualizar de manera eficiente los datos recopilados por sus
            proyectos de IoT. Este dashboard no solo representa una herramienta tecnológica avanzada, sino también un
            recurso valioso que potencia la comprensión y la toma de decisiones informadas en el ámbito de las variables
            atmosféricas. La interfaz intuitiva y amigable del dashboard garantiza que los usuarios, independientemente
            de su nivel de experiencia, puedan aprovechar al máximo la riqueza de datos proporcionados por sus
            dispositivos IoT, fomentando así la innovación y la colaboración en Tecnoparque Nodo Neiva.
          </p>

        </div>

        <div class="row gy-4">
          <div class="col-lg-4">
            <img src="Assets/Img/prototipo.jpeg" class="img-fluid rounded-4 mb-4 about-img" alt="Prototipo" />
          </div>
          <div class="col-lg-8">
            <div class="content ps-0 ps-lg-5">
              <p>
                Para la realización de este proyecto se han tenido
                en cuenta los siguientes parametros:
              </p>
              <ul>
                <li>
                  <i class="bi bi-1-square"></i> Se ha diseñado y construido
                  un sistema de login, el cual cuenta con el rol de administrrador,
                  lo que permite la creación de cuentas de usuario para cada proyecto
                  alojado en el dashboard.
                </li>
                <li>
                  <i class="bi bi-2-square"></i> Se ha construido un panel de visualización
                  de datos, el cual permite apreciar de manera clara, amigable y precisa los
                  datos captados por el dispositivo IoT, la visualización de los datos se presenta
                  en un conjunto de graficas cuidadosamente seleccionadas para garantizar una visualización
                  clara y precisa de los datos.
                </li>
                <li>
                  <i class="bi bi-3-square"></i> Se ha agregado la opción de descarga de los datos almacenados por la base de datos
                  esto mediante la generación de reportes por rango de fecha, lo cual pone a disposición los datos para ser analizados
                  de manera mas profunda, permitiendo asi una toma de deción segura en base a la data.
                </li>
                <li>
                  <i class="bi bi-4-square"></i> Se ha dispuesto el uso del FTP del server para el envio de los datos desde cada uno de los
                  proyectos IoT que se alojen en el presente dashboard, lo cual permite un medio de comunicación entre el dispositivo y el
                  presente desarrollo, garantizando la disponibilidad, integridad y seguridad de la data transmitida.
                </li>
                <li>
                  <i class="bi bi-5-square"></i> Se desarrollo un Socket, el cual permite el almacenamiento de la información
                  recibida por el FTP del servidor, a la base de datos, garantizando el correcto almacenamiento de la información
                  dejandola a disposición del usuario, para que esta pueda ser consutada en cualquier lugar y momento.
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- - - - - - - - -  Clients Section - - - - - - - -  -->
    <section id="clients" class="clients">
      <div class="container" data-aos="zoom-out">
        <div class="clients-slider swiper container-carrusel2">
          <div class="swiper-wrapper align-items-center container-carrusel2">
            <div class="swiper-slide img-carrusel2">
              <img src="Assets/Img/rise/prototipo1.png" class="img-fluid" alt="" />
            </div>
            <div class="swiper-slide img-carrusel2">
              <img src="Assets/Img/rise/prototipo2.jpg" class="img-fluid" alt="" />
            </div>
            <div class="swiper-slide img-carrusel2">
              <img src="Assets/Img/rise/prototipo3.jpg" class="img-fluid" alt="" />
            </div>
            <div class="swiper-slide img-carrusel2">
              <img src="Assets/Img/rise/prototipo4.jpg" class="img-fluid" alt="" />
            </div>
            <div class="swiper-slide img-carrusel2">
              <img src="Assets/Img/rise/prototipo1.png" class="img-fluid" alt="" />
            </div>
            <div class="swiper-slide img-carrusel2">
              <img src="Assets/Img/rise/prototipo2.jpg" class="img-fluid" alt="" />
            </div>
            <div class="swiper-slide img-carrusel2">
              <img src="Assets/Img/rise/prototipo3.jpg" class="img-fluid" alt="" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Clients Section -->

    <!-- - - - - - - - -  Call To Action Section - - - - - - - -  -->
    <section id="call-to-action" class="call-to-action">
      <div class="container text-center" data-aos="zoom-out">
        <h3>
          "La innovación es lo que distingue a un lider de los demas"<br>
          Steve Jobs.
        </h3>
      </div>
    </section>
    <!-- End Call To Action Section -->

    <!-- - - - - - - - -  Frequently Asked Questions Section - - - - - - - -  -->
    <section id="faq" class="faq section-2-new">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-lg-12">
            <div class="content text-center">
              <h3>Preguntas <strong>frecuentes</strong></h3>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">
              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    <span class="num"><i class="bi bi-1-square"></i></span>
                    Que es Tecnoparque?
                  </button>
                </h3>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Es un programa de
                    innovación tecnológica del
                    SENA, que actúa como
                    acelerador para el desarrollo
                    de proyectos de I+D+I
                    materializados en prototipos
                    funcionales, promoviendo el
                    emprendimiento de base
                    tecnológica
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    <span class="num"><i class="bi bi-2-square"></i></span>
                    ¿Para quienes?
                  </button>
                </h3>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Residentes de Colombia con
                    potencial para la concepción
                    de sus ideas innovadoras
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    <span class="num"><i class="bi bi-3-square"></i></span>
                    ¿Como lo hace?
                  </button>
                </h3>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    * Asesoría de expertos por
                    línea tecnológica<br>
                    * Laboratorios especializados<br>
                    * Alianzas estratégicas para
                    potencializar proyectos
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                    <span class="num"><i class="bi bi-4-square"></i></span>
                    Lineas Técnologicas
                  </button>
                </h3>
                <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    * Ingeniería y Diseño <br>
                    * Tecnologías Virtuales <br>
                    * Electrónica y
                    Telecomunicaciones
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


  </main>
  <!-- WhatsApp Icon -->
  <div class="whatsapp-container">
    <a href="https://api.whatsapp.com/send?phone=" class="btn btn-lg btn-whatsapp" target="_blank">
      <i class="bi bi-whatsapp whatsapp-icon"></i>
    </a>
  </div>
  <style>
    /* Estilos para el contenedor */
    .whatsapp-container {
      position: fixed;
      bottom: 10px;
      /* Distancia desde la parte inferior */
      right: 10px;
      /* Distancia desde la parte derecha */
      z-index: 1000;
      /* Asegúrate de que esté por encima de otros elementos */
    }

    /* Estilos para el ícono de WhatsApp */
    .whatsapp-icon {
      color: #25D366 !important;
      font-size: 3rem;
    }

    /* Estilos para el texto de WhatsApp */
    .whatsapp-text {
      margin-left: 10px;
      /* Espacio entre el ícono y el texto */
      font-size: 1.5rem;
      /* Tamaño del texto */
    }
  </style>
  <footer id="footer" class="footer">
    <div class="logos-footer"></div>
    <div class="container">
      <div class="row gy-4">
        <div class="footer-info text-center">
          <div>
            <p class="sub-headerText">Centro de la Empresa la Industria y los Servicios <br>
              Carrera 9 No 68-50, NEIVA - PBX (60 8) 8757040 IP 83352
            </p>
          </div>
          <div class="social-links d-flex mt-4 justify-content-center">
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-youtube"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
          <div class="enlaces-sena d-flex flex-column justify-content-center align-items-center">
            <a>@SENAComunica</a>
            <a href="https://www.sena.edu.co" target="_blank">www.sena.edu.co</a>
            <a href="https://industriaempresayservicios.blogspot.com/p/servicios-tecnologicos.html" target="_blank">https://industriaempresayservicios.blogspot.com/p/servicios-tecnologicos.html</a>
          </div>

          <div class="copyright">&copy; Copyright. All Rights Reserved</div>
        </div>
      </div>
    </div>
    <div class="logos-footer2">
    </div>
  </footer>



  <div id="preloader"></div>


</body>

</html>