<nav class="sidebar-wrapper">

    <!-- Sidebar brand starts -->
    <div class="brand">
        <a href="{{ route('dashboard')}}" class="logo">
       <div class="d-flex">
        <img src="{{ asset('/TemplateDashboard/design/assets/images/faviconsulsel.png')}}" class="" alt="Rapid Admin Dashboard" />
        <span class="justify-content-end mt-4">Selamat Datang {{Auth()->user()->name}}</span>
       </div>
          
        </a>
    </div>
    <!-- Sidebar brand ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul>
                <li class="@if (Route::is('dashboard')) active-page-link @endif">
                    <a href="{{ route('dashboard')}}">
                        <i class="bi bi-house"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
               {{-- @role('user') --}}
                <li class="@if (Route::is('kegiatan', 'kegiatan.create', 'kegiatan.edit')) active-page-link @endif">
                    <a href="{{ route('kegiatan')}}">
                        <i class="bi bi-text-right"></i>
                        <span class="menu-text">Kegiatan</span>
                    </a>
                </li>
                <li class="sidebar-dropdown @if (Route::is('laporan.index')) active-page-link @endif">
                    <a href="{{ route('laporan.index') }}">
                        <i class="bi bi-window"></i>
                        <span class="menu-text">Cetak Laporan</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-person-lines-fill"></i>
                        <span class="menu-text">Master Data</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('akun.index')}}  @if (Route::is('akun.index')) active-page-link @endif">User</a>
                            </li>
                            <li>
                                <a href="{{ route('bidang.index')}}  @if (Route::is('bidang.index')) active-page-link @endif">Bidang</a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('user.index')}}">Bidang</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
             
            </ul>
          
        </div>
    </div>
    <!-- Sidebar menu ends -->

</nav>