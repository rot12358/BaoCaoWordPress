<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
            aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admin.home')}}">Trang chủ Admin</a>
                </li>

                <!-- Quản lý danh mục -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Quản lý danh mục
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.categories.create') }}">Thêm
                                danh mục</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Liệt kê
                                danh mục</a></li>
                    </ul>
                </li>

                <!-- Quản lý bài viết -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="postDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Quản lý bài viết
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="postDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.posts.create') }}">Thêm bài
                                viết</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.posts.index') }}">Liệt kê bài
                                viết</a></li>
                    </ul>
                </li>

                <!-- Quản lý tài khoản -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Quản lý tài khoản
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Danh
                                sách tài khoản</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.users.create') }}">Thêm
                                tài khoản</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Quản lý đơn hàng
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">Danh
                                sách đơn hàng</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
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