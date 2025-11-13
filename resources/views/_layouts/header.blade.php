<header>
    {{-- <div class="header-container">
        <h1 class="header-title">Header</h1>
        <nav class="header-nav">
            <ul class="header-nav-list">
                <li><a class="header-nav-link" href="/">Trang chủ</a></li>
                <li><a class="header-nav-link" href="/news">Tin tức</a></li>
                <li><a class="header-nav-link" href="/news-item">Chi tiết tin tức</a></li> <!-- gắn tạm -->

                <li><a class="header-nav-link" href="{{ route('user.dashboard') }}">Thông tin tài khoản</a></li>
                <!-- gắn tạm -->

                <li><a class="header-nav-link" href="{{ route('user.register') }}">Đăng ký</a></li>
                <li><a class="header-nav-link" href="{{ route('user.forgot-password') }}">Quên mật khẩu</a></li>

                <li><a class="header-nav-link" href="{{ route('user.login') }}">Đăng nhập</a></li>
                <li>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                    <a class="header-nav-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Đăng xuất
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    --}}
    <div class="header-container">
        <a href="/" class="header-logo text-white text-decoration-none">SHOWBIZ</a>
        <form method="get" action="">
            <input class="header-search-input" type="text" name="search" placeholder="Tìm kiếm">
            <button class="header-search-submit">Tìm</button>
        </form>
        <ul class="header-nav-list">
            <li class="header-nav-item">
                <a class="header-nav-link" href="{{ route('index') }}">Trang chủ</a>
            </li>
            <li class="header-nav-item">
                <a class="header-nav-link" href="{{ route('articles') }}">Tin tức</a>
            </li>
            <li class="header-nav-item">
                <a class="header-nav-link" href="#">Chuyên mục</a>
            </li>
            <li class="header-nav-item">
                <a class="header-nav-link" href="#">Nghệ sĩ</a>
            </li>
        </ul>
        <div class="header-user">
            @if ($user)
                <a class="user-link" href="{{ route('user.dashboard') }}">Chào! {{ $user->first_name }}</a>
            @else
                <a class="user-link" href="{{ route('user.login') }}">Đăng nhập</a>
            @endif
        </div>
    </div>
</header>
