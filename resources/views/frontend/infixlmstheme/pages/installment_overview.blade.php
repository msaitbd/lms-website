@extends(theme('layouts.master'))
@section('title')
    {{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{_trans('installment.Installment Overview')}}
@endsection
@section('css')
    <link href="{{asset('frontend/infixlmstheme/css/select2.min.css')}}{{assetVersion()}}" rel="stylesheet"/>
    <link href="{{asset('frontend/infixlmstheme/css/checkout.css')}}{{assetVersion()}}" rel="stylesheet"/>
@endsection
@section('mainContent')
    <x-installment-overview-page-section :data="$data"/>

@endsection
@section('js')
    <script src="{{asset('frontend/infixlmstheme/js/select2.min.js')}}{{assetVersion()}}"></script>
    <script src="{{asset('frontend/infixlmstheme/js/checkout.js')}}{{assetVersion()}}"></script>
    <script src="{{asset('frontend/infixlmstheme/js/city.js')}}{{assetVersion()}}"></script>
@endsection
