<nav class="sidebar-wrapper">

    <!-- Sidebar brand starts -->
    <div class="brand">
        <a href="{{ route('dashboard')}}" class="logo">
            <img src="{{ asset('/TemplateDashboard/design/assets/images/user-avatar-default.png')}}" class="d-none d-md-block me-4 float-center" alt="Rapid Admin Dashboard" />
            <span>Selamat Datang {{Auth()->user()->name}}</span>
          
        </a>
    </div>
    <!-- Sidebar brand ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul>
                <li class="active-page-link">
                    <a href="index.html">
                        <i class="bi bi-house"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="widgets.html">
                        <i class="bi bi-box"></i>
                        <span class="menu-text">Widgets</span>
                    </a>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-collection"></i>
                        <span class="menu-text">Master User</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="accordions.html">User</a>
                            </li>
                          
                           
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
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
                </li>
             
            </ul>
        </div>
    </div>
    <!-- Sidebar menu ends -->

</nav>