@extends('layouts.app')

@section('title', $title)

@section('content')
<div class=" container-xxl " id="kt_content_container">

    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-lg-6 mb-xl-10">
            <!--begin::Navbar-->
            <x-card>
                <x-card.header>
                    <x-card.title title="Add New Resource" />
                </x-card.header>
                <x-card.body>
                    <x-form method="POST" :action="$action">

                        <div class="form-group mb-6">
                            <label class="form-label required">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Resource Title" value="{{ isset($data) ? $data->title : old('title') }}" required {{ isset($data) ? 'disabled' : '' }}>
                        </div>

                        <div class="form-group mb-6">
                            <label class="form-label">Tags</label>
                            <input name="tags" class="tagify--custom-dropdown form-control" placeholder="Type a tag letter" value="{{ isset($data) ? $data->tags : '' }}">
                            <div class="text-muted fs-7">{{ isset($data) ? 'changing tags will not be saved' : '' }}</div>
                        </div>

                        <div class="form-group mb-6">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status_id">
                                @if (isset($data))
                                    <option value="{{ $data->status_id }}">{{ $data->status->status }}</option>
                                @else
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        @if (!isset($data))
                            <x-form.submit-btn />
                        @endif
                    </x-form>
                </x-card.body>
            </x-card>
            <!--end::Navbar-->
        </div>
        <!--end::col-->
        <div class="col-lg-6 mb-xl-10">
            <!--begin::details View-->
            <x-card>
                <!--begin::Card header-->
                <x-card.header>
                    <!--begin::Card title-->
                    <x-card.title title="Add Files to Resource"/>
                    <!--end::Card title-->
                </x-card.header>
                <!--begin::Card header-->

                <!--begin::Card body-->
                <x-card.body>
                    @if(isset($data))
                    <form action="{{ $action }}" class="dropzone" id="my-awesome-dropzone">
                        @csrf
                        <input type="hidden" name="transaction_id" value="{{ $data->id }}"/>
                        <input type="hidden" name="transaction_title" value="{{ $data->title }}"/>
                    </form>
                    <span class="required">Accepted File Format : {{ \App\Helpers\Anyhelpers::getExtension() }}</span>
                    <div class="text-muted fs-5">Click
                        <a href="{{ route('transactions.show', Crypt::encryptString($data->id)) }}">here</a>
                        to manage files</div>
                    @else
                    <h5 class="text-muted">add resource first before adding files</h5>
                    @endif



                </x-card.body>
                <!--end::Card body-->
            </x-card>
            <!--end::details View-->
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
@endpush
