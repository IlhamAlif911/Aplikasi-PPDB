<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SMK YPE Kroya | <?= $page?></title>
    <link rel="icon" href="<?= base_url('assets/' . 'Logo-YPE.png'); ?>" type="image/png">
    <meta name="description" content="The small framework with powerful features">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/bootstrap-datepicker.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/custom.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/cdb.min.css') ?>" />
</head>

<body class="bg-white">
    <?= $this->include('User/header') ?>
    <?= $this->include('User/navbar') ?>
    <?= $this->renderSection('content') ?>
    <?= $this->include('User/footer') ?>

    <script defer src="<?= base_url('js/solid.js') ?>" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/e7578f8e4a.js') ?>" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('js/jquery-3.5.1.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?= base_url('js/cdb.min.js') ?>"></script>
    <!-- SmoothScroll Plugin JavaScript-->
    <script src="<?= base_url('js/smoothscroll.min.js') ?>"></script>
    <script>
        const stepper = document.querySelector('#stepper');
        const n = document.querySelector('.n');
        new CDB.Stepper(stepper);
        n.navigate(3);
    </script>
    <script>
        $(document).ready(function() {

            // INITIALIZE DATEPICKER PLUGIN
            $('.datepicker').datepicker({
                clearBtn: true,
                format: "dd/mm/yyyy"
            });

            // FOR DEMO PURPOSE
            $('#reservationDate').on('change', function() {
                var pickedDate = $('input').val();
                $('#pickedDate').html(pickedDate);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var i = 1;

            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div id="rowbtn' + i + '"><div class="d-flex justify-content-start mt-5 mb-2"><button type="button" name="remove" id="btn' + i + '" class="btn btn-danger btn_remove">Hapus Field</button></div><div class="row mb-3"><label for="JenisPrestasi" class="col-sm-2 col-form-label">Jenis Prestasi</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="jenis_prestasi[]" id="jenis_prestasi"><option selected>.:Pilih Jenis Prestasi:.</option><?php if (!empty($jenis_prestasi)) { foreach ($jenis_prestasi as $row) {echo '<option value="' . $row->id . '">' . $row->nama_opsi . '</option>';}}?></select></div></div><div class="row mb-3"><label for="TingkatPrestasi" class="col-sm-2 col-form-label">Tingkat Prestasi</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="tingkat_prestasi[]" id="tingkat_prestasi"><option selected>.:Pilih Tingkat Prestasi:.</option><?php if (!empty($tingkat_prestasi)) { foreach ($tingkat_prestasi as $row) {echo '<option value="' . $row->id . '">' . $row->nama_opsi . '</option>';}}?></select></div></div><div class="row mb-3"><label for="NamaPrestasi" class="col-sm-2 col-form-label">Nama Prestasi</label><div class="col-sm-10"><input type="text" class="form-control" id="nama_prestasi" name="nama_prestasi[]" placeholder="Nama Prestasi"></div></div><div class="row mb-3"><label for="Tahun" class="col-sm-2 col-form-label">Tahun</label><div class="col-sm-10"><input type="text" class="form-control" id="tahun_prestasi" name="tahun_prestasi[]" placeholder="Tahun"></div></div><div class="row mb-3"><label for="Penyelenggara" class="col-sm-2 col-form-label">Penyelenggara</label><div class="col-sm-10"><input type="text" class="form-control" id="penyelenggara" name="penyelenggara[]" placeholder="Penyelenggara"></div></div><div class="row mb-3"><label for="Peringkat" class="col-sm-2 col-form-label">Peringkat</label><div class="col-sm-10"><input type="number" class="form-control" id="peringkat" name="peringkat[]"></div></div></div></div>');
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
        function showForm(){
            var y = document.getElementById("asal_sekolah");
            var z = document.getElementById("asal_sekolah_field");
            var x = document.getElementById("asal_sekolah_check");
            if (x.checked === false) {
                y.disabled = false;
                z.innerHTML ='';
            } else {
                y.disabled = true;
                z.innerHTML ='<label for="AsalSekolah" class="col-sm-2 col-form-label"></label><div class="col-sm-10"><input type="text" class="form-control" name="asal_sekolah" placeholder="Asal Sekolah" value="<?php echo set_value('asal_sekolah') ?>" required></div>';
                
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var i = 1;

            $('#add_beasiswa').click(function() {
                i++;
                $('#dynamic_field_beasiswa').append('<div id="rowbtn' + i + '"><div class="d-flex justify-content-start mt-5 mb-2"><button type="button" name="remove_beasiswa" id="btn' + i + '" class="btn btn-danger btn_remove_beasiswa">Hapus Field</button></div><div class="row mb-3"><label for="JenisBeasiswa" class="col-sm-2 col-form-label">Jenis Beasiswa</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="jenis_beasiswa[]" id="jenis_beasiswa"><option selected>.:Pilih Jenis Beasiswa:.</option><?php if(!empty($jenis_beasiswa)) { foreach ($jenis_beasiswa as $row) {echo '<option value="' . $row->id . '">' . $row->nama_opsi . '</option>';}}?></select></div></div><div class="row mb-3"><label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label><div class="col-sm-10"><input type="text" class="form-control" id="keterangan" name="keterangan[]" placeholder="Keterangan"></div></div><div class="row mb-3"><label for="TanggalMulai" class="col-sm-2 col-form-label">Tanggal Mulai</label><div class="col-sm-4"><div class="input-group"><input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_mulai[]"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div><div class="row mb-3"><label for="TanggalSelesai" class="col-sm-2 col-form-label">Tanggal Selesai</label><div class="col-sm-4"><div class="input-group"><input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_selesai[]"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div></div></div>');
                $('.datepicker').datepicker({
                    clearBtn: true,
                    format: "dd/mm/yyyy"
                });
            });

            $(document).on('click', '.btn_remove_beasiswa', function() {
                var button_id = $(this).attr("id");
                var res = confirm('Are You Sure You Want To Delete This?');
                if (res == true) {
                    $('#row' + button_id + '').remove();
                    $('#' + button_id + '').remove();
                }
            });

            $('#cek_data').click(function() {
                var nama = $('#nama').val();
                var nomor = $('#nomor_pendaftaran').val();

                var action = 'cek_data';

                if (nomor != '') {
                    $.ajax({
                        url: "<?php echo base_url('dynamic_dependent/action'); ?>",
                        method: "POST",
                        data: {
                            nama: nama,
                            nomor: nomor,
                            action: action
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.nama_lengkap == nama) {
                                var html = '<div class="card mt-5 shadow" style="width: 40rem;"><div class="card-body text-center"><p class="card-title h2 pb-3">' + data.nama_lengkap + '</p><p class="">No. Pendaftaran</p><p class="fw-bold">' + nomor + '</p><p class="">Status Pendaftaran</p><p class="fw-bold bg-danger text-white rounded-4 p-2">' + data.status + '</p></div></div>';
                                $('#result_data').html(html);
                            } else {
                                var html = '<h3>Data Tidak Cocok!</h3>';
                                $('#result_data').html(html);
                            }


                        }
                    });
                } else {
                    var html = '<h3>Data Tidak Ditemukan!</h3>';
                    $('#result_data').html(html);
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajax({
                method: "POST",
                url: "<? echo base_url('dynamic_dependent/provinsi'); ?>",
                success: function(hasil_provinsi) {
                    //console.log(hasil_provinsi);
                    $("select[name=asal_sekolah]").html(hasil_provinsi);
                }
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
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 3000)
     </script>
</body>

</html>