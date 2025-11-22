<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">SHOWBIZ</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }} ">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('admin.articles.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ Request::routeIs('admin.articles.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-newspaper"></i>
                        <p>
                            Quản lý tin tức
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.articles.index') }}"
                                class="nav-link {{ Request::routeIs('admin.articles.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Nháp</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Đã xóa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-link {{ Request::routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-list-ul"></i>
                        <p>
                            Quản lý chuyên mục
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.artists.index') }}"
                        class="nav-link {{ Request::routeIs('admin.artists.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-hearts"></i>
                        <p>
                            Quản lý nghệ sĩ
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.comments.index') }}"
                        class="nav-link {{ Request::routeIs('admin.comments.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-chat-right-text-fill"></i>
                        <p>
                            Quản lý bình luận
                            <span class="nav-badge badge text-bg-secondary me-3">6</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            Quản lý tài khoản
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Mục con 1: Quản lý người dùng thường -->
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Người dùng ({{ \App\Models\User::count() }})</p>
                            </a>
                        </li>

                        <!-- Mục con 2: Quản lý tài khoản Admin -->
                        <li class="nav-item">
                            <a href="{{ route('admin.admins.index') }}"
                                class="nav-link {{ Request::routeIs('admin.admins.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-shield-lock-fill text-danger"></i>
                                <p>Admin ({{ \App\Models\Admin::count() }})</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Request::routeIs('admin.media.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.media.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-images"></i>
                        <p>
                            Quản lý media
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.footers.index') }}"
                        class="nav-link {{ Request::routeIs('admin.footers.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-ui-checks"></i>
                        <p>Quản lý footer</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->