@extends('layouts.main')

@section('content')
    
<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Donatur</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/admin/"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="/admin/donatur"><i class="bi bi-people-fill"></i> Donatur</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Tambah Donatur
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<div class="row">
  <div class="col-xl-6 mx-auto">
    <h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">Form Tambah Donatur</h6>
    <hr/>
    <div class="card">
      <div class="card-body">
        <div class="border p-3 rounded">
          <form action="/admin/donatur" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
              <label class="form-label">Nama Donatur</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" tabindex="1" autofocus>
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <label class="form-label">Jenis Kelamin</label>
              <div class="d-flex">
                <div class="form-check me-3">
                  <input class="form-check-input" type="radio" name="gender" value="Laki-laki" id="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'checked' : '' }} tabindex="2">
                  <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                </div>
                <div class="form-check me-3">
                  <input class="form-check-input" type="radio" name="gender" value="Perempuan" id="Perempuan" {{ old('gender') == 'Perempuan' ? 'checked' : '' }} tabindex="3">
                  <label class="form-check-label" for="Perempuan">Perempuan</label>
                </div>
              </div>
              @error('gender')
              <small class="text-danger">
                {{ $message }}
              </small>
              @enderror
            </div>
            <div class="col-12">
              <label class="form-label">Alamat</label>
              <textarea class="form-control @error('address') is-invalid @enderror" rows="4" cols="4" name="address" tabindex="5">{{ old('address') }}</textarea>
              @error('address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="first_donate">Infaq Awal</label>
              <div class="input-group"> 
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control @error('first_donate') is-invalid @enderror" id="first_donate" name="first_donate" value="{{ old('first_donate') }}"> 
                <span class="input-group-text">.00</span>
              </div>
              @error('first_donate')
              <small class="text-danger">
                {{ $message }}
              </small>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Periode</label>
              <select class="form-select @error('period') is-invalid @enderror" name="period" aria-label="Default select example">
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
              <div class="d-grid">
                <button type="submit" class="btn btn-primary" tabindex="7">Tambah Pedagang</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection