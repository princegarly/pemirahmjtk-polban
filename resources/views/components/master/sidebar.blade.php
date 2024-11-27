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
            @can(['dashboard'])
                <li class="menu-header">{{ __('Main') }}</li>

                <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-fire"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endcan

            @canany(['study-program-read', 'grade-read', 'candidate-read'])
                <li class="menu-header">{{ __('Manajemen Data') }}</li>
            @endcanany
            
            @can(['study-program-read'])
                <li class="{{ Request::routeIs('study-program.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('study-program.index') }}">
                        <i class="fas fa-fire"></i>
                        <span>{{ __('Program Studi') }}</span>
                    </a>
                </li>
            @endcan

            @can(['grade-read'])
                <li class="{{ Request::routeIs('grade.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('grade.index') }}">
                        <i class="fas fa-fire"></i>
                        <span>{{ __('Kelas') }}</span>
                    </a>
                </li>
            @endcan

            @can(['candidate-read'])
                <li class="{{ Request::routeIs('candidate.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('candidate.index') }}">
                        <i class="fas fa-fire"></i>
                        <span>{{ __('Kandidat') }}</span>
                    </a>
                </li>
            @endcan

            @canany(['polling-booth'])
                <li class="menu-header">{{ __('Bilik Suara') }}</li>
            @endcanany
            
            @can(['polling-booth'])
                <li class="{{ Request::routeIs('polling-booth.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('polling-booth.index') }}">
                        <i class="fas fa-fire"></i>
                        <span>{{ __('Surat Suara') }}</span>
                    </a>
                </li>
            @endcan

            @canany(['election-status-already', 'election-status-not-yet'])
                <li class="menu-header">{{ __('Status Pemilihan') }}</li>
            @endcanany
            
            @can(['election-status-already'])
                <li class="{{ Request::routeIs('election-status.already.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('election-status.already.index') }}">
                        <i class="fas fa-fire"></i>
                        <span>{{ __('Sudah Memilih') }}</span>
                    </a>
                </li>
            @endcan

            @can(['election-status-not-yet'])
                <li class="{{ Request::routeIs('election-status.notyet.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('election-status.notyet.index') }}">
                        <i class="fas fa-fire"></i>
                        <span>{{ __('Belum Memilih') }}</span>
                    </a>
                </li>
            @endcan

            @canany(['permission-read', 'role-read', 'user-read'])
                <li class="menu-header">{{ __('Pengaturan') }}</li>
            @endcanany

            @canany(['permission-read', 'role-read', 'user-read'])
                <li class="dropdown">
                    <a href="" class="nav-link has-dropdown">
                        <i class="fas fa-th-large"></i>
                        <span>{{ __('Kelola Akun') }}</span>
                    </a>

                    @can(['permission-read'])
                        <ul class="dropdown-menu">
                            <li class="{{ Request::routeIs('permission.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('permission.index') }}">{{ __('Izin') }}</a>
                            </li>
                        </ul>
                    @endcan
                        
                    @can(['role-read'])
                        <ul class="dropdown-menu">
                            <li class="{{ Request::routeIs('role.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('role.index') }}">{{ __('Peran') }}</a>
                            </li>
                        </ul>
                    @endcan

                    @can(['user-read'])
                        <ul class="dropdown-menu">
                            <li class="{{ Request::routeIs('user.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('user.index') }}">{{ __('Pengguna') }}</a>
                            </li>
                        </ul>
                    @endcan
                </li>
            @endcanany
        </ul>
    </aside>
</div>