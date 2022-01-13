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

  // Add Expanses
  $('.addButton').on('click', function () {
    $('#form-container').attr('action', '/bazaar');
    $('.modal-title').html('Form Tambah Pengeluaran');
    $('input[name=_method').val('POST');
    $('#nominal').val('');
    $('#date').val('');
    $('.buttonSubmit').html('Tambah Pengeluaran!');
  })

  // Edit Expanses
  $('.editButton').on('click', function () {
    const data = $(this).attr('data-expanses');
    console.log(data);
    $.ajax({
      type: "GET",
      url: '/getExpanseData/' + data,
      dataType: 'json',
      success: function (data) {
        console.log(data)
        $('#form-container').attr('action', '/bazaar/' + data.id);
        $('.modal-title').html('Form Edit Pengeluaran');
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
});