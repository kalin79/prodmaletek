<!DOCTYPE html>
<html lang="es">
<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    @yield('meta_tags')

    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div id="app" class="backgroundGlobal">
    <div class="contentBlur">
        @include('includes.frontend.header.header')
        @yield('content')
        @include('includes.frontend.footer.footer')
        <a href="https://wa.link/8y73a4" target="_blank" class="boxWhatsApp" id="boxWhatsApp" style="display: none">
            <div class="relative">
                <img src="/frontend/images/whatsApp.svg" alt="" >
                <div class="boxTextWhatsApp">
                    <p>
                        Contacta con un asesor...
                    </p>
                </div>
            </div>
        </a>
    </div>
</div>
{{-- @include('includes.frontend.load.load') --}}
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>