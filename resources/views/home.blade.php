<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="/css/main.css">
  <link rel="shortcut icon" href="/img/logo.png" type="image/x-icon">

  <title>Infaqlillah</title>
</head>

<body data-bs-spy="scroll" data-bs-target="#navigation" data-bs-offset="0" class="scrollspy-example" tabindex="0">
  <!-- Navbar -->
  <nav id="navigation" class="navbar navbar-expand-lg fixed-top">
    <div class="container px-3">
      <a class="navbar-brand" href="/">
        <img src="/img/logo.png" alt="" width="30" class="me-2">
        Infaqlillah
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto text-center">
          <a class="nav-link active" href="#home">Beranda</a>
          <a class="nav-link" href="#about">Tentang</a>
          <a class="nav-link" href="#statistics">Statistik</a>
          <a class="nav-link" href="#contact">Kontak</a>
        </div>
      </div>
    </div>
  </nav>
  <!-- End of Navbar -->

  <!-- Header -->
  <header id="home">
    <div class="container header">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h1 class="header-title font-weight-bold text-center">Infaqlillah</h1>
          <p class="header-desc text-center px-5">Dakwah sosial yang membantu dan mendukung sesama untuk berusaha mencapai kehidupan yang lebih baik secara ekonomi, serta tidak melupakan untuk tetap mencari ridho Allah swt. lewat infaq yang diberikan.</p>
        </div>
        <div class="col-md-6">
          <img class="w-100" src="/img/header.svg" alt="">
        </div>
      </div>
    </div>
  </header>
  <!-- End of Header -->

  <!-- About -->
  <section id="about">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h2 class="content-title text-center">Tentang Kami</h2>
          <p class="content-desc text-center">Suasana pandemi Covid-19 menyebabkan banyak saudara di sekitar kita terdampak dalam segi ekonomi. Selain membantu dalam memberikan bantuan modal, kami mengajak untuk saling berbagi sehingga berharap akan mendapatkan pahala jariyah yang akan bermanfaat untuk kita pribadi serta orang lain.</p>
          <img class="w-100 mb-4" src="/img/about.svg" alt="">
        </div>
        <div class="col-lg-6">
          <h3 class="content-subtitle text-center my-3">Manfaat</h3>
          <div class="row benefit px-md-5">
            <div class="col-6 mt-4">
              <div class="benefit-box mx-auto">
                <img class="w-100 p-4" src="/img/tiket-surga.svg" alt="">
              </div>
              <h4 class="benefit-desc text-center my-2">Tiket Surga</h4>
            </div>
            <div class="col-6 mt-4">
              <div class="benefit-box mx-auto">
                <img class="w-100 p-4" src="/img/menambah-rezeki.svg" alt="">
              </div>
              <h4 class="benefit-desc text-center my-2">Keberkahan Rezeki</h4>
            </div>
            <div class="col-6 mt-4">
              <div class="benefit-box mx-auto">
                <img class="w-100 p-4" src="/img/amal-jariyah.svg" alt="">
              </div>
              <h4 class="benefit-desc text-center my-2">Amal Jariyah</h4>
            </div>
            <div class="col-6 mt-4">
              <div class="benefit-box mx-auto">
                <img class="w-100 p-4" src="/img/membantu-sesama.svg" alt="">
              </div>
              <h4 class="benefit-desc text-center my-2">Membantu Sesama Manusia</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End of About -->
  <!-- Statistics -->
  <section id="statistics">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-1 order-2">
          <!-- Total User and Infaq -->
          <div class="users">
            <h3 class="content-subtitle text-center">Jumlah Infaq</h3>
            <div class="row justify-content-center">
              <div class="col-sm-4 text-center mt-3">
                <div class="content-box mb-2 mx-auto">
                  <h4 class="total-user"><?= $pedagang; ?></h4>
                  <span class="total-desc">Pedagang</span>
                </div>
                <span class="number-infaq">Rp. <?= number_format($total_pedagang, 2, ',', '.'); ?></span>
              </div>
              <div class="col-sm-4 text-center mt-3">
                <div class="content-box mb-2 mx-auto">
                  <h4 class="total-user"><?= $donatur; ?></h4>
                  <span class="total-desc">Donatur</span>
                </div>
                <span class="number-infaq">Rp. <?= number_format($total_donatur, 2, ',', '.'); ?></span>
              </div>
            </div>
          </div>
          <!-- End of Total User and Infaq -->

          <!-- Total Infaq -->
          <div class="infaq text-center">
            <h3 class="content-subtitle my-4 px-3">Total Akumulasi Infaq</h3>
            <div class="content-box-bordered mx-auto">
              <h4 class="infaq-total">Rp. {{ number_format($pemasukkan, 2, ',', '.') }} </h4>
            </div>
          </div>
          <!-- End of Total Infaq -->

          <!-- Money Report -->
          <div class="report text-center">
            <h3 class="content-subtitle my-4">Laporan Keuangan</h3>
            <div class="content-box-bordered mx-auto">
              <div class="d-flex justify-content-between flex-md-row flex-column mb-2">
                <span class="report-desc">Uang tersalurkan</span>
                <span class="report-money">Rp. <?= number_format($uang_pedagang, 2, ',', '.'); ?></span>
              </div>
              <div class="d-flex justify-content-between flex-md-row flex-column mb-2">
                <span class="report-desc">Pengeluaran lain</span>
                <span class="report-money">Rp. <?= number_format($pengeluaran, 2, ',', '.'); ?></span>
              </div>
              <div class="divider my-3"></div>
              <div class="d-flex justify-content-between flex-md-row flex-column mb-2">
                <span class="report-desc">Uang saat ini</span>
                <span class="report-money">Rp. <?= number_format($total_sekarang, 2, ',', '.'); ?></span>
              </div>
            </div>
          </div>
          <!-- End of Money Report -->
        </div>
        <div class="col-lg-6 order-lg-2 order-1">
          <h2 class="content-title text-center">Statistik</h2>
          <p class="content-desc text-center mb-5">Infaq diberikan sebagai modal usaha yang nantinya pedagang diharapkan dapat berinfaq kembali dan akan dikumpulkan sehingga hasil infaq yang terkumpul akan disalurkan kembali untuk modal pedagang lain, santunan kepada yayasan yatim piatu, dan bantuan lain yang bersifat amal jariyah.</p>
          <img class="w-100" src="/img/statistics.svg" alt="">
        </div>
      </div>
    </div>
  </section>
  <!-- End of Statistics -->

  <!-- Footer -->
  <footer id="contact">
    <div class="container">
      <h2 class="content-title text-center">Temukan kami</h2>
      <!-- Maps -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d989.078924256082!2d112.72601512923082!3d-7.4302742698214255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e71774f9d015%3A0x65159fdd90ce5de8!2sInfaqlillah!5e0!3m2!1sen!2sid!4v1627988827310!5m2!1sen!2sid" allowfullscreen="" loading="lazy" class="maps my-4"></iframe>
      <!-- End of Maps -->
      <div class="row align-items-center">
        <div class="col-md-6 order-md-1 order-2 text-center">
          <img class="w-100" src="/img/footer.svg" alt="">
        </div>
        <div class="col-md-6 order-md-2 order-1 text-center">
          <h3 class="content-subtitle mt-4">Alamat</h3>
          <p>
            Perum. Gading Fajar 1 B6/21 Buduran,<br>
            (Depan Masjid Aminah Al-Fajr)<br>
            Sidoarjo, Jawa Timur - 61252
          </p>
          <h3 class="content-subtitle mt-4">No Telepon / Whatsapp</h3>
          <p>
            <a href="https://wa.me/6282140534712">+62 821-4053-4712 (Ibu Tari)</a>
          </p>
        </div>
      </div>
    </div>
    <div class="copyright mt-5 px-3 text-center">
      &copy; 2021 <a href="https://breakpoint.id/">Breakpoint.id</a>, Semua hak cipta dilindungi undang-undang
    </div>
  </footer>
  <!-- End of Footer -->
  <!-- Javascript -->
  <script src="/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
      target: '#navigation'
    })
  </script>
</body>

</html>