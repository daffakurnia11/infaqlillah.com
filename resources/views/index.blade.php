@extends('layouts.main')

@section('content')
    
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3 border-0">Selamat Datang, {{ auth()->user()->name }}</div>
  <div class="ms-auto ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item active" aria-current="page"><i class="bx bx-home-alt"></i> Dashboard</li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->


@endsection