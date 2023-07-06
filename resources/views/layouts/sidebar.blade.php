<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->segment(1) == 'dashboard' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('dashboard') }}">
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
    <!-- <li class="nav-item {{ request()->segment(1) == 'users' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>User</span>
        </a>
    </li> -->
    <li class="nav-item {{ request()->segment(1) == 'products' ? 'active' : ''}}"">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fas fa-boxes"></i>
            <span>Barang</span>
        </a>
    </li>
    <li class="nav-item {{ request()->segment(1) == 'perangkats' ? 'active' : ''}}"">
        <a class="nav-link" href="{{ route('perangkats.index') }}">
            <i class="fa fa-podcast"></i>
            <span>Perangkat</span>
        </a>
    </li>
    <li class="nav-item {{ request()->segment(1) == 'laporans' ? 'active' : ''}}"">
        <a class="nav-link" href="{{ route('laporans.index') }}">
            <i class="fa fa-book"></i>
            <span>Laporan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>