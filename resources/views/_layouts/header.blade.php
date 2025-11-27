<header>
    <div class="header-container">
        <div class="header-logo"><a href="{{ route('index') }}">SHOWBIZ</a></div>
        <form method="get" action="{{ route('articles') }}">
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
                <a class="header-nav-link" href="{{ route('categories.index') }}">Chuyên mục</a>
            </li>
            <li class="header-nav-item">
                <a class="header-nav-link" href="{{ route('artists.index') }}">Nghệ sĩ</a>
            </li>
        </ul>
        <div class="header-user">
            @if ($user)
                <a class="user-link" href="{{ route('user.dashboard') }}">Chào! {{ $user->first_name }}</a>
            @else
                <a class="user-link" href="{{ route('user.login') }}">
                    <img src="{{ asset('assets/img/account.svg') }}"
                        style="width: 20px; filter: invert(1) sepia(1) saturate(10000%) hue-rotate(200deg); display: inline;">
                    Đăng nhập
                </a>
            @endif
        </div>
    </div>
</header>