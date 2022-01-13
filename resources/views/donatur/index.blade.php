@extends('layouts.main')

@section('content')
    
@if (session()->has('success') || session()->has('failed'))
  <div id="notifications" data-success="{{ session('success') }}" data-failed="{{ session('failed') }}"></div>
@endif

<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Donatur</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-people-fill"></i> Donatur
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">
  <span>Data Seluruh Donatur</span>
  <a href="/donatur/create" class="btn btn-sm btn-primary">Tambah Donatur</a>
</h6>
<hr/>
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table id="example2" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Total Infaq</th>
            <th>Tanggal Daftar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($donors as $donor)
            <tr>
              <td class="align-middle text-center text-nowrap">{{ $loop->iteration }}</td>
              <td class="align-middle text-nowrap">{{ $donor->name }}</td>
              <td class="align-middle text-nowrap">{{ $donor->gender }}</td>
              <td class="align-middle text-wrap">{{ $donor->address }}</td>
              <td class="align-middle text-wrap">{{ $donor->donate }}</td>
              <td class="align-middle text-center text-nowrap">{{ $donor->created_at }}</td>
              <td class="align-middle text-nowrap">
                <div class="table-actions d-flex align-items-center justify-content-center gap-3 fs-6">
                  <a href="/donatur/{{ $donor->id }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Detail" aria-label="Detail"><i class="bi bi-eye-fill"></i></a>
                  <a href="/donatur/{{ $donor->id }}/edit" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Ubah" aria-label="Ubah"><i class="bi bi-pencil-fill"></i></a>
                  <form action="/donatur/{{ $donor->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-danger bg-transparent border-0 p-0 m-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Hapus" aria-label="Hapus" onclick="return confirm('Apakah data ingin dihapus?');"><i class="bi bi-trash-fill"></i></button>
                  </form>
                  <button type="button" data-bs-toggle="modal" data-bs-target="#addNewIncome" class="btn text-success donorIncomeButton p-0" data-number="{{ $donor->id }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tambah Infaq" data-bs-original-title="Tambah Infaq" aria-label="Tambah Infaq"><i class="bi bi-plus"></i> Tambah Infaq</button>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Total Infaq</th>
            <th>Tanggal Daftar</th>
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
      <form action="/addDonorIncome/" method="POST" id="form-container">
        @csrf
        <input type="hidden" class="form-control" id="donor_id" name="donor_id" value="">
        <div class="modal-body">
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