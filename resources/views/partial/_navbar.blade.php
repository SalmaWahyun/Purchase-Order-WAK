<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler-right align-self-center me-2" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <a class="navbar-brand brand-logo ml-2" href="{{ route('dashboard') }}">
            <img src="/images/logo_wak_main.png" alt="logo" class="logo-image"/>
            <span class="ms-2 fw-bold text-center company-name">CV.WAK PUTRA JAYA</span>
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
            <img src="/images/logo_wak_main.png" alt="logo" class="logo-image-mini"/>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-logout text-white"></i> Log Out
                    </button>
                </form>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>

<style>
    .navbar {
        width: 100% !important;
        padding: 0;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,.08);
    }

    .navbar-brand-wrapper {
        width: 260px !important;
        padding: 0 1rem;
        background: #f8f9fa;
        border-right: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        transition: width 0.3s ease;
    }

    .logo-image {
        height: 50px;
        width: auto;
        object-fit: contain;
        display: block;
    }

    .logo-image-mini {
        height: 35px;
        width: auto;
        object-fit: contain;
        display: none;
    }

    .navbar-brand {
        padding: 0.5rem 0;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .company-name {
        font-size: 12px; 
        color: black; 
        font-weight: bold;
        transition: opacity 0.3s ease;
    }

    .navbar-menu-wrapper {
        width: calc(100% - 260px) !important;
        padding: 0 2rem;
        transition: width 0.3s ease;
    }

    .navbar-toggler {
        border: none;
        background: transparent;
        padding: 0;
        cursor: pointer;
    }

    /* Ketika sidebar ditutup */
    .sidebar-icon-only .navbar-brand-wrapper {
        width: 70px !important;
    }

    .sidebar-icon-only .navbar-menu-wrapper {
        width: calc(100% - 70px) !important;
    }

    .sidebar-icon-only .company-name {
        display: none;
    }

    .sidebar-icon-only .brand-logo {
        display: none;
    }

    .sidebar-icon-only .brand-logo-mini {
        display: block;
    }

    @media (max-width: 991.98px) {
        .navbar-brand-wrapper {
            width: 70px !important;
            padding: 0 0.5rem;
        }
        
        .navbar-menu-wrapper {
            width: calc(100% - 70px) !important;
            padding: 0 1rem;
        }
        
        .brand-logo {
            display: none;
        }
        
        .brand-logo-mini {
            display: block;
        }
        
        .company-name {
            display: none;
        }
    }

    .navbar .navbar-menu-wrapper .navbar-nav {
        margin-left: auto;
    }
</style>