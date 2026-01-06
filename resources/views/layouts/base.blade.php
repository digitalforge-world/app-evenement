<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#4f46e5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Icon Font Stylesheet -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('asset/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/bootstrap/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/bootstrap/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/bootstrap/stylese.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/bootstrap/build-bootstrap.js') }}">
    <link rel="stylesheet" href="{{ asset('asset/bootstrap/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/bootstrap/responsive.css') }}">
    <!-- Google Web Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>{{config('app.name')}}  @yield('title')</title>
</head>

<body>

<div>

    <div id="app">

            <div id="chargement" class="d-flex justify-content-center align-items-center ">
                <section id="hero" class="d-flex align-items-center justify-center">
                    <div class="col-lg-12 order-1 order-lg-2 hero-img d-flex justify-content-center align-items-center"
                        data-aos="zoom-in" data-aos-delay="200">
                       <!-- <img src="" class="img-fluid animated" alt=""
                            style="height: 100px;width:100px">-->
                    </div>
                </section>
            </div>


        <div id="contenu" class="d-none">
            @include('layouts.publicnavbar')
            <div class="" style="margin-top:65px;">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>


</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('asset/bootstrap/bootstrap.min.js') }}"></script>

<!-- Font Awesome JS -->
<script src="{{ asset('asset/bootstrap/all.js') }}"></script>
<script src="{{ asset('asset/bootstrap/js.js') }}"></script>
<script src="{{ asset('asset/bootstrap/jquery.js') }}"></script>
<script src="{{ asset('asset/bootstrap/build-bootstrap.js') }}"></script>
<script src="{{ asset('asset/bootstrap/main.js') }}"></script>
<script src="{{ asset('asset/bootstrap/aos.js') }}"></script>
<style>
    a{
        text-decoration: none;
    }
</style>
</body>
</html>

