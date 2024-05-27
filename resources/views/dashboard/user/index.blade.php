@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="container" id="kt_content_container">
    <!--begin::Row-->
    <div class="row g-5 gx-xxl-8 mb-xxl-3">
        <!--begin::Col-->
        <div class="col-12">
            <!--begin::Engage Widget 1-->
            <div class="card card-xxl-stretch">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column justify-content-between h-100">
                    <!--begin::Section-->
                    <div class="pt-12">
                        <!--begin::Title-->
                        <h3 class="text-dark text-center fs-1 fw-boldest line-height-lg">API Resource Manager</h3>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="text-center text-gray-600 fs-5 fw-bold pt-4">Easy to store your files. to be used as a resource (link) for an application.</div>
                        <!--end::Text-->
                        <!--begin::Action-->
                        <div class="text-center py-7 mb-18">
                            <a href="{{ route('user.transactions.create') }}" class="btn btn-primary fs-6 px-6">New Resource</a>
                        </div>
                        <!--end::Action-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Image-->
                    <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom card-rounded-bottom h-200px" style="background-image:url('assets/media/illustrations/coding.png')"></div>
                    <!--end::Image-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Engage Widget 1-->
        </div>
        <!--end::Col-->
    </div>
    <div class="row g-5 gx-xxl-8 mb-xxl-3 mt-4">
        <!--begin::Col-->
        <div class="col-12">
            <!--begin::Table Widget 1-->
            <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5 pb-3">
                    <!--begin::Heading-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-boldest text-gray-800 fs-2">Last Transaction</span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-0">
                    <!--begin::Table responsive-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed table-rounded fs-6 gy-5 table-hover">
                            <!--begin::Table head-->
                            <x-table.thead>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Number of files</th>
                                <th>Tags</th>
                                <th>Status</th>
                            </x-table.head>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            <tbody>
                                @if(count($datas) == 0)
                                <tr><td colspan="6" class="text-center text-gray-500">No Data Found</td></tr>
                                @endif
                                <!--begin::Table row-->
                                @foreach ($datas as $data)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('transactions.show', Crypt::encryptString($data->id)) }}" class="text-gray-800 text-hover-primary mb-1">{{ $data["title"] }}</a>
                                    </td>
                                    <td>{{ date('d F Y', strtotime($data->created_at)) }}</td>
                                    <td>{{ count($data->file) }} Files</td>
                                    @php
                                        $tags = explode(',', $data->tags);
                                    @endphp
                                    <td>
                                        @foreach ($tags as $tag)
                                            <span class="badge badge-light-info">{{ $tag }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($data->status_id == '1')
                                        @php($badge = 'badge-warning')
                                        @elseif($data->status_id == '2')
                                        @php($badge = 'badge-success')
                                        @else
                                        @php($badge = 'badge-danger')
                                        @endif
                                        <span class="badge {{ $badge }}">{{ $data->status->status }}</span>
                                    </td>
                                </tr>
                                @endforeach
                                <!--end::Table row-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                    <!--end::Table responsive-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Table Widget 1-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>

@endsection

@push('js')
    {{-- <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/widgets.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/intro.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/modals/create-app.js') }}"></script> --}}
@endpush
