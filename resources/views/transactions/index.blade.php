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
                @php
                    $filterData = array();
                    foreach ($users as $user) {
                        array_push($filterData, $user['username']);
                    }
                @endphp
                <x-table.filter column="3" :filterData="$filterData" />

                <!--begin::Add product-->
                {{-- <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                    Add Product
                </a> --}}
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
                    <th>User Add</th>
                    <th>Tags</th>
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
                            @if($isadmin)
                            <a href="{{ route('admin.transactions.show', Crypt::encryptString($data["id"])) }}" class="text-gray-800 text-hover-primary mb-1">{{ $data["title"] }}</a>
                            @else
                            <a href="{{ route('transactions.show', Crypt::encryptString($data["id"])) }}" class="text-gray-800 text-hover-primary mb-1">{{ $data["title"] }}</a>
                            @endif
                        </td>
                        <td>{{ date('d F Y', strtotime($data["date"])) }}</td>
                        <td>{{ $data["user_add"] }}</td>
                        @php
                            $tags = explode(',', $data["tags"]);
                        @endphp
                        <td>
                            @foreach ($tags as $tag)
                                <span class="badge badge-light-info">{{ $tag }}</span>
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('transactions.delete') }}" method="post">
                                @csrf @method("delete")
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
        </x-card.body>
        <!--end::Card body-->
    </x-card>
    <!--end::Products-->
</div>
@endsection

@push('js')
@endpush
