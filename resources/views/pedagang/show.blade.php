@extends('layouts.main')

@section('content')

@if (session()->has('success') || session()->has('failed'))
  <div id="notifications" data-success="{{ session('success') }}" data-failed="{{ session('failed') }}"></div>
@endif
    
<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Pedagang</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="/pedagang"><i class="bi bi-shop"></i> Pedagang</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          {{ $merchant->name }}
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<div class="row">
  <div class="col-12 col-lg-6 col-xl-8 order-lg-1 order-2">
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <h5 class="mb-2">Pedagang No. {{ $merchant->number }} : {{ $merchant->name }}</h5>
        <div class="mb-0 d-flex justify-content-between flex-md-row flex-column">
          <div class="pb-2">
            Terdaftar pada : <span class="fw-bold">{{ $merchant->created_at }}</span>
          </div>
          @if ($merchant->status == 'Aktif')
            <div class="text-success text-end"><i class="bi bi-patch-check"></i> Aktif</div>
          @else
            <div class="text-danger text-end">Tidak Aktif</div>
          @endif
        </div>
        <hr>

        {{-- Informasi Infaq --}}
        <div class="card border">
          <div class="card-header">
            <h6 class="mb-0">Informasi Infaq</h6>
          </div>
          <div class="card-body">
            @foreach ($income as $data)
              <div class="row mb-2">
                <div class="col-xl-4 col-lg-5 col-sm-6 d-flex justify-content-between">
                  <span>{{ $data['period'] }}</span>
                  <span class="d-none d-sm-block">:</span>
                </div>
                <div class="col-xl-8 col-lg-7 col-sm-6 fw-bold">
                  {{ $data['nominal'] }}
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @if ($merchant->status == 'Aktif')
        <div class="card border">
          <div class="card-header">
            <h6 class="mb-0">Informasi Infaq</h6>
          </div>
          <div class="card-body">
            <canvas id="chart1" data-merchant="{{ $merchant->number }}"></canvas>
          </div>
        </div>
        @endif
      </div>
      <div class="card-footer">
        <div class="d-flex flex-row-reverse">
          <form action="/pedagang/{{ $merchant->number }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger ms-2" onclick="return confirm('Apakah data ingin dihapus?');"><i class="bi bi-trash-fill"></i> Hapus Data</button>
          </form>
          <a href="/pedagang/{{ $merchant->number }}/edit" class="btn btn-warning ms-2"><i class="bi bi-pencil-fill"></i> Ubah Data</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6 col-xl-4 order-lg-2 order-1">
    <div class="card shadow-sm border-0 overflow-hidden">
      <div class="card-body">
        <div class="profile-avatar text-center">
          <img src="/img/foto_pedagang/{{ $merchant->photo }}" class="shadow" height="200" alt="">
        </div>
        <div class="text-center mt-4">
          <h4 class="mb-1">{{ $merchant->name }}</h4>
          <p class="mb-0 text-secondary">{{ $merchant->gender }}</p>
          <div class="mt-4"></div>
          <h4 class="mb-1">Rp {{ $merchant->incomes }},00</h4>
          <p class="mb-0 text-secondary">Total Infaq</p>
          <div class="mt-4"></div>
          <p class="mb-0 text-secondary">Terdaftar dari</p>
          <h6 class="mb-1">{{ $merchant->created_at->diffForHumans() }}</h6>
        </div>
        <hr>
        <div class="text-start">
          <h5 class="">Alamat Pedagang</h5>
          <p class="mb-0">
            {{ $merchant->address }}
          </p>
        </div>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
          Terdaftar pada
          <span>{{ $merchant->created_at }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
          Tersalurkan pada
          <span>{{ $merchant->received_at }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
          Status
          @if ($merchant->status == 'Aktif')
            <span class="badge bg-success rounded-pill"><i class="bi bi-patch-check"></i> Aktif</span>
          @else
            <span class="badge bg-danger rounded-pill">Tidak Aktif</span>
          @endif
        </li>
      </ul>
    </div>
  </div>
</div><!--end row-->

@endsection