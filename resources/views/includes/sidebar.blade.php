<!-- Vertical Nav -->
<nav class="hk-nav hk-nav-light">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <li class="nav-item active">
                    <a class="nav-link" href="javascript:void(0);">
                        <span class="feather-icon"><i data-feather="activity"></i></span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                
               @can('user_management_access')
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_1">
                        <i class="fa fa-lock"></i>
                        <span class="nav-link-text">Accesos</span>
                    </a>
                    <ul id="pages_1" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                
                                @can('user_access')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('administrator.index')}}">Administrador</a>
                                </li>
                                @endcan
                                @can('role_access')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('role.index')}}">Roles</a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
            
        </div>
    </div>
</nav>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
<!-- /Vertical Nav -->
