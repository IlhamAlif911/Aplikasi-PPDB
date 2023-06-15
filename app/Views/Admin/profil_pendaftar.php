<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<div class="container border-0 pt-4 pb-4 ps-0 pe-0">
    <div class="pb-3">
        <h3 class="border-bottom pb-3">Profil Pendaftar</h3>
    </div>
    <table class="table table-bordered table-striped">
        <tr class="">
            <td class="text-center">
                <label for="Periode" class="fw-bold form-label">Periode</label>
            </td>
            <td>
                <input type="text" class="form-control border-0" id="periode" name="periode" value="Periode" readonly>
            </td>
        </tr>
        <tr class="">
            <td class="text-center">
                <label for="Tahap" class="fw-bold form-label">Tahap</label>
            </td>
            <td>
                <input type="text" class="form-control border-0" id="tahap" name="tahap" value="Tahap" readonly>
            </td>
        </tr>
        <tr class="">
            <td class="text-center">
                <label for="Jalur" class="fw-bold form-label">Jalur</label>
            </td>
            <td>
                <input type="text" class="form-control border-0" id="jalur" name="jalur" value="Jalur" readonly>
            </td>
        </tr>
    </table>
    <div class="d-flex flex-wrap mb-3 justify-content-center">
        <div class="photo">
            <img src="<?= base_url('assets/' . 'Gumintang.png'); ?>" class="card-img-top img-card-jurusan" style="object-fit: contain; height:400px;" alt="Wild Landscape" />
        </div>
        <div class="form">
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
                                <label for="Nama" class="fw-bold col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="nama_lengkap" name="nama_lengkap" value="Nama Lengkap" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="NISN" class="fw-bold col-sm-2 col-form-label">NISN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="border-0 form-control" id="nisn" name="nisn" value="NISN" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="NIK" class="col-sm-2 col-form-label fw-bold">NIK/No. KITAS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="nik" name="nik" value="NIK/No. KITAS (untuk WNA)" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="TempatLahir" class="col-sm-2 col-form-label fw-bold">Tempat Lahir</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control border-0" id="tempat_lahir" name="tempat_lahir" value="Tempat Lahir" readonly>
                                </div>
                                <label for="TanggalLahir" class="col-sm-2 col-form-label fw-bold">Tanggal Lahir</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control mb-0 border-0" id="autoSizingInputGroup" name="tanggal_lahir" value="2 Agustus" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="NoAkta" class="col-sm-2 col-form-label fw-bold">No. Registrasi Akta Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control border-0" id="nomor_akta" name="nomor_akta" value="No. Registrasi Akta Lahir" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="JenisKelamin" class="col-sm-2 col-form-label fw-bold">Jenis Kelamin</label>
                                <div class="col-sm-4">
                                    <div class="btn-group mt-2 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="p" value="p" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Perempuan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="ms-3 form-check-input" type="radio" name="jenis_kelamin" id="l" value="l" disabled>
                                            <label class="ms-2 form-check-label" for="flexRadioDefault2">
                                                Laki-Laki
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <label for="Agama" class="col-sm-2 col-form-label fw-bold">Agama & Kepercayaan</label>
                                <div class="col-sm-4">
                                    <select class="form-control border-0" aria-label="Default select example" name="agama" id="agama">
                                        <option selected>.:Pilih Agama & Kepercayaan:.</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="Kewarganegaraan" class="col-sm-2 col-form-label fw-bold">Kewarganegaraan</label>
                                <div class="col-sm-10">
                                    <select class="form-control border-0" aria-label="Default select example" name="kewarganegaraan" id="kewarganegaraan">
                                        <option selected>.:Pilih Kewarganegaraan:.</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="BerkebutuhanKhusus" class="fw-bold col-sm-2 col-form-label">Berkebutuhan Khusus</label>
                                <div class="col-sm-6">
                                    <select class="form-control border-0" aria-label="Default select example" name="berkebutuhan_khusus" id="berkebutuhan_khusus">
                                        <option selected>.:Pilih Kebutuhan Khusus:.</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <h5 class="mt-3 border-top pt-3">Data Kontak</h5>
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
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <label for="Kabupaten" class="col-sm-2 col-form-label">Kabupaten<span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <select class="form-select" aria-label="Default select example" name="kabupaten" id="kebupaten" required>
                                        <option selected>.:Pilih Kabupaten:.</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan<span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <select class="form-select" aria-label="Default select example" name="kecamatan" id="kecamatan" required>
                                        <option selected>.:Pilih Kecamatan:.</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan<span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <select class="form-select" aria-label="Default select example" name="kelurahan" id="kelurahan" required>
                                        <option selected>.:Pilih Kelurahan:.</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
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
                                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="No. HP">
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
                            <h4 class="mt-3">Data Orang Tua</h4>
                            <h5 class="mt-3 border-top pt-3">Data Ayah</h5>
                            <div class="row mb-3">
                                <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="NIKAyah" class="col-sm-2 col-form-label">NIK<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nik_ayah" name="nik_ayah" placeholder="NIK" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="TahunLahir" class="col-sm-2 col-form-label">Tahun Lahir<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tahun_lahir_ayah" name="tahun_lahir_ayah" placeholder="Tahun Lahir" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="PendidikanAyah" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="pendidikan_ayah" id="pendidikan_ayah" required>
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
                                    <select class="form-select" aria-label="Default select example" name="pekerjaan_ayah" id="pekerjaan_ayah" required>
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
                                    <select class="form-select" aria-label="Default select example" name="penghasilan_ayah" id="penghasilan_ayah" required>
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
                                    <textarea class="form-control" name="alamat_ayah" id="alamat-ayah" rows="3" required></textarea>
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
                            <h5 class="mt-3 border-top pt-3">Data Ibu</h5>
                            <div class="row mb-3">
                                <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="NIKIbu" class="col-sm-2 col-form-label">NIK<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nik_ibu" name="nik_ibu" placeholder="NIK" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="TahunLahirIbu" class="col-sm-2 col-form-label">Tahun Lahir<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tahun_lahir_ibu" name="tahun_lahir_ibu" placeholder="Tahun Lahir" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="PendidikanIbu" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="pendidikan_ibu" id="pendidikan_ibu" required>
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
                                    <select class="form-select" aria-label="Default select example" name="pekerjaan_ibu" id="pekerjaan_ibu" required>
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
                                    <select class="form-select" aria-label="Default select example" name="penghasilan_ibu" id="penghasilan_ibu" required>
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
                                    <textarea class="form-control" name="alamat_ibu" id="alamat_ibu" rows="3" required></textarea>
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
                            <h5 class="mt-3 border-top pt-3">Data Wali</h5>
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
                            <h4 class="mt-3">Data Rincian</h4>
                            <h5 class="mt-3 border-top pt-3">Data Priodik</h5>
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
                            <h5 class="mt-3 border-top pt-3">Data Registrasi</h5>
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
                            <h5 class="mt-3 border-top pt-3">Data Prestasi</h5>
                            <div id="dynamic_field">
                                <div class="row mb-3">
                                    <label for="JenisPrestasi" class="col-sm-2 col-form-label">Jenis Prestasi</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="jenis_prestasi[]" id="jenis_prestasi">
                                            <option selected>.:Pilih Jenis Prestasi:.</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="TingkatPrestasi" class="col-sm-2 col-form-label">Tingkat Prestasi</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="tingkat_prestasi[]" id="tingkat_prestasi">
                                            <option selected>.:Pilih Tingkat Prestasi:.</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="NamaPrestasi" class="col-sm-2 col-form-label">Nama Prestasi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_prestasi" name="nama_prestasi[]" placeholder="Nama Prestasi">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Tahun" class="col-sm-2 col-form-label">Tahun</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tahun_prestasi" name="tahun_prestasi[]" placeholder="Tahun">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Penyelenggara" class="col-sm-2 col-form-label">Penyelenggara</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="penyelenggara" name="penyelenggara[]" placeholder="Penyelenggara">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Peringkat" class="col-sm-2 col-form-label">Peringkat</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="peringkat" name="peringkat[]">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" name="add" id="add" class="btn btn-success">Tambah Field</button>
                            </div>
                            <h5 class="mt-3 border-top pt-3">Data Beasiswa</h5>
                            <div id="dynamic_field_beasiswa">
                                <div class="row mb-3">
                                    <label for="JenisBeasiswa" class="col-sm-2 col-form-label">Jenis Beasiswa</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="jenis_beasiswa[]" id="jenis_beasiswa">
                                            <option selected>.:Pilih Jenis Beasiswa:.</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan[]" placeholder="Keterangan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="TanggalMulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_mulai[]">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="TanggalSelesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_selesai[]">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" name="add_beasiswa" id="add_beasiswa" class="btn btn-success">Tambah Field</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-3 pe-0">
                <button type="submit" name="submit" id="submit" value="submit" class="btn btn-primary mt-3">Simpan</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>