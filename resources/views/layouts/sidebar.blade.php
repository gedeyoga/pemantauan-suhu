<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link {{ request()->is('user') ? 'active' : ''}}" href="#">
            <i class="fas fa-users"></i>
            <span>User</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('user') ? 'active' : ''}}" href="#">
            <i class="fas fa-boxes"></i>
            <span>Barang</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('user') ? 'active' : ''}}" href="#">
            <i class="fas fa-boxes"></i>
            <span>Barang</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>