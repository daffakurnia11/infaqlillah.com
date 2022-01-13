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
        $('#form-container').attr('action', '/addIncome/' + data.number)
      }
    });
  });
  // Add Donor Income
  $('.donorIncomeButton').on('click', function () {
    const data = $(this).attr('data-number');
    $.ajax({
      type: "GET",
      url: '/getDonorData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#name').val(data.name)
        $('#donor_id').val(data.id)
        $('#form-container').attr('action', '/addDonorIncome/' + data.id)
      }
    });
  });

  // Add Bazaar Expanses
  $('.addBazaar').on('click', function () {
    $('#form-container').attr('action', '/bazaar');
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
      url: '/getExpanseData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#form-container').attr('action', '/bazaar/' + data.id);
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
    $('#form-container').attr('action', '/pengeluaran-lain');
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
      url: '/getExpanseData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#form-container').attr('action', '/pengeluaran-lain/' + data.id);
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
    $('#form-container').attr('action', '/modal-toko');
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
      url: '/getExpanseData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#form-container').attr('action', '/modal-toko/' + data.id);
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