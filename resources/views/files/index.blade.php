@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="container-xxl portfolio" id="kt_content_container" id="portfolio">
    <x-card>
        <x-card.header>
            <x-card.title title="List Files" />
            <x-card.toolbar>
                <div class="portfolio-isotope" data-portfolio-filter="*">
                    <ul class="portfolio-flters text-end">
                        <li data-filter="*" class="filter-active">All</li>
                        @foreach($transactions as $transaction)
                        <li data-filter=".filter-{{ $transaction->id }}">{{ $transaction->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </x-card.toolbar>
        </x-card.header>

        <x-card.body>
            <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" >
                <div class="row g-0 portfolio-container">
                    @foreach($datas as $data)
                    <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item filter-{{ $data->transaction_id }} p-2">
                        <img src="{{ $data->img_link }}" class="img-fluid" alt=""/>
                        <div class="portfolio-info">
                            <a href="{{ asset($data->location.$data->name) }}" data-gallery="portfolio-gallery" class="glightbox preview-link">
                                <i class="bi bi-zoom-in fs-1" style="color:black"></i>
                            </a>
                            <button data-link="{{ url($data->location.$data->name) }}" class="btn btn-success btn-sm copy_txt_btn">
                                <i class="bi bi-paperclip fs-3"></i>
                                Get Link
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </x-card.body>

    </x-card>
</div>
@endsection

@push('css')
    <x-link-css :href="asset('assets/vendor/aos/aos.css')" />
    <x-link-css :href="asset('assets/vendor/glightbox/css/glightbox.min.css')" />
    <x-link-css :href="asset('assets/vendor/swiper/swiper-bundle.min.css')" />
    <x-link-css :href="asset('assets/css/files-index.css')" />
@endpush

@push('js')
    <x-script-js :src="asset('assets/vendor/aos/aos.js')" />
    <x-script-js :src="asset('assets/vendor/glightbox/js/glightbox.min.js')" />
    <x-script-js :src="asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')" />
    <x-script-js :src="asset('assets/vendor/swiper/swiper-bundle.min.js')" />
    <x-script-js :src="asset('assets/js/custom/pages/files-index.js')" />
@endpush
