<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>FashionStore</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #4B382A;
            color: white;
            padding-top: 60px;
        }

        .sidebar h4 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #997950;
            color: white;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
        }

        .btn-theme {
            background-color: #997950;
            color: white;
            border: none;
        }

        .btn-outline-theme {
            border-color: #997950;
            color: white;
        }

        .btn-outline-theme:hover {
            background-color: #997950;
            color: white;
        }

        .nav-link.active {
            color: #997950 !important;
            font-weight: bold;
        } */

        .nav-link:hover {
            color: #997950 !important;
        }

        /* Posisi vertikal tombol keranjang & pesanan */
        .btn-vertical-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-right: 12px;
        }
    </style>
</head>

<body>
    <div id="app">
        @auth
            @if(Auth::user()->is_admin)
                <!-- Sidebar Admin -->
                <div class="sidebar">
                    <h4>Admin Panel</h4>
                    <a href="{{ route('index_product') }}"><i class="bi bi-house me-2"></i> Dashboard</a>
                    <a href="{{ route('admin.create_product') }}"><i class="bi bi-plus-circle me-2"></i> Upload Product</a>
                    <a href="{{ route('admin.index_order') }}"><i class="bi bi-box-seam me-2"></i> Orders</a>
                    <a href="{{ route('show_profile') }}"><i class="bi bi-person me-2"></i> Profile</a>
                    <a href="{{ route('admin.index_user') }}"><i class="bi bi-people me-2"></i> Users</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
                <main class="main-content">@yield('content')</main>
            @else
                <!-- Header untuk User -->
                <header style="background-color:#4B382A;" class="py-3">
                    <div class="container-fluid d-flex justify-content-between align-items-center">
                        <a href="{{ route('index_product') }}" class="text-white fs-4 text-decoration-none">
                            StyleIn
                        </a>

                        <ul class="nav">
                            <li class="nav-item me-3">
                                <a class="nav-link text-white {{ request()->routeIs('index_product') ? 'active' : '' }}"
                                    href="{{ route('index_product') }}">Home</a>
                            </li>
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                                    Category
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($categories as $category)
                                        <li><a class="dropdown-item" href="{{ route('show_category', $category->id) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>

                        <div class="d-flex align-items-center">
                            <!-- Tombol keranjang dan pesanan secara vertikal -->
                            <div class="btn-vertical-group">
                                <a href="{{ route('show_cart') }}" class="btn btn-outline-theme">
                                    <i class="bi bi-cart me-1"></i> Keranjang
                                </a>
                                <a href="{{ route('admin.index_order') }}" class="btn btn-theme">
                                    <i class="bi bi-card-list me-1"></i> Pesanan
                                </a>
                            </div>

                            <!-- Dropdown user -->
                            <div class="dropdown">
                                <button class="btn btn-outline-theme dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person me-1"></i> {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h6 class="dropdown-header">Welcome to FashionStore</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('show_profile') }}"><i class="bi bi-person-circle me-2"></i> My Profile</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </div>
                        </div>
                    </div>
                </header>
                <main class="py-4">@yield('content')</main>
            @endif
        @else
            <!-- Guest Navbar -->
            <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #4B382A;">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('index_product') }}">StyleIn</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#guestNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="guestNavbar">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item me-2">
                                <a class="btn btn-theme" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-theme" href="{{ route('register') }}">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">@yield('content')</main>
        @endauth
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
