@extends('../layout/base')

@section('body')
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        @yield('content')
        {{-- @include('../layout/components/dark-mode-switcher')
        @include('../layout/components/main-color-switcher') --}}

        <!-- BEGIN: JS Assets-->
      
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        @vite('resources/js/app.js')
        <!-- END: JS Assets-->

        @yield('script')

    </body>
@endsection
