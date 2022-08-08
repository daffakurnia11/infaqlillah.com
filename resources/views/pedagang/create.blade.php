@extends('layouts.main')

@section('content')
    
<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Pedagang</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/admin"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="/admin/pedagang"><i class="bi bi-shop"></i> Pedagang</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Tambah Pedagang
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<div class="row">
  <div class="col-xl-6 mx-auto">
    <h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">Form Tambah Pedagang</h6>
    <hr/>
    <div class="card">
      <div class="card-body">
        <div class="border p-3 rounded">
          <form action="/admin/pedagang" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
              <label class="form-label">Nama Pedagang</label>
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
              <label class="form-label">Nominal</label>
              <div class="input-group mb-3"> 
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal') }}" tabindex="4">
                <span class="input-group-text">.00</span>
              </div>
              @error('nominal')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
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
            <div class="col-12">
              <label class="form-label">Foto Pedagang</label>
              <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept=".jpg,.jpeg,.png" tabindex="6">
              @error('photo')
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