@extends('aorapagebuilder::layouts.master')

@section('content')
    {!! htmlspecialchars_decode($details) !!}
@endsection


@section('scripts')
    @php
        $route = request()->route()->getName();
    @endphp
    @if ($route == 'blogs')
        <script src="{{ asset('frontend/infixlmstheme/js/blogs.js') }}"></script>
    @elseif($route == 'contact')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ Settings('gmap_key') }}"></script>
        <script src="{{ asset('frontend/infixlmstheme') }}/js/map.js"></script>
    @else
        <script src="{{ asset('frontend/infixlmstheme/js/courses.js') }}"></script>
    @endif
    @if (isModuleActive('Store') && \Illuminate\Support\Facades\Route::currentRouteName() == 'store.products')
        <script src="{{ asset('frontend/infixlmstheme/js/store.js') }}"></script>
    @endif

    <script>
        $('.ui-resizable-resizer').remove()
    </script>
@endsection
