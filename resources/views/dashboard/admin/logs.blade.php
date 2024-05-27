@extends('layouts.app')
@php($menu_name = "Dashboard")

@section('title', $title)

@section('content')
<div class="container-xxl" id="kt_content_container">
    <x-card>
        <!--begin::Header-->
        <x-card.header>
            <x-card.title title="Activity Logs" />
        </x-card.header>
        <!--end::Header-->
        <!--begin::Body-->
        <x-card.body>
            <!--begin::Timeline items-->
            <div class="timeline mt-5">
                <!--begin::Timeline item-->
                @foreach($datas->reverse() as $log)
                @php($color = $log->type)
                @php($icon = 'bi-check-lg')
                @if ($log->type == 'info')
                    @php($color = 'primary')
                    @php($icon = 'bi-info-lg')
                @elseif ($log->type == 'fail')
                    @php($color = 'danger')
                    @php($icon = 'bi-x-lg')
                @elseif ($log->type == 'warning')
                    @php($icon = 'bi-exclamation-triangle')
                @endif
                <div class="timeline-item">
                    <!--begin::Timeline line-->
                    <div class="timeline-line w-40px"></div>
                    <!--end::Timeline line-->
                    <!--begin::Timeline icon-->
                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                        <div class="symbol-label bg-light-{{ $color }}">
                            <!--begin::Svg Icon | path: icons/duotone/Communication/Thumbtack.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-gray-500">
                                <i class="bi {{ $icon }} fs-2x" style="color:black"></i>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::Timeline icon-->
                    <!--begin::Timeline content-->
                    <div class="timeline-content mb-10 mt-n2  bg-light-{{ $color }} p-3">
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
    {{-- <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script> --}}
    {{-- <x-script-js :src="asset('assets/js/custom/widgets.js')" /> --}}
    {{-- <script src="{{ asset('assets/js/custom/intro.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/modals/create-app.js') }}"></script> --}}
@endpush
