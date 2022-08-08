@extends('layouts.main')

@section('content')

@if (session()->has('message'))
  <div id="notifications" data-notification="{{ session('message') }}"></div>
@endif
    
<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Infaq Pedagang</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/admin"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-shop"></i> Infaq Pedagang
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<h6 class="mb-0 text-uppercase">Data Semua Infaq Pedagang</h6>
<hr/>
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table id="example2" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Total Infaq</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($merchants as $merchant)
            <tr>
              <td class="align-middle text-center text-nowrap">{{ $merchant->number }}</td>
              <td class="align-middle text-nowrap">{{ $merchant->name }}</td>
              <td class="align-middle text-center text-nowrap">{{ $merchant->status }}</td>
              <td class="align-middle text-center text-nowrap">{{ $merchant->incomes }}</td>
              <td class="align-middle text-nowrap">
                <div class="d-flex align-items-center justify-content-center fs-6">
                  <a href="/admin/pedagang/{{ $merchant->number }}" class="mx-3 text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Detail" aria-label="Detail"><i class="bi bi-eye-fill"></i> Detail</a>
                  <a href="/admin/pedagang/{{ $merchant->number }}/edit" data-bs-toggle="modal" data-bs-target="#addNewIncome" class="mx-3 text-success addIncomeButton" data-number="{{ $merchant->number }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Tambah Infaq" aria-label="Tambah Infaq"><i class="bi bi-plus"></i>Tambah Infaq</a>
                  {{-- <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Hapus" aria-label="Hapus"><i class="bi bi-trash-fill"></i></a> --}}
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Total Infaq</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="addNewIncome" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Tambah Infaq</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/addIncome/" method="POST" id="form-container">
        @csrf
        <input type="hidden" class="form-control" id="merchant_id" name="merchant_id" value="">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nomor Pedagang</label>
            <input type="text" class="form-control" name="number" id="number" value="" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Nama Pedagang</label>
            <input type="text" class="form-control" name="name" id="name" value="" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Periode</label>
            <select class="form-select mb-3" name="period" aria-label="Default select example">
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
          </div>
          <div class="mb-3">
            <label class="form-label" for="nominal">Jumlah Infaq</label>
            <div class="input-group mb-3"> 
              <span class="input-group-text">Rp</span>
              <input type="text" class="form-control" id="nominal" name="nominal"> 
              <span class="input-group-text">.00</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit"  class="btn btn-primary">Tambah Infaq!</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection