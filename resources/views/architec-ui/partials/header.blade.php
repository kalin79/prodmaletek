{{--app-header header-shadow bg-info header-text-light--}}
{{--bg-dark header-text-light--}}
{{--app-header header-shadow bg-primary header-text-light--}}
{{--bg-primary--}}
<div class="app-header header-shadow header-text-light " style="background: linear-gradient(74.62deg, #017BC0 4.79%, #0090DD 82.12%);">
    <div class="app-header__logo">
        {{--        logo-src--}}
        {{--        <div class="logo-src"></div>--}}
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
            </button>
        </div>
        <a href="{{route('dashboard.index')}}" class="text-white pl-2 p-0">
            <h1 style="font-size: 22px" class="p-0 m-0 mb-1">{{ env('APP_NAME') }}</h1>
        </a>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header__content">
        <div class="d-none d-lg-block">
            <a href="{{route('dashboard.index')}}" class="app-header-left text-white">
                {{--                <span class="d-inline-block pr-2">--}}
                {{--                    <img src="/images/logo-min.png" width="18px" alt="">--}}
                {{--                </span>--}}
                <h1 style="font-size: 22px" class="p-0 m-0  ">{{ env('APP_NAME') }}</h1>
            </a>
        </div>
        <div class="app-header-right">
            {{--            <div class="search-wrapper">--}}
            {{--                <div class="input-holder">--}}
            {{--                    <input type="text" class="search-input" placeholder="Buscar ...">--}}
            {{--                    <button class="search-icon"><span></span></button>--}}
            {{--                </div>--}}
            {{--                <button class="close"></button>--}}
            {{--            </div>--}}


            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                   class="p-0 btn">
                                    <img width="42" class="rounded-circle user_avatar" src="{{asset('/iso.svg')}}"
                                         alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                     class="rm-pointers dropdown-menu-xs dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-night-sky">
                                            <div class="menu-header-image opacity-2"
                                                 style="background-image: url('{{ asset('architec-ui/images/dropdown-header/city3.jpg') }}');"></div>
                                            <div class="menu-header-content text-left">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle user_avatar"
                                                                 src="{{asset('/iso.svg')}}"
                                                                 alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">{{ Auth::user()->name }}
                                                            </div>
                                                            <div class="widget-subheading opacity-8">
                                                                @foreach(Auth::user()->role as $role)
                                                                    {{ $role->title }}
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right mr-2">


                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                  method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid-menu grid-menu-2col">
                                        <div class="no-gutters row">



                                            <div class="col-sm-12">
                                                <button onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                                        class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                    <i class="pe-7s-right-arrow icon-gradient bg-danger btn-icon-wrapper mb-2"></i>
                                                    Salir
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
