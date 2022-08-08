@extends('layouts.main')

@section('content')
    
@if (session()->has('success') || session()->has('failed'))
  <div id="notifications" data-success="{{ session('success') }}" data-failed="{{ session('failed') }}"></div>
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
          Buduran
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<h6 class="mb-0 text-uppercase d-flex justify-content-between align-items-center">
  <span>Data Jumat Berkah Buduran</span>
  <a href="/admin/jumat-berkah/create" class="btn btn-sm btn-primary">Tambah Pengeluaran</a>
</h6>
<hr/>
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table id="example2" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Nama Penanggungjawab</th>
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
              <td class="align-middle text-nowrap">{{ $data->in_charge }}</td>
              <td class="align-middle text-center text-nowrap">Rp {{ $data->nominal }},00</td>
              <td class="align-middle text-wrap">{{ $data->date_period }}</td>
              <td class="align-middle text-center text-nowrap">
                @if ($data->photo)
                <a href="/img/foto_jumat/{{ $data->photo }}" target="_blank"><i class="bi bi-eye-fill"></i> Lihat Foto</a>
                @else
                <i>Tidak ada foto</i>
                @endif
              </td>
              <td class="align-middle text-nowrap">
                <div class="table-actions d-flex align-items-center justify-content-center gap-3 fs-6">
                  {{-- <a href="/toko/{{ $data->id }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Detail" aria-label="Detail"><i class="bi bi-eye-fill"></i></a> --}}
                  <a href="/admin/jumat-berkah/{{ $data->id }}/edit" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Ubah" aria-label="Ubah"><i class="bi bi-pencil-fill"></i></a>
                  <form action="/admin/jumat-berkah/{{ $data->id }}" method="POST">
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
            <th>Nama Penanggungjawab</th>
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

@endsection