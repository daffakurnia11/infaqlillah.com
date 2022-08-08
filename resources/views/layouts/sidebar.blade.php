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
    
    <li class="{{ Request::is('/admin') ? 'mm-active' : '' }}">
      <a href="/admin">
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
      <ul class="mm-collapse {{ (Request::is('admin/infaq**') or Request::is('toko**') or Request::is('donatur**')) ? 'mm-show' : '' }}" style="">
        <li class="{{ Request::is('admin/infaq/pedagang') ? 'mm-active' : '' }}"> 
          <a href="/admin/infaq/pedagang"><i class="bi bi-arrow-right-short"></i>
            Pedagang
          </a>
        </li>
        <li class="{{ Request::is('admin/donatur**') ? 'mm-active' : '' }}"> 
          <a href="/admin/donatur"><i class="bi bi-arrow-right-short"></i>
            Donatur
          </a>
        </li>
        <li class="{{ Request::is('admin/toko**') ? 'mm-active' : '' }}"> 
          <a href="/admin/toko"><i class="bi bi-arrow-right-short"></i>
            Toko
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-label">Data Pengeluaran</li>
    <li class="{{ Request::is('admin/pedagang**') ? 'mm-active' : '' }}">
      <a href="/admin/pedagang">
        <div class="parent-icon"><i class="bi bi-shop"></i>
        </div>
        <div class="menu-title">Modal Pedagang</div>
      </a>
    </li>
    <li class="{{ Request::is('admin/modal-toko**') ? 'mm-active' : '' }}">
      <a href="/admin/modal-toko">
        <div class="parent-icon"><i class="bi bi-basket"></i>
        </div>
        <div class="menu-title">Modal Toko</div>
      </a>
    </li>
    <li class="">
      <a class="has-arrow" href="#" aria-expanded="true">
        <div class="parent-icon"><i class="bi bi-house"></i>
        </div>
        <div class="menu-title">Yatim Piatu</div>
      </a>
      <ul class="mm-collapse {{ Request::is('admin/yatim-piatu**') ? 'mm-show' : '' }}" style="">
        <li class="{{ Request::is('admin/yatim-piatu/nurussalam') ? 'mm-active' : '' }}"> 
          <a href="/admin/yatim-piatu/nurussalam"><i class="bi bi-arrow-right-short"></i>
            Yayasan Nurussalam
          </a>
        </li>
        <li class="{{ Request::is('admin/yatim-piatu/al-firdaus') ? 'mm-active' : '' }}"> 
          <a href="/admin/yatim-piatu/al-firdaus"><i class="bi bi-arrow-right-short"></i>
            Yayasan Al Firdaus
          </a>
        </li>
        <li class="{{ Request::is('admin/yatim-piatu/al-kahfi') ? 'mm-active' : '' }}"> 
          <a href="/admin/yatim-piatu/al-kahfi"><i class="bi bi-arrow-right-short"></i>
            Yayasan Al Kahfi
          </a>
        </li>
      </ul>
    </li>
    <li class="">
      <a class="has-arrow" href="#" aria-expanded="true">
        <div class="parent-icon"><i class="bi bi-gift"></i>
        </div>
        <div class="menu-title">Jumat Berkah</div>
      </a>
      <ul class="mm-collapse {{ Request::is('admin/jumat-berkah**') ? 'mm-show' : '' }}" style="">
        <li class="{{ Request::is('admin/jumat-berkah/aminah-al-fajr') ? 'mm-active' : '' }}"> 
          <a href="/admin/jumat-berkah/aminah-al-fajr"><i class="bi bi-arrow-right-short"></i>
            Masjid Aminah Al-Fajr
          </a>
        </li>
        <li class="{{ Request::is('admin/jumat-berkah/siwalan-panji') ? 'mm-active' : '' }}"> 
          <a href="/admin/jumat-berkah/siwalan-panji"><i class="bi bi-arrow-right-short"></i>
            Masjid Siwalan Panji
          </a>
        </li>
        <li class="{{ Request::is('admin/jumat-berkah/buduran') ? 'mm-active' : '' }}"> 
          <a href="/admin/jumat-berkah/buduran"><i class="bi bi-arrow-right-short"></i>
            Buduran
          </a>
        </li>
        <li class="{{ Request::is('admin/jumat-berkah/gedangan') ? 'mm-active' : '' }}"> 
          <a href="/admin/jumat-berkah/gedangan"><i class="bi bi-arrow-right-short"></i>
            Gedangan
          </a>
        </li>
        <li class="{{ Request::is('admin/jumat-berkah/tulungagung') ? 'mm-active' : '' }}"> 
          <a href="/admin/jumat-berkah/tulungagung"><i class="bi bi-arrow-right-short"></i>
            Tulungagung
          </a>
        </li>
      </ul>
    </li>
    <li class="{{ Request::is('admin/bazaar**') ? 'mm-active' : '' }}">
      <a href="/admin/bazaar">
        <div class="parent-icon"><i class="bi bi-bag"></i>
        </div>
        <div class="menu-title">Bazar Subuh</div>
      </a>
    </li>
    <li class="{{ Request::is('admin/pengeluaran-lain**') ? 'mm-active' : '' }}">
      <a href="/admin/pengeluaran-lain">
        <div class="parent-icon"><i class="bi bi-cart-dash"></i>
        </div>
        <div class="menu-title">Lain-lain</div>
      </a>
    </li>

  </ul>
  <!--end navigation-->
</aside>
<!--end sidebar -->