<aside class="main-sidebar elevation-4 sidebar-{{ config('admin.theme.sidebar') }}">

{{--    <a href="{{ admin_url('/') }}" class="brand-link {{ config('admin.theme.logo') ? 'navbar-'.config('admin.theme.logo') : '' }}">
        <img src="{!! config('admin.logo.image') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{!! config('admin.logo.text', config('admin.name')) !!}</span>
    </a>--}}

    <!-- sidebar: style can be found in sidebar.less -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @each('admin::partials.menu', Admin::menu(), 'item')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
