@extends('layouts.main')

@section('content')
    
<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Selamat Datang, {{ auth()->user()->name }}</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item active" aria-current="page"><i class="bx bx-home-alt"></i> Dashboard</li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

{{-- Total Statistics --}}
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3">
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
          <div class="d-flex align-items-center">
              <div>
                <p class="mb-0 text-secondary">Saldo Saat Ini</p>
                <h4 class="my-1">Rp {{ number_format($current, 2, ',', '.') }}</h4>
                @if ($monthly_current <= 0)
                <p class="mb-0 font-13 text-danger"><i class="bi bi-caret-down-fill"></i> Rp {{ number_format($monthly_current, 2, ',', '.') }} dari bulan ini</p>
                @else
                <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i> Rp {{ number_format($monthly_current, 2, ',', '.') }} dari bulan ini</p>
                @endif
              </div>
              <div class="widget-icon-large bg-gradient-purple text-white ms-auto">
                <i class="bi bi-wallet"></i>
              </div>
          </div>
      </div>
    </div>
   </div>
   <div class="col">
      <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
              <div>
                <p class="mb-0 text-secondary">Total Pemasukkan</p>
                <h4 class="my-1">Rp {{ number_format($all_incomes, 2, ',', '.') }}</h4>
                @if ($incomes_inc == 0)
                <p class="mb-0 font-13">0</p>
                @else
                <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i> Rp {{ number_format($incomes_inc, 2, ',', '.') }} dari bulan ini</p>
                @endif
              </div>
              <div class="widget-icon-large bg-gradient-success text-white ms-auto">
                <i class="bi bi-bag-plus"></i>
              </div>
            </div>
        </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Total Pengeluaran</p>
              <h4 class="my-1">Rp {{ number_format($all_expanses, 2, ',', '.') }}</h4>
              @if ($expanse_inc == 0)
              <p class="mb-0 font-13">0</p>
              @else
              <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i> Rp {{ number_format($expanse_inc, 2, ',', '.') }} dari bulan ini</p>
              @endif
            </div>
            <div class="widget-icon-large bg-gradient-danger text-white ms-auto">
              <i class="bi bi-cart-dash"></i>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
{{-- End of Total Statistics --}}

<h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">Data Seluruh Pemasukkan</h6>
<hr/>
{{-- Incomes --}}
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Total Infaq Pedagang</p>
            <h4 class="mb-0 text-primary">Rp {{ number_format($merchant_incomes, 2, ',', '.') }}</h4>
          </div>
          <div class="ms-auto fs-2 text-primary">
            <i class="bi bi-shop"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <small class="mb-0">Penambahan : 
          @if ($merchant_inc == 0)
          <span>0</span>
          @else
          <span class="text-success">Rp {{ number_format($merchant_inc, 2, ',', '.') }}<i class="bi bi-arrow-up"></i></span>
          @endif
        </small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Total Infaq Donatur</p>
            <h4 class="mb-0 text-success">Rp {{ number_format($donor_incomes, 2, ',', '.') }}</h4>
          </div>
          <div class="ms-auto fs-2 text-success">
            <i class="bi bi-people-fill"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <small class="mb-0">Penambahan : 
          @if ($donor_inc == 0)
          <span>0</span>
          @else
          <span class="text-success">Rp {{ number_format($donor_inc, 2, ',', '.') }}<i class="bi bi-arrow-up"></i></span>
          @endif
        </small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Total Infaq Toko</p>
            <h4 class="mb-0 text-pink">Rp {{ number_format($store_incomes, 2, ',', '.') }}</h4>
          </div>
          <div class="ms-auto fs-2 text-pink">
            <i class="bi bi-basket"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <small class="mb-0">Penambahan : 
          @if ($store_inc == 0)
          <span>0</span>
          @else
          <span class="text-success">Rp {{ number_format($store_inc, 2, ',', '.') }}<i class="bi bi-arrow-up"></i></span>
          @endif
        </small>
      </div>
    </div>
  </div>
</div>
{{-- End of Incomes --}}

{{-- Incomes Statistics --}}
<div class="row">
  <div class="col-12 col-xxl-6 d-flex">
    <div class="card radius-10 w-100">
      <div class="card-body" style="position: relative;">
        <canvas id="merchantOverall"></canvas>
      </div>
    </div>
  </div>
  <div class="col-12 col-xxl-6 d-flex">
    <div class="card radius-10 w-100">
      <div class="card-body" style="position: relative;">
        <canvas id="donorOverall"></canvas>
      </div>
    </div>
  </div>
</div>
{{-- End of Incomes Statistics --}}

<h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">Data Seluruh Pengeluaran</h6>
<hr/>

<div class="card radius-10">
  <div class="card-body">
    <div class="row g-3">
      <div class="col-12 col-md-6 col-xxl-4 d-flex">
        <div class="card mb-0 radius-10 border shadow-none w-100">
          <div class="card-body">
            <h5 class="card-title">Jumat Berkah Bulan Ini</h5>
            <h4 class="mt-4">Rp {{ number_format($friday_permonth, 2, ',', '.') }}</h4>
            <p class="mb-0 text-secondary font-13"></p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item border-top">
                <div class="d-flex align-items-center">
                  <div>Masjid Aminah Al Fajr</div>
                  <div class="ms-auto">Rp {{ number_format($friday_1, 2, ',', '.') }}</div>
                </div>
              </li>
              <li class="list-group-item border-top">
                <div class="d-flex align-items-center">
                  <div>Masjid Siwalan Panji</div>
                  <div class="ms-auto">Rp {{ number_format($friday_2, 2, ',', '.') }}</div>
                </div>
              </li>
              <li class="list-group-item border-top">
                <div class="d-flex align-items-center">
                  <div>Buduran</div>
                  <div class="ms-auto">Rp {{ number_format($friday_3, 2, ',', '.') }}</div>
                </div>
              </li>
              <li class="list-group-item border-top">
                <div class="d-flex align-items-center">
                  <div>Gedangan</div>
                  <div class="ms-auto">Rp {{ number_format($friday_4, 2, ',', '.') }}</div>
                </div>
              </li>
              <li class="list-group-item border-top">
                <div class="d-flex align-items-center">
                  <div>Tulungagung</div>
                  <div class="ms-auto">Rp {{ number_format($friday_5, 2, ',', '.') }}</div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xxl-4 d-flex">
        <div class="card mb-0 radius-10 border shadow-none w-100">
          <div class="card-body">
            <h5 class="card-title">Yatim Piatu Bulan Ini</h5>
            <h4 class="mt-4">Rp {{ number_format($foundation_permonth, 2, ',', '.') }}</h4>
            <p class="mb-0 text-secondary font-13"></p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item border-top">
                <div class="d-flex align-items-center">
                  <div>Yayasan Nurussalam</div>
                  <div class="ms-auto">Rp {{ number_format($foundation_1, 2, ',', '.') }}</div>
                </div>
              </li>
              <li class="list-group-item border-top">
                <div class="d-flex align-items-center">
                  <div>Yayasan Al Firdaus</div>
                  <div class="ms-auto">Rp {{ number_format($foundation_2, 2, ',', '.') }}</div>
                </div>
              </li>
              <li class="list-group-item border-top">
                <div class="d-flex align-items-center">
                  <div>Yayasan Al Kahfi</div>
                  <div class="ms-auto">Rp {{ number_format($foundation_3, 2, ',', '.') }}</div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xxl-4 d-flex">
        <div class="card mb-0 radius-10 border shadow-none w-100">
          <div class="card-body">
            <h5 class="card-title">Bazar Subuh Bulan Ini</h5>
            <h4 class="mt-4">Rp {{ number_format($bazaar_total, 2, ',', '.') }}</h4>
            <p class="mb-0 text-secondary font-13"></p>
            <ul class="list-group list-group-flush mt-3">
              @foreach ($bazaars as $bazaar)
              <li class="list-group-item border-top">
                <div class="d-flex align-items-center">
                  <div>Periode {{ $bazaar->date }}</div>
                  <div class="ms-auto">Rp {{ number_format($bazaar->nominal, 2, ',', '.') }}</div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div><!--end row-->
  </div>
</div>

{{-- Expanses Statistics --}}
<div class="row">
  <div class="col-12 col-xxl-6 d-flex">
    <div class="card radius-10 w-100">
      <div class="card-body" style="position: relative;">
        <canvas id="storeExpanses"></canvas>
      </div>
    </div>
  </div>
  <div class="col-12 col-xxl-6 d-flex">
    <div class="card radius-10 w-100">
      <div class="card-body" style="position: relative;">
        <canvas id="otherExpanses"></canvas>
      </div>
    </div>
  </div>
</div>
{{-- End of Expanses Statistics --}}

@endsection