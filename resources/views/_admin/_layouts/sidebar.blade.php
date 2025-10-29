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
            <span class="brand-text fw-light">AdminLTE 4</span>
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
                <li class="nav-item">
                    <a href="{{ route('admin.news.index') }}"
                        class="nav-link {{ Request::routeIs('admin.news.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Quản lý tin tức
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-link {{ Request::routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Quản lý chuyên mục
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.artists.index') }}"
                        class="nav-link {{ Request::routeIs('admin.artists.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>
                            Quản lý nghệ sĩ
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.comments.index') }}"
                        class="nav-link {{ Request::routeIs('admin.comments.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-tree-fill"></i>
                        <p>
                            Quản lý bình luận
                            <span class="nav-badge badge text-bg-secondary me-3">6</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Quản lý người dùng
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::routeIs('admin.media.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.media.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-in-right"></i>
                        <p>
                            Quản lý media
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.footers.index') }}"
                        class="nav-link {{ Request::routeIs('admin.footers.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-download"></i>
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