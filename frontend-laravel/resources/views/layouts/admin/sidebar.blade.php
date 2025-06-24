    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <!-- corona text -->
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="index.html"><img src="{{ asset('assets/images/logo.svg') }}" alt="logo" /></a>
            <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/logo-mini.svg') }}"
                    alt="logo" /></a>
        </div>
        <!-- corona text -->
        <ul class="nav">
            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('admin.index')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <!-- nav dd -->
            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <span class="menu-icon">
                        <i class="mdi mdi-security"></i>
                    </span>
                    <span class="menu-title">User</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.users.byRole', 1) }}"> Members </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.users.byRole', 3) }}"> Finance </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.users.byRole', 4) }}"> Commitee </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- nav dd -->
        </ul>
    </nav>
