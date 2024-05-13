@extends('layouts.app')

@section('title', $title)

@section('content')
<div class=" container-xxl " id="kt_content_container">

    <!--begin::Row-->
    <div class="row g-5 gx-xxl-8 mb-xxl-3">
        <!--begin::Col-->
        <div class="col-lg-4">
            <x-card>
                <x-card.header>
                    <x-card.title :title="isset($data) ? 'Edit Role' : 'New Role'"/>
                </x-card.header>

                <x-card.body>
                    <x-form :method="isset($data) ? 'PUT' : 'POST'" :action="$action">
                        <x-form.input label="ID" type="number" placeholder="Role ID" :required="true" name="id" :value="isset($data) ? $data['id'] : ''" tooltip="Set the role id."/>
                        <x-form.input label="Name" type="text" placeholder="Role Name" :required="true" name="name" :value="isset($data) ? $data['role'] : ''" tooltip="Set the role name."/>

                        <x-form.submit-btn />
                    </x-form>
                </x-card.body>
            </x-card>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <!--begin::Card title-->
                    <x-card.title title="Role List" />
                    <!--end::Card title-->
                    <x-card.toolbar>
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <x-table.search />
                        </div>
                        <!--end::Search-->
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
                            <th class="text-center">role</th>
                            <th class="text-center">Action</th>
                        </x-table.thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            <!--begin::Table row-->
                            @foreach ($datas as $data)
                            <tr>
                                <td class="text-center">{{ $data['id'] }}</td>
                                <td class="text-center">{{ $data['role'] }}</td>
                                <td class="text-center">
                                    <x-form :action="route('admin.roles.delete')" method="DELETE">
                                        <x-form.edit-btn :href="route('admin.roles.edit', Crypt::encryptString($data['id']))" />
                                        <input type="hidden" name="id" value="{{ $data['id'] }}" />
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </x-form>
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
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
@endsection
