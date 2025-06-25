    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <!-- corona text -->
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="index.html"><img src="{{ asset('assets/images/logo.svg') }}"
                    alt="logo" /></a>
            <a class="sidebar-brand brand-logo-mini" href="index.html"><img
                    src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
        </div>
        <!-- corona text -->
        <ul class="nav">
            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('committee.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('committee.events.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Events</span>
                </a>
            </li>
        </ul>
    </nav>
