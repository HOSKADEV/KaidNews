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
        <li class="menu-item {{ request()->routeIs('dashboard.students.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.students.index') }}" class="menu-link">
                <i class="menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                <div>{{ trans('menu.students') }}</div>
            </a>
        </li>
    </ul>

</aside>
