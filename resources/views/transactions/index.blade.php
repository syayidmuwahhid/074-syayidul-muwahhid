@extends('layouts.app')

@section('title', $title)

@section('content')
<div class=" container-xxl " id="kt_content_container">
    <!--begin::Products-->
    <x-card>
        <!--begin::Card header-->
        <x-card.header>
            <!--begin::Card title-->
            <x-card.title title="">
                <x-table.search />
            </x-card.title>
            <!--end::Card title-->

            <!--begin::Card toolbar-->
            <x-card.toolbar>
                @if(Auth::user()->role_id == 1)
                @php
                    $filterData = array();
                    foreach ($users as $user) {
                        array_push($filterData, $user['name']);
                    }
                @endphp
                <x-table.filter column="3" :filterData="$filterData" />
                @endif

                <!--begin::Add product-->
                @if(Auth::user()->role_id != 1)
                <a href="{{ route('user.transactions.create') }}" class="btn btn-primary">
                    New Resource
                </a>
                @endif
                <!--end::Add product-->
            </x-card.toolbar>
            <!--end::Card toolbar-->
        </x-card.header>
        <!--end::Card header-->

        <!--begin::Card body-->
        <x-card.body>
            <x-table>
                <!--begin::Table head-->
                <x-table.thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                    @if(Auth::user()->role_id == 1)<th>User Add</th>@endif
                    <th>Number of files</th>
                    <th>Tags</th>
                    <th>Status</th>
                    <th>Actions</th>
                </x-table.head>
                <!--end::Table head-->

                <!--begin::Table body-->
                <tbody>
                    <!--begin::Table row-->
                    @foreach ($datas as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            {{-- @if(Auth::user()->role_id == 1)
                            <a href="{{ route('admin.transactions.show', Crypt::encryptString($data->id)) }}" class="text-gray-800 text-hover-primary mb-1">{{ $data["title"] }}</a>
                            @else --}}
                            <a href="{{ route('transactions.show', Crypt::encryptString($data->id)) }}" class="text-gray-800 text-hover-primary mb-1">{{ $data["title"] }}</a>
                            {{-- @endif --}}
                        </td>
                        <td>{{ date('d F Y', strtotime($data->created_at)) }}</td>
                        @if(Auth::user()->role_id == 1) <td>{{ $data->user->name }}</td> @endif
                        <td>{{ count($data->file) }} Files</td>
                        <td>
                            @foreach ($data->tags as $tag)
                                <span class="badge badge-light-info">{{ $tag }}</span>
                            @endforeach
                        </td>
                        <td>
                            <span class="badge {{ $data->badge }}">{{ $data->status->status }}</span></td>
                        <td>
                            @php($uri = Auth::user()->role_id == 1 ? 'admin.transactions.destroy' : 'user.transactions.destroy')
                            <form action="{{ route($uri, Crypt::encryptString($data['id'])) }}" method="post">
                                @csrf @method("delete")
                                <input type="hidden" name="id" value="{{ $data['id'] }}" />
                                <button type="button" class="btn btn-sm btn-danger btn-form-delete">Delete</button>
                            </form>
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
    <!--end::Products-->
</div>
@endsection
