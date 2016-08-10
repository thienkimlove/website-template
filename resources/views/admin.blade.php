<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Custom Fonts -->
    <link href="{{ url('/css/admin.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{ url('js/datetimepicker/build/jquery.datetimepicker.min.css')}}" rel="stylesheet" />


</head>

<body>

<div id="wrapper">

    @include('admin.nav')

    <div id="page-wrapper">
        @include('flash::message')
        @yield('content')
    </div>


</div>
<script>
    var Config = {};
    window.baseUrl = '{{url('/')}}';
</script>

<script src="{{url('/js/admin.js')}}"></script>
<script src="{{url('/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('/js/select2.min.js')}}"></script>
<script src="{{url('js/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script>
@yield('footer')
</body>

</html>
