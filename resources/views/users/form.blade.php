@extends('layouts.app')

@section('title', $title)

@section('content')
<div class=" container-xxl " id="kt_content_container">
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-lg-12 mb-xl-10">
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <!--begin::Card title-->
                    <x-card.title title="Add User" />
                    <!--end::Card title-->
                </x-card.header>
                <!--begin::Card header-->

                <!--begin::Content-->
                <!--begin::Form-->
                <x-card.body>
                    <form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Avatar</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    {{-- <div class="image-input image-input-outline m-4" data-kt-image-input="true" style="background-image: url({{ asset('assets/media/svg/avatars/blank.svg') }})"> --}}
                                        <!--begin::Preview existing avatar-->
                                        <img id="image-input-show" src="{{ asset('assets/media/svg/avatars/blank.svg') }}" height="100" class="icon mb-7"/>
                                        <!--end::Preview existing avatar-->
                                    {{-- </div> --}}
                                    <br>

                                    <input class="form-control" type="file" name="avatar" accept=".png, .jpg, .jpeg, .svg" value="{{ old('file') }}">
                                    <!--end::Image input-->

                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types:  png, jpg, jpeg, svg.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <input type="text" name="name" class="form-control form-control-lg mb-3 mb-lg-0" placeholder="Full name" required value="{{ old('name') }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Email</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="email" class="form-control form-control-lg" placeholder="Email" required value="{{ old('email') }}">
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="">Contact Phone</span>

                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Phone number must be active" aria-label="Phone number must be active"></i>
                                </label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="tel" name="phone" class="form-control form-control-lg" placeholder="Phone number" value="{{ old('phone') }}">
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Password</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="password" class="form-control form-control-lg" placeholder="New Password" required value="12345678">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Role</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <select class="form-select" name="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->

                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>

                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                        </div>
                        <!--end::Actions-->
                    <input type="hidden"><div></div></form>

                </x-card.body>
                <!--end::Form-->
                <!--end::Content-->
            </x-card>
        </div>
        <!--end::col-->

    </div>

</div>
@endsection

@push('js')
<x-script-js :src="asset('assets/js/custom/pages/users-form.js')" />
@endpush
