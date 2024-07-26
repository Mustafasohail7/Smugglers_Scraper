<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Smugglers OMS Scrapper</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset ('css/style.css')}}">
</head>
<body>
    <div id="app">
        <div id="header">
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <a class="navbar-brand d-block d-lg-none" href="{{ url('/') }}">
                    <img src="{{ url('/images/logo.png') }}" alt="logo" style="width: 100px;">
                </a>
                <button class="navbar-toggler navbar_toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav leftnav">
                  
                    </ul>
                    <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">
                    <img src="{{ url('/images/logo.png') }}" alt="logo" style="width: 100px;">
                </a>
                    <ul class="navbar-nav rightnav">
                        
                        <li class="navbar-nav">
                            <a class="nav-link" href="{{ route('login') }}">Log in</a>
                            <a class="nav-link" href="{{ route('register') }}">Sign up</a>

                            </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

        

        <main class="">
            
            @if ($flash = session('message'))
        <div class="container" style="justify-content: center;display: flex;">
            <div class="col-md-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $flash }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
            </div>
        </div>
        @elseif ($flash = session('error'))
        <div class="container" style="justify-content: center;display: flex;">
            <div class="col-md-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $flash }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>
        </div>
        @endif
            @yield('content')
        </main>

        
    </div>
</body>
</html>


