<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom CSS -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">


    <!-- Bootstrap CSS v5.2.1 -->

    <link href="./assets/bootstrap.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="https://suustore.com/assets/frontend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/app.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body style="background-color:#121214;">
    <header class="header d-none d-lg-block">
        <!-- place navbar here -->
        <nav class="navbar navbar-expand-lg navbar-dark header__navbar p-md-0">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="width: 80px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a href="/sanpham" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Truyện
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom">
                                <li><a href="/sanpham" class="dropdown-item">Tất cả loại truyện</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Hỗ Trợ
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom">
                                <li><a class="dropdown-item" href="/support">Liên hệ</a></li>
                            </ul>
                        </li>
                    </ul>

                    <form class="d-flex header__form-search" action="" method="GET">
                        <input class="form-control search-story" type="text" placeholder="Tìm kiếm" name="key_word" value="">
                        <div class="col-12 search-result shadow no-result d-none">
                            <div class="card text-white bg-light">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush d-none">
                                        <li class="list-group-item">
                                            <a href="#" class="text-dark hover-title">Tự cẩm</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <button class="btn" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                            </svg>
                        </button>
                    </form>

                    <ul class="navbar-nav ms-auto">
                        <!-- Cart Button -->
                        <li class="nav-item">
                            <a href="/cart" class="nav-link">
                                <img src="{{ asset('images/cart.png') }}" alt="Cart">
                            </a>
                        </li>
                        @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                                <img src="{{ asset('images/profile.jpg') }}" alt="Profile" style="width: 50px; height: 50px; border-radius: 50%;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Trang cá nhân</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.orders') }}">Đơn hàng đã đặt</a></li>
                                <!-- Admin specific link -->
                                @if(Auth::user()->role == 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.home') }}">Trang Admin</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-dark">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        @if (Route::has('login'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Nội dung chính của trang -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap JS và các kịch bản cần thiết khác -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>