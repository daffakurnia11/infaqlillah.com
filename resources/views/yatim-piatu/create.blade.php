@extends('layouts.main')

@section('content')

@if (session()->has('message'))
  <div id="notifications" data-notification="{{ session('message') }}"></div>
@endif
    
<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Yatim Piatu</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/admin"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-house"></i> Yatim Piatu
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Tambah Pengeluaran
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<div class="row">
  <div class="col-xl-6 mx-auto">
    <h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">Form Tambah Pengeluaran</h6>
    <hr/>
    <div class="card">
      <div class="card-body">
        <div class="border p-3 rounded">
          <form action="/admin/yatim-piatu" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
              <label class="form-label">Nama Pemilik/Penerima</label>
              <input type="text" class="form-control @error('receiver') is-invalid @enderror" name="receiver" value="{{ old('receiver') }}" tabindex="1" autofocus>
              @error('receiver')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <label class="form-label">Yayasan</label>
              <select class="form-select @error('category') is-invalid @enderror" name="category" id="category" aria-label="Default select example" tabindex="2">
                <option selected="" disabled>-- Pilih Yayasan --</option>
                <option value="Yayasan Nurussalam" {{ old('category') == 'Yayasan Nurussalam' ? 'selected' : '' }}>Yayasan Nurussalam</option>
                <option value="Yayasan Al Firdaus" {{ old('category') == 'Yayasan Al Firdaus' ? 'selected' : '' }}>Yayasan Al Firdaus</option>
                <option value="Yayasan Al Kahfi" {{ old('category') == 'Yayasan Al Kahfi' ? 'selected' : '' }}>Yayasan Al Kahfi</option>
              </select>
              @error('category')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <label class="form-label">Nominal</label>
              <div class="input-group"> 
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal') }}" tabindex="3">
                <span class="input-group-text">.00</span>
              </div>
              @error('nominal')
              <small class="text-danger">
                {{ $message }}
              </small>
              @enderror
            </div>
            <div class="col-12">
              <label class="form-label">Periode</label>
              <select class="form-select @error('period') is-invalid @enderror" name="period" aria-label="Default select example" tabindex="4">
                <option selected="" disabled>--PILIH PERIODE--</option>
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
              </select>
              @error('period')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <label class="form-label">Dokumentasi</label>
              <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept=".jpg,.jpeg,.png" tabindex="5">
              @error('photo')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <div class="d-grid">
                <button type="submit" class="btn btn-primary" tabindex="6">Tambah Pengeluaran</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection