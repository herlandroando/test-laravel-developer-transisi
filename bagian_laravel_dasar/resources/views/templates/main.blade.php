<html>

<head>
    <title>Laravel Dasar - @yield('title',"No Title")</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @if (route('login') === url()->current())
    <link rel="stylesheet" href="{{mix('css/login.css')}}">
    @endif
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <script src="{{mix('js/app.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js"></script>
    <!-- Cropper.js is required -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cropper/1.0.1/jquery-cropper.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

</head>

<body>
    <div class="wrapper">
        @includeWhen(route('login') !== url()->current(),"templates.header")
        @includeWhen(route('login') !== url()->current(),"templates.sidebar")
        @if (route('login') !== url()->current())
        <div class="content-container container">
            <h4 class="mb-4">@yield("title","No Title")</h4>
            @yield("content")
        </div>
        @else
        @yield("content")
        @endif

        @includeWhen(route('login') !== url()->current(),"templates.footer")
        @yield("script")

    </div>

</body>

</html>
