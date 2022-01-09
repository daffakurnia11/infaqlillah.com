const flashdata = $('#flash-data').data('flashdata');
const notification = $('#notifications').data('notification');

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

if (notification) {
  if (notification == 'Data masih belum lengkap!') {
    Lobibox.notify('warning', {
      pauseDelayOnHover: true,
      size: 'mini',
      rounded: true,
      delayIndicator: false,
      icon: 'bx bx-error',
      continueDelayOnInactiveTab: false,
      position: 'top right',
      msg: notification
    });
  }
  if (notification == 'Data berhasil dikirim! Cek kembali data anda!') {
    Lobibox.notify('success', {
      pauseDelayOnHover: true,
      size: 'mini',
      rounded: true,
      icon: 'bx bx-check-circle',
      delayIndicator: false,
      continueDelayOnInactiveTab: false,
      position: 'top right',
      msg: notification
    });
  }
  if (notification == 'Pengeluaran telah dicatat dan Pedagang telah ditambahkan!') {
    Lobibox.notify('success', {
      pauseDelayOnHover: true,
      size: 'mini',
      rounded: true,
      icon: 'bx bx-check-circle',
      delayIndicator: false,
      continueDelayOnInactiveTab: false,
      position: 'top right',
      msg: notification
    });
  }
  if (notification == 'Data pedagang telah berhasil diubah!') {
    Lobibox.notify('success', {
      pauseDelayOnHover: true,
      size: 'mini',
      rounded: true,
      icon: 'bx bx-check-circle',
      delayIndicator: false,
      continueDelayOnInactiveTab: false,
      position: 'top right',
      msg: notification
    });
  }
  if (notification == 'Data pedagang telah berhasil dihapus!') {
    Lobibox.notify('success', {
      pauseDelayOnHover: true,
      size: 'mini',
      rounded: true,
      icon: 'bx bx-check-circle',
      delayIndicator: false,
      continueDelayOnInactiveTab: false,
      position: 'top right',
      msg: notification
    });
  }
}

$(function () {
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
        $('#form-container').attr('action', '/addIncome/' + data.number)
      }
    });
  });
});

// chart 1
var ctx = document.getElementById('chart1').getContext('2d');
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

var updateChart = function () {
  const number = $('#chart1').data('merchant');
  console.log(number);
  $.ajax({
    url: window.location.origin + '/getIncomeData/' + number,
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

updateChart();
