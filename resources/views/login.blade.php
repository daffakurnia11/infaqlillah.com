<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/img/logo.png" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/vendor/bootstrap/dist/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="/css/style.css" rel="stylesheet" />
  <link href="/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <title>Infaqlillah Admin | Login</title>
</head>

<body>

  <!--start wrapper-->
  <div class="wrapper">

    @if (session()->has('message'))
      <div id="flash-data" data-flashdata="{{ session('message') }}"></div>
    @endif

    <!--start content-->
    <main class="authentication-content">
      <div class="container-fluid">
        <div class="authentication-card">
          <div class="card shadow rounded-0 overflow-hidden">
            <div class="card-body p-4 p-sm-5">
              <h5 class="card-title">Login</h5>
              <p class="card-text mb-3">Silakan login untuk mengakses halaman admin!</p>
              <form action="/login" method="POST" class="form-body">
                @csrf
                <hr>
                <div class="row g-3">
                  <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <div class="ms-auto position-relative">
                      <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                      <input type="text" class="form-control radius-30 ps-5" name="username" id="username" placeholder="Username">
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <div class="ms-auto position-relative">
                      <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                      <input type="password" class="form-control radius-30 ps-5" name="password" id="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary radius-30">Login</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!--end page main-->

  </div>
  <!--end wrapper-->


  <!--plugins-->
  <script src="/vendor/jquery/dist/jquery.js"></script>
  <script src="/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="/js/script.js?modify={{ date('Ymd') }}"></script>

</body>

</html>