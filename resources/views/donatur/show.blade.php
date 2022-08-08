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
          <a href="/admin"><i class="bx bx-home-alt"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="/admin/donatur"><i class="bi bi-people-fill"></i> Donatur</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          {{ $donor->name }}
        </li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<div class="row">
  <div class="col-12 col-lg-6 col-xl-8 order-lg-1 order-2">
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <h5 class="mb-2">Donatur : {{ $donor->name }}</h5>
        <div class="mb-0 d-flex justify-content-between flex-md-row flex-column">
          <div class="pb-2">
            Terdaftar pada : <span class="fw-bold">{{ $donor->created_at }}</span>
          </div>
        </div>
        <hr>

        {{-- Informasi Infaq --}}
        <div class="card border">
          <div class="card-header">
            <h6 class="mb-0">Informasi Infaq</h6>
          </div>
          <div class="card-body">
            @foreach ($income as $data)
              <div class="row mb-2">
                <div class="col-xl-4 col-lg-5 col-sm-6 d-flex justify-content-between">
                  <span>{{ $data['period'] }}</span>
                  <span class="d-none d-sm-block">:</span>
                </div>
                <div class="col-xl-8 col-lg-7 col-sm-6 fw-bold">
                  {{ $data['nominal'] }}
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <div class="card border">
          <div class="card-header">
            <h6 class="mb-0">Informasi Infaq</h6>
          </div>
          <div class="card-body">
            <canvas id="donaturChart" data-donor="{{ $donor->id }}"></canvas>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="d-flex flex-row-reverse">
          <form action="/admin/donatur/{{ $donor->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger ms-2" onclick="return confirm('Apakah data ingin dihapus?');"><i class="bi bi-trash-fill"></i> Hapus Data</button>
          </form>
          <a href="/admin/donatur/{{ $donor->id }}/edit" class="btn btn-warning ms-2"><i class="bi bi-pencil-fill"></i> Ubah Data</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6 col-xl-4 order-lg-2 order-1">
    <div class="card shadow-sm border-0 overflow-hidden">
      <div class="card-body">
        <div class="text-center mt-4">
          <h4 class="mb-1">{{ $donor->name }}</h4>
          <p class="mb-0 text-secondary">{{ $donor->gender }}</p>
          <div class="mt-4"></div>
          <h4 class="mb-1">Rp {{ $donor->donate }},00</h4>
          <p class="mb-0 text-secondary">Total Infaq</p>
          <div class="mt-4"></div>
          <p class="mb-0 text-secondary">Terdaftar dari</p>
          <h6 class="mb-1">{{ $donor->created_at->diffForHumans() }}</h6>
        </div>
        <hr>
        <div class="text-start">
          <h5 class="">Alamat Donatur</h5>
          <p class="mb-0">
            {{ $donor->address }}
          </p>
        </div>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
          Terdaftar pada
          <span>{{ $donor->created_at }}</span>
        </li>
      </ul>
    </div>
  </div>
</div><!--end row-->

<script>
  var ctx = document.getElementById('donaturChart').getContext('2d');
  var incomeChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Data Infaq',
        data: [],
        backgroundColor: "transparent",
        borderColor: "#3461ff",
        borderWidth: 4
      }]
    },
    options: {
      maintainAspectRatio: true,
      legend: {
        display: true,
        labels: {
          fontColor: '#585757',
          boxWidth: 40
        }
      },
      tooltips: {
        enabled: true
      },
      scales: {
        xAxes: [{
          ticks: {
            beginAtZero: true,
            autoSkip: false,
            fontColor: '#585757'
          },
          gridLines: {
            display: true,
            color: "rgba(0, 0, 0, 0.07)"
          },

        }],

        yAxes: [{
          ticks: {
            beginAtZero: true,
            fontColor: '#585757',
          },
          gridLines: {
            display: true,
            color: "rgba(0, 0, 0, 0.07)"
          },
        }]
      }
    }
  });

  var donorChart = function () {
    const number = $('#donaturChart').data('donor');
    console.log(number);
    $.ajax({
      url: window.location.origin + '/donorIncomeData/' + number,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        incomeChart.data.labels = data.period;
        incomeChart.data.datasets[0].data = data.nominal;
        incomeChart.update();
      },
      error: function (data) {
        console.log(data)
      }
    });
  }

  donorChart();
</script>

@endsection