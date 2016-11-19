<!DOCTYPE html>
<head>
    @include('includes.dependencies')

    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    @include('includes.navbar')
    <div class="messages row">
        @include('includes.messages')
    </div>
    @yield('content');
</div>
</body>