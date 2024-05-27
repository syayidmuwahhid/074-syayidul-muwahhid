<div class="{{ Auth::user()->role_id == 1 ? 'wrapper' : '' }} d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <!--begin::Header-->
    @include('layouts.partials.header')
    <!--end::Header-->

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        @error('error')
            <x-alert :message="$message" type="danger" />
        @enderror

        @if(session()->has('error'))
            <x-alert :message="session('error')" type="danger" />
        @enderror

        @if(session()->has('success'))
            <x-alert :message="session('success')" type="success" />
        @enderror

        <!--begin::Container-->
        @yield('content')
        <!--end::Container-->
    </div>
    <!--end::Content-->

    <!--begin::Footer-->
    @include('layouts.partials.footer')
    <!--end::Footer-->
</div>
