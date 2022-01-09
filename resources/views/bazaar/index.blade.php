@extends('layouts.main')

@section('content')
    
@if (session()->has('success') || session()->has('failed'))
  <div id="notifications" data-success="{{ session('success') }}" data-failed="{{ session('failed') }}"></div>
@endif

<!--breadcrumb-->
<div class="page-breadcrumb d-flex align-items-center flex-column flex-md-row mb-3">
  <div class="breadcrumb-title pe-3 border-0">Bazar Subuh</div>
  <div class="ms-md-auto me-md-0 mx-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item">
          <a href="/"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-bag"></i> Bazar Subuh
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">
  <span>Data Pengeluaran Bazaar Subuh</span>
  <a href="/jumat-berkah/create" data-bs-toggle="modal" data-bs-target="#bazaarButton" class="btn btn-sm btn-primary addButton">Tambah Pengeluaran</a>
</h6>
<hr/>
<div class="row">
  <div class="col-xxl-8">

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example2" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nomor</th>
                <th>Nominal</th>
                <th>Periode</th>
                <th>Dokumentasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datas as $data)
              <tr>
                <td class="align-middle text-center text-nowrap">{{ $loop->iteration }}</td>
                <td class="align-middle text-nowrap">{{ $data->nominal }}</td>
                <td class="align-middle text-wrap">{{ $data->date }}</td>
                <td class="align-middle text-center text-nowrap">
                  @if ($data->photo)
                  <a href="/img/foto_bazaar/{{ $data->photo }}" target="_blank"><i class="bi bi-eye-fill"></i> Lihat Foto</a>
                  @else
                  <i>Tidak ada foto</i>
                  @endif
                </td>
                <td class="align-middle text-nowrap">
                  <div class="table-actions d-flex align-items-center justify-content-center gap-3 fs-6">
                    {{-- <a href="/toko/{{ $data->id }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Detail" aria-label="Detail"><i class="bi bi-eye-fill"></i></a> --}}
                    <button type="button" class="btn btn-sm p-0 text-warning editButton" data-bs-toggle="modal" data-bs-target="#bazaarButton" data-expanses="{{ $data->id }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Ubah" aria-label="Ubah"><i class="bi bi-pencil-fill"></i></button>
                    <form action="/bazaar/{{ $data->id }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-danger bg-transparent border-0 p-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Hapus" aria-label="Hapus" onclick="return confirm('Apakah data ingin dihapus?');"><i class="bi bi-trash-fill"></i></button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Nomor</th>
                <th>Nominal</th>
                <th>Periode</th>
                <th>Dokumentasi</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bazaarButton" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Tambah Pengeluaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/bazaar" method="POST" id="form-container" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" class="form-control" id="merchant_id" name="merchant_id" value="">
        <div class="modal-body">
          <div class="col-12">
            <label class="form-label">Nominal</label>
            <div class="input-group"> 
              <span class="input-group-text">Rp</span>
              <input type="text" class="form-control" name="nominal" id="nominal" value="{{ old('nominal') }}" tabindex="1" autofocus>
              <span class="input-group-text">.00</span>
            </div>
          </div>
          <div class="col-12 mt-3">
            <label class="form-label">Tanggal Pelaksanaan</label>
            <input class="result form-control" type="text" name="date" id="date" placeholder="Klik untuk pilih tanggal.." value="{{ old('date') }}" tabindex="2">
          </div>
          <div class="col-12 mt-3">
            <label class="form-label">Dokumentasi</label>
            <input type="file" class="form-control" name="photo" accept=".jpg,.jpeg,.png" tabindex="3">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" tabindex="4">Tutup</button>
          <button type="submit" class="btn btn-primary buttonSubmit" tabindex="4">Tambah Pengeluaran!</button>
        </div>
      </form>
    </div>
  </div>
</div>
    
@endsection