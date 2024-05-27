

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
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700"/>        <!--end::Fonts-->



                    <!--begin::Global Stylesheets Bundle(used by all pages)-->

                    <x-link-css :href="asset('assets/plugins/global/plugins.bundle.css') "/>
                    <x-link-css :href="asset('assets/css/style.bundle.css') "/>
                    <!--end::Global Stylesheets Bundle-->

            </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body  id="kt_body"  class="auth-bg"  >

        <!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - 404 Page-->
<div class="d-flex flex-column flex-center flex-column-fluid p-10">
    <!--begin::Illustration-->
    <img src="{{ asset('assets/media/illustrations/sigma-18.png') }}" alt="" class="mw-100 mb-10 h-lg-450px"/>
    <!--end::Illustration-->

    <!--begin::Message-->
    <h1 class="fw-bold mb-10" style="color: #A3A3C7">Seems there is nothing here</h1>
    <!--end::Message-->

    <!--begin::Link-->
    <a href="{{ Auth::user() ? Auth::user()->role->id == 1 ? route('admin.dashboard') :  route('user.dashboard') : route('user.dashboard') }}" class="btn btn-primary">Return Home</a>
    <!--end::Link-->
</div>
<!--end::Authentication - 404 Page-->

	</div>
<!--end::Main-->


        <!--begin::Javascript-->
        <script>
            var hostUrl = "/jet-html-free/assets/";        </script>

                    <!--begin::Global Javascript Bundle(used by all pages)-->
                            <x-script-js :src="asset('assets/plugins/global/plugins.bundle.js')" />
                            <x-script-js :src="asset('assets/js/scripts.bundle.js')" />
                        <!--end::Global Javascript Bundle-->


                <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>
