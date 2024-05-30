@if (Auth::user()->role_id == 1)
<div id="kt_aside" class="aside aside-extended bg-white" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Primary-->
    <div class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto">
        <!--begin::Logo-->
        <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto pt-10" id="kt_aside_logo">
            <a href="{{ url('/') }}">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="h-80px" />
            </a>
        </div>
        <!--end::Logo-->
        <!--begin::Nav-->
        <div class="aside-nav d-flex flex-column flex-lg-center flex-column-fluid w-100 pt-5 pt-lg-0" id="kt_aside_nav">
            <!--begin::Primary menu-->
            <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5" data-kt-menu="true">
               @foreach (\App\Helpers\Anyhelpers::getMenus() as $menu)
                    <x-sidebar-menus :menu="$menu" :position="$title"/>
                @endforeach
            </div>
            <!--end::Primary menu-->
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Primary-->
</div>
@endif
