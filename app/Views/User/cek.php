<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gumintang Berkah Rahayu</title>
    <meta name="description" content="The small framework with powerful features">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="<?= base_url('css/custom.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/cdb.min.css') ?>" />
</head>

<body class="bg-white">
    <?= $this->include('User/navbar') ?>
    <div class="container-fluid mt-5 mb-4">
        <div class="container">
            <div class="mt-5 mb-5">
                <h2 class="">Cek Data</h2>
                <p>Silakan memasukkan nama lengkap dan nomor pendaftaran pada form yang tersedia untuk mengetahui status pendaftaran anda.</p>
            </div>
            <div height="" class="stepper" id="stepper">
                <div class="steps-container">
                    <div class="steps">
                        <div class="step" icon="fa fa-pencil-alt" id="1">
                            <div class="step-title">
                                <span class="step-number">01</span>
                                <div class="step-text">Isi Data</div>
                            </div>
                        </div>
                        <div class="step" icon="fa fa-list" id="2">
                            <div class="step-title">
                                <span class="step-number">02</span>
                                <div class="step-text">Nilai Rapot</div>
                            </div>
                        </div>
                        <div class="step" icon="fa fa-user" id="3">
                            <div class="step-title">
                                <span class="step-number">03</span>
                                <div class="step-text">Akun</div>
                            </div>
                        </div>
                        <div class="step" icon="fa fa-check" id="4">
                            <div class="step-title">
                                <span class="step-number">04</span>
                                <div class="step-text">Konfirmasi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stepper-content-container">
                    <div class="stepper-content fade-in" stepper-label="1">
                        <div class="card border-1 bg-transparent text-center">
                            <div class="card-body">
                                <h3 class="card-title text-start">Mengisi Formulir</h3>
                                <p class="card-text text-start">Lengkapi data dibawah ini dengan benar dan dapat dipertanggungjawabkan. Data bertanda <span class="text-danger">*</span> wajib diisi.</p>
                                <form action="" class="mt-5">
                                    <div class="">
                                        <div class="d-flex flex-wrap mb-3 justify-content-center">
                                            <div>
                                                <img src="<?= base_url('assets/' . 'Gumintang.png'); ?>" class="card-img-top" style="object-fit: contain; width:150px; height:200px;" alt="Wild Landscape" />
                                                <div class="mb-3">
                                                    <label for="FileFoto" class="form-label">Upload File Foto<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="file" id="file_foto" name="file_foto" required>
                                                    <span class="text-danger"><small>Tipe file : PNG/JPG/JPEG <br> Ukuran maks. : 2MB</small></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-start">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                            Data Pribadi
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body">
                                                            <div class="row mb-3">
                                                                <label for="Nama" class="col-sm-2 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NISN" class="col-sm-2 col-form-label">NISN<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NIK" class="col-sm-2 col-form-label">NIK/No. KITAS<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK/No. KITAS (untuk WNA)" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                                                                </div>
                                                                <label for="TanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <div class="input-group">
                                                                        <input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_lahir" required>
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoAkta" class="col-sm-2 col-form-label">No. Registrasi Akta Lahir<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_akta" name="nomor_akta" placeholder="No. Registrasi Akta Lahir" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="JenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <div class="btn-group mt-2 mb-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="p" value="p" checked>
                                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                                Perempuan
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="ms-3 form-check-input" type="radio" name="jenis_kelamin" id="l" value="l">
                                                                            <label class="ms-2 form-check-label" for="flexRadioDefault2">
                                                                                Laki-Laki
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <label for="Agama" class="col-sm-2 col-form-label">Agama & Kepercayaan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" aria-label="Default select example" name="agama" id="agama" required>
                                                                        <option selected>.:Pilih Agama & Kepercayaan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="Kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="kewarganegaraan" id="kewarganegaraan" required>
                                                                        <option selected>.:Pilih Kewarganegaraan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="BerkebutuhanKhusus" class="col-sm-2 col-form-label">Berkebutuhan Khusus</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-select" aria-label="Default select example" name="berkebutuhan_khusus" id="berkebutuhan_khusus">
                                                                        <option selected>.:Pilih Kebutuhan Khusus:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoKKS" class="col-sm-2 col-form-label">No. KKS</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_kks" name="nomor_kks" placeholder="No. KKS (Kartu Keluarga Sejahtera)">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoKPS/PKH" class="col-sm-2 col-form-label">No. KPS/PKH</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_kps_pkh" name="nomor_kps_pkh" placeholder="No. KPS/PKH">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoKIP" class="col-sm-2 col-form-label">No. KIP</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_kip" name="nomor_kip" placeholder="No. KIP (Kartu Indonesia Pintar)">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NamaKIP" class="col-sm-2 col-form-label">Nama di KIP</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nama_kip" name="nama_kip" placeholder="Nama di KIP">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="AlasanLayakPIP" class="col-sm-2 col-form-label">Alasan Layak PIP</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-select" aria-label="Default select example" name="alasan_layak_pip" id="alasan_layak_pip">
                                                                        <option selected>.:Pilih Alasan Layak PIP:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <h5 class="mt-3 border-top pt-3 text-start">Data Kontak</h5>
                                                            <div class="row mb-3">
                                                                <label for="Alamat" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" aria-label="Default select example" name="provinsi" id="provinsi" required>
                                                                        <option selected>.:Pilih Provinsi:.</option>
                                                                        <?php
                                                                        foreach ($country as $row) {
                                                                            echo '<option value="' . $row["prov_id"] . '">' . $row["prov_name"] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <label for="Kabupaten" class="col-sm-2 col-form-label">Kabupaten<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" aria-label="Default select example" name="kabupaten" id="kabupaten" required>
                                                                        <option selected>.:Pilih Kabupaten:.</option>
                                                                        <?php
                                                                        foreach ($country as $row) {
                                                                            echo '<option value="' . $row["prov_id"] . '">' . $row["prov_name"] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" aria-label="Default select example" name="kecamatan" id="kecamatan" required>
                                                                        <option selected>.:Pilih Kecamatan:.</option>
                                                                        <?php
                                                                        foreach ($country as $row) {
                                                                            echo '<option value="' . $row["prov_id"] . '">' . $row["prov_name"] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" aria-label="Default select example" name="kelurahan" id="kelurahan" required>
                                                                        <option selected>.:Pilih Kelurahan:.</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="KodePos" class="col-sm-2 col-form-label">Kode Pos<span class="text-danger">*</span></label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos" required>
                                                                </div>
                                                                <label for="RT" class="col-sm-1 col-form-label">RT<span class="text-danger">*</span></label>
                                                                <div class="col-sm-1">
                                                                    <input type="text" class="form-control" id="rt" name="rt" placeholder="RT" required>
                                                                </div>
                                                                <label for="RW" class="col-sm-1 col-form-label">RW<span class="text-danger">*</span></label>
                                                                <div class="col-sm-1">
                                                                    <input type="text" class="form-control" id="rw" name="rw" placeholder="RW" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="TempatTinggal" class="col-sm-2 col-form-label">Tempat Tinggal<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" aria-label="Default select example" name="tempat_tinggal" id="tempat_tinggal" required>
                                                                        <option selected>.:Pilih Tempat Tinggal:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                                <label for="ModaTransportasi" class="col-sm-2 col-form-label">Moda Transportasi<span class="text-danger">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" aria-label="Default select example" name="moda_transportasi" id="moda_transportasi" required>
                                                                        <option selected>.:Pilih Moda Transportasi:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoHP" class="col-sm-2 col-form-label">No. HP</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="No. HP" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="Email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                                            Data Orang Tua
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                                                        <div class="accordion-body">
                                                            <h5 class="mt-3 pt-3 text-start">Data Ayah</h5>
                                                            <div class="row mb-3">
                                                                <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NIKAyah" class="col-sm-2 col-form-label">NIK<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nik_ayah" name="nik_ayah" placeholder="NIK">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="TahunLahir" class="col-sm-2 col-form-label">Tahun Lahir<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="tahun_lahir_ayah" name="tahun_lahir_ayah" placeholder="Tahun Lahir">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="PendidikanAyah" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="pendidikan_ayah" id="pendidikan_ayah">
                                                                        <option selected>.:Pilih Pendidikan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="PekerjaanAyah" class="col-sm-2 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="pekerjaan_ayah" id="pekerjaan_ayah">
                                                                        <option selected>.:Pilih Pekerjaan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="PenghasilanAyah" class="col-sm-2 col-form-label">Penghasilan Bulanan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="penghasilan_ayah" id="penghasilan_ayah">
                                                                        <option selected>.:Pilih Penghasilan Bulanan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="BerkebutuhanKhususAyah" class="col-sm-2 col-form-label">Berkebutuhan Khusus</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="berkebutuhan_khusus_ayah" id="berkebutuhan_khusus_ayah">
                                                                        <option selected>.:Pilih Kebutuhan Khusus:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" name="alamat_ayah" id="alamat-ayah" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoHPAyah" class="col-sm-2 col-form-label">No. HP</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_hp_ayah" name="nomor_hp_ayah" placeholder="No. HP">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="EmailAyah" class="col-sm-2 col-form-label">Email</label>
                                                                <div class="col-sm-10">
                                                                    <input type="email" class="form-control" id="email_ayah" name="email_ayah" placeholder="name@example.com">
                                                                </div>
                                                            </div>
                                                            <h5 class="mt-3 border-top pt-3 text-start">Data Ibu</h5>
                                                            <div class="row mb-3">
                                                                <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NIKIbu" class="col-sm-2 col-form-label">NIK<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nik_ibu" name="nik_ibu" placeholder="NIK">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="TahunLahirIbu" class="col-sm-2 col-form-label">Tahun Lahir<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="tahun_lahir_ibu" name="tahun_lahir_ibu" placeholder="Tahun Lahir">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="PendidikanIbu" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="pendidikan_ibu" id="pendidikan_ibu">
                                                                        <option selected>.:Pilih Pendidikan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="pekerjaan_ibu" id="pekerjaan_ibu">
                                                                        <option selected>.:Pilih Pekerjaan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="PenghasilanIbu" class="col-sm-2 col-form-label">Penghasilan Bulanan<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="penghasilan_ibu" id="penghasilan_ibu">
                                                                        <option selected>.:Pilih Penghasilan Bulanan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="BerkebutuhanKhususIbu" class="col-sm-2 col-form-label">Berkebutuhan Khusus</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="berkebutuhan_khusus_ibu" id="berkebutuhan_khusus_ibu">
                                                                        <option selected>.:Pilih Kebutuhan Khusus:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" name="alamat_ibu" id="alamat_ibu" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoHPIbu" class="col-sm-2 col-form-label">No. HP</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_hp_ibu" name="nomor_hp_ibu" placeholder="No. HP">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="EmailIbu" class="col-sm-2 col-form-label">Email</label>
                                                                <div class="col-sm-10">
                                                                    <input type="email" class="form-control" id="email_ibu" name="email_ibu" placeholder="name@example.com">
                                                                </div>
                                                            </div>
                                                            <h5 class="mt-3 border-top pt-3 text-start">Data Wali</h5>
                                                            <div class="row mb-3">
                                                                <label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Nama Wali">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NIKWali" class="col-sm-2 col-form-label">NIK</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nik_wali" name="nik_wali" placeholder="NIK">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="TahunLahirWali" class="col-sm-2 col-form-label">Tahun Lahir</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="tahun_lahir_wali" name="tahun_lahir_wali" placeholder="Tahun Lahir">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="PendidikanWali" class="col-sm-2 col-form-label">Pendidikan</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="pendidikan_wali" id="pendidikan_wali">
                                                                        <option selected>.:Pilih Pendidikan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="pekerjaan_wali" id="pekerjaan_wali">
                                                                        <option selected>.:Pilih Pekerjaan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="PenghasilanWali" class="col-sm-2 col-form-label">Penghasilan Bulanan</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="penghasilan_wali" id="penghasilan_wali">
                                                                        <option selected>.:Pilih Penghasilan Bulanan:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="BerkebutuhanKhususWali" class="col-sm-2 col-form-label">Berkebutuhan Khusus</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" aria-label="Default select example" name="berkebutuhan_khusus_wali" id="berkebutuhan_khusus_wali">
                                                                        <option selected>.:Tidak Berkebutuhan Khusus:.</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" name="alamat_wali" id="alamat_wali" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoHPWali" class="col-sm-2 col-form-label">No. HP</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_hp_wali" name="nomor_hp_wali" placeholder="No. HP">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="EmailWali" class="col-sm-2 col-form-label">Email</label>
                                                                <div class="col-sm-10">
                                                                    <input type="email" class="form-control" id="email_wali" name="email_wali" placeholder="name@example.com">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                                                            Data Rincian
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
                                                        <div class="accordion-body">
                                                            <h5 class="mt-3 pt-3 text-start">Data Priodik</h5>
                                                            <div class="row mb-3">
                                                                <label for="TinggiBadan" class="col-sm-2 col-form-label">Tinggi Badan</label>
                                                                <div class="col-sm-2">
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" placeholder="">
                                                                        <div class="input-group-text">cm</div>
                                                                    </div>
                                                                </div>
                                                                <label for="JarakTinggal" class="col-sm-2 col-form-label">Jarak Tempat Tinggal Ke Sekolah<span class="text-danger">*</span></label>
                                                                <div class="col-sm-2">
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="jarak_tinggal" name="jarak_tinggal" placeholder="" required>
                                                                        <div class="input-group-text">m</div>
                                                                    </div>
                                                                </div>
                                                                <label for="AnakKe" class="col-sm-2 col-form-label">Anak Ke-<span class="text-danger">*</span></label>
                                                                <div class="col-sm-2">
                                                                    <input type="number" class="form-control" id="anak_ke" name="anak_ke" placeholder="" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="BeratBadan" class="col-sm-2 col-form-label">Berat Badan</label>
                                                                <div class="col-sm-2">
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="berat_badan" name="berat_badan" placeholder="">
                                                                        <div class="input-group-text">kg</div>
                                                                    </div>
                                                                </div>
                                                                <label for="WaktuTempuh" class="col-sm-2 col-form-label">Waktu Tempuh Ke Sekolah<span class="text-danger">*</span></label>
                                                                <div class="col-sm-2">
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="waktu_tempuh" name="waktu_tempuh" placeholder="" required>
                                                                        <div class="input-group-text">jam</div>
                                                                    </div>
                                                                </div>
                                                                <label for="JumlahSaudara" class="col-sm-2 col-form-label">Jumlah Saudara Kandung<span class="text-danger">*</span></label>
                                                                <div class="col-sm-2">
                                                                    <input type="number" class="form-control" id="jumlah_saudara" name="jumlah_saudara" placeholder="" required>
                                                                </div>
                                                            </div>
                                                            <h5 class="mt-3 border-top pt-3 text-start">Data Registrasi</h5>
                                                            <div class="row mb-3">
                                                                <label for="AsalSekolah" class="col-sm-2 col-form-label">Asal Sekolah<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="Asal Sekolah" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoSeriIjazah" class="col-sm-2 col-form-label">No. Seri Ijazah<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_seri_ijazah" name="nomor_seri_ijazah" placeholder="No. Seri Ijazah" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="NoSeriSKHUS" class="col-sm-2 col-form-label">No. Seri SKHUS<span class="text-danger">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="nomor_seri_skhus" name="nomor_seri_skhus" placeholder="No. Seri SKHUS" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <div class="d-flex align-items-center m-3 border-start border-end border-top border-bottom p-3">
                                                        <span class="h6 me-3">Selanjutnya</span>
                                                        <div class="step btn btn-primary" icon="fa fa-arrow-right" id="2"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="stepper-content fade-in" stepper-label="2">
                        <div class="card border-1 bg-transparent">
                            <div class="card-body">
                                <h3 class="card-title">Nilai Rapot</h3>
                                <table class="table">
                                    <thead>
                                        <th>No.</th>
                                        <th>Jenis Nilai</th>
                                        <th>Matematika<span class="text-danger">*</span></th>
                                        <th>IPA<span class="text-danger">*</span></th>
                                        <th>Bahasa Inggris<span class="text-danger">*</span></th>
                                        <th>Bahasa Indonesia<span class="text-danger">*</span></th>
                                        <th>Dokumen<span class="text-danger">*</span></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td width="200px">Semester 5</td>
                                            <td>
                                                <input type="text" class="form-control" value="98" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="99" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="98" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="99" required>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td width="200px">Semester 6</td>
                                            <td>
                                                <input type="text" class="form-control" value="98">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="99">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="98">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="99">
                                            </td>
                                            <td>
                                                <input type="file" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td width="200px">Ujian Sekolah</td>
                                            <td>
                                                <input type="text" class="form-control" value="98">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="99">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="98">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="99">
                                            </td>
                                            <td>
                                                <input type="file" class="form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="d-flex align-items-center m-3 border-start border-end border-top border-bottom p-3">
                                    <div class="step btn btn-primary" icon="fa fa-arrow-left" id="1"></div>
                                    <span class="h6 me-3">Sebelumnya</span>
                                </div>
                                <div class="d-flex align-items-center m-3 border-start border-end border-top border-bottom p-3">
                                    <span class="h6 me-3">Selanjutnya</span>
                                    <div class="step btn btn-primary" icon="fa fa-arrow-right" id="3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="stepper-content fade-in" stepper-label="3">
                        <div class="card border-1 bg-transparent">
                            <div class="card-body">
                                <h3 class="card-title">Akun</h3>
                                <div class="row mb-3">
                                    <label for="NomorPendaftaran" class="col-sm-2 col-form-label">Nomor Pendaftaran</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="nomor_pendaftaran" name="nomor_pendaftaran" class="border-0 form-control fw-bold" value="1234567890" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Password" class="col-sm-2 col-form-label">Password<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="KonfirmasiPassword" class="col-sm-2 col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="password" id="konf_password" name="konf_password" class="form-control" placeholder="Konfirmasi Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="d-flex align-items-center m-3 border-start border-end border-top border-bottom p-3">
                                    <div class="step btn btn-primary" icon="fa fa-arrow-left" id="2"></div>
                                    <span class="h6 me-3">Sebelumnya</span>
                                </div>
                                <div class="d-flex align-items-center m-3 border-start border-end border-top border-bottom p-3">
                                    <span class="h6 me-3">Selanjutnya</span>
                                    <div class="step btn btn-primary" icon="fa fa-arrow-right" id="4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="stepper-content fade-in" stepper-label="4">
                        <div class="card border-1 bg-transparent">
                            <div class="card-body">
                                <h3 class="card-title">Konfirmasi</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="cek" name="konfirmasi" id="konfirmasi" required>
                                    <label class="form-check-label" for="konfirmasi">
                                        <span class="text-danger">*</span>Dengan ini saya menyatakan dengan sesungguhnya bahwa semua informasi yang disampaikan dalam seluruh dokumen serta lampiran-lampirannya ini adalah benar dan kesatuan yang tidak dapat dipisahkan. Apabila diketemukan dan/atau dibuktikan adanya penipuan/pemalsuan atas informasi yang kami sampaikan, maka kami bersedia dikenakan dan menerima penerapan sanksi.
                                    </label>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary btn-lg col-12" type="submit" id="submit" name="submit">Submit Data</button>
                                </div>
                                </form>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="d-flex align-items-center m-3 border-start border-end border-top border-bottom p-3">
                                    <div class="step btn btn-primary" icon="fa fa-arrow-left" id="3"></div>
                                    <span class="h6 me-3">Sebelumnya</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('footer') ?>

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e7578f8e4a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/cdb.min.js"></script>
    <script src="<?php echo base_url('js/popper.min.js'); ?>"></script>
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
                $('#dynamic_field').append('<div id="rowbtn' + i + '"><div class="d-flex justify-content-start mt-5 mb-2"><button type="button" name="remove" id="btn' + i + '" class="btn btn-danger btn_remove">Hapus Field</button></div><div class="row mb-3"><label for="JenisPrestasi" class="col-sm-2 col-form-label">Jenis Prestasi</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="jenis_prestasi[]" id="jenis_prestasi"><option selected>.:Pilih Jenis Prestasi:.</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div><div class="row mb-3"><label for="TingkatPrestasi" class="col-sm-2 col-form-label">Tingkat Prestasi</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="tingkat_prestasi[]" id="tingkat_prestasi"><option selected>.:Pilih Tingkat Prestasi:.</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div><div class="row mb-3"><label for="NamaPrestasi" class="col-sm-2 col-form-label">Nama Prestasi</label><div class="col-sm-10"><input type="text" class="form-control" id="nama_prestasi" name="nama_prestasi[]" placeholder="Nama Prestasi"></div></div><div class="row mb-3"><label for="Tahun" class="col-sm-2 col-form-label">Tahun</label><div class="col-sm-10"><input type="text" class="form-control" id="tahun_prestasi" name="tahun_prestasi[]" placeholder="Tahun"></div></div><div class="row mb-3"><label for="Penyelenggara" class="col-sm-2 col-form-label">Penyelenggara</label><div class="col-sm-10"><input type="text" class="form-control" id="penyelenggara" name="penyelenggara[]" placeholder="Penyelenggara"></div></div><div class="row mb-3"><label for="Peringkat" class="col-sm-2 col-form-label">Peringkat</label><div class="col-sm-10"><input type="number" class="form-control" id="peringkat" name="peringkat[]"></div></div></div></div>');
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
                $('#dynamic_field_beasiswa').append('<div id="rowbtn' + i + '"><div class="d-flex justify-content-start mt-5 mb-2"><button type="button" name="remove_beasiswa" id="btn' + i + '" class="btn btn-danger btn_remove_beasiswa">Hapus Field</button></div><div class="row mb-3"><label for="JenisBeasiswa" class="col-sm-2 col-form-label">Jenis Beasiswa</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="jenis_beasiswa[]" id="jenis_beasiswa"><option selected>.:Pilih Jenis Beasiswa:.</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div><div class="row mb-3"><label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label><div class="col-sm-10"><input type="text" class="form-control" id="keterangan" name="keterangan[]" placeholder="Keterangan"></div></div><div class="row mb-3"><label for="TanggalMulai" class="col-sm-2 col-form-label">Tanggal Mulai</label><div class="col-sm-4"><div class="input-group"><input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_mulai[]"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div><div class="row mb-3"><label for="TanggalSelesai" class="col-sm-2 col-form-label">Tanggal Selesai</label><div class="col-sm-4"><div class="input-group"><input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_selesai[]"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div></div></div>');
            });

            $(document).on('click', '.btn_remove_beasiswa', function() {
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
                    $('#kabupaten').val('0');
                }
                $('#kecamatan').val('0');
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
                            var html = '<option value="0">.:Pilih Kecamatan:.</option>';

                            for (var count = 0; count < data.length; count++) {
                                html += '<option value="' + data[count].dis_id + '">' + data[count].dis_name + '</option>';
                            }
                            html += '<p>' + city_id + '</p>';

                            $('#kecamatan').html(html);
                        }
                    });
                } else {
                    $('#kecamatan').val('0');
                }
                $('#kelurahan').val('0');

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
                            var html = '<option value="0">.:Pilih Kelurahan:.</option>';

                            for (var count = 0; count < data.length; count++) {
                                html += '<option value="' + data[count].subdis_id + '">' + data[count].subdis_name + '</option>';
                            }

                            $('#kelurahan').html(html);
                        }
                    });
                } else {
                    $('#kelurahan').val('0');
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
                            var html = '<option value="0">.:Pilih Kelurahan:.</option>';

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
</body>

</html>