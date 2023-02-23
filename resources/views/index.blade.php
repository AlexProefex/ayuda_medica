<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Proefex, Kirudent, Proyectos, Desarrollo, Tecnologia, Ayuda Medica, Btrix, Sistema TPV, Terminales PV, Chatbots + IA, Marketing Digital, Analitica Web, Proyectos Proefex">
    <meta name=”title” content="Proyectos Proefex" />
    <meta name="description" content="website listing proefex projects where you will find the details of each of them, both new and old">
    <meta name="author" content="Proefex">
    <meta name="robots" content="index" />
    <link rel="icon" href="{{ asset('imagenes/cropped-favicon-100x100.png') }}" sizes="32x32">
    <title>Proyectos</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">


    <meta property=”og:type” content=”website” />
    <meta property=”og:title” content="Proyectos Proefex" />
    <meta property=”og:description” content="website listing proefex projects where you will find the details of each of them, both new and old" />
    <meta property=”og:image” content="{{asset('imagenes/Transformacion-digital.jpg')}}" />
    <meta property=”og:url” content="https://proyectosproefex.com/" />


  </head>
  <body>

  <div class="row">
        <div class="col-md-12">
        <?php var_dump( isset($data)?$data:"");?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            <a href="/token"> Gogle Cuenta</a>
        </div>
      </div>
    <div class="container">
      <div class="row mr-0">
          <div class="col-md-4">
            <h1 class="text-muted font-weight-bold titleProefex">PROEFEX</h1>
          </div>
          <div class="col-md-8">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link active nav-text font-weight-bolder" href="https://proyectosproefex.com/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-text font-weight-bolder" href="https://proefexperu.com/">Quienes Somos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-text font-weight-bolder" href="https://proefexperu.com/servicios-y-asesoria/">Servicios</a>
              </li>
            </ul>
          </div>
      </div>
      <div class="row pt-3 mr-0 ml-0">
        <section class="intro-full">
          <div class="slideronly">
            <ul>
              <li style='background-image: url("{{asset('imagenes/home.jpg')}}");'>
              </li>
              <li style='background-image: url("{{asset('imagenes/rse_am.jpg')}}");'>
              </li>
              <li style='background-image: url("{{asset('imagenes/rse_sum.jpg')}}");'>
              </li>
            </ul>
            <div>
              <nav>
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
              </nav>
            </div>
          </div>
        </section>
      </div>
      <div class="row pt-3 mr-0 ml-0">
        <div class="col-md-12">
          <h2 class="pb-2"><span >Alianzas</span><h2>
          <div id="Anuncios" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active align-middle">
                        <img src="{{ asset('imagenes/atom.jpg') }}" class="img-fluid mx-auto d-block" alt="Atom">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/bitrix24.jpg') }}" class="img-fluid mx-auto d-block" alt="Bitrix24">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/hiopos.jpg') }}" class="img-fluid mx-auto d-block" alt="Hiopos">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/netelip.jpg') }}" class="img-fluid mx-auto d-block" alt="Netelip">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/sirena.jpg') }}" class="img-fluid mx-auto d-block" alt="Sirena">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/make-partner.jpg') }}" class="img-fluid mx-auto d-block" alt="Make Partner">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/ap_badge.png') }}" class="img-fluid mx-auto d-block" alt="Agency Partner">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/atom.jpg') }}" class="img-fluid mx-auto d-block" alt="Atom">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/bitrix24.jpg') }}" class="img-fluid mx-auto d-block" alt="img2">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/hiopos.jpg') }}" class="img-fluid mx-auto d-block" alt="img3">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/netelip.jpg') }}" class="img-fluid mx-auto d-block" alt="img4">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/sirena.jpg') }}" class="img-fluid mx-auto d-block" alt="img5">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/make-partner.jpg') }}" class="img-fluid mx-auto d-block" alt="Make Partner">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="{{ asset('imagenes/ap_badge.png') }}" class="img-fluid mx-auto d-block" alt="Agency Partner">
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
        <section class="intro">
          <div class="left">
            <div>
              <span >Innovación</span>
              <h1 class="title-h1">PENSANDO EN TRANSFORMACION DIGITAL</h1>
              <p class="content-body">De seguro has escuchado hablar de Transformación Digital en los últimos meses y más aún tras los grandes avances digitales a los que muchos negocios se han visto obligados a adoptar tras la pandemia del Covid-19</p>
            </div>
          </div>
          <div class="slider">
            <ul>
              <li class="background-image" style="background-image:url({{asset('imagenes/Transformacion-digital.jpg')}});">
                <div class="center-y">
                  <h3>TRANSFORMACIÓN DIGITAL</h3>
                </div>
              </li>
              <li style="background-image:url({{asset('imagenes/negocios-digitales.jpg')}});">
                <div class="center-y">
                  <h3>NEGOCIOS DIGITALES</h3>
                </div>
              </li>
              <li style="background-image:url({{asset('imagenes/Trabajar-sin-ir-a-la-oficina.jpg')}});">
                <div class="center-y">
                  <h3>VIRTUAL JOBS</h3>
                </div>
              </li>
            </ul>
            <div>
              <nav>
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
              </nav>
            </div>
          </div>
        </section>
      </div>
    </div>
    <div class="row ml-0 mr-0">
      <div class="col-md-12 ml-0 mr-0 pr-0 pl-0">
        <footer class="mainfooter" role="contentinfo">
          <div class="footer-middle">
            <div class="container">
                <div class="row">
                  <div class="col-md-3 col-sm-6">
                    <div class="footer-pad">
                      <h4>ASOCIADOS A:</h4>
                      <div class="card-body w-100 col">
                        <div class="img-logo">
                          <img src="{{asset('imagenes/LOGO-EN-PNG_b.png')}}" class="w-100 pb-4">
                        </div>
                      </div>
                      <h4>NOSOTROS</h4>
                        <ul class="list-unstyled">
                          <li><a href="#"></a></li>
                          <li><a href="#">GRUPO PROEFEX</a></li>
                          <li><a href="https://proefexperu.com/nosotros">Misión – Visión – Valores</a></li>
                          <li><a href="https://proefexperu.com/rse">RSE</a></li>
                          <li><a href="https://proefexperu.com/prensa">Prensa</a></li>
                          <li><a href="https://proefexperu.com/brochure">Brochure</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <!--Column1-->
                    <div class="footer-pad">
                      <h4>SERVICIOS</h4>
                      <ul class="list-unstyled">
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/#mkt-digital">Marketing Digital + Analítica Web</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/#web-ecommerce">Web & eCommerce</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/#facturacion-electronica">Facturación Electrónica</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/#automatizacion">Automation</a></li>
                        <li><a href="#">Chatbots + IA</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/#apps">Apps Web y  Móviles</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/#crm">CRM</a></li>
                        <li><a href="#">Centralita Virtual</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/#tour-360">Tour Virtual 360°</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/#ubicacion">Ubicación y Proximidad</a></li>
                        <li><a href="#">VR/AR</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/#automatizacion">Sistema TPV</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <!--Column1-->
                    <div class="footer-pad">
                      <h4>PRODUCTOS</h4>
                      <ul class="list-unstyled">
                        <li><a href="https://proefexperu.com/categoria-producto/tpv">Terminales PV</a></li>
                        <li><a href="https://proefexperu.com/categoria-producto/impresion-3d">Impresoras 3D</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/categoria-producto/rpas-drones">RPAS – Drones</a></li>
                        <li><a href="https://proefexperu.com/categoria-producto/domotica-onmotica">Domótica / Inmótica</a></li>
                        <li><a href="https://proefexperu.com/categoria-producto/lifi">Li-Fi</a></li>
                        <li><a href="https://proefexperu.com/servicios-y-asesoria/categoria-producto/pintura-pizarra-corporativa">Pintura de Pizarra Corporativa</a></li>
                        <li>
                          <a href="#"></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-3 mb-4">
                    <div class="footer-pad">
                        <h4>SUSCRÍBETE</h4>
                        <ul class="list-unstyled">
                          <li><span class="text-foo">Déjanos tus datos y recibe la mejor información de tecnología, innovación y marketing.</span></li>
                          <li>
                            <a href="#"></a>
                          </li>
                        </ul>
                        <h4>POLITICAS</h4>
                        <ul class="list-unstyled">
                          <li><span class="text-foo politics">Terminos y Condiciones de Servicio</span></li>
                          <li><span class="text-foo politics">Politica de Privacidad</span></li>
                        </ul>
                    </div>
                    <h4>CONTÁCTANOS</h4>
                    <ul class="social-network social-circle">
                      <li><a href="https://www.facebook.com/grupo.proefex/" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="https://pe.linkedin.com/company/proefex" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                      <li><a href="https://api.whatsapp.com/send?phone=51989551657&text=*%C2%A1Hola%20PROEFEX!*%20estoy%20interesado%20en%20sus%20servicios%20y%20quisiera%20que%20me%20contacten." class="icoWhatsapp" title="WhatsApp"><i class="fa fa-whatsapp"></i></a></li>
                    </ul>				
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 copy">
                    <div class="card-body col d-flex justify-content-center">
                      <div class="img-logo-proefex">
                        <img class="text-center img-fluid rounded" src="{{asset('imagenes/logo-fondo_oscuro.png')}}">
                    </div>
                    </div>
                    <div class="col-md-12">
                      <p class="text-center"> PROEFEX S.R.L. &copy; 2023</p>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="{{asset('js/header.js')}}"></script>
  </body>
</html>