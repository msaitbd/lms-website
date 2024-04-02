<!DOCTYPE html>
<html dir="{{isRtl()?'rtl':'ltr'}}" class="{{isRtl()?'rtl':'ltr'}}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{getCourseImage(Settings('favicon'))}}{{assetVersion()}}" type="image/png"/>
    <title>
        {{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}}
    </title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    @include('backend.partials.style')
    <script src="{{asset('public/js/common.js')}}{{assetVersion()}}"></script>


    <script>
        window.Laravel = {
            "baseUrl": '{{ url("/") }}' + '/',
            "current_path_without_domain": '{{request()->path()}}',
            "csrfToken": '{{csrf_token()}}',
        }
    </script>

    <script>
        window._locale = '{{ app()->getLocale() }}';
        window._translations = {!! $jsonLang??''!!}
            window.jsLang = function (key, replace) {
            let output = '';

            if (key.includes('.')) {
                const parts = key.split('.');
                key = parts[1];
            }

            if (window._translations.hasOwnProperty(key)) {
                output = window._translations[key];
            } else {
                output = key;
            }
            return output;

        }

    </script>


    <x-frontend-dynamic-style-color/>

    <script>
        const RTL = "{{isRtl()}}";
        const LANG = "{{ app()->getLocale() }}";
    </script>

    @livewireStyles

</head>

<body class="admin">
@include('preloader')
@include('secret_login')
<input type="hidden" name="demoMode" id="demoMode" value="{{appMode()}}">
<input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
<input type="hidden" name="active_date_format" id="active_date_format" value="{{Settings('active_date_format')}}">
<input type="hidden" name="js_active_date_format" id="js_active_date_format" value="{{getActiveJsDateFormat()}}">
<input type="hidden" name="table_name" id="table_name" value="@yield('table')">
<input type="hidden" name="csrf_token" class="csrf_token" value="{{csrf_token()}}">
<input type="hidden" name="currency_symbol" class="currency_symbol" value="{{Settings('currency_symbol')}}">
<input type="hidden" name="currency_show" class="currency_show" value="{{Settings('currency_show')}}">
<input type="hidden" name="chat_settings" id="chat_settings" value="{{ env('BROADCAST_DRIVER') }}">
<div class="main-wrapper" style="min-height: 600px">
    <!-- Sidebar  -->
    @if (isModuleActive('LmsSaas') && Auth::user()->is_saas_admin==1 && Auth::user()->active_panel=='saas')
        @include('lmssaas::partials.sidebar')
    @elseif(isModuleActive('LmsSaasMD') && Auth::user()->is_saas_admin==1 && Auth::user()->active_panel=='saas')
        @include('lmssaasmd::partials.sidebar')
    @else
        @include('backend.partials.sidebar')
    @endif


    <!-- Page Content  -->
    <div id="main-content">
@include('backend.partials.menu')
