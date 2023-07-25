<li class="app-sidebar__heading">Menú</li>


<li >
    <a href="#">
        <i class="metismenu-icon pe-7s-shopbag"></i>
        Catálogo
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        <li >
            <a href="{{route('categories.index')}}">
                <i class="metismenu-icon pe-7s-rocket"></i>
                <span>Categorías</span>
            </a>
        </li>
        <li >
            <a href="{{route('producto.index')}}">
                <i class="metismenu-icon pe-7s-rocket"></i>
                <span>Productos</span>
            </a>
        </li>

    </ul>
</li>
<li >
    <a href="#">
        <i class="metismenu-icon pe-7s-config"></i>
        Configurariones
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>

        <li >
            <a href="{{route('banner.index')}}">
                <i class="metismenu-icon pe-7s-display2"></i>
                <span>Banners</span>
            </a>
        </li>


    </ul>
</li>

<li>
    <a href="#">
        <i class="metismenu-icon pe-7s-lock"></i>
        Accesos
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>

    <ul>

        <li >
            <a href="{{route('administrator.index')}}">
                <span>Usuarios</span>
            </a>
        </li>
    </ul>
</li>

