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
                    @if($data->status_id == '1')
                    @php($badge = 'badge-light-warning')
                    @elseif($data->status_id == '2')
                    @php($badge = 'badge-light-success')
                    @else
                    @php($badge = 'badge-light-danger')
                    @endif
                    <x-card.title title="Resource Transaction <span class='badge {{ $badge }}'>{{ $data->status->status }}</span>" />
                    <x-card.toolbar>
                        @if (Auth::user()->role_id != 1)
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit"><i class="bi bi-pencil"></i></button>
                        @endif

                        <x-modal id="modal-edit">
                            <x-form method="PUT" :action="route('user.transactions.update', Crypt::encryptString($data->id))" >
                            <x-modal.header title="Edit Data Resource" />
                            <x-modal.body>
                                    <div class="form-group mb-6">
                                        <label class="form-label required">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Resource Title" value="{{ isset($data) ? $data->title : old('title') }}" required>
                                    </div>

                                    <div class="form-group mb-6">
                                        <label class="form-label">Tags</label>
                                        <input name="tags" class="tagify--custom-dropdown form-control" placeholder="Type a tag letter" value="{{ isset($data) ? $data->tags : '' }}">
                                    </div>

                                    @if ($data->status_id == 1)
                                    <div class="form-group mb-6">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status_id">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                </x-modal.body>
                                <x-modal.footer />
                            </x-form>
                        </x-modal>
                    </x-card.toolbar>

                </x-card.header>
                <!--end::Card header-->

                <!--begin::Card body-->
                <x-card.body>
                    <div class="row form-group mb-7">
                        <label class="form-label col-md-5 col-lg-12">Title</label>
                        <div class="col-md-7 col-lg-12">
                            <input class="form-control form-control-solid" value="{{ $data->title }}" readonly/>
                        </div>
                    </div>
                    <div class="row form-group mb-7">
                        <label class="form-label col-md-5 col-lg-12">Date</label>
                        <div class="col-md-7 col-lg-12">
                            <input class="form-control form-control-solid" value="{{ date('d F Y', strtotime($data->created_at)) }}" readonly/>
                        </div>
                    </div>
                    @if(Auth::user()->role_id == 1)
                    <div class="row form-group mb-7">
                        <label class="form-label col-md-5 col-lg-12">User Add</label>
                        <div class="col-md-7 col-lg-12">
                            <input class="form-control form-control-solid" value="{{ $data->user->name }}" readonly/>
                        </div>
                    </div>
                    @endif
                    <div class="row form-group mb-7">
                        <label class="form-label col-md-5 col-lg-12">Tags</label>
                        <div class="col-md-7 col-lg-12">
                            <tags class="tagify form-control mb-2" tabindex="-1" aria-expanded="false">
                                @php($tags = explode(',', $data->tags))
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
            <br />
            @if ($data->status_id == 1)
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <!--begin::Card title-->
                    <x-card.title title="Change Status"/>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <x-card.toolbar>
                        @if($data->status_id == '1')
                        @php($bg = 'warning')
                        @elseif($data->status_id == '2')
                        @php($bg = 'success')
                        @else
                        @php($bg = 'danger')
                        @endif
                        <div class="rounded-circle w-15px h-15px bg-primary bg-{{ $bg }}"></div>
                    </x-card.toolbar>
                    <!--begin::Card toolbar-->
                </x-card.header>
                <!--end::Card header-->

                <!--begin::Card body-->
                <x-card.body>
                    <form method="post" action="{{ route('transactions.change-status') }}" class="form form-change-status">
                        @csrf @method('patch')
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <!--begin::Select2-->
                        <select class="form-select mb-2" data-placeholder="Select an option" id="status-changer" name="status">
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                        <!--end::Select2-->
                    </form>

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the user status.</div>
                    <!--end::Description-->
                </x-card.body>
                <!--end::Card body-->
            </x-card>
            @endif
        </div>
        <!--end::col-->
        <div class="col-lg-8 mb-xl-10">
            <x-card style="display:none" id="card_form_files">
                <!--begin::Card header-->
                <x-card.header>
                    <!--begin::Card title-->
                    <x-card.title title="Add Files to Resource"/>
                    <!--end::Card title-->
                </x-card.header>
                <!--begin::Card header-->

                <!--begin::Card body-->
                <x-card.body>
                    <form action="{{ route('user.files.store') }}" class="dropzone" id="my-awesome-dropzone">
                        @csrf
                        <input type="hidden" name="transaction_id" value="{{ $data->id }}"/>
                        <input type="hidden" name="transaction_title" value="{{ $data->title }}"/>
                    </form>
                    <div class="text-muted fs-5">Reload Page After Upload File
                        <a href="{{ request()->url() }}">Click Here To Reload</a>
                    </div>
                </x-card.body>
                <!--end::Card body-->
            </x-card>

            <br />

            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <x-card.title title="Files" />
                    <x-card.toolbar>
                        @if (Auth::user()->role_id != 1)
                        <button class="btn btn-primary" id="btn_add_file">Add File</button>
                        @endif
                    </x-card.toolbar>
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
                                @if (Auth::user()->role_id != 1)
                                <th class="text-center">Action</th>
                                @endif
                        </x-table.thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            <!--begin::Table row-->
                            @foreach ($data->file as $file)
                            @php($filename = $file['location'].$file['name'])
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <?php
                                        $ext = explode('.', $filename)[1];
                                        if($ext == 'mp4' || $ext == 'mkv' || $ext == 'mov' || $ext == 'ts') {
                                            $link = 'https://png.pngtree.com/png-vector/20190215/ourmid/pngtree-play-video-icon-graphic-design-template-vector-png-image_530837.jpg';
                                            $modalAsset = '<video width="640" height="360" controls>
                                                                <source src="'. asset($filename) .'" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>';
                                        } elseif ($ext == 'pdf') {
                                            $link = 'https://st3.depositphotos.com/4799321/14326/v/450/depositphotos_143261637-stock-illustration-pdf-download-vector-icon-simple.jpg';
                                            $modalAsset = '<iframe src="'. asset($filename) .'" width="800" height="500"></iframe>';
                                        } else {
                                            $link = asset($filename);
                                            $modalAsset = '<img src="'. asset($filename) .'" alt="file" />';
                                        }
                                    ?>

                                    <img src="{{ $link }}" alt="file" width="200" data-bs-toggle="modal" data-bs-target="#modal-{{ $file->id }}"/>

                                    <x-modal id="modal-{{ $file->id }}">
                                        {!! $modalAsset !!}
                                    </x-modal>
                                </td>
                                <td class="text-center">
                                    <button data-link="{{ url($filename) }}" class="btn btn-success btn-sm copy_txt_btn" {{ $data->status_id != 2 ? 'disabled' : '' }}>
                                        <i class="bi bi-paperclip fs-3"></i>
                                        Get Link
                                    </button>
                                </td>
                                @if (Auth::user()->role_id != 1)
                                <td>
                                    <x-form :action="route('user.files.destroy', Crypt::encryptString($file->id))" method="DELETE">
                                        <input type="hidden" name="id" value="{{ $file->id }}" />
                                        <button type="button" class="btn btn-sm btn-danger btn-form-delete">Delete</button>
                                    </x-form>
                                </td>
                                @endif
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

@push('css')
<style>
.tags-look .tagify__dropdown__item{
    display: inline-block;
    vertical-align: middle;
    border-radius: 3px;
    padding: .3em .5em;
    border: 1px solid #CCC;
    background: #F3F3F3;
    margin: .2em;
    font-size: .85em;
    color: black;
    transition: 0s;
}

.tags-look .tagify__dropdown__item--active{
    border-color: black;
}

.tags-look .tagify__dropdown__item:hover{
    background: lightyellow;
    border-color: gold;
}

.tags-look .tagify__dropdown__item--hidden {
    max-width: 0;
    max-height: initial;
    padding: .3em 0;
    margin: .2em 0;
    white-space: nowrap;
    text-indent: -20px;
    border: 0;
}
</style>
<x-link-css href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" />
@endpush

@push('js')
    <x-script-js src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js" />
    <x-script-js :src="asset('assets/js/custom/pages/detail-transaction.js')" />
    <script>
        $(document).ready(function() {
            $("#status-changer").change(function () {
                $(".form-change-status").submit();
            });
        });
    </script>
@endpush
