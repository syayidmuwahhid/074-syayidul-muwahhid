<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between" id="kt_header_container">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
            <!--begin::Heading-->
            <h1 class="text-dark fw-bolder my-1 fs-2">{{ $title_page }}
            <small class="text-muted fs-6 fw-normal ms-1"></small></h1>
            <!--end::Heading-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb fw-bold fs-base my-1">
                @foreach ($breadcrumbs as $key => $breadcrumb)
                <li class="breadcrumb-item text-muted">
                    <a href="{{ $breadcrumb }}" class="{{ $loop->last ? 'text-dark' : 'text-muted' }}">{{ $key }}</a>
                </li>
                @endforeach
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title=-->
        <!--begin::Wrapper-->
        <div class="d-flex d-lg-none align-items-center ms-n2 me-2">
            <!--begin::Aside mobile toggle-->
            <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                <!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
                <span class="svg-icon svg-icon-2x">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                            <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Aside mobile toggle-->
            <!--begin::Logo-->
            <a href="{{ url('') }}" class="d-flex align-items-center">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-compact.svg') }}" class="max-h-40px" />
            </a>
            <!--end::Logo-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Toolbar wrapper-->
        <div class="d-flex align-items-stretch flex-shrink-0">
            <!--begin::Quick links-->
            @if (Auth::user()->role_id != 1)
            <div class="d-flex align-items-center ms-1 ms-lg-3">
                <!--begin::Menu wrapper-->
                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                    <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
                    <!--begin::Heading-->
                    <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url({{ asset('assets/media//misc/pattern-2.jpg') }})">
                        <!--begin::Title-->
                        <h3 class="text-white fw-bold mb-3">Quick Links</h3>
                        <!--end::Title-->
                        <!--begin::Status-->
                        {{-- <span class="badge bg-success py-2 px-3">25 pending tasks</span> --}}
                        <!--end::Status-->
                    </div>
                    <!--end::Heading-->
                    <!--begin:Nav-->
                    <div class="row g-0">
                        <!--begin:Item-->
                        <div class="col-6">
                            <a href="{{ route('user.dashboard') }}" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                                <!--begin::Svg Icon | path: icons/duotone/Communication/Group.svg-->
                                <span class="svg-icon svg-icon-3x svg-icon-success mb-2">
                                    <i class="bi bi-house-fill fs-3x" style="color:#50cd89"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-5 fw-bold text-gray-800 mb-0">Home</span>
                                <span class="fs-7 text-gray-400">Go to Dashboard</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-6">
                            <a href="{{ route('user.transactions.index') }}" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                                <!--begin::Svg Icon | path: icons/duotone/Communication/Group.svg-->
                                <span class="svg-icon svg-icon-3x svg-icon-success mb-2">
                                    <i class="bi bi-cloud-upload-fill fs-3x" style="color:#50cd89"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-5 fw-bold text-gray-800 mb-0">Transactions</span>
                                <span class="fs-7 text-gray-400">List Resource</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-12">
                            <a href="{{ route('files.index') }}" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
                                <!--begin::Svg Icon | path: icons/duotone/Communication/Mail-attachment.svg-->
                                <span class="svg-icon svg-icon-3x svg-icon-success mb-2">
                                    <i class="bi bi-folder-symlink-fill fs-3x" style="color:#50cd89"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-5 fw-bold text-gray-800 mb-0">Files</span>
                                <span class="fs-7 text-gray-400">List Files</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        {{-- <div class="col-6">
                            <a href="#" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">
                                <!--begin::Svg Icon | path: icons/duotone/Shopping/Euro.svg-->
                                <span class="svg-icon svg-icon-3x svg-icon-success mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M4.3618034,10.2763932 L4.8618034,9.2763932 C4.94649941,9.10700119 5.11963097,9 5.30901699,9 L15.190983,9 C15.4671254,9 15.690983,9.22385763 15.690983,9.5 C15.690983,9.57762255 15.6729105,9.65417908 15.6381966,9.7236068 L15.1381966,10.7236068 C15.0535006,10.8929988 14.880369,11 14.690983,11 L4.80901699,11 C4.53287462,11 4.30901699,10.7761424 4.30901699,10.5 C4.30901699,10.4223775 4.32708954,10.3458209 4.3618034,10.2763932 Z M14.6381966,13.7236068 L14.1381966,14.7236068 C14.0535006,14.8929988 13.880369,15 13.690983,15 L4.80901699,15 C4.53287462,15 4.30901699,14.7761424 4.30901699,14.5 C4.30901699,14.4223775 4.32708954,14.3458209 4.3618034,14.2763932 L4.8618034,13.2763932 C4.94649941,13.1070012 5.11963097,13 5.30901699,13 L14.190983,13 C14.4671254,13 14.690983,13.2238576 14.690983,13.5 C14.690983,13.5776225 14.6729105,13.6541791 14.6381966,13.7236068 Z" fill="#000000" opacity="0.3" />
                                            <path d="M17.369,7.618 C16.976998,7.08599734 16.4660031,6.69750122 15.836,6.4525 C15.2059968,6.20749878 14.590003,6.085 13.988,6.085 C13.2179962,6.085 12.5180032,6.2249986 11.888,6.505 C11.2579969,6.7850014 10.7155023,7.16999755 10.2605,7.66 C9.80549773,8.15000245 9.45550123,8.72399671 9.2105,9.382 C8.96549878,10.0400033 8.843,10.7539961 8.843,11.524 C8.843,12.3360041 8.96199881,13.0779966 9.2,13.75 C9.43800119,14.4220034 9.7774978,14.9994976 10.2185,15.4825 C10.6595022,15.9655024 11.1879969,16.3399987 11.804,16.606 C12.4200031,16.8720013 13.1129962,17.005 13.883,17.005 C14.681004,17.005 15.3879969,16.8475016 16.004,16.5325 C16.6200031,16.2174984 17.1169981,15.8010026 17.495,15.283 L19.616,16.774 C18.9579967,17.6000041 18.1530048,18.2404977 17.201,18.6955 C16.2489952,19.1505023 15.1360064,19.378 13.862,19.378 C12.6999942,19.378 11.6325049,19.1855019 10.6595,18.8005 C9.68649514,18.4154981 8.8500035,17.8765035 8.15,17.1835 C7.4499965,16.4904965 6.90400196,15.6645048 6.512,14.7055 C6.11999804,13.7464952 5.924,12.6860058 5.924,11.524 C5.924,10.333994 6.13049794,9.25950479 6.5435,8.3005 C6.95650207,7.34149521 7.5234964,6.52600336 8.2445,5.854 C8.96550361,5.18199664 9.8159951,4.66400182 10.796,4.3 C11.7760049,3.93599818 12.8399943,3.754 13.988,3.754 C14.4640024,3.754 14.9609974,3.79949954 15.479,3.8905 C15.9970026,3.98150045 16.4939976,4.12149906 16.97,4.3105 C17.4460024,4.49950095 17.8939979,4.7339986 18.314,5.014 C18.7340021,5.2940014 19.0909985,5.62999804 19.385,6.022 L17.369,7.618 Z" fill="#000000" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="fs-5 fw-bold text-gray-800 mb-0">Finance</span>
                                <span class="fs-7 text-gray-400">Credit &amp; Payments</span>
                            </a>
                        </div> --}}
                        <!--end:Item-->
                    </div>
                    <!--end:Nav-->
                    <!--begin::View more-->
                    <div class="py-2 text-center border-top">
                        {{-- <a href="#" class="btn btn-color-gray-600 btn-active-color-primary">View All
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Right-2.svg-->
                        <span class="svg-icon svg-icon-5">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <rect fill="#000000" opacity="0.5" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
                                    <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                </g>
                            </svg>
                        </span> --}}
                        <!--end::Svg Icon--></a>
                    </div>
                    <!--end::View more-->
                </div>
                <!--end::Menu-->
                <!--end::Menu wrapper-->
            </div>
            @endif
            <!--end::Quick links-->
            <!--begin::Activities-->
            <div class="d-flex align-items-center ms-1 ms-lg-3">
                <!--begin::drawer toggle-->
                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_activities_toggle">
                    <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
                                <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
                                <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::drawer toggle-->
            </div>
            <!--end::Activities-->
            <!--begin::User-->
            <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                <!--begin::Menu wrapper-->
                <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                    <img src="{{ asset(Auth::user()->avatar) }}" alt="metronic" />
                </div>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="{{ asset(Auth::user()->avatar) }}" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bolder d-flex align-items-center fs-5">{{ Auth::user()->name }}</div>
                                <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="{{ route('profile.index') }}" class="menu-link px-5">Profile</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    {{-- <div class="separator my-2"></div> --}}
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="{{ route('logout') }}" class="menu-link px-5">Sign Out</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::User -->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Container-->
</div>
