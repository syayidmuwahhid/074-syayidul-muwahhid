@extends('layouts.app')

@section('title', $title)

@section('content')
<div class=" container-xxl " id="kt_content_container">
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-lg-9 mb-xl-10">
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <!--begin::Card title-->
                    <x-card.title title="Profile Details" />
                    <!--end::Card title-->
                </x-card.header>
                <!--begin::Card header-->

                <!--begin::Content-->
                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="{{ $action }}" enctype="multipart/form-data">
                    @csrf @method('put')
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
                                <div class="image-input image-input-outline m-4" data-kt-image-input="true" style="background-image: url({{ asset('assets/media/svg/avatars/blank.svg') }})">
                                    <!--begin::Preview existing avatar-->
                                    <img id="image-input-show" src="{{ asset($data["avatar"]) }}" height="100" class="icon"/>
                                    <!--end::Preview existing avatar-->
                                </div>

                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                <input type="hidden" id="avatar_old" value="{{ $data["avatar"] }}">
                                <!--end::Image input-->

                                <!--begin::Hint-->
                                <div class="form-text">Allowed file types:  png, jpg, jpeg.</div>
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
                                <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="{{ $data["name"] }}">
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
                                <input type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{ $data["email"] }}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">Contact Phone</span>

                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Phone number must be active" aria-label="Phone number must be active"></i>
                            </label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{ $data["phone"] }}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">New Password</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="New Password">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        @if (Auth::user()->role_id == 1)
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Role</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <select class="form-select" name="role_id">
                                    <option value="{{ $data["role_id"] }}">{{ $data["role"]->role }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        @endif
                        <!--end::Input group-->

                    </div>
                    <!--end::Card body-->

                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        {{-- <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button> --}}

                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                    </div>
                    <!--end::Actions-->
                <input type="hidden"><div></div></form>
                <!--end::Form-->
                <!--end::Content-->
            </x-card>
        </div>
        <!--end::col-->

        <!--begin::Col-->
        @if (Auth::user()->role_id == 1)
        <div class="col-lg-3 mb-xl-10">
            <!--begin::Engage widget 1-->
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <!--begin::Card title-->
                    <x-card.title title="Change Status"/>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <x-card.toolbar>
                        <div class="rounded-circle w-15px h-15px bg-primary bg-{{ $data['status'] == '1' ? 'success' : 'danger' }}"></div>
                    </x-card.toolbar>
                    <!--begin::Card toolbar-->
                </x-card.header>
                <!--end::Card header-->

                <!--begin::Card body-->
                <x-card.body>
                    <form method="post" action="{{ route('admin.users.change-status') }}" class="form form-change-status">
                        @csrf @method('patch')
                        <input type="hidden" name="id" value="{{ $data["id"] }}">
                        <!--begin::Select2-->
                        <select class="form-select mb-2" data-placeholder="Select an option" id="status-changer" name="status">
                            <option value="{{ $data["status"] }}">{{ \App\Helpers\Anyhelpers::getStatus($data["status"]) }}</option>
                            <option value="{{ $data["status"] == 1 ? 0 : 1 }}">{{ \App\Helpers\Anyhelpers::getStatus($data["status"] == 1 ? 0 : 1) }}</option>
                        </select>
                        <!--end::Select2-->
                    </form>

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the user status.</div>
                    <!--end::Description-->
                </x-card.body>
                <!--end::Card body-->
            </x-card>
            <!--end::Engage widget 1-->
        </div>
        @endif
        <!--end::col-->
    </div>

</div>
@endsection

@push('js')
<x-script-js :src="asset('assets/js/custom/pages/users-form.js')" />
@endpush
