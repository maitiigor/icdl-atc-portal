<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{route('dashboard')}}">
                        <i data-feather="home"></i>
                        <span class="badge rounded-pill bg-soft-success text-success float-end"></span>
                        <span data-key="t-dashboard">@lang('translation.Dashboards')</span>
                    </a>
                </li>

    

                <li>
                    <a href="{{route('icdl_modules.index')}}">
                        <i class="fas fa-graduation-cap"></i>
                        <span data-key="t-icdl-modules">ICDL Module</span>
                    </a>
                </li>

             
                @if(auth()->user()->hasRole('admin'))
                <li>
                    <a href="{{route('users.index')}}">
                        <i class="fas fa-users-cog"></i>
                        <span data-key="t-users">Users</span>
                    </a>
                </li>
                @endif


            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
