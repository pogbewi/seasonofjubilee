<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('description')"/>
    <meta name="keywords" content="@yield('keyword')"/>
    <meta name="author" content="{{ setting('pastor_name') }}">

    <title>{{ setting('admin_title', 'Season Of Jubilee') }} - @yield('page_title')</title>
    <meta name="copyright" content="Copyright &copy; 2016-{!! date("Y") !!} {{ setting('admin_title', 'Season Of Jubilee') }}" />
    <link rel="shortcut icon" href="{{ asset('/storage/'.setting('site_favcon')) }}" type="image/x-icon"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link  rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/css/daterangepicker.css">
    <link rel="stylesheet" href="/css/datetimepicker.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/admin/css/ionicons.min.css">
    <link rel="stylesheet" href="/admin/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/admin/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin/css/_all-skins.min.css">
    <link rel="stylesheet" href="/admin/css/pace.min.css">
    <link rel="stylesheet" href="/admin/css/sweetalert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="/admin/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/admin/css/admin.css">
    <!-- frontend css files -->
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @yield('header')
</head>
<body class="@yield('body-class')">
<div class="loader"></div>
@yield('content')
<a class="totop" href="#"><i class="fa fa-angle-up"></i></a>
<script>
    $.widget.bridge('uibutton', $.ui.button);

    $(document).ajaxStart(function() { Pace.restart(); });
</script>

<script type="text/javascript" src="/js/moment.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/js/daterangepicker.js"></script>
<script type="text/javascript" src="/js/datetimepicker.min.js"></script>
<script src="/admin/js/jquery.dataTables.min.js"></script>
<script src="/admin/js/dataTables.bootstrap.min.js"></script>
<script src="/admin/js/pace.min.js"></script>
<script src="/admin/js/adminlte.min.js"></script>
<script src="/admin/js/dashboard.js"></script>
<script src="/admin/js/admin.js"></script>
<script src="/admin/js/sweetalert.min.js"></script>
<script type="text/javascript" src="/js/totop.min.js"></script>
<script src="/admin/js/bootstrap-tagsinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
@stack('scripts')
@include('admin.notify.flash')
</body>
</html>