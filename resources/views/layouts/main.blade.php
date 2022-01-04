<!doctype html>
<html lang="en" class="minimal-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/img/logo.png" type="image/png" />
  <!--plugins-->
  <link href="/vendor/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="/vendor/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/vendor/bootstrap/dist/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="/css/style.css" rel="stylesheet" />
  <link href="/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
	{{-- <link href="/css/pace.min.css" rel="stylesheet" /> --}}


  <!--Theme Styles-->
  <link href="/css/dark-theme.css" rel="stylesheet" />
  <link href="/css/light-theme.css" rel="stylesheet" />
  <link href="/css/semi-dark.css" rel="stylesheet" />
  <link href="/css/header-colors.css" rel="stylesheet" />

  <title>Infaqlillah Admin | Dashboard</title>
</head>

<body>

<!--start wrapper-->
<div class="wrapper">
  
  @include('layouts.topbar')

  @include('layouts.sidebar')

  <!--start content-->
  <main class="page-content">
    
    @yield('content')
 
  </main>
  <!--end page main-->

  <!--start overlay-->
  <div class="overlay nav-toggle-icon"></div>
  <!--end overlay-->

  <!--Start Back To Top Button-->
  <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
  <!--End Back To Top Button-->
  
  @include('layouts.switcher')

</div>
<!--end wrapper-->


<!-- Bootstrap bundle JS -->
<script src="/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="/vendor/jquery/dist/jquery.js"></script>
<script src="/vendor/simplebar/js/simplebar.min.js"></script>
<script src="/vendor/metismenu/js/metisMenu.min.js"></script>
<!--app-->
<script src="/js/app.js"></script>

</body>

</html>