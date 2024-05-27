@extends('layouts.app-login')

@section('content')
<div class="w-lg-600px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
<form class="form w-100" method="POST" action="{{ route('register') }}">
    @csrf
    <!--begin::Heading-->
    <div class="mb-10 text-center">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">
            Create an Account
        </h1>
        <!--end::Title-->

        <!--begin::Link-->
        <div class="text-gray-400 fw-bold fs-4">
            Already have an account?

            <a href="{{ route('login') }}" class="link-primary fw-bolder">
                Sign in here
            </a>
        </div>
        <!--end::Link-->
    </div>
    <!--end::Heading-->

    @error('error')
        <x-alert type="danger" :message="$message" />
    @enderror

    {{-- <!--begin::Action-->
    <button type="button" class="btn btn-light-primary fw-bolder w-100 mb-10">
        <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3"/>
        Sign in with Google
    </button>
    <!--end::Action-->

    <!--begin::Separator-->
    <div class="d-flex align-items-center mb-10">
        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
        <span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
    </div>
    <!--end::Separator--> --}}

    <!--begin::Input group-->
    <div class="row fv-row mb-7">

        <label class="form-label fw-bolder text-dark fs-6 required">Full Name</label>
        <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="name" required autocomplete="off" value="{{ old('name') }}"/>

    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="fv-row mb-7">
        <label class="form-label fw-bolder text-dark fs-6 required">Email</label>
        <input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" required autocomplete="off" value="{{ old('email') }}"/>
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="mb-10 fv-row" data-kt-password-meter="true">
        <!--begin::Wrapper-->
        <div class="mb-1">
            <!--begin::Label-->
            <label class="form-label fw-bolder text-dark fs-6 required">
                Password
            </label>
            <!--end::Label-->

            <!--begin::Input wrapper-->
            <div class="position-relative mb-3">
                <input class="form-control form-control-lg form-control-solid" id="password" type="password" placeholder="" name="password" autocomplete="off" required/>

                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" id="toggle_show_password">
                    <i class="bi bi-eye-slash fs-2"></i>
                </span>
            </div>
            <!--end::Input wrapper-->

        </div>
        <!--end::Wrapper-->

        <!--begin::Hint-->
        @error('password')
        <div class="text-danger">
            {{ $message }}
        </div>
        @enderror
        <!--end::Hint-->
    </div>
    <!--end::Input group--->

    <!--begin::Input group-->
    <div class="fv-row mb-5">
        <label class="form-label fw-bolder text-dark fs-6 required">Confirm Password</label>

        <!--begin::Input wrapper-->
        <div class="position-relative mb-3">
            <input class="form-control form-control-lg form-control-solid" id="confirm_password" type="password" placeholder="" name="confirmPassword" autocomplete="off" required/>

            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" id="toggle_show_confirm_password">
                <i class="bi bi-eye-slash fs-2"></i>
            </span>
        </div>
        <!--end::Input wrapper-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    {{-- <div class="fv-row mb-10">
        <label class="form-check form-check-custom form-check-solid form-check-inline">
            <input class="form-check-input" type="checkbox" name="toc" value="1"/>
            <span class="form-check-label fw-bold text-gray-700 fs-6">
                I Agree <a href="#" class="ms-1 link-primary">Terms and conditions</a>.
            </span>
        </label>
    </div> --}}
    <!--end::Input group-->

    <!--begin::Actions-->
    <div class="text-center">
        <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
            <span class="indicator-label">
                Submit
            </span>
            <span class="indicator-progress">
                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </div>
    <!--end::Actions-->
</form>
</div>
@endsection

@push('js')
    <x-script-js :src="asset('assets/js/custom/pages/register-form.js')" />
@endpush
