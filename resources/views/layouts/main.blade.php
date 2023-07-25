<!DOCTYPE html>
<html lang="en">

@include( 'includes.head' )

<body>
<!-- Preloader -->
<div class="preloader-it">
    <div class="loader-pendulums"></div>
</div>
<!-- /Preloader -->

<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-dark bg-indigo fixed-top hk-navbar">
        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
        <span class="navbar-brand mb-0 h2">LEAD</span>
        <ul class="navbar-nav hk-navbar-content">

            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                <img src="{{ asset( 'template-mintos/dist/img/avatar12.jpg' ) }}" alt="user" class="avatar-img rounded-circle">
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            <span>{{ Auth::user()->name }}<i class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">

                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
            </li>
        </ul>
    </nav>
    
    <!-- /Top Navbar -->

    @include( 'includes.sidebar' )

  

    <!-- Main Content -->

    <div class="hk-pg-wrapper">
        <div class='side-body'>   </div>
        <div class="row">
            <div class="col-md-12">
            @include('layouts.messages.message')
            </div>
        </div>
        <!-- Container -->
        @yield('content')
        <!-- /Container -->

        <!-- Footer -->
        <div class="hk-footer-wrap container">
            <footer class="footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <p>Talent Consulting by<a href="#" class="text-dark" target="_blank">Weraki</a> © 2020</p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /Footer -->
    </div>
    <!-- /Main Content -->

</div>
<!-- /HK Wrapper -->
@include( 'includes.footer' )
</body>
</html>
