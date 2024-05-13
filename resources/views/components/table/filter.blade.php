<div class="w-100 mw-150px">
    <!--begin::Select2-->
    <select class="form-select form-select-solid dataTable-filter" data-column="{{ $column }}">
        <option>all</option>
        @foreach ($filterData as $data)
            <option value="{{ $data }}">{{ $data }}</option>
        @endforeach
    </select>
    <!--end::Select2-->
</div>