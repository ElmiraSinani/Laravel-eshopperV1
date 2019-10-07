<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
    <!-- bootstrap -->
    <link href="{{asset ('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- scripts -->
    <script src="{{ asset ('js/jquery.js') }}"></script>

    <script src="{{asset ('js/bootstrap.min.js') }}" ></script>

    <!-- Custom styles for this template -->
    <link href="{{asset ('css/dashboard.css') }}" rel="stylesheet">


</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                 <li><a href="{{route('allProducts')}}">Home</a></li>
                <li><a href="{{route('adminDisplayProducts')}}">Dashboard</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Help</a></li>
            </ul>

        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
               <li class="active"><a href="{{route('adminDisplayProducts')}}">Overview <span class="sr-only">(current)</span></a></li>
                <li><a href="/admin/createProductForm">Insert</a></li>
                <li><a href="">Orders</a></li>
                 <li><a href="#">Edit</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Analytics</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('body')
        </div>
    </div>
</div>


</body>
</html>
