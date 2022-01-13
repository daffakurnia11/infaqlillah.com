<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="/img/logo.png" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text fs-6">Infaqlillah Admin</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    
    <li class="{{ Request::is('/') ? 'mm-active' : '' }}">
      <a href="">
        <div class="parent-icon"><i class="bi bi-house-door"></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>

    <li class="menu-label">Data Pemasukan</li>
    <li class="">
      <a class="has-arrow" href="#" aria-expanded="true">
        <div class="parent-icon"><i class="bi bi-wallet"></i>
        </div>
        <div class="menu-title">Infaq Masuk</div>
      </a>
      <ul class="mm-collapse {{ (Request::is('infaq**') or Request::is('toko**') or Request::is('donatur**')) ? 'mm-show' : '' }}" style="">
        <li class="{{ Request::is('infaq/pedagang') ? 'mm-active' : '' }}"> 
          <a href="/infaq/pedagang"><i class="bi bi-arrow-right-short"></i>
            Pedagang
          </a>
        </li>
        <li class="{{ Request::is('donatur**') ? 'mm-active' : '' }}"> 
          <a href="/donatur"><i class="bi bi-arrow-right-short"></i>
            Donatur
          </a>
        </li>
        <li class="{{ Request::is('toko**') ? 'mm-active' : '' }}"> 
          <a href="/toko"><i class="bi bi-arrow-right-short"></i>
            Toko
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-label">Data Pengeluaran</li>
    <li class="{{ Request::is('pedagang**') ? 'mm-active' : '' }}">
      <a href="/pedagang">
        <div class="parent-icon"><i class="bi bi-shop"></i>
        </div>
        <div class="menu-title">Modal Pedagang</div>
      </a>
    </li>
    {{-- <li class="">
      <a class="has-arrow" href="#" aria-expanded="true">
        <div class="parent-icon"><i class="bi bi-house"></i>
        </div>
        <div class="menu-title">Yatim Piatu</div>
      </a>
      <ul class="mm-collapse" style="">
        <li class=""> 
          <a href=""><i class="bi bi-arrow-right-short"></i>
            A
          </a>
        </li>
        <li class=""> 
          <a href=""><i class="bi bi-arrow-right-short"></i>
            A
          </a>
        </li>
        <li class=""> 
          <a href=""><i class="bi bi-arrow-right-short"></i>
            A
          </a>
        </li>
      </ul>
    </li> --}}
    <li class="">
      <a class="has-arrow" href="#" aria-expanded="true">
        <div class="parent-icon"><i class="bi bi-gift"></i>
        </div>
        <div class="menu-title">Jumat Berkah</div>
      </a>
      <ul class="mm-collapse {{ Request::is('jumat-berkah**') ? 'mm-show' : '' }}" style="">
        <li class="{{ Request::is('jumat-berkah/aminah-al-fajr') ? 'mm-active' : '' }}"> 
          <a href="/jumat-berkah/aminah-al-fajr"><i class="bi bi-arrow-right-short"></i>
            Masjid Aminah Al-Fajr
          </a>
        </li>
        <li class="{{ Request::is('jumat-berkah/siwalan-panji') ? 'mm-active' : '' }}"> 
          <a href="/jumat-berkah/siwalan-panji"><i class="bi bi-arrow-right-short"></i>
            Masjid Siwalan Panji
          </a>
        </li>
        <li class="{{ Request::is('jumat-berkah/buduran') ? 'mm-active' : '' }}"> 
          <a href="/jumat-berkah/buduran"><i class="bi bi-arrow-right-short"></i>
            Buduran
          </a>
        </li>
        <li class="{{ Request::is('jumat-berkah/gedangan') ? 'mm-active' : '' }}"> 
          <a href="/jumat-berkah/gedangan"><i class="bi bi-arrow-right-short"></i>
            Gedangan
          </a>
        </li>
        <li class="{{ Request::is('jumat-berkah/tulungagung') ? 'mm-active' : '' }}"> 
          <a href="/jumat-berkah/tulungagung"><i class="bi bi-arrow-right-short"></i>
            Tulungagung
          </a>
        </li>
      </ul>
    </li>
    <li class="{{ Request::is('bazaar**') ? 'mm-active' : '' }}">
      <a href="/bazaar">
        <div class="parent-icon"><i class="bi bi-bag"></i>
        </div>
        <div class="menu-title">Bazar Subuh</div>
      </a>
    </li>
    <li class="{{ Request::is('pengeluaran-lain**') ? 'mm-active' : '' }}">
      <a href="/pengeluaran-lain">
        <div class="parent-icon"><i class="bi bi-cart-dash"></i>
        </div>
        <div class="menu-title">Lain-lain</div>
      </a>
    </li>

    {{-- <li class="menu-label">Galeri</li>
    <li class="">
      <a class="has-arrow" href="#" aria-expanded="true">
        <div class="parent-icon"><i class="bi bi-images"></i>
        </div>
        <div class="menu-title">Galeri</div>
      </a>
      <ul class="mm-collapse" style="">
        <li class=""> 
          <a href=""><i class="bi bi-arrow-right-short"></i>
            Foto Pedagang
          </a>
        </li>
        <li class=""> 
          <a href=""><i class="bi bi-arrow-right-short"></i>
            Foto Jumat Berkah
          </a>
        </li>
        <li class=""> 
          <a href=""><i class="bi bi-arrow-right-short"></i>
            Foto Bazar Subuh
          </a>
        </li>
        <li class=""> 
          <a href=""><i class="bi bi-arrow-right-short"></i>
            Foto Kegiatan
          </a>
        </li>
      </ul>
    </li> --}}

  </ul>
  <!--end navigation-->
</aside>
<!--end sidebar -->