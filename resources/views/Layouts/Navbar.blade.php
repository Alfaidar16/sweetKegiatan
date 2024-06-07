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
                <li class="@if (Route::is('kegiatan')) active-page-link @endif">
                    <a href="{{ route('kegiatan')}}">
                        <i class="bi bi-text-right"></i>
                        <span class="menu-text">Kegiatan</span>
                    </a>
                </li>
              
                {{-- @endrole --}}
            
                {{-- <li class="@if (Route::is('laporan.index')) active-page-link @endif">
                    <a href="{{ route('laporan.index')}}">
                        <i class="bi bi-window"></i>
                        <span class="menu-text">Laporan OPD</span>
                    </a>
                </li> --}}
              
                <li class="sidebar-dropdown @if (Route::is('laporan.index')) active-page-link @endif">
                    <a href="#">
                        <i class="bi bi-window"></i>
                        <span class="menu-text">Sekretariat</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('laporan.index')}}">Minggu 1</a>
                            </li>
                            <li>
                                <a href="{{ route('laporan.index')}}">Minggu 2</a>
                            </li>
                            <li>
                                <a href="{{ route('laporan.index')}}">Minggu 3</a>
                            </li>
                            <li>
                                <a href="{{ route('laporan.index')}}">Minggu 4</a>
                            </li>
                          
                           
                        </ul>
                    </div>
                </li>
              
                <li class="sidebar-dropdown @if (Route::is('user.index')) active-page-link @endif">
                    <a href="#">
                        <i class="bi bi-person-lines-fill"></i>
                        <span class="menu-text">Master User</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('user.index')}}">User</a>
                            </li>
                          
                           
                        </ul>
                    </div>
                </li>
               
             
                {{-- <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-stickies"></i>
                        <span class="menu-text">Pages</span>
                        <span class="badge blue">8</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="support.html">Support</a>
                            </li>
                            <li>
                                <a href="create-invoice.html">Create Invoice</a>
                            </li>
                           
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-calendar4"></i>
                        <span class="menu-text">Events</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="events.html">Events List</a>
                            </li>
                            <li>
                                <a href="calendar.html">Daygrid</a>
                            </li>
                          
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-columns-gap"></i>
                        <span class="menu-text">Forms</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="form-inputs.html">Form Inputs</a>
                            </li>
                            <li>
                                <a href="form-checkbox-radio.html">Checkbox &amp; Radio</a>
                            </li>
                          
                        </ul>
                    </div>
                </li> --}}
             
            </ul>
          
        </div>
    </div>
    <!-- Sidebar menu ends -->

</nav>