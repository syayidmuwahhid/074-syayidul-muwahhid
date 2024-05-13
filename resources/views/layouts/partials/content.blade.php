<div class="{{ $isadmin ? 'wrapper' : '' }} d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <!--begin::Header-->
    @include('layouts.partials.header')
    <!--end::Header-->

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        @yield('content')
        <!--end::Container-->
    </div>
    <!--end::Content-->

    <!--begin::Footer-->
    @include('layouts.partials.footer')
    <!--end::Footer-->
</div>
