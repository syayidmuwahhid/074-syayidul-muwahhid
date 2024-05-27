

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
        <title>API Resource Manager</title>
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

<!--End::Google Tag Manager -->
            </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body  id="kt_body"  class="auth-bg"  >



        <!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - Signup Welcome Message -->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div class="d-flex flex-row-fluid flex-column flex-column-fluid text-center p-10 py-lg-20">
        <!--begin::Logo-->
        <a href="#" class="pt-lg-20 mb-12">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo-default.svg') }}" class="h-70px"/>
        </a>
        <!--end::Logo-->


    <!--begin::Logo-->
    <h1 class="fw-bolder fs-2qx text-gray-800 mb-7">Welcome to API Resource Manager</h1>
    <!--end::Logo-->

    <!--begin::Message-->
    <div class="fw-bold fs-3 text-muted mb-15">
        {{-- Website untuk menyimpan resource file berupa Foto/Dokumen/Video <br />
        untuk digunakan sebagai resource (link) dari sebuah aplikasi. --}}
        Website for storing resource files in the form of Photos/Documents/Videos <br />
        to be used as a resource (link) for an application.
    </div>
    <!--end::Message-->

    <!--begin::Action-->
    <div class="text-center mr-5">
        <a href="{{ Auth::user() ? Auth::user()->role->id == 1 ? route('admin.dashboard') :  route('user.dashboard') : route('user.dashboard') }}" class="btn btn-lg btn-primary fw-bolder">Go to Home Page</a>
    </div>
    <!--end::Action-->

    </div>
    <!--end::Content-->

    <!--begin::Illustration-->
    <div
        class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-150px min-h-lg-350px"
        style="background-image: url({{ asset('assets/media/illustrations/sigma-7.png') }})">
    </div>
    <!--end::Illustration-->
</div>
<!--end::Authentication - Signup Welcome Message-->
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
    </body>
    <!--end::Body-->
</html>

