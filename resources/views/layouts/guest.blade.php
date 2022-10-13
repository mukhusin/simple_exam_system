<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>Sauti ya Unabii</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <!-- Template CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/skins/blue.css') }}" />

    <!-- Revolution Slider CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/revolution/css/settings.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/revolution/css/layers.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/revolution/css/navigation.css') }}" />

    <!-- Live Style Switcher - demo only -->
    <link rel="alternate stylesheet" type="text/css" title="blue" href="{{ asset('css/skins/blue.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="blueviolet" href="{{ asset('css/skins/blueviolet.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="goldenrod" href="{{ asset('css/skins/goldenrod.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="green" href="{{ asset('css/skins/green.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="magenta" href="{{ asset('css/skins/magenta.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="orange" href="{{ asset('css/skins/orange.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="purple" href="{{ asset('css/skins/purple.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="red" href="{{ asset('css/skins/red.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="yellow" href="{{ asset('css/skins/yellow.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="yellowgreen" href="{{ asset('css/skins/yellowgreen.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/skins/yellow.css') }}" />
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/styleswitcher.css') }}" /> --}}
     <!-- Toastr -->
     <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">

    <!-- Template JS Files -->
    <script src="{{ asset('js/modernizr.js') }}"></script>
</head>

<body class="skew">
    
    <main>
        <div class="preloader" id="preloader">
            <div class="logopreloader">
                <img src="{{ asset('img/preloaders/preloader-yellow-light.svg') }}" alt="logo-black">
            </div>
            <div class="loader" id="loader"></div>
              <!-- Preloader Ends -->
              <!-- Page Wrapper Starts -->
        </div>
        <div class="wrapper">
            <!-- Header Starts -->
            @include('layouts.header')
            <!-- Header Ends -->
            @yield('contents')
            @include('layouts.footer')
        </div>
        <!-- Wrapper Ends -->
    </main>

     <!-- Template JS Files -->
     <script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
     <script src="{{ asset('js/plugins/jquery.easing.1.3.js') }}"></script>
     <script src="{{ asset('js/plugins/bootstrap.min.js') }}"></script>
     <script src="{{ asset('js/plugins/jquery.bxslider.min.js') }}"></script>
     <script src="{{ asset('js/jquery.form.js') }}"></script>
     <script src="{{ asset('js/plugins/jquery.filterizr.js') }}"></script>
     <script src="{{ asset('js/plugins/jquery.magnific-popup.min.js') }}"></script>
 
     <!-- Revolution Slider Main JS Files -->
     <script src="{{ asset('js/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
     <script src="{{ asset('js/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
 
     <!-- Revolution Slider Extensions -->
 
     <script src="{{ asset('js/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
     <script src="{{ asset('js/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
     <script src="{{ asset('js/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
     <script src="{{ asset('js/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
     <script src="{{ asset('js/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
     <script src="{{ asset('js/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
     <script src="{{ asset('js/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
     <script src="{{ asset('js/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
     <script src="{{ asset('js/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
      <!-- Toastr -->
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
 
     <!-- Live Style Switcher JS File - only demo -->
     <script src="js/styleswitcher.js"></script>
 
     <!-- Main JS Initialization File -->
     <script src="js/custom.js"></script>
     @yield('javascript')
</body>

</html>
