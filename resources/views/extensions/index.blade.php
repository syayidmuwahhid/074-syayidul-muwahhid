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
                    <x-card.title :title="isset($data) ? 'Edit File Extension' : 'New File Extension'"/>
                </x-card.header>

                <x-card.body>
                    <x-form :method="isset($data) ? 'PUT' : 'POST'" :action="$action">
                        <x-form.input label="File Extension" type="text" placeholder="File Extension" :required="true" name="extension" :value="isset($data) ? $data->extension : ''" tooltip="Set the file extension."/>

                        <div class="form-group mb-6">
                            <label class="form-label required">File Type</label>
                            <select class="form-select" name="type" required>
                                @if (isset($data))
                                <option>{{ $data->type }}</option>
                                @endif
                                <option>image</option>
                                <option>video</option>
                                <option>document</option>
                            </select>

                            <div class="text-muted fs-7">set the file type.</div>
                        </div>

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
                    <x-card.title title="File Extension List" />
                    <!--end::Card title-->
                    <x-card.toolbar>
                        @php
                            $filterData = array();
                            foreach($datas as $data) {
                                array_push($filterData, $data->type);
                            }
                        @endphp
                        <x-table.filter column="2" :filterData="array_unique($filterData)" />

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
                            <th class="text-center">File Extension</th>
                            <th class="text-center">File Type</th>
                            <th class="text-center">Action</th>
                        </x-table.thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            <!--begin::Table row-->
                            @foreach ($datas->reverse() as $data)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $data->extension }}</td>
                                <td class="text-center">{{ $data->type }}</td>
                                <td class="text-center">
                                    <x-form :action="route('admin.file-extensions.destroy', Crypt::encryptString($data['id']))" method="DELETE" class="form-delete" id="form_delete{{ $loop->iteration }}" data-id="{{ Crypt::encryptString($data['id']) }}">
                                        <x-form.edit-btn :href="route('admin.file-extensions.edit', Crypt::encryptString($data['id']))" />
                                        <button type="button" class="btn btn-sm btn-danger btn-form-delete">Delete</button>
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
