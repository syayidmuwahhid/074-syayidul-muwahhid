@extends('layouts.app')
@php($menu_name = "Dashboard")

@section('title', "Admin $title")

@section('content')
<div class="container" id="kt_content_container">
    <!--begin::Row-->
    <div class="row g-5 gx-xxl-8 mb-xxl-3">
        <!--begin::Col-->
        <div class="col-12">
            <!--begin::Chart Widget 1-->
            <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-5">
                    <!--begin::Card title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-boldest fs-3 text-dark">Authors Overview</span>
                        <span class="text-gray-400 mt-2 fw-bold fs-6">22M total income</span>
                    </h3>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Nav-->
                        <ul class="nav nav-pills">
                            <li class="nav-item me-1">
                                <a class="nav-link btn btn-active-light active btn-color-gray-400 btn-active-color-gray-700" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_chart_widget_1_tab_pane_1">30 Days</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-active-light btn-color-gray-400 btn-active-color-gray-700" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_chart_widget_1_tab_pane_2">Sep 2020</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-active-light btn-color-gray-400 btn-active-color-gray-700" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_chart_widget_1_tab_pane_3">Oct 2020</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-active-light btn-color-gray-400 btn-active-color-gray-700" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_chart_widget_1_tab_pane_4">More</a>
                            </li>
                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <!--begin::Tab content-->
                    <div class="tab-content pt-10">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade active show" id="kt_chart_widget_1_tab_pane_1">
                            <!--begin::Row-->
                            <div class="row p-0 px-9">
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">User Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="3899">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Admin Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="72">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Author Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="291">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Failed Attempts</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="6">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Chart-->
                            <div class="px-4 mt-7" id="kt_charts_widget_1_chart_1" style="height: 350px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_chart_widget_1_tab_pane_2">
                            <!--begin::Row-->
                            <div class="row p-0 px-9">
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">User Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="2472">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Admin Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="34">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Author Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="419">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Failed Attempts</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="12">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Chart-->
                            <div class="px-4 mt-7" id="kt_charts_widget_1_chart_2" style="height: 350px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_chart_widget_1_tab_pane_3">
                            <!--begin::Row-->
                            <div class="row p-0 px-9">
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">User Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="2917">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Admin Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="102">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Author Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="219">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Failed Attempts</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="15">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Chart-->
                            <div class="px-4 mt-7" id="kt_charts_widget_1_chart_3" style="height: 350px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_chart_widget_1_tab_pane_4">
                            <!--begin::Row-->
                            <div class="row p-0 px-9">
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">User Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="7392">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Admin Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="23">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Author Sign-in</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="418">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                        <span class="fs-4 fw-bold text-gray-400 d-block">Failed Attempts</span>
                                        <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="11">0</span>
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Chart-->
                            <div class="px-4 mt-7" id="kt_charts_widget_1_chart_4" style="height: 350px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Tap pane-->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Chart Widget 1-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--Begin::Row-->
    <div class="row g-xxl-8">
        <!--begin::Col-->
        <div class="col-xxl-4">
            <!--begin::List Widget 1-->
            <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <!--begin::Card title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-boldest text-dark fs-3">Market Leaders</span>
                        <span class="text-gray-400 mt-1 fw-bold fs-6">Total 350k Products Sold</span>
                    </h3>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                            <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks-2.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                        <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start" data-kt-menu-flip="left-start, top">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Dropdown-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-5">
                    <!--begin::Item-->
                    <div class="d-flex align-items-sm-center mb-9">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label">
                                <img src="{{ asset('assets/media/svg/brand-logos/plurk.svg') }}" class="h-50 align-self-center" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                            <!--begin::Block-->
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-4 fw-boldest">Piper Aerostar</a>
                                <span class="text-muted fw-bold d-block pt-1">Mark, Rowling, Esther</span>
                            </div>
                            <!--end::Block-->
                            <!--begin::Badge-->
                            <span class="badge fs-6 badge-light fw-bolder my-2">+82$</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-sm-center mb-9">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label">
                                <img src="{{ asset('assets/media/svg/brand-logos/telegram-2.svg') }}" class="h-50 align-self-center" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                            <!--begin::Block-->
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-4 fw-boldest">Cirrus SR22</a>
                                <span class="text-muted fw-bold d-block pt-1">cirrus-aircraft.jsp</span>
                            </div>
                            <!--end::Block-->
                            <!--begin::Badge-->
                            <span class="badge fs-6 badge-light fw-bolder my-2">+280$</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-sm-center mb-9">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label">
                                <img src="{{ asset('assets/media/svg/misc/puzzle.svg') }}" class="h-50 align-self-center" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                            <!--begin::Block-->
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-4 fw-boldest">Beachcraft Baron</a>
                                <span class="text-muted fw-bold d-block pt-1">beachcraft-class.jsp</span>
                            </div>
                            <!--end::Block-->
                            <!--begin::Badge-->
                            <span class="badge fs-6 badge-light fw-bolder my-2">+4500$</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-sm-center mb-9">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label">
                                <img src="{{ asset('assets/media/svg/brand-logos/bebo.svg') }}" class="h-50 align-self-center" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                            <!--begin::Block-->
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-4 fw-boldest">Active Customers</a>
                                <span class="text-muted fw-bold d-block pt-1">Mark, Rowling, Esther</span>
                            </div>
                            <!--end::Block-->
                            <!--begin::Badge-->
                            <span class="badge fs-6 badge-light fw-bolder my-2">+1,050$</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-sm-center mb-0">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label">
                                <img src="{{ asset('assets/media/svg/misc/infography.svg') }}" class="h-50 align-self-center" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                            <!--begin::Block-->
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-4 fw-boldest">Cessna SF150</a>
                                <span class="text-muted fw-bold d-block pt-1">cessna-aircraft-class.jsp</span>
                            </div>
                            <!--end::Block-->
                            <!--begin::Badge-->
                            <span class="badge fs-6 badge-light fw-bolder my-2">+730$</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::List Widget 1-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-8">
            <!--begin::Table Widget 1-->
            <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5 pb-3">
                    <!--begin::Heading-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-boldest text-gray-800 fs-2">Teams Progress</span>
                        <span class="text-gray-400 fw-bold mt-2 fs-6">890,344 Sales</span>
                    </h3>
                    <!--end::Heading-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Select-->
                        <div class="pe-6 my-1">
                            <select class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="All Users" data-hide-search="true">
                                <option value="1" selected="selected">All Users</option>
                                <option value="2">Active users</option>
                                <option value="3">Pending users</option>
                            </select>
                        </div>
                        <!--end::Select-->
                        <!--begin::Search-->
                        <div class="w-125px position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->
                            <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" class="form-control form-control-sm form-control-solid ps-10" name="search" value="" placeholder="Search" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-0">
                    <!--begin::Table responsive-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered table-row-dashed gy-5" id="kt_table_widget_1">
                            <!--begin::Table body-->
                            <tbody>
                                <tr class="text-start text-gray-400 fw-boldest fs-7 text-uppercase">
                                    <th class="w-20px ps-0">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_widget_1 .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-200px px-0">Authors</th>
                                    <th class="min-w-125px">Progress</th>
                                    <th class="text-end pe-2 min-w-70px">Action</th>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-2">
                                                <span class="symbol-label">
                                                    <img alt="" class="w-25px" src="{{ asset('assets/media/svg/misc/infography.svg') }}" />
                                                </span>
                                            </div>
                                            <div class="ps-3">
                                                <a href="#" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">Ricky Hunt</a>
                                                <span class="text-gray-400 fw-bold d-block">HTML, JS, ReactJS</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column w-100 me-2 mt-2">
                                            <span class="text-gray-400 me-2 fw-boldest mb-2">65%</span>
                                            <div class="progress bg-light-warning w-100 h-5px">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 65%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-end">
                                        <a href="#" class="btn btn-light text-muted fw-boldest btn-sm px-5">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-2">
                                                <span class="symbol-label">
                                                    <img alt="" class="w-25px" src="{{ asset('assets/media/svg/misc/recycling.svg') }}" />
                                                </span>
                                            </div>
                                            <div class="ps-3">
                                                <a href="#" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">Anne Clarc</a>
                                                <span class="text-gray-400 fw-bold d-block">PHP, SQLite, Artisan CLI</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column w-100 me-2 mt-2">
                                            <span class="text-gray-400 me-2 fw-boldest mb-2">85%</span>
                                            <div class="progress bg-light-primary w-100 h-5px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 85%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-end">
                                        <a href="#" class="btn btn-light text-muted fw-boldest btn-sm px-5">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-2">
                                                <span class="symbol-label">
                                                    <img alt="" class="w-25px" src="{{ asset('assets/media/svg/misc/eolic-energy.svg') }}" />
                                                </span>
                                            </div>
                                            <div class="ps-3">
                                                <a href="#" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">Kristaps Zumman</a>
                                                <span class="text-gray-400 fw-bold d-block">PHP, Laravel, VueJS</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column w-100 me-2 mt-2">
                                            <span class="text-gray-400 me-2 fw-boldest mb-2">47%</span>
                                            <div class="progress bg-light-danger w-100 h-5px">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 47%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-end">
                                        <a href="#" class="btn btn-light text-muted fw-boldest btn-sm px-5">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-2">
                                                <span class="symbol-label">
                                                    <img alt="" class="w-25px" src="{{ asset('assets/media/svg/brand-logos/leaf.svg') }}" />
                                                </span>
                                            </div>
                                            <div class="ps-3">
                                                <a href="#" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">Natali Trump</a>
                                                <span class="text-gray-400 fw-bold d-block">Python, ReactJS</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column w-100 me-2 mt-2">
                                            <span class="text-gray-400 me-2 fw-boldest mb-2">71%</span>
                                            <div class="progress bg-light-info w-100 h-5px">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 71%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-end">
                                        <a href="#" class="btn btn-light text-muted fw-boldest btn-sm px-5">View</a>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table responsive-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Table Widget 1-->
        </div>
        <!--end::Col-->
    </div>
    <!--End::Row-->
    <!--Begin::Row-->
    <div class="row g-xxl-8">
        <!--begin::Col-->
        <div class="col-xxl-4">
            <!--begin::General Widget 1-->
            <div class="card mb-5 mb-xxl-8 card-xxl-stretch">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Wrapper-->
                    <div class="flex-grow-1">
                        <!--begin::Heading-->
                        <div class="d-flex flex-stack pr-2 mb-5">
                            <!--begin::Info-->
                            <span class="text-gray-400 fw-bold me-2">7 hours ago</span>
                            <!--end::Info-->
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50px">
                                <div class="symbol-label">
                                    <img src="{{ asset('assets/media/svg/brand-logos/treva.svg') }}" class="h-30px align-self-center" alt="" />
                                </div>
                            </div>
                            <!--end::Symbol-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Title-->
                        <a href="#" class="text-dark fw-bolder fs-2 text-hover-primary">Dis’ - Multiple Email Generator Dashboard Admin</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <p class="pt-5 fw-bold text-gray-600 fs-5">Outlines keep you honest. If stop indulging in poorly thought-out metaphors driving and keep structure many emails</p>
                        <!--end::Desc-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Users-->
                    <div class="mt-13">
                        <!--begin::User-->
                        <a href="#" class="symbol symbol-40px me-2" data-bs-toggle="tooltip" title="Ricky Hunt">
                            <img src="{{ asset('assets/media/avatars/150-2.jpg') }}" alt="" />
                        </a>
                        <!--end::User-->
                        <!--begin::User-->
                        <a href="#" class="symbol symbol-40px me-2" data-bs-toggle="tooltip" title="Emma Smith">
                            <img src="{{ asset('assets/media/avatars/150-5.jpg') }}" alt="" />
                        </a>
                        <!--end::User-->
                        <!--begin::User-->
                        <a href="#" class="symbol symbol-40px me-2" data-bs-toggle="tooltip" title="Rudy Stone">
                            <img src="{{ asset('assets/media/avatars/150-6.jpg') }}" alt="" />
                        </a>
                        <!--end::User-->
                        <!--begin::User-->
                        <a href="#" class="symbol symbol-40px me-2" data-bs-toggle="tooltip" title="Brad Dennis">
                            <img src="{{ asset('assets/media/avatars/150-24.jpg') }}" alt="" />
                        </a>
                        <!--end::User-->
                    </div>
                    <!--end::Users-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::General Widget 1-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-4">
            <!--begin::General Widget 1-->
            <div class="card mb-5 mb-xxl-8 card-xxl-stretch">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Wrapper-->
                    <div class="flex-grow-1">
                        <!--begin::Heading-->
                        <div class="d-flex flex-stack pr-2 mb-5">
                            <!--begin::Info-->
                            <span class="text-gray-400 fw-bold me-2">2 days ago</span>
                            <!--end::Info-->
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50px">
                                <div class="symbol-label">
                                    <img src="{{ asset('assets/media/svg/misc/puzzle.svg') }}" class="h-30px align-self-center" alt="" />
                                </div>
                            </div>
                            <!--end::Symbol-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Title-->
                        <a href="#" class="text-dark fw-bolder fs-2 text-hover-primary">Jet - ReactJS Admin Dashboard Template</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <p class="pt-5 fw-bold text-gray-600 fs-5">Outlines keep you honest. If stop and indulging in poorly thought-out metaphors driving and keep structure many emails indulging in poor conmne thought-out metaphors driving and keep a good structure many emails</p>
                        <!--end::Desc-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Users-->
                    <div class="mt-13">
                        <!--begin::User-->
                        <a href="#" class="symbol symbol-40px me-2" data-bs-toggle="tooltip" title="Carles Puyol">
                            <img src="{{ asset('assets/media/avatars/150-3.jpg') }}" alt="" />
                        </a>
                        <!--end::User-->
                        <!--begin::User-->
                        <a href="#" class="symbol symbol-40px me-2" data-bs-toggle="tooltip" title="Kristaps Zumman">
                            <img src="{{ asset('assets/media/avatars/150-12.jpg') }}" alt="" />
                        </a>
                        <!--end::User-->
                    </div>
                    <!--end::Users-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::General Widget 1-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-4">
            <!--begin::General Widget 1-->
            <div class="card mb-5 mb-xxl-8 card-xxl-stretch">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column">
                    <!--begin::Wrapper-->
                    <div class="flex-grow-1">
                        <!--begin::Heading-->
                        <div class="d-flex flex-stack pr-2 mb-5">
                            <!--begin::Info-->
                            <span class="text-gray-400 fw-bold me-2">A week ago</span>
                            <!--end::Info-->
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50px">
                                <div class="symbol-label">
                                    <img src="{{ asset('assets/media/svg/misc/recycling.svg') }}" class="h-30px align-self-center" alt="" />
                                </div>
                            </div>
                            <!--end::Symbol-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Title-->
                        <a href="#" class="text-dark fw-bolder fs-2 text-hover-primary">KT.com - Hight Quality Themes by Maret Leaders</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <p class="pt-5 fw-bold text-gray-600 fs-5">Outlines keep you honest. If stop indulging in poorly thought-out metaphors driving and keep structure many good emails indulging in poorly thought-out</p>
                        <!--end::Desc-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Users-->
                    <div class="mt-13">
                        <!--begin::User-->
                        <a href="#" class="symbol symbol-40px me-2" data-bs-toggle="tooltip" title="Kevin Leonard">
                            <img src="{{ asset('assets/media/avatars/150-13.jpg') }}" alt="" />
                        </a>
                        <!--end::User-->
                        <!--begin::User-->
                        <a href="#" class="symbol symbol-40px me-2" data-bs-toggle="tooltip" title="Lebron Wayde">
                            <img src="{{ asset('assets/media/avatars/150-11.jpg') }}" alt="" />
                        </a>
                        <!--end::User-->
                        <!--begin::User-->
                        <a href="#" class="symbol symbol-40px me-2" data-bs-toggle="tooltip" title="Brad Simmons">
                            <img src="{{ asset('assets/media/avatars/150-17.jpg') }}" alt="" />
                        </a>
                        <!--end::User-->
                    </div>
                    <!--end::Users-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::General Widget 1-->
        </div>
        <!--end::Col-->
    </div>
    <!--End::Row-->
</div>
@endsection


@push('js')
    {{-- <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script> --}}
    <x-script-js :src="asset('assets/js/custom/widgets.js')" />
    {{-- <script src="{{ asset('assets/js/custom/intro.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/modals/create-app.js') }}"></script> --}}
@endpush
