const flashdata = $('#flash-data').data('flashdata');
const success = $('#notifications').data('success');
const failed = $('#notifications').data('failed');

if (flashdata) {
  // Login Failed
  if (flashdata == 'Login Failed') {
    Swal.fire({
      icon: 'error',
      title: 'Access Ditolak!',
      text: 'Username / Password tidak cocok. Ulangi kembali!',
      confirmButtonColor: '#dc3545',
    })
  }
  // Logout Success
  if (flashdata == 'Logout Success') {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil Logout!',
      text: 'Anda berhasil keluar, terima kasih.',
      confirmButtonColor: '#198754',
    })
  }
}

if (success) {
  Lobibox.notify('success', {
    pauseDelayOnHover: true,
    size: 'mini',
    rounded: true,
    icon: 'bx bx-check-circle',
    delayIndicator: false,
    continueDelayOnInactiveTab: false,
    position: 'top right',
    msg: success
  });
}

if (failed) {
  Lobibox.notify('warning', {
    pauseDelayOnHover: true,
    size: 'mini',
    rounded: true,
    delayIndicator: false,
    icon: 'bx bx-error',
    continueDelayOnInactiveTab: false,
    position: 'top right',
    msg: failed
  });
}

$(function () {
  // Add Merchant Income
  $('.addIncomeButton').on('click', function () {
    const data = $(this).attr('data-number');
    $.ajax({
      type: "GET",
      url: '/getMerchantData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#name').val(data.name)
        $('#number').val(data.number)
        $('#merchant_id').val(data.id)
        $('#form-container').attr('action', '/admin/addIncome/' + data.number)
      }
    });
  });
  // Add Donor Income
  $('.donorIncomeButton').on('click', function () {
    const data = $(this).attr('data-number');
    $.ajax({
      type: "GET",
      url: '/admin/getDonorData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#name').val(data.name)
        $('#donor_id').val(data.id)
        $('#form-container').attr('action', '/admin/addDonorIncome/' + data.id)
      }
    });
  });

  // Add Bazaar Expanses
  $('.addBazaar').on('click', function () {
    $('#form-container').attr('action', '/admin/bazaar');
    $('.modal-title').html('Form Tambah Pengeluaran Bazaar');
    $('input[name=_method').val('POST');
    $('#nominal').val('');
    $('#date').val('');
    $('.buttonSubmit').html('Tambah Pengeluaran!');
  })

  // Edit Bazaar Expanses
  $('.editBazaar').on('click', function () {
    const data = $(this).attr('data-expanses');
    console.log(data);
    $.ajax({
      type: "GET",
      url: '/admin/getExpanseData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#form-container').attr('action', '/admin/bazaar/' + data.id);
        $('.modal-title').html('Form Edit Pengeluaran Bazaar');
        $('input[name=_method').val('PUT');
        $('#nominal').val(data.nominal);
        $('#date').val(data.date);
        $('.buttonSubmit').html('Edit Pengeluaran!');
      },
      error: function (data) {
        console.log(data);
      }
    });
  });

  // Add Other Expanses
  $('.addExpanse').on('click', function () {
    $('#form-container').attr('action', '/admin/pengeluaran-lain');
    $('.modal-title').html('Form Tambah Pengeluaran Lain');
    $('input[name=_method').val('POST');
    $('#nominal').val('');
    $('#date').val('');
    $('.buttonSubmit').html('Tambah Pengeluaran!');
  })

  // Edit Other Expanses
  $('.editExpanse').on('click', function () {
    const data = $(this).attr('data-expanses');
    console.log(data);
    $.ajax({
      type: "GET",
      url: '/admin/getExpanseData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#form-container').attr('action', '/admin/pengeluaran-lain/' + data.id);
        $('.modal-title').html('Form Edit Pengeluaran ' + data.event);
        $('input[name=_method').val('PUT');
        $('#event').val(data.event);
        $('#nominal').val(data.nominal);
        $('#date').val(data.date);
        $('.buttonSubmit').html('Edit Pengeluaran!');
      },
      error: function (data) {
        console.log(data);
      }
    });
  });

  // Add Shop Expanse
  $('.addShopExpanse').on('click', function () {
    $('#form-container').attr('action', '/admin/modal-toko');
    $('.modal-title').html('Form Tambah Modal Toko');
    $('input[name=_method').val('POST');
    $('#nominal').val('');
    $('#notes').html();
    $('#date').val('');
    $('.buttonSubmit').html('Tambah Pengeluaran!');
  })

  // Edit Shop Expanse
  $('.editShopExpanse').on('click', function () {
    const data = $(this).attr('data-expanses');
    console.log(data);
    $.ajax({
      type: "GET",
      url: '/admin/getExpanseData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#form-container').attr('action', '/admin/modal-toko/' + data.id);
        $('.modal-title').html('Form Edit Modal Toko');
        $('input[name=_method').val('PUT');
        $('#notes').html(data.notes);
        $('#nominal').val(data.nominal);
        $('#date').val(data.date);
        $('.buttonSubmit').html('Edit Pengeluaran!');
      },
      error: function (data) {
        console.log(data);
      }
    });
  });
});

$(function () {
  var ctx = document.getElementById('merchantOverall').getContext('2d');
  var incomeChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Data Infaq Pedagang',
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

  var merchantOverall = function () {
    $.ajax({
      url: window.location.origin + '/admin/merchantOverall',
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

  merchantOverall();
});

$(function () {
  var ctx = document.getElementById('donorOverall').getContext('2d');
  var incomeChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Data Infaq Donatur',
        data: [],
        backgroundColor: "transparent",
        borderColor: "#12bf24",
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

  var donorOverall = function () {
    $.ajax({
      url: window.location.origin + '/admin/donorOverall',
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

  donorOverall();
});

$(function () {
  var ctx = document.getElementById('storeExpanses').getContext('2d');
  var incomeChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [{
        label: 'Data Pengeluaran Modal Toko',
        data: [],
        backgroundColor: "#12bf24",
        borderColor: "#12bf24",
        borderWidth: 2
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
          barPercentage: 0.4
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

  var storeExpanses = function () {
    $.ajax({
      url: window.location.origin + '/admin/storeExpanses',
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

  storeExpanses();
});

$(function () {
  var ctx = document.getElementById('otherExpanses').getContext('2d');
  var incomeChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [{
        label: 'Data Pengeluaran Lain',
        data: [],
        backgroundColor: "#e72e7a",
        borderColor: "#e72e7a",
        borderWidth: 2
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
          barPercentage: 0.4
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

  var storeExpanses = function () {
    $.ajax({
      url: window.location.origin + '/admin/otherExpanses',
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

  storeExpanses();
});