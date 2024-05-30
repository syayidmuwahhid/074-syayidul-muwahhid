<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Jet HTML Free  - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme
Upgrade to Pro: https://keenthemes.com/products/jet-html-pro
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>@yield('title') | API-RM</title>
		<meta name="description" content="Website for storing resource files in the form of Photos/Documents/Videos to be used as a resource (link) for an application." />
		<meta name="keywords" content="API, Resource Manager, File Manager" />
		{{-- <link rel="canonical" href="Https://preview.keenthemes.com/jet-free" /> --}}
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="baseUrl" content="{{ url('') }}" />
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<x-link-css :href="asset('assets/plugins/global/plugins.bundle.css')"/>
		<x-link-css :href="asset('assets/css/style.bundle.css')"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<!--end::Global Stylesheets Bundle-->
        <x-script-js :src="asset('assets/plugins/custom/jquery/jquery-3.7.1.min.js')" />
        <x-link-css :href="asset('assets/plugins/custom/datatables/datatables.min.css')" />
        <x-script-js src="https://cdn.jsdelivr.net/npm/sweetalert2@11" />
        @stack('css')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
                @include('layouts.partials.sidebar')
				<!--end::Aside-->
				<!--begin::Wrapper-->
				@include('layouts.partials.content')
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--begin::Drawers-->
		@include('layouts.partials.activity-log')
		<!--end::Activities drawer-->
		<!--end::Drawers-->

		<!--begin::Scrolltop-->
        @include('layouts.partials.scroling-btn')
		<!--end::Scrolltop-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<x-script-js :src="asset('assets/plugins/global/plugins.bundle.js')" />
		<x-script-js :src="asset('assets/js/scripts.bundle.js')" />
        <x-script-js :src="asset('assets/plugins/custom/datatables/datatables.min.js')" />
        <x-script-js :src="asset('assets/js/custom/helpers.js')" />
        <!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		@stack('js')
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>

