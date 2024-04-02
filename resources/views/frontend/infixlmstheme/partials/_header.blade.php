<!doctype html>
<html dir="{{isRtl()?'rtl':''}}" class="{{isRtl()?'rtl':''}}" lang="en" itemscope
      itemtype="{{url('/')}}">

<head>
    @laravelPWA
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="@yield('meta_title',Settings('site_title'));"/>
    <meta property="og:description" content="@yield('meta_description',Settings('footer_about_description'))"/>
    <meta property="og:image" content="@yield('og_image',Settings('logo'))"/>
    <meta property="og:type" content="website">
    <meta property="og:image:type" content="image/png"/>
    <meta name="title" content="@yield('meta_title',Settings('site_title'));">
    <meta name="description" content="{{Settings('meta_description')}}">
    <meta name="keywords" content="{{Settings('meta_keywords')}}">
    <title>
        @yield('title')
    </title>

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ Settings('site_name')  }}">

    <meta itemprop="image" content="{{asset(Settings('logo') )}}">
    @if(routeIs('frontendHomePage'))
        <meta itemprop="description" content="{{ Settings('meta_description')  }}">
        <meta property="og:description" content="{{ Settings('meta_description')  }}">
        <meta itemprop="keywords" content="{{ Settings('meta_keywords') }}">

    @elseif(routeIs('courseDetailsView'))
        <meta itemprop="description" content="{{ $course->meta_description  }}">
        <meta property="og:description" content="{{ $course->meta_description  }}">
        <meta itemprop="keywords" content="{{ $course->meta_keywords }}">
    @elseif(routeIs('quizDetailsView'))
        <meta itemprop="description" content="{{ $course->meta_description  }}">
        <meta property="og:description" content="{{ $course->meta_description  }}">
        <meta itemprop="keywords" content="{{ $course->meta_keywords }}">
    @endif
    <meta itemprop="author" content="{{Settings('site_name')}}">

    <!-- Facebook Meta Tags -->

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(Settings('favicon') )}}">
    <!-- Place favicon.ico in the root directory -->


    <x-frontend-dynamic-style-color/>


    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/fontawesome.css{{assetVersion()}} ">
    <link rel="stylesheet" href="{{asset('public/backend/css/themify-icons.css')}}{{assetVersion()}}"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/flaticon.css{{assetVersion()}}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/nice-select.css{{assetVersion()}}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/notification.css{{assetVersion()}}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/mega_menu.css') }}">

    <link href="{{asset('public/backend/css/summernote-bs4.min.css')}}{{assetVersion()}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/css/preloader.css')}}{{assetVersion()}}"/>

    @if(str_contains(request()->url(), 'chat'))
        <link rel="stylesheet" href="{{asset('public/backend/css/jquery-ui.css')}}{{assetVersion()}}"/>
        <link rel="stylesheet" href="{{asset('public/backend/vendors/select2/select2.css')}}{{assetVersion()}}"/>
        <link rel="stylesheet" href="{{asset('public/chat/css/style-student.css')}}{{assetVersion()}}">
    @endif

    @if(auth()->check() && auth()->user()->role_id == 3 && !str_contains(request()->url(), 'chat'))
        <link rel="stylesheet" href="{{asset('public/chat/css/notification.css')}}{{assetVersion()}}">
    @endif

    @if(isModuleActive("WhatsappSupport"))
        <link rel="stylesheet" href="{{ asset('public/whatsapp-support/style.css') }}{{assetVersion()}}">
    @endif
    <script>
        window.Laravel = {
            "baseUrl": '{{ url('/') }}' + '/',
            "current_path_without_domain": '{{request()->path()}}',
            "csrfToken": '{{csrf_token()}}',
        }
    </script>


    <script>
        window._locale = '{{ app()->getLocale() }}';
        window._translations = {!! $jsonLang??''!!};

    </script>

    @if(auth()->check() && auth()->user()->role_id == 3)
        <style>
            .admin-visitor-area {
                margin: 0 30px 30px 30px !important;
            }

            .dashboard_main_wrapper .main_content_iner.main_content_padding {
                padding-top: 50px !important;
            }

            .primary_input {
                height: 50px;
                border-radius: 0px;
                border: unset;
                font-family: "Jost", sans-serif;
                font-size: 14px;
                font-weight: 400;
                color: unset;
                padding: unset;
                width: 100%;
                @if($errors->any())
                                             margin-bottom: 5px;
                @else
                            margin-bottom: 30px;
            @endif


            }

            .primary_input_field {
                border: 1px solid #ECEEF4;
                font-size: 14px;
                color: #415094;
                padding-left: 20px;
                height: 46px;
                border-radius: 30px;
                width: 100%;
                padding-right: 15px;
            }

            .primary_input_label {
                font-size: 12px;
                text-transform: uppercase;
                color: #828BB2;
                display: block;
                margin-bottom: 6px;
                font-weight: 400;
            }

            .chat_badge {
                color: #ffffff;
                border-radius: 20px;
                font-size: 10px;
                position: relative;
                left: -10px;
                top: -12px;
                padding: 0px 4px !important;
                max-width: 18px;
                max-height: 18px;
                box-shadow: none;
                background: #ed353b;
            }

            .chat-icon-size {
                font-size: 1.35em;
                color: #687083;
            }
        </style>
    @endif


    <input type="hidden" name="lat" class="lat" value="{{Settings('lat') }}">
    <input type="hidden" name="lng" class="lng" value="{{Settings('lng') }}">
    <input type="hidden" name="zoom" class="zoom" value="{{Settings('zoom_level')}}">
    <input type="hidden" id="baseUrl" value="{{url('/')}}">
    <input type="hidden" name="chat_settings" id="chat_settings" value="{{ env('BROADCAST_DRIVER') }}">
    <input type="hidden" name="slider_transition_time" id="slider_transition_time"
           value="{{Settings('slider_transition_time')?Settings('slider_transition_time'):5}}">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/app.css{{assetVersion()}}"
          media="screen,print">
    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/frontend_style.css{{assetVersion()}}"
          media="screen,print">
    <script src="{{asset('public/js/common.js')}}{{assetVersion()}}"></script>
    @yield('css')

    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme/css/custom.css') }}">
    <x-analytics-tool/>
</head>

<body>

@include('secret_login')
