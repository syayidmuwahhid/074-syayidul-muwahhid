@extends('layouts.app')

@section('title', $title)

@section('content')
<div class=" container-xxl " id="kt_content_container">
    <!--begin::Row-->
    <div class="row g-5 gx-xxl-8 mb-xxl-3">
        <!--begin::Col-->
        <div class="col-lg-4">
            <!--begin::Chart Widget 1-->
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <x-card.title :title="isset($data) ? 'Edit Status' : 'New Status'"/>
                </x-card.header>
                <!--end::Header-->
                <!--begin::Card body-->
                <x-card.body>
                    <x-form :action="$action" :method="isset($data) ? 'PUT' : 'POST'">
                        <x-form.input :required="true" label="ID" type="number" placeholder="Status ID" name="id" :value="isset($data) ? $data['id'] : ''" tooltip="Set the status id."/>
                        <x-form.input :required="true" label="Name" type="text" placeholder="Status Name" name="name" :value="isset($data) ? $data['status'] : ''" tooltip="Set the status name."/>
                        
                        <x-form.submit-btn />
                    </x-form>
                </x-card.body>
                <!--end::Card body-->
            </x-card>
            <!--end::Chart Widget 1-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Chart Widget 1-->
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <!--begin::Card title-->
                    <x-card.title title="Status List" />
                    <!--end::Card title-->
                    <x-card.toolbar>
                        <x-table.search />
                    </x-card.toolbar>
                </x-card.header>
                <!--end::Header-->
                <!--begin::Card body-->
                <x-card.body>
                    <!--begin::Table-->
                    <x-table>
                        <!--begin::Table head-->
                        <x-table.thead>
                            <th class="text-center">ID</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </x-table.thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            <!--begin::Table row-->
                            @foreach ($datas as $data)
                            <tr>
                                <td class="text-center">{{ $data['id'] }}</td>
                                <td class="text-center">{{ $data['status'] }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.statuses.delete') }}" method="post">
                                        @csrf @method("delete")
                                        <a href="{{ route('admin.statuses.edit', Crypt::encryptString($data['id'])) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <input type="hidden" name="id" value="{{ $data['id'] }}" />
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
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
