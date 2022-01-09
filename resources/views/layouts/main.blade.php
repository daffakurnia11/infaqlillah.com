<!doctype html>
<html lang="en" class="minimal-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/img/logo.png" type="image/png" />
  <!-- Plugins -->
  <link href="/vendor/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="/vendor/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- Datatable -->
  <link href="/vendor/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <!-- Notification -->
  <link href="/vendor/notifications/css/lobibox.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/vendor/bootstrap/dist/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="/css/style.css" rel="stylesheet" />
  <link href="/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- Datepicker -->
	<link rel="stylesheet" href="/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Theme Styles -->
  <link href="/css/dark-theme.css" rel="stylesheet" />
  <link href="/css/light-theme.css" rel="stylesheet" />
  <link href="/css/semi-dark.css" rel="stylesheet" />
  <link href="/css/header-colors.css" rel="stylesheet" />

  <script src="/vendor/jquery/dist/jquery.js"></script>

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
<!-- Plugins -->
<script src="/vendor/jquery/dist/jquery.js"></script>
<script src="/vendor/simplebar/js/simplebar.min.js"></script>
<script src="/vendor/metismenu/js/metisMenu.min.js"></script>
<!-- Datatable -->
<script src="/vendor/datatable/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatable/js/dataTables.bootstrap5.min.js"></script>
<!--notification js -->
<script src="/vendor/notifications/js/lobibox.min.js"></script>
<script src="/vendor/notifications/js/notifications.min.js"></script>
<!-- Chartjs -->
<script src="/vendor/chartjs/js/Chart.min.js"></script>
<script src="/vendor/chartjs/js/Chart.extension.js"></script>
<!-- Datepicker -->
<script src="/vendor/bootstrap-material-datetimepicker/js/moment.min.js"></script>
<script src="/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
<!-- Javascript -->
<script src="/js/app.js"></script>
<script src="/js/script.js"></script>
<script>
  $(function() {
	"use strict";
  $(document).ready(function() {
    var table = $('#example2').DataTable( {
      lengthChange: false,
      buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis']
    } );

    table.buttons().container().appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    $('#date').bootstrapMaterialDatePicker({
      time: false
    });
  });


});
</script>

</body>

</html>