@extends('layouts.app')

@section('title', $title)

@section('content')
<div class=" container-xxl " id="kt_content_container">

    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-lg-4 mb-xl-10">
            <!--begin::Engage widget 1-->
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <x-card.title title="Transaction [#{{ $data['id'] }}]" />
                </x-card.header>
                <!--end::Card header-->

                <!--begin::Card body-->
                <x-card.body>
                    <div class="row form-group mb-7">
                        <label class="form-label col-md-5 col-lg-12">Title</label>
                        <div class="col-md-7 col-lg-12">
                            <input class="form-control form-control-solid" value="{{ $data['title'] }}" readonly/>
                        </div>
                    </div>
                    <div class="row form-group mb-7">
                        <label class="form-label col-md-5 col-lg-12">Transaction Date</label>
                        <div class="col-md-7 col-lg-12">
                            <input class="form-control form-control-solid" value="{{ $data['date'] }}" readonly/>
                        </div>
                    </div>
                    <div class="row form-group mb-7">
                        <label class="form-label col-md-5 col-lg-12">User Add</label>
                        <div class="col-md-7 col-lg-12">
                            <input class="form-control form-control-solid" value="{{ $data['user_add'] }}" readonly/>
                        </div>
                    </div>
                    <div class="row form-group mb-7">
                        <label class="form-label col-md-5 col-lg-12">Tags</label>
                        <div class="col-md-7 col-lg-12">
                            <tags class="tagify form-control mb-2" tabindex="-1" aria-expanded="false">
                                @php($tags = explode(',', $data['tags']))
                                @foreach ($tags as $tag)
                                <tag title="new" contenteditable="false" spellcheck="false" tabindex="-1" class="tagify__tag tagify--noAnim">
                                    <div>
                                        <span class="tagify__tag-text">{{ $tag }}</span>
                                    </div>
                                </tag>
                                @endforeach
                            </tags>
                        </div>
                    </div>
                </x-card.body>
                <!--end::Card body-->
            </x-card>
            <!--end::Engage widget 1-->
        </div>
        <!--end::col-->
        <div class="col-lg-8 mb-xl-10">
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <x-card.title title="Files" />
                </x-card.header>
                <!--end::Card header-->

                <!--begin::Card body-->
                <x-card.body>
                    <x-table>
                        <!--begin::Table head-->
                        <x-table.thead>
                                <th class="text-center">ID</th>
                                <th class="text-center">File</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">Action</th>
                        </x-table.thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            <!--begin::Table row-->
                            @foreach ($files as $file)
                            @php($filename = $file['location'].$file['name'].".".$file['extension'])
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    @switch($file['extension'])
                                        @case("png")
                                        @case("jpg")
                                        @case("jpeg")
                                            <img src="{{ url($filename) }}" alt="file" width="200"/>
                                        @break

                                        @default

                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <button data-link="{{ url($filename) }}" class="btn btn-success btn-sm copy_txt_btn">
                                        <i class="bi bi-paperclip fs-3"></i>
                                        Copy
                                    </button>
                                </td>
                                <td>
                                    <x-form :action="route('files.delete')" method="DELETE">
                                        <input type="hidden" name="id" value="{{ $file['id'] }}" />
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </x-form>
                                </td>
                            </tr>
                            @endforeach
                            <!--end::Table row-->
                        </tbody>
                        <!--end::Table body-->
                    </x-table>
                </x-card.body>
                <!--end::Card body-->
            </x-card>
        </div>
    </div>

@endsection

@push('js')
    <x-script-js :src="asset('assets/js/custom/pages/detail-transaction.js')" />
@endpush
