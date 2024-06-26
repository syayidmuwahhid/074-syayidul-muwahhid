@extends('layouts.app-login')

@section('content')
<div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{ url('/login') }}" method="POST">
    @csrf
    <!--begin::Heading-->
    <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">Sign In to API Resource Manager</h1>
        <!--end::Title-->

        <!--begin::Link-->
        <div class="text-gray-400 fw-bold fs-4 mb-6">
            New Here?

            <a href="{{ route('register') }}" class="link-primary fw-bolder">
                Create an Account
            </a>
        </div>
        <!--end::Link-->
    </div>
    @error('login')
        <x-alert type="danger" :message="$message" />
    @enderror

    @if(session()->has('success'))
        <x-alert type="success" :message="session('success')" />
    @endif
    <!--begin::Heading-->

    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Label-->
        <label class="form-label fs-6 fw-bolder text-dark required">Email</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" value="{{ old('email') }}" />
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <!--end::Input-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack mb-2">
            <!--begin::Label-->
            <label class="form-label fw-bolder text-dark required fs-6 mb-0">Password</label>
            <!--end::Label-->

            <!--begin::Link-->
            {{-- <a href="/jet-html-free/authentication/base/password-reset.html" class="link-primary fs-6 fw-bolder">
                Forgot Password ?
            </a> --}}
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Input-->
        <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off"/>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <!--end::Input-->
    </div>
    <!--end::Input group-->

    <!--begin::Actions-->
    <div class="text-center">
        <!--begin::Submit button-->
        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
            <span class="indicator-label">
                Continue
            </span>

            <span class="indicator-progress">
                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
        <!--end::Submit button-->

        {{-- <!--begin::Separator-->
        <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
        <!--end::Separator-->

        <!--begin::Google link-->
        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
            <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3"/>
            Continue with Google
        </a>
        <!--end::Google link--> --}}
    </div>
    <!--end::Actions-->
</form>
</div>
@endsection
