@extends('layouts.main')

@section('content')

@if (session()->has('message'))
  <div id="notifications" data-notification="{{ session('message') }}"></div>
@endif
    
<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Jumat Berkah</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/admin"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-gift"></i> Jumat Berkah
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
          <form action="/admin/jumat-berkah" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
              <label class="form-label">Nama Penanggungjawab</label>
              <input type="text" class="form-control @error('in_charge') is-invalid @enderror" name="in_charge" value="{{ old('in_charge') }}" tabindex="1" autofocus>
              @error('in_charge')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <label class="form-label">Tempat</label>
              <select class="form-select @error('category') is-invalid @enderror" name="category" id="category" aria-label="Default select example" tabindex="2">
                <option selected="" disabled>-- Pilih tempat --</option>
                <option value="Masjid Aminah Al-Fajr" {{ old('category') == 'Masjid Aminah Al-Fajr' ? 'selected' : '' }}>Masjid Aminah Al-Fajr</option>
                <option value="Masjid Siwalan Panji" {{ old('category') == 'Masjid Siwalan Panji' ? 'selected' : '' }}>Masjid Siwalan Panji</option>
                <option value="Buduran" {{ old('category') == 'Buduran' ? 'selected' : '' }}>Buduran</option>
                <option value="Gedangan" {{ old('category') == 'Gedangan' ? 'selected' : '' }}>Gedangan</option>
                <option value="Tulungagung" {{ old('category') == 'Tulungagung' ? 'selected' : '' }}>Tulungagung</option>
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
              <input class="result form-control @error('date_period') is-invalid @enderror" type="text" name="date_period" id="date" placeholder="Klik untuk pilih tanggal.." value="{{ old('date_period') }}" tabindex="4">
              @error('date_period')
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