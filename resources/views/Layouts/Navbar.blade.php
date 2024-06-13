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
                        <span class="menu-text text-white">Dashboard</span>
                    </a>
                </li>
               {{-- @role('user') --}}
                <li class="@if (Route::is('kegiatan', 'kegiatan.create', 'kegiatan.edit')) active-page-link @endif">
                    <a href="{{ route('kegiatan')}}">
                        <i class="bi bi-text-right"></i>
                        <span class="menu-text text-white">Kegiatan</span>
                    </a>
                </li>
                <li class="@if (Route::is('laporan.index')) active-page-link @endif">
                    <a href="{{ route('laporan.index') }}">
                        <i class="bi bi-window"></i>
                        <span class="menu-text text-white">Cetak Laporan</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                </li>

              
                @if(Auth::user()->roles_id == 1) 
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-bar-chart-fill"></i>
                        <span class="menu-text text-white"> Bidang</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        @php
                              $dinas = DB::table('ms_bidangs')
                ->where(DB::raw('SUBSTRING(kode_bidang, -2)'), '00')
                ->get();
                        @endphp
                        <ul>
                             @foreach ($dinas as $key )
                             <li class="" style="margin-right: 15px;">
                                <a class="text-white" href="{{ route('daftar.bidang', $key->kode_bidang) }}">{{ $key->nama_unit }}</a>
                            </li>
                             @endforeach
                          
                            {{-- <li>
                                <a href="{{ route('user.index')}}">Bidang</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-person-lines-fill"></i>
                        <span class="menu-text text-white">Master Data</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li class="@if (Route::is('akun.index')) active-page-link @endif">
                                <a class="text-white" href="{{ route('akun.index')}}">User</a>
                            </li>
                            <li class="@if (Route::is('bidang.index')) active-page-link @endif">
                                <a class="text-white" href="{{ route('bidang.index')}}">Bidang</a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('user.index')}}">Bidang</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>

               

                @endif
             
            </ul>
          
        </div>
    </div>
    <!-- Sidebar menu ends -->

</nav>