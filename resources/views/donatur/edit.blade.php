@extends('layouts.main')

@section('content')
    
<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Donatur</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="/donatur"><i class="bi bi-people-fill"></i> Donatur</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Ubah Donatur
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<div class="row">
  <div class="col-xl-6 mx-auto">
    <h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">Form Ubah Donatur</h6>
    <hr/>
    <div class="card">
      <div class="card-body">
        <div class="border p-3 rounded">
          <form action="/donatur/{{ $donor->id }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="col-12">
              <label class="form-label">Nama Pedagang</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $donor->name) }}" tabindex="1" autofocus>
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
                  <input class="form-check-input" type="radio" name="gender" value="Laki-laki" id="Laki-laki" {{ $donor->gender == 'Laki-laki' ? 'checked' : '' }} tabindex="2">
                  <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                </div>
                <div class="form-check me-3">
                  <input class="form-check-input" type="radio" name="gender" value="Perempuan" id="Perempuan" {{ $donor->gender == 'Perempuan' ? 'checked' : '' }} tabindex="3">
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
              <textarea class="form-control @error('address') is-invalid @enderror" rows="4" cols="4" name="address" tabindex="7">{{ old('address', $donor->address) }}</textarea>
              @error('address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <div class="d-grid">
                <button type="submit" class="btn btn-primary" tabindex="8">Ubah Pedagang</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection