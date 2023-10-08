<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>SMK YPE KROYA | <?= $title ?></title>
  <meta name="description" content="The small framework with powerful features">
  <link rel="icon" href="<?= base_url('assets/' . 'Logo-YPE.png'); ?>" type="image/png">
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('css/custom.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('css/boxicons.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('css/boxicons.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('css/animations.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('css/transformations.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('css/dataTables.bootstrap5.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('css/bootstrap-datepicker.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('css/custom-sidebar.css') ?>" />

  <!-- GRAFIK -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
  <script type="text/javascript">
    google.charts.load('visualization', "1", {
      packages: ['corechart']
    });
  </script>

</head>

<body class="" onload="showInput()">

  <?= $this->include('Admin/navbar') ?>
  <div class="container-fluid body-pd" id="body-pd">
    <?= $this->renderSection('content') ?>
  </div>
  <?= $this->include('Admin/footer') ?>


</body>
<script defer src="<?= base_url('js/solid.js') ?>" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script src="<?= base_url('js/e7578f8e4a.js') ?>" crossorigin="anonymous"></script>
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('js/jquery-3.5.1.js') ?>"></script>
<script src="<?= base_url('js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('js/cdb.min.js') ?>"></script>
<script src="<?= base_url('js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('js/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('js/tinymce/tinymce.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<!-- SmoothScroll Plugin JavaScript-->
<script src="<?= base_url('js/smoothscroll.min.js') ?>"></script>

<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script>

  $(document).ready(function() {
    $('table.display').DataTable();
  } );
</script>

<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    const showNavbar = (toggleId, navId, bodyId, headerId) => {
      const toggle = document.getElementById(toggleId),
      nav = document.getElementById(navId),
      bodypd = document.getElementById(bodyId),
      headerpd = document.getElementById(headerId)

// Validate that all variables exist
      if (toggle && nav && bodypd && headerpd) {

        toggle.addEventListener('click', () => {
// show navbar
          nav.classList.toggle('show-side')
// change icon
          toggle.classList.toggle('bx-x')
// add padding to body
          bodypd.classList.toggle('body-pd')
// add padding to header
          headerpd.classList.toggle('header-pd')
        })
      }
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

/*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
      if (linkColor) {
        linkColor.forEach(l => l.classList.remove('active'))
        this.classList.add('active')
      }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink))

// Your code to run since DOM is loaded and ready
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var i = 1;

    $('#add').click(function() {
      i++;
      $('#dynamic_field').append('<div id="row' + i + '"><div class="d-flex justify-content-start mt-5 mb-2"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Hapus Field</button></div><div class="row mb-3"><label for="JenisPrestasi" class="col-sm-2 col-form-label">Jenis Prestasi</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="jenis_prestasi'+ i +'" id="jenis_prestasi"><option selected>.:Pilih Jenis Prestasi:.</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div><div class="row mb-3"><label for="TingkatPrestasi" class="col-sm-2 col-form-label">Tingkat Prestasi</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="tingkat_prestasi'+ i +'" id="tingkat_prestasi"><option selected>.:Pilih Tingkat Prestasi:.</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div><div class="row mb-3"><label for="NamaPrestasi" class="col-sm-2 col-form-label">Nama Prestasi</label><div class="col-sm-10"><input type="text" class="form-control" id="nama_prestasi" name="nama_prestasi'+ i +'" placeholder="Nama Prestasi"></div></div><div class="row mb-3"><label for="Tahun" class="col-sm-2 col-form-label">Tahun</label><div class="col-sm-10"><input type="text" class="form-control" id="tahun_prestasi" name="tahun_prestasi'+ i +'" placeholder="Tahun"></div></div><div class="row mb-3"><label for="Penyelenggara" class="col-sm-2 col-form-label">Penyelenggara</label><div class="col-sm-10"><input type="text" class="form-control" id="penyelenggara" name="penyelenggara'+ i +'" placeholder="Penyelenggara"></div></div><div class="row mb-3"><label for="Peringkat" class="col-sm-2 col-form-label">Peringkat</label><div class="col-sm-10"><input type="number" class="form-control" id="peringkat" name="peringkat'+ i +'"></div></div></div></div>');
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      var res = confirm('Are You Sure You Want To Delete This?');
      if (res == true) {
        $('#row' + button_id + '').remove();
        $('#' + button_id + '').remove();
      }
    });

  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var i = 1;

    $('#add_beasiswa').click(function() {
      i++;
      $('#dynamic_field_beasiswa').append('<div id="row' + i + '"><input type="text" name="rowprestasi" value="' + i + '" hidden><div class="d-flex justify-content-start mt-5 mb-2"><button type="button" name="remove_beasiswa" id="' + i + '" class="btn btn-danger btn_remove_beasiswa">Hapus Field</button></div><div class="row mb-3"><label for="JenisBeasiswa" class="col-sm-2 col-form-label">Jenis Beasiswa</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="jenis_beasiswa'+ i +'" id="jenis_beasiswa"><option selected>.:Pilih Jenis Beasiswa:.</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div><div class="row mb-3"><label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label><div class="col-sm-10"><input type="text" class="form-control" id="keterangan" name="keterangan'+ i +'" placeholder="Keterangan"></div></div><div class="row mb-3"><label for="TanggalMulai" class="col-sm-2 col-form-label">Tanggal Mulai</label><div class="col-sm-4"><div class="input-group"><input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_mulai'+ i +'"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div><div class="row mb-3"><label for="TanggalSelesai" class="col-sm-2 col-form-label">Tanggal Selesai</label><div class="col-sm-4"><div class="input-group"><input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_selesai'+ i +'"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div></div></div>');
    });

    $(document).on('click', '.btn_remove_beasiswa', function() {
      var button_id = $(this).attr("id");
      var res = confirm('Are You Sure You Want To Delete This?');
      if (res == true) {
        $('#row' + button_id + '').remove();
        $('#' + button_id + '').remove();
      }
    });

    $('#add_jalur').click(function() {
      i++;
      $('#dynamic_field_jalur').append('<div id="row' + i + '"><input type="text" name="rowbeasiswa" value="' + i + '" hidden><button type="button" name="remove_jalur" id="' + i + '" class="btn btn-danger btn_remove_jalur ms-1">Hapus Field</button><div class="row mb-2"><label for="NamaJalur" class="col-3 col-form-label">Nama Jalur<span class="text-danger">*</span></label><div class="col-9"><input required type="text" class="form-control " id="nama_jalur'+ i +'" name="nama_jalur'+ i + '" placeholder="Nama Jalur" required></div></div><div class="row mb-2"><label for="NamaKuota" class="col-3 col-form-label">Kuota</label><div class="col-9"><input required type="number" class="form-control " id="kuota'+ i +'" name="kuota'+ i +'" placeholder="Kuota"></div></div></div></div>');
    });

    $(document).on('click', '.btn_remove_jalur', function() {
      var button_id = $(this).attr("id");
      var res = confirm('Are You Sure You Want To Delete This?');
      if (res == true) {
        $('#row' + button_id + '').remove();
        $('#' + button_id + '').remove();
      }
    });

  });
</script>
<script>
  var date = new Date();

  $(document).ready(function() {

// INITIALIZE DATEPICKER PLUGIN
    $('.datepicker').datepicker({
      clearBtn: true,
      format: "dd/mm/yyyy",
      autoclose: true
    });

    $('.input-daterange').datepicker({
      clearBtn: true,
      format: "dd/mm/yyyy",
      startDate: date,
      autoclose: true
    });
  });
</script>

<script>
  tinymce.init({
    selector: 'textarea#tiny'
  });
</script>
<script>
  function preview() {
    frame.src = URL.createObjectURL(event.target.files[0]);
  }
</script>
<script>
  function bacaGambar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#gambar_load').attr('src', e.target.result);
        $('#gambar_load2').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#bukti_transfer").change(function() {
    bacaGambar(this);
  });
  $("#bukti_transfer2").change(function() {
    bacaGambar(this);
  });
</script>
<script>
  $(document).ready(function() {
    var periode = $('#dashboard_periode').val();
    var action = 'get_pendaftar';
    $.ajax({
      url: "<?php echo base_url('dynamic_dependent/action'); ?>",
      method: "POST",
      data: {
        periode: periode,
        action: action
      },
      dataType: "JSON",
      success: function(data) {
        var label = [];
        var value = [];
        for (var count = 0; count < data.length; count++) {
          label.push(data[count].nama_tahap);
          value.push(data[count].total);
        }

        var ctx = document.getElementById('perda').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: label,
            datasets: [{
              label: 'Jumlah Pendaftar',
              backgroundColor: 'rgb(252, 116, 101)',
              borderColor: 'rgb(255, 255, 255)',
              data: value,
            }]
          },
          options: {
            responsive: true,
            legend: {
              position: 'bottom',
            },
            hover: {
              mode: 'label'
            },
            scales: {
              yAxes: [{
                display: true,
                ticks: {
                  beginAtZero: true,
                  steps: 10,
                  stepValue: 5,
                }
              }]
            },
          }
        });
      }
    });
    $('#dashboard_periode').change(function() {
      var periode = $('#dashboard_periode').val();
      var action = 'get_pendaftar';
      $.ajax({
        url: "<?php echo base_url('dynamic_dependent/action'); ?>",
        method: "POST",
        data: {
          periode: periode,
          action: action
        },
        dataType: "JSON",
        success: function(data) {
          var label = [];
          var value = [];
          for (var count = 0; count < data.length; count++) {
            label.push(data[count].nama_tahap);
            value.push(data[count].total);
          }

          var ctx = document.getElementById('perda').getContext('2d');
          var chart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: label,
              datasets: [{
                label: 'Jumlah Pendaftar',
                backgroundColor: 'rgb(252, 116, 101)',
                borderColor: 'rgb(255, 255, 255)',
                data: value
              }]
            },
            options: {
              responsive: true,
              legend: {
                position: 'bottom',
              },
              hover: {
                mode: 'label'
              },
              scales: {
                yAxes: [{
                  display: true,
                  ticks: {
                    beginAtZero: true,
                    steps: 10,
                    stepValue: 5,
                  }
                }]
              },
            }
          });
        }
      });
    });
  });

</script>
<script>
  $(document).ready(function() {
    $('#provinsi').change(function() {

      var prov_id = $('#provinsi').val();

      var action = 'get_state';

      if (prov_id != '') {
        $.ajax({
          url: "<?php echo base_url('dynamic_dependent/action'); ?>",
          method: "POST",
          data: {

            prov_id: prov_id,
            action: action
          },
          dataType: "JSON",
          success: function(data) {
            var html = '<option value="0">.:Pilih Kabupaten:.</option>';

            for (var count = 0; count < data.length; count++) {

              html += '<option value="' + data[count].city_id + '">' + data[count].city_name + '</option>';

            }

            $('#kabupaten').html(html);
          }
        });
      } else {
        $('#kabupaten').val('');
      }
    });

    $('#kabupaten').change(function() {

      var city_id = $('#kabupaten').val();

      var action = 'get_city';

      if (city_id != '') {
        $.ajax({
          url: "<?php echo base_url('dynamic_dependent/action'); ?>",
          method: "POST",
          data: {
            city_id: city_id,
            action: action
          },
          dataType: "JSON",
          success: function(data) {
            var html = '<option value="">.:Pilih Kecamatan:.</option>';

            for (var count = 0; count < data.length; count++) {
              html += '<option value="' + data[count].dis_id + '">' + data[count].dis_name + '</option>';
            }
            html += '<p>' + city_id + '</p>';

            $('#kecamatan').html(html);
          }
        });
      } else {
        $('#kecamatan').val('');
      }
    });

    $('#kecamatan').change(function() {

      var dis_id = $('#kecamatan').val();

      var action = 'get_district';

      if (dis_id != '') {
        $.ajax({
          url: "<?php echo base_url('dynamic_dependent/action'); ?>",
          method: "POST",
          data: {
            dis_id: dis_id,
            action: action
          },
          dataType: "JSON",
          success: function(data) {
            var html = '<option value="">.:Pilih Kelurahan:.</option>';

            for (var count = 0; count < data.length; count++) {
              html += '<option value="' + data[count].subdis_id + '">' + data[count].subdis_name + '</option>';
            }

            $('#kelurahan').html(html);
          }
        });
      } else {
        $('#kelurahan').val('');
      }

    });

    $('#kelurahan').change(function() {

      var subdis_id = $('#kelurahan').val();

      var postalcode = $('#kode_pos').val();

      var action = 'get_postalcode';

      if (subdis_id != '') {
        $.ajax({
          url: "<?php echo base_url('dynamic_dependent/action'); ?>",
          method: "POST",
          data: {
            subdis_id: subdis_id,
            action: action
          },
          dataType: "JSON",
          success: function(data) {
            var html = '<option value="">.:Pilih Kelurahan:.</option>';

            for (var count = 0; count < data.length; count++) {
              document.getElementById("kode_pos").value = data[count].postal_code;

            }
          }
        });
      } else {
        $('#kode_pos').val('');
      }

    });
  });
</script>
<script>
  window.setTimeout(function() {
    $('#alert').fadeTo(500, 0).slideUp(500, function() {
      $(this).remove();
    });
  }, 3000)
</script>
</html>