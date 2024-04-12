 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('panel') }}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-cash-register"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Punto de Venta <sup>@yield('company')</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ (str_contains(url()->current(), 'panel'))? 'active' : '' }}">
    <a class="nav-link" href="{{ route('panel') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Panel</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading
<div class="sidebar-heading">
    Interface
</div>
-->
<!-- Nav Item - Pages Collapse Menu
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
        </div>
    </div>
</li>
-->
<!-- Nav Item - Utilities Collapse Menu
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
        </div>
    </div>
</li>
-->
<!-- Divider
<hr class="sidebar-divider">
-->


<!-- Heading -->
<div class="sidebar-heading">
    Modulos
</div>

<!-- Nav Item - Pages Collapse Menu
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Categorias</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
    </div>
</li>
-->
<!-- Nav Item - Categorias -->
<li class="nav-item {{ (str_contains(url()->current(), 'categoria'))? 'active' : '' }}">
    <a class="nav-link" href="{{ route('categorias.index')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Categorias</span></a>
</li>

<li class="nav-item {{ (str_contains(url()->current(), 'presentacion'))? 'active' : '' }}">
    <a class="nav-link" href="{{ route('presentaciones.index')}}">
        <i class="fas fa-fw fa-box"></i>
        <span>Presentaciones</span></a>
</li>

<li class="nav-item {{ (str_contains(url()->current(), 'marca'))? 'active' : '' }}">
    <a class="nav-link" href="{{ route('marcas.index')}}">
        <i class="fas fa-fw fa-trademark"></i>
        <span>Marcas</span></a>
</li>


<li class="nav-item {{ (str_contains(url()->current(), 'producto'))? 'active' : '' }}">
    <a class="nav-link" href="{{ route('productos.index')}}">
        <i class="fas fa-shopping-basket"></i>
        <span>Productos</span></a>
</li>

<li class="nav-item {{ (str_contains(url()->current(), 'cliente'))? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clientes.index')}}">
        <i class="fas fa-users"></i>
        <span>Clientes</span></a>
</li>

<li class="nav-item {{ (str_contains(url()->current(), 'proveedor'))? 'active' : '' }}">
    <a class="nav-link" href="{{ route('proveedores.index')}}">
        <i class="fas fa-user-tie"></i>
        <span>Proveedores</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<li class="nav-item {{ (str_contains(url()->current(), 'compra'))? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-shopping-bag"></i>
        <span>Compras</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-bs-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('compras.index')}}">Ver</a>
            <a class="collapse-item" href="{{route('compras.create')}}">Crear</a>
        </div>
    </div>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message
<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div>
-->
</ul>
<!-- End of Sidebar -->
