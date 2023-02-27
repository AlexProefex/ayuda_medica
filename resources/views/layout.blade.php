<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Proefex, Kirudent, Proyectos, Desarrollo, Tecnologia, Ayuda Medica, Btrix, Sistema TPV, Terminales PV, Chatbots + IA, Marketing Digital, Analitica Web, Proyectos Proefex">

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
    
    <meta property=”og:type” content=”website” />
    <meta property=”og:title” content="Proyectos Proefex" />
    <meta property=”og:description” content="website listing proefex projects where you will find the details of each of them, both new and old" />
    <meta property=”og:image” content="{{asset('imagenes/Transformacion-digital.jpg')}}" />
    <meta property=”og:url” content="https://proyectosproefex.com/" />

    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
      {!! SEO::generate() !!}


  </head>
  <body>
    <!--<div class="col-md-12">
      <?php //var_dump( isset($data)?$data:"");?>
    </div>

    <div class="row">
      <div class="col-md-12">
          <a href="/token"> Gogle Cuenta</a>
      </div>
    </div>
  -->

    <div id="header-style">
    </div>
    <div class="container">
      @include('header')
      @yield("content")
    </div>
    @include('footer')
    <script src="{{asset('js/header.js')}}"></script>
  </body>
</html>
