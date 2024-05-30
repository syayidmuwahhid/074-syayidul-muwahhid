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
                        <span class="card-label fw-boldest fs-3 text-dark">Welcome {{ Auth::user()->name }}</span>
                    </h3>
                    <!--end::Card title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade active show" id="kt_chart_widget_1_tab_pane_1">
                            <!--begin::Row-->
                            <div class="row p-0 px-9 py-4">
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <a href="{{ route('admin.users.index') }}">
                                        <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                            <span class="fs-4 fw-bold text-gray-400 d-block">User Registered</span>
                                            <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="{{ $count_users }}">0</span>
                                        </div>
                                    </a>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <a href="{{ route('admin.transactions.index') }}">
                                        <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                            <span class="fs-4 fw-bold text-gray-400 d-block">User Transactions</span>
                                            <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="{{ $count_transactions }}">0</span>
                                        </div>
                                    </a>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <a href="{{ route('files.index') }}">
                                        <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                            <span class="fs-4 fw-bold text-gray-400 d-block">User Files</span>
                                            <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="{{ $count_files }}">0</span>
                                        </div>
                                    </a>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Stat-->
                                    <a href="{{ route('admin.logs') }}">
                                        <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-6 pb-4 my-3">
                                            <span class="fs-4 fw-bold text-gray-400 d-block">User Activities</span>
                                            <span class="fs-2x fw-boldest text-gray-800" data-kt-countup="true" data-kt-countup-value="{{ count($logs) }}">0</span>
                                        </div>
                                    </a>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Chart-->
                            {{-- <div class="px-4 mt-7" id="kt_charts_widget_1_chart_1" style="height: 350px"></div> --}}
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
    <x-card>
        <!--begin::Header-->
        <x-card.header>
            <x-card.title title="Last Activity" />
        </x-card.header>
        <!--end::Header-->
        <!--begin::Body-->
        <x-card.body>
            <!--begin::Timeline items-->
            <div class="timeline mt-5">
                <!--begin::Timeline item-->
                @foreach($logs->reverse() as $log)
                <div class="timeline-item">
                    <!--begin::Timeline line-->
                    <div class="timeline-line w-40px"></div>
                    <!--end::Timeline line-->
                    <!--begin::Timeline icon-->
                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                        <div class="symbol-label {{ $log->color }}">
                            <!--begin::Svg Icon | path: icons/duotone/Communication/Thumbtack.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-gray-500">
                                <i class="bi {{ $log->icon }} fs-2x" style="color:black"></i>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::Timeline icon-->
                    <!--begin::Timeline content-->
                    <div class="timeline-content mb-10 mt-n2  {{ $log->color }} p-3">
                        <!--begin::Timeline heading-->
                        <div class="overflow-auto pe-3">
                            <!--begin::Title-->
                            <div class="fs-5 fw-bold mb-2">{{ $log->description }}</div>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center mt-1 fs-6">
                                <!--begin::Info-->
                                <div class="text-muted me-2 fs-7">at {{ date('d F Y, H:i', strtotime($log->created_at)) }} by</div>
                                <!--end::Info-->
                                <!--begin::User-->
                                <a href="{{ route('admin.users.show', Crypt::encryptString($log->user_id)) }}">
                                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="{{ $log->user->name }}">
                                        <img src="{{ asset($log->user->avatar) }}" alt="img" />
                                    </div>
                                </a>
                                <!--end::User-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Timeline heading-->
                    </div>
                    <!--end::Timeline content-->
                </div>
                @endforeach
                <!--end::Timeline item-->

            </div>
            <!--end::Timeline items-->
        </x-card.body>
        <!--end::Body-->
    </x-card>
</div>
@endsection


@push('js')
    <x-script-js :src="asset('assets/js/custom/widgets.js')" />
@endpush
