@extends('layouts.app')

@section('title', $title)

@section('content')
<div class=" container-xxl " id="kt_content_container">
    <!--begin::Row-->
    <div class="row g-5 gx-xxl-8 mb-xxl-3">
        <!--begin::Col-->
        <div class="col-12">
            <!--begin::Chart Widget 1-->
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <!--begin::Card title-->
                    <x-card.title title="">
                        <x-table.search />
                    </x-card.title>
                    <!--end::Card title-->

                    <x-card.toolbar>
                        @php
                            $filterData = array();
                            foreach($roles as $role) {
                                array_push($filterData, $role['role']);
                            }
                        @endphp
                        <x-table.filter column="2" :filterData="$filterData" />

                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            Add Users
                        </a>
                    </x-card.toolbar>
                </x-card.header>
                <!--end::Header-->
                <!--begin::Card body-->
                <x-card.body>
                    <!--begin::Table-->
                    <x-table>
                        <!--begin::Table head-->
                        <x-table.thead>
                            <th class="text-center">#</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined Date</th>
                            <th class="text-center">Action</th>
                        </x-table.thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            <!--begin::Table row-->
                            @foreach ($datas as $data)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="{{ route('admin.users.show', Crypt::encryptString($data["id"])) }}">
                                                <div class="symbol-label">
                                                    <img src="{{ asset($data["avatar"]) }}" alt="{{ $data["name"] }}" class="w-100">
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->

                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.users.show', Crypt::encryptString($data["id"])) }}" class="text-gray-800 text-hover-primary mb-1">{{ $data["name"] }}</a>
                                            <span>{{ $data["email"] }}</span>
                                        </div>
                                        <!--begin::User details-->

                                    </td>
                                    <td>{{ $data->role->role }}</td>
                                    <td><span class="badge {{ $data['status'] == '0' ?  'badge-light-danger' : 'badge-light-success' }}">{{ \App\Helpers\Anyhelpers::getStatus($data["status"]) }}</span></td>
                                    <td>{{ date('d F Y, H:i', strtotime($data["created_at"])) }}</td>
                                    <td class="text-center">
                                        @if ($data->id != 1)
                                        <x-form :action="route('admin.users.destroy', Crypt::encryptString($data['id']))" method="DELETE" class="form-delete" id="form_delete{{ $loop->iteration }}" data-id="{{ Crypt::encryptString($data['id']) }}">
                                            {{-- <input type="hidden" name="id" value="{{ $data['id'] }}" /> --}}
                                            <button type="button" class="btn btn-sm btn-danger btn-form-delete">Delete</button>
                                        </x-form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <!--end::Table row-->
                        </tbody>
                        <!--end::Table body-->
                    </x-table>
                    <!--end::Table-->
                </x-card.body>
                <!--end::Card body-->
            </x-card>
            <!--end::Chart Widget 1-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
