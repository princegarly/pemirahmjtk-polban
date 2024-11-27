<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img class="d-inline-block" width="32px" height="30.61px" src="{{ asset('images/logo/hmjtk-polban.png') }}" alt="">
        </div>
        
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="{{ asset('images/logo/hmjtk-polban.png') }}" alt="">
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('Main') }}</li>
            
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fire"></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            </li>

            <li class="menu-header">{{ __('Manajemen Data') }}</li>
            
            <li class="{{ Request::routeIs('study-program.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('study-program.index') }}">
                    <i class="fas fa-fire"></i>
                    <span>{{ __('Program Studi') }}</span>
                </a>
            </li>

            <li class="menu-header">{{ __('Settings') }}</li>

            <li class="dropdown">
                <a href="" class="nav-link has-dropdown">
                    <i class="fas fa-th-large"></i>
                    <span>{{ __('Manage Account') }}</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('permission.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('permission.index') }}">{{ __('Permission') }}</a>
                    </li>
                </ul>
                    
                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('role.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('role.index') }}">{{ __('Role') }}</a>
                    </li>
                </ul>

                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('user.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.index') }}">{{ __('User') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>