<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img width="50" src="{{ asset('assets/logo/kaid-logo.png') }}" alt="brand-logo" srcset="">
                {{-- @include('_partials.macros',["width"=>25,"withbg"=>'#696cff']) --}}
            </span>
            <span class="app-brand-text demo menu-text fw-bold text-capitalize ms-2">
                {{ config('app.locale') == 'en' ? 'Kaid' : 'القايد' }}
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-autod-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ trans('menu.dashboard') }}</span>
        </li>
        <li class="menu-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.index') }}" class="menu-link">
                <i class='menu-icon bx bxs-dashboard'></i>
                <div>{{ trans('menu.dashboard') }}</div>
            </a>
        </li>
        @if (auth('admin')->check())
            <li class="menu-item {{ request()->routeIs('dashboard.admins.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.admins.index') }}" class="menu-link">
                    <i class="menu-icon fa fa-user-secret" aria-hidden="true"></i>
                    <div>{{ trans('menu.admins') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.teachers.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.teachers.index') }}" class="menu-link">
                    <i class="menu-icon fa fa-users" aria-hidden="true"></i>
                    <div>{{ trans('menu.teachers') }}</div>
                </a>
            </li>
        @endif
        <li class="menu-item {{ request()->routeIs('dashboard.students.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.students.index') }}" class="menu-link">
                <i class="menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                <div>{{ trans('menu.students') }}</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('dashboard.subjects.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.subjects.index') }}" class="menu-link">
                <i class="menu-icon bx bxs-purchase-tag" aria-hidden="true"></i>
                <div>{{ trans('menu.subjects') }}</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('dashboard.attendence.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.attendence.index') }}" class="menu-link">
                <i class="menu-icon bx bxs-time" aria-hidden="true"></i>
                <div>{{ trans('menu.attendence') }}</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('dashboard.evaluations.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.evaluations.index') }}" class="menu-link">
                <i class="menu-icon fa fa-star" aria-hidden="true"></i>
                <div>{{ trans('menu.evaluations') }}</div>
            </a>
        </li>

        @if (auth('admin')->check())
            <li class="menu-item {{ request()->routeIs('dashboard.settings.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.settings.index') }}" class="menu-link">
                    <i class="menu-icon bx bxs-cog" aria-hidden="true"></i>
                    <div>{{ trans('menu.settings') }}</div>
                </a>
            </li>
        @endif
    </ul>

</aside>
