<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{ \App\Models\Setting::where('key', 'dark_mode')->value('value') == '1' ? 'dark' : 'light' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Models\Setting::where('key', 'app_name')->value('value') ?? config('app.name', 'Laravel Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- No Vite scripts needed, using CDN instead -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --sidebar-color: #000000;
            --sidebar-transition: all 0.3s;
            --dark-bg: #212529;
            --dark-card: #2c3034;
            --dark-input: #2b3035;
            --dark-border: #495057;
            --dark-text: #f8f9fa;
            --dark-table-stripe: #343a40;
            --dark-table-hover: #3f474e;
            --dark-dropdown: #343a40;
            --dark-dropdown-hover: #495057;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            transition: var(--sidebar-transition);
        }
        
        /* Dark Mode Styles */
        [data-bs-theme="dark"] {
            color-scheme: dark;
        }
        
        [data-bs-theme="dark"] body {
            background-color: var(--dark-bg);
            color: var(--dark-text);
        }
        
        [data-bs-theme="dark"] .card {
            background-color: var(--dark-card);
            border-color: var(--dark-border);
        }
        
        [data-bs-theme="dark"] .card-header {
            background-color: var(--dark-card);
            border-bottom: 1px solid var(--dark-border);
        }
        
        [data-bs-theme="dark"] .navbar {
            background-color: var(--dark-card) !important;
            border-color: var(--dark-border);
        }
        
        [data-bs-theme="dark"] .navbar-brand,
        [data-bs-theme="dark"] .nav-link {
            color: var(--dark-text) !important;
        }
        
        [data-bs-theme="dark"] .sidebar {
            background-color: var(--sidebar-color);
        }
        
        [data-bs-theme="dark"] .sidebar-header {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }
        
        [data-bs-theme="dark"] .dropdown-menu {
            background-color: var(--dark-dropdown);
            border-color: var(--dark-border);
        }
        
        [data-bs-theme="dark"] .dropdown-item {
            color: var(--dark-text);
        }
        
        [data-bs-theme="dark"] .dropdown-item:hover {
            background-color: var(--dark-dropdown-hover);
        }
        
        [data-bs-theme="dark"] .table {
            color: var(--dark-text);
            border-color: var(--dark-border);
        }
        
        [data-bs-theme="dark"] .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: var(--dark-table-stripe);
        }
        
        [data-bs-theme="dark"] .table-hover > tbody > tr:hover > * {
            background-color: var(--dark-table-hover);
        }
        
        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select {
            background-color: var(--dark-input);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }
        
        [data-bs-theme="dark"] .form-control:focus,
        [data-bs-theme="dark"] .form-select:focus {
            background-color: var(--dark-input);
            color: var(--dark-text);
        }
        
        [data-bs-theme="dark"] .input-group-text {
            background-color: var(--dark-dropdown);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }
        
        [data-bs-theme="dark"] .modal-content {
            background-color: var(--dark-card);
            border-color: var(--dark-border);
        }
        
        [data-bs-theme="dark"] .modal-header,
        [data-bs-theme="dark"] .modal-footer {
            border-color: var(--dark-border);
        }
        
        [data-bs-theme="dark"] .alert-success {
            background-color: rgba(25, 135, 84, 0.2);
            color: #75b798;
            border-color: rgba(25, 135, 84, 0.3);
        }
        
        [data-bs-theme="dark"] .alert-danger {
            background-color: rgba(220, 53, 69, 0.2);
            color: #ea868f;
            border-color: rgba(220, 53, 69, 0.3);
        }
        
        [data-bs-theme="dark"] .alert-warning {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffda6a;
            border-color: rgba(255, 193, 7, 0.3);
        }
        
        [data-bs-theme="dark"] .alert-info {
            background-color: rgba(13, 202, 240, 0.2);
            color: #6edff6;
            border-color: rgba(13, 202, 240, 0.3);
        }
        
        [data-bs-theme="dark"] .pagination {
            --bs-pagination-bg: var(--dark-card);
            --bs-pagination-border-color: var(--dark-border);
            --bs-pagination-color: var(--dark-text);
            --bs-pagination-hover-bg: var(--dark-dropdown-hover);
            --bs-pagination-hover-border-color: var(--dark-border);
            --bs-pagination-active-bg: #0d6efd;
            --bs-pagination-active-border-color: #0d6efd;
            --bs-pagination-disabled-bg: var(--dark-card);
            --bs-pagination-disabled-border-color: var(--dark-border);
        }
        
        [data-bs-theme="dark"] .page-link {
            background-color: var(--dark-card);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }
        
        [data-bs-theme="dark"] .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        
        [data-bs-theme="dark"] .badge.bg-secondary {
            background-color: #6c757d !important;
        }
        
        [data-bs-theme="dark"] .badge.bg-success {
            background-color: #198754 !important;
        }
        
        [data-bs-theme="dark"] .badge.bg-danger {
            background-color: #dc3545 !important;
        }
        
        [data-bs-theme="dark"] .badge.bg-warning {
            background-color: #ffc107 !important;
        }
        
        [data-bs-theme="dark"] .badge.bg-info {
            background-color: #0dcaf0 !important;
        }
        
        [data-bs-theme="dark"] .badge.bg-light {
            background-color: #f8f9fa !important;
            color: #212529;
        }
        
        [data-bs-theme="dark"] .badge.bg-dark {
            background-color: #212529 !important;
        }
        
        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        
        .sidebar {
            background-color: var(--sidebar-color);
            color: #fff;
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1030;
            transition: var(--sidebar-transition);
            overflow-y: auto;
            flex-shrink: 0;
        }
        
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--sidebar-transition);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
        }
        
        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }
        
        .navbar {
            height: 56px;
            z-index: 1020;
            background-color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        .sidebar.collapsed .nav-link span {
            display: none;
        }
        
        .sidebar.collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.25rem;
        }
        
        .content {
            flex: 1;
            padding: 2rem;
            transition: var(--sidebar-transition);
            width: 100%;
            overflow-x: auto;
        }
        
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            font-weight: 600;
        }
        
        .navbar-brand img {
            max-height: 30px;
            margin-right: 10px;
        }
        
        .toggle-sidebar {
            cursor: pointer;
            margin-right: 15px;
        }
        
        .theme-switch {
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
            }
            
            .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.25rem;
            }
            
            .main-content {
                margin-left: var(--sidebar-collapsed-width);
                width: calc(100% - var(--sidebar-collapsed-width));
            }
            
            .toggle-sidebar {
                display: block;
            }
            
            .sidebar-header img,
            .sidebar-header .rounded-circle {
                max-height: 50px !important;
                max-width: 50px !important;
            }
            
            .sidebar-header h5 {
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-brand span {
                max-width: 150px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }
            
            .sidebar.collapsed {
                width: var(--sidebar-width);
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .main-content.expanded {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div id="app" class="wrapper">
        @auth
            <nav id="sidebar" class="sidebar">
                <div class="p-4">
                    <div class="sidebar-header mb-4 text-center">
                        <div class="mb-3">
                            @if(\App\Models\Setting::where('key', 'app_logo')->value('value'))
                                <img src="{{ asset('storage/' . \App\Models\Setting::where('key', 'app_logo')->value('value')) }}" alt="Logo" class="rounded-circle" style="max-height: 80px; max-width: 80px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                    <i class="fas fa-user fa-2x text-dark"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="text-white mb-0">
                            <span>{{ \App\Models\Setting::where('key', 'app_name')->value('value') ?? config('app.name', 'Laravel Dashboard') }}</span>
                        </h5>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        @can('view users')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <i class="fas fa-users"></i> <span>Users</span>
                            </a>
                        </li>
                        @endcan
                        @can('view roles')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                                <i class="fas fa-user-tag"></i> <span>Roles</span>
                            </a>
                        </li>
                        @endcan
                        @can('view permissions')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('permissions*') ? 'active' : '' }}" href="{{ route('permissions.index') }}">
                                <i class="fas fa-key"></i> <span>Permissions</span>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('settings*') ? 'active' : '' }}" href="{{ route('settings.index') }}">
                                <i class="fas fa-cog"></i> <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        @endauth

        <div class="main-content" id="mainContent">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        @auth
                        <span class="toggle-sidebar me-3" id="sidebarCollapse">
                            <i class="fas fa-bars"></i>
                        </span>
                        @endauth
                        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                            @guest
                                @if(\App\Models\Setting::where('key', 'app_logo')->value('value'))
                                    <img src="{{ asset('storage/' . \App\Models\Setting::where('key', 'app_logo')->value('value')) }}" alt="Logo">
                                @endif
                                <span>{{ \App\Models\Setting::where('key', 'app_name')->value('value') ?? config('app.name', 'Laravel Dashboard') }}</span>
                            @endguest
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Theme Switch -->
                            <li class="nav-item me-3">
                                <a class="nav-link theme-switch" href="#" id="themeSwitch">
                                    <i class="fas {{ \App\Models\Setting::where('key', 'dark_mode')->value('value') == '1' ? 'fa-sun' : 'fa-moon' }}"></i>
                                </a>
                            </li>
                            
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('settings.index') }}">
                                            <i class="fas fa-cog me-2"></i> {{ __('Settings') }}
                                        </a>
                                        
                                        <div class="dropdown-divider"></div>
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle
            const sidebarCollapse = document.getElementById('sidebarCollapse');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            if (sidebarCollapse && sidebar && mainContent) {
                sidebarCollapse.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                });
            }
            
            // Check for mobile devices and collapse sidebar by default
            const checkMobile = function() {
                if (window.innerWidth < 768 && sidebar && mainContent) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                } else if (sidebar && mainContent) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
            };
            
            // Run on page load
            checkMobile();
            
            // Run on window resize
            window.addEventListener('resize', checkMobile);
            
            // Theme switch
            const themeSwitch = document.getElementById('themeSwitch');
            const htmlElement = document.documentElement;
            
            if (themeSwitch) {
                themeSwitch.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const currentTheme = htmlElement.getAttribute('data-bs-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    
                    htmlElement.setAttribute('data-bs-theme', newTheme);
                    
                    // Update icon
                    const icon = themeSwitch.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('fa-moon');
                        icon.classList.toggle('fa-sun');
                    }
                    
                    // Save preference via AJAX
                    const formData = new FormData();
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    formData.append('dark_mode', newTheme === 'dark' ? 1 : 0);
                    formData.append('app_name', '{{ \App\Models\Setting::where("key", "app_name")->value("value") ?? config("app.name", "Laravel Dashboard") }}');
                    formData.append('sidebar_color', '{{ \App\Models\Setting::where("key", "sidebar_color")->value("value") ?? "#343a40" }}');
                    
                    fetch('{{ route("settings.update") }}', {
                        method: 'POST',
                        body: formData
                    });
                });
            }
        });
    </script>
</body>
</html>