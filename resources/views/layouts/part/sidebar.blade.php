<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src={{asset("/img/asset/Xploreastro_brand.png")}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        @guest
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src={{asset("/img/asset/default-profile-icon.jpg")}} class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Halo, pengunjung!</a>
                </div>
            </div>
        </ul>
        @else
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if (is_null(Auth::user()->profile->profilepicture))
                        <img src={{asset("/img/asset/default-profile-icon.jpg")}} class="img-circle elevation-2" alt="User Image">
                    @else

                        <img src="/img/user/{{Auth::user()->profile->profilepicture}}"class="img-circle elevation-2" alt="User Image">
                    @endif
                </div>
                <div class="info">
                    <a href="#" class="d-block">Halo, {{ Auth::user()->nickname }}!</a>
                </div>
            </div>
        @endguest
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                @guest
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                                Punya akun?
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="../mailbox/compose.html" class="nav-link">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                                Mulai Aktivitas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/article/create" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Buat Artikel Baru</p>
                                </a>
                            </li>
                            <li class="nav-item">

                                <a href="/in/{{Auth::user()->nickname}}/articles" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Semua Artikel Kamu</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endguest
                <li class="nav-header">
                    Cari Artikel
                </li>
                <li class="nav-item">
                    <!-- SidebarSearch Form -->
                    <div class="form-inline">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-header">
                    Filter Kategori
                </li>
                <li class="nav-item">
                    <a href="../calendar.html" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendar
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../gallery.html" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../kanban.html" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Kanban Board
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
