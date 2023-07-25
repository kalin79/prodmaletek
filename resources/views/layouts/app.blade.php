<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('architec-ui.partials.head')
<body>
{{--app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar--}}
{{--fixed-footer--}}
<div class="app-container app-theme-white body-tabs-shadow fixed-header closed-sidebar " id="app">

    @include('architec-ui.partials.header')

    <div class="app-main">
        @include('architec-ui.partials.sidebar')

        <div class="app-main__outer">

            <div class="app-main__inner">
                <div class='side-body'>   </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts.messages.message')
                    </div>
                </div>
                @yield('content')

            </div>
            @include('architec-ui.partials.footer-bar')
        </div>
    </div>


</div>
<div class="body-block-loading-1 d-none">
    <div class="loader bg-transparent no-shadow p-0">
        <div class="ball-grid-pulse">
            <div class="bg-white"></div>
            <div class="bg-white"></div>
            <div class="bg-white"></div>
            <div class="bg-white"></div>
            <div class="bg-white"></div>
            <div class="bg-white"></div>
            <div class="bg-white"></div>
            <div class="bg-white"></div>
            <div class="bg-white"></div>
        </div>
    </div>
</div>

@include( 'architec-ui.partials.footer' )
</body>
</html>

<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
</style>

