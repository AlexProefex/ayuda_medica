
@extends('layout') 
@section('content')
      <div class="row pt-3 mr-0 ml-0">
        <section class="intro-full">
          <div class="slideronly">
            <ul>
              <li style="background-image:url({{ asset('imagenes/home.jpg') }})">
               <!-- <div class="center-y">
                  <h3>Kiru</h3>
                  <a href="#">Sistema de administracion para clinicas Odontologicas</a>	
                </div>-->
              </li>
              <li style="background-image:url({{ asset('imagenes/rse_am.jpg') }})">
               <!-- <div class="center-y">
                  <h3>RPA</h3>
                  <a href="#">View Project</a>	
                </div>-->
              </li>
              <li style="background-image:url({{ asset('imagenes/rse_sum.jpg') }})">
              <!--  <div class="center-y">
                  <h3></h3>
                  <a href="#">View Project</a>	
                </div>-->
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
              <li class="background-image" style="background-image:url({{asset('imagenes/Transformacion-digital.jpg')}})">
                <div class="center-y">
                  <h3>TRANSFORMACIÓN DIGITAL</h3>
                </div>
              </li>
              <li style="background-image:url({{asset('imagenes/negocios-digitales.jpg')}})">
                <div class="center-y">
                  <h3>NEGOCIOS DIGITALES</h3>
                </div>
              </li>
              <li style="background-image:url({{asset('imagenes/Trabajar-sin-ir-a-la-oficina.jpg')}})">
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
@endsection
 


