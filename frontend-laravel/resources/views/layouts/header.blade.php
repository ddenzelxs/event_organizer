<header id="header" class="header fixed-top d-flex align-items-center" style="z-index: 1020;">

    <div class="d-flex align-items-center justify-content-between">
        <img src="" alt="logo" style="width: 200px; height: auto;">
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <div class="nav-item pe-3 ">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <span class="d-none d-md-block dropdown-toggle ps-2 fs-5"></span>
            </a><!-- End Profile Image Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h1 class="fs-5 fw-bold"></h1>
                    <span class="fs-6">JABATAN</span>
                    <span class="fs-6">EVENT</span>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center" href="">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </button>
                    </form>
                </li>
            </ul><!-- End Profile Dropdown Items -->
            </fiv><!-- End Profile Nav -->
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
