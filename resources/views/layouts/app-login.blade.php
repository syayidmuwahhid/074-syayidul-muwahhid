

<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Jet HTML Pro - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme
Upgrade to Pro: https://keenthemes.com/products/jet-html-pro
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en" >
    <!--begin::Head-->
    <head>
        <title>Jet HTML Pro - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme by Keenthemes</title>
        <meta charset="utf-8"/>
        <meta name="description" content="Jet admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets."/>
        <meta name="keywords" content="Jet theme, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Jet HTML Pro - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
        <meta property="og:url" content="https://keenthemes.com/products/jet-html-pro"/>
        <meta property="og:site_name" content="Keenthemes | Jet HTML Free" />
        <link rel="canonical" href="https://preview.keenthemes.com/jet-html-pro"/>
        <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}"/>

        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700"/>        <!--end::Fonts-->



                    <!--begin::Global Stylesheets Bundle(used by all pages)-->
                            <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
                            <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
                        <!--end::Global Stylesheets Bundle-->

            </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body  id="kt_body"  class="auth-bg"  >

        <!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - Sign-up -->
<div
    class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
    style="background-image: url({{ asset('assets/media/illustrations/sigma-14.png') }})">

    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <!--begin::Logo-->
        <a href="{{ route('welcome') }}" class="mb-12">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="h-100px"/>
        </a>
        <!--end::Logo-->

        <!--begin::Wrapper-->

<!--begin::Form-->
@yield('content')
<!--end::Form-->
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->

    <!--begin::Footer-->
    <div class="d-flex flex-center flex-column-auto p-10">
        <!--begin::Links-->
        <div class="d-flex align-items-center fw-bold fs-6">
            <a href="https://github.com/syayidmuwahhid/074-syayidul-muwahhid" class="text-muted text-hover-primary px-2">Syayidul Muwahhid</a>
            {{-- <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a> --}}

            {{-- <a href="https://devs.keenthemes.com" class="text-muted text-hover-primary px-2">Support</a> --}}

            {{-- <a href="https://keenthemes.com/products/jet-html-pro" class="text-muted text-hover-primary px-2">
                                    Upgrade To Pro
                            </a> --}}
        </div>
        <!--end::Links-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Authentication - Sign-up-->
                         	</div>
<!--end::Main-->


        <!--begin::Javascript-->
        <script>
            var hostUrl = "/assets/";        </script>

                    <!--begin::Global Javascript Bundle(used by all pages)-->
                            <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
                            <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
                        <!--end::Global Javascript Bundle-->

                <!--end::Javascript-->
            @stack('js')
    </body>
    <!--end::Body-->
</html>
