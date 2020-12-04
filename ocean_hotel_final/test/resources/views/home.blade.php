<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Administrator </title>
    <!-- Bootstrap Styles-->
    @include('admin.css')

    <script src="{{asset('Admin/assets/js/jquery-1.10.2.js')}}"></script>
</head>

<body>
@yield('css')
<div id="wrapper">
    @include('header')

    @include('sidebar')

    <div id="page-wrapper">
        <div id="page-inner">
            <button class="btn btn-danger" style="margin-bottom: 10px" id="collapse">☰</button>
            @yield('content')
        </div>
    </div>

</div>
@include('admin.js')
@yield('js')
</body>

</html>
