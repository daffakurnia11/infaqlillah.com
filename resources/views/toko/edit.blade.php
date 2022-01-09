@extends('layouts.main')

@section('content')

@if (session()->has('message'))
  <div id="notifications" data-notification="{{ session('message') }}"></div>
@endif
    
<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Toko</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="/toko"><i class="bi bi-shop"></i> Toko</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          Ubah Pemasukkan
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<div class="row">
  <div class="col-xl-6 mx-auto">
    <h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">Form Ubah Pemasukkan</h6>
    <hr/>
    <div class="card">
      <div class="card-body">
        <div class="border p-3 rounded">
          <form action="/toko/{{ $income->id }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-12">
              <label class="form-label">Nama Pembeli</label>
              <input type="text" class="form-control @error('buyer') is-invalid @enderror" name="buyer" value="{{ old('buyer', $income->buyer) }}" tabindex="1" autofocus>
              @error('buyer')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <label class="form-label">Nominal</label>
              <div class="input-group mb-3"> 
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal', $income->nominal) }}" tabindex="2">
                <span class="input-group-text">.00</span>
              </div>
              @error('nominal')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <label class="form-label">Catatan Pembelian</label>
              <textarea class="form-control @error('notes') is-invalid @enderror" rows="4" cols="4" name="notes" tabindex="3">{{ old('notes', $income->notes) }}</textarea>
              @error('notes')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-12">
              <div class="d-grid">
                <button type="submit" class="btn btn-primary" tabindex="4">Ubah Pedagang</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection