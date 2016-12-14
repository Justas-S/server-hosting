<!DOCTYPE html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
    @include('includes.dependencies')

    <meta name="verify-paysera" content="ceefbee04fc951fa9e7ca08a87142281">

    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    @include('includes.navbar')
    <div class="messages row">
        @include('includes.messages')
    </div>
    @yield('content');

    @include('includes.javascript')
</div>
</body>