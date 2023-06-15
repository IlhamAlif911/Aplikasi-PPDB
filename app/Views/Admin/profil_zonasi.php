<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<div class="container border-0 pt-4 pb-4 ps-0">
  <div class="pb-3">
    <h3 class="border-bottom pb-3">Daftar Ulang Siswa</h3>
  </div>
  <?php if (session()->has('error')) : ?>
  <ul id="alert" class="alert alert-danger list-unstyled">
    <li><?= session('error') ?></li>
  </ul>
<?php elseif (session()->has('alert')) : ?>
<ul id="alert" class="alert alert-success list-unstyled">
  <li><?= session('alert') ?></li>
</ul>
<?php endif ?>
<?php if ($stat1->id != $pendaftar->status_penerimaan) { ?>
  <?php if ($stat2->id != $pendaftar->status_penerimaan) { ?>
    <?php if ($stat3->id != $pendaftar->status_penerimaan) { ?>
      <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/update-zonasi/<?= $pendaftar->id_ref ?>">
    <div>
      <?php if ($pendaftar->foto == '') { ?>
        <img id="frame" src="<?= base_url('assets/logo-def.png'); ?>" class="card-img-top" style="object-fit: contain; width:150px; height:200px;" alt="Foto Profil" />
      <?php } else { ?>
        <img id="frame" src="<?= base_url('assets/' . $pendaftar->foto); ?>" class="card-img-top" style="object-fit: contain; width:150px; height:200px;" alt="Foto Profil" />
      <?php }
       ?>
      
      <div class="mb-3">
        <label for="FileFoto" class="form-label">Upload File Foto</label>
        <input class="form-control" type="file" id="file_foto" name="file_foto" onchange="preview()">
        <span class="text-danger"><small>Tipe file : PNG/JPG/JPEG <br> Ukuran maks. : 2MB</small></span>
      </div>
    </div>

    <?php if ($pendaftar->type_registration == '1') { ?>
      <h4>Data Pribadi</h4>
      <div class="row mb-3">
        <label for="Nama" class="col-sm-2 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $pendaftar->nama_lengkap ?>" maxlength="255" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NISN" class="col-sm-2 col-form-label">NISN<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $pendaftar->nisn ?>" maxlength="10" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NIK" class="col-sm-2 col-form-label">NIK/No. KITAS<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nik" name="nik" value="<?= $pendaftar->nik ?>" maxlength="16" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $pendaftar->tempat_lahir ?>" maxlength="50" required>
        </div>
        <label for="TanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <div class="input-group">
            <input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_lahir" value="<?php $pecah = explode('-', $pendaftar->tanggal_lahir); $tanggal_lahir = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
            echo $tanggal_lahir; ?>" required>
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label for="JenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <div class="btn-group mt-2 mb-2">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_kelamin" id="p" value="p" <?php echo ($pendaftar->jenis_kelamin == 'p') ? 'checked' : ''; ?>>
              <label class="form-check-label" for="flexRadioDefault1">
                Perempuan
              </label>
            </div>
            <div class="form-check">
              <input class="ms-3 form-check-input" type="radio" name="jenis_kelamin" id="l" value="l" <?php echo ($pendaftar->jenis_kelamin == 'l') ? 'checked' : ''; ?>>
              <label class="ms-2 form-check-label" for="flexRadioDefault2">
                Laki-Laki
              </label>
            </div>
          </div>
        </div>
        <label for="Agama" class="col-sm-2 col-form-label">Agama & Kepercayaan<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="agama" id="agama" required>
            <option selected value="">.:Pilih Agama & Kepercayaan:.</option>
            <?php
            foreach ($agama as $row) {
              $stat = ($pendaftar->agama == $row->id) ? 'selected' : '';
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <label for="BerkebutuhanKhusus" class="col-sm-2 col-form-label">Berkebutuhan Khusus</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="berkebutuhan_khusus" id="berkebutuhan_khusus">
            <option selected value="">.:Pilih Kebutuhan Khusus:.</option>
            <?php
            foreach ($berkebutuhan_khusus as $row) {
              $stat = ($pendaftar->berkebutuhan_khusus == $row->id) ? 'selected' : '';
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <h5 class="mt-3 border-top pt-3 text-start">Data Kontak</h5>
      <div class="row mb-3">
        <label for="Alamat" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <textarea class="form-control" name="alamat" id="alamat" rows="3" required><?= $pendaftar->alamat ?></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="provinsi" id="provinsi" required>
            <option selected value="">.:Pilih Provinsi:.</option>
            <?php
            foreach ($country as $row) {
              $stat = ($pendaftar->provinsi == $row['prov_id']) ? 'selected' : '';
              echo '<option value="' . $row['prov_id'] . '" ' . $stat . '>' . $row['prov_name'] . '</option>';
            }
            ?>
          </select>
        </div>
        <label for="Kabupaten" class="col-sm-2 col-form-label">Kabupaten<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="kabupaten" id="kabupaten" required>
            <option selected value="">.:Pilih Kabupaten:.</option>
            <?php
            echo '<option value="' . $city['city_id'] . '" selected >' . $city['city_name'] . '</option>';
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="kecamatan" id="kecamatan" required>
            <option selected value="">.:Pilih Kecamatan:.</option>
            <?php
            echo '<option value="' . $district['dis_id'] . '" selected >' . $district['dis_name'] . '</option>';
            ?>
          </select>
        </div>
        <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="kelurahan" id="kelurahan" required>
            <option selected value="">.:Pilih Kelurahan:.</option>
            <?php
            echo '<option value="' . $subdistrict['subdis_id'] . '" selected>' . $subdistrict['subdis_name'] . '</option>';
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="KodePos" class="col-sm-2 col-form-label">Kode Pos<span class="text-danger">*</span></label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?php if (!empty($postalcode)) echo $postalcode['postal_id']; ?>" readonly>
        </div>
        <label for="RT" class="col-sm-1 col-form-label">RT<span class="text-danger">*</span></label>
        <div class="col-sm-1">
          <input type="text" class="form-control" id="rt" name="rt" value="<?= $pendaftar->rt ?>" maxlength="5" required>
        </div>
        <label for="RW" class="col-sm-1 col-form-label">RW<span class="text-danger">*</span></label>
        <div class="col-sm-1">
          <input type="text" class="form-control" id="rw" name="rw" value="<?= $pendaftar->rw ?>" maxlength="5" required>
        </div>
      </div>

      <div class="row mb-3">
        <label for="NoHP" class="col-sm-2 col-form-label">No. HP</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?= $pendaftar->nomor_hp ?>" maxlength="20">
        </div>
      </div>
      <div class="row mb-3">
        <label for="Email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="email" value="<?= $pendaftar->email ?>" maxlength="50" disabled>
        </div>
      </div>
      <h4 class="mt-3">Data Orang Tua</h4>
      <h5 class="mt-3 pt-3 text-start">Data Ayah</h5>
      <div class="text-start fst-italic mb-1 text-danger">
        <span>*kosongkan jika hanya memiliki wali*</span>
      </div>
      <div class="row mb-3">
        <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?php if (!empty($ayah->nama)) echo $ayah->nama ?>" maxlength="255">
        </div>
      </div>

      <div class="row mb-3">
        <label for="PendidikanAyah" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pendidikan_ayah" id="pendidikan_ayah">
            <option selected value="">.:Pilih Pendidikan:.</option>
            <?php
            foreach ($pendidikan as $row) {
              if (!empty($ayah)) {
                $stat = ($ayah->pendidikan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="PekerjaanAyah" class="col-sm-2 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pekerjaan_ayah" id="pekerjaan_ayah">
            <option selected value="">.:Pilih Pekerjaan:.</option>
            <?php
            foreach ($pekerjaan as $row) {
              if (!empty($ayah)) {
                $stat = ($ayah->pekerjaan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <textarea class="form-control" name="alamat_ayah" id="alamat-ayah" rows="3" maxlength="100"><?php if (!empty($ayah->alamat)) echo $ayah->alamat ?></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NoHPAyah" class="col-sm-2 col-form-label">No. HP</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nomor_hp_ayah" name="nomor_hp_ayah" value="<?php if (!empty($ayah->nomor_hp)) echo $ayah->nomor_hp ?>" maxlength="15">
        </div>
      </div>

      <h5 class="mt-3 border-top pt-3 text-start">Data Ibu</h5>
      <div class="text-start fst-italic mb-1 text-danger">
        <span>*kosongkan jika hanya memiliki wali*</span>
      </div>
      <div class="row mb-3">
        <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?php if (!empty($ibu->nama)) echo $ibu->nama ?>" maxlength="255">
        </div>
      </div>
      <div class="row mb-3">
        <label for="PendidikanIbu" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pendidikan_ibu" id="pendidikan_ibu">
            <option selected value="">.:Pilih Pendidikan:.</option>
            <?php
            foreach ($pendidikan as $row) {
              if (!empty($ibu)) {
                $stat = ($ibu->pendidikan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pekerjaan_ibu" id="pekerjaan_ibu">
            <option selected value="">.:Pilih Pekerjaan:.</option>
            <?php
            foreach ($pekerjaan as $row) {
              if (!empty($ibu)) {
                $stat = ($ibu->pekerjaan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <textarea class="form-control" name="alamat_ibu" id="alamat_ibu" rows="3" maxlength="100"><?php if (!empty($ibu->alamat)) echo $ibu->alamat ?></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NoHPIbu" class="col-sm-2 col-form-label">No. HP</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nomor_hp_ibu" name="nomor_hp_ibu" value="<?php if (!empty($ibu->nomor_hp)) echo $ibu->nomor_hp ?>" maxlength="15">
        </div>
      </div>
      <h5 class="mt-3 border-top pt-3 text-start">Data Wali</h5>
      <div class="text-start fst-italic mb-1 text-danger">
        <span>*kosongkan jika tidak memiliki wali*</span>
      </div>
      <div class="row mb-3">
        <label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?php if (!empty($wali->nama)) echo $wali->nama ?>" maxlength="255">
        </div>
      </div>
      <div class="row mb-3">
        <label for="PendidikanWali" class="col-sm-2 col-form-label">Pendidikan</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pendidikan_wali" id="pendidikan_wali">
            <option selected value="">.:Pilih Pendidikan:.</option>
            <?php
            foreach ($pendidikan as $row) {
              if (!empty($wali)) {
                $stat = ($wali->pendidikan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pekerjaan_wali" id="pekerjaan_wali">
            <option selected value="">.:Pilih Pekerjaan:.</option>
            <?php
            foreach ($pekerjaan as $row) {
              if (!empty($wali)) {
                $stat = ($wali->pekerjaan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="alamat_wali" id="alamat_wali" rows="3" maxlength="100"><?php if (!empty($wali->alamat)) echo $wali->alamat ?></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NoHPWali" class="col-sm-2 col-form-label">No. HP</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nomor_hp_wali" name="nomor_hp_wali" value="<?php if (!empty($wali->nomor_hp)) echo $wali->nomor_hp ?>" maxlength="15">
        </div>
      </div>
      <h5 class="mt-3 border-top pt-3 text-start">Data Registrasi</h5>
      <div class="row mb-3">
        <label for="AsalSekolah" class="col-sm-2 col-form-label">Asal Sekolah<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="<?= $pendaftar->asal_sekolah ?>" maxlength="30" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="Jurusan" class="col-sm-2 col-form-label">Jurusan/Keahlian</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="jurusan" id="jurusan" required>
            <?php
            foreach ($jurusan as $row) { 
              $stat = ($pendaftar->jurusan == $row->id) ? 'selected' : '';
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_jurusan . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
    <?php } else { ?>
      <h4>Data Pribadi</h4>
      <div class="row mb-3">
        <label for="Nama" class="col-sm-2 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $pendaftar->nama_lengkap ?>" maxlength="255" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NISN" class="col-sm-2 col-form-label">NISN<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $pendaftar->nisn ?>" maxlength="10" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NIK" class="col-sm-2 col-form-label">NIK/No. KITAS<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nik" name="nik" value="<?= $pendaftar->nik ?>" maxlength="16" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $pendaftar->tempat_lahir ?>" maxlength="50" required>
        </div>
        <label for="TanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <div class="input-group">
            <input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_lahir" value="<?php $pecah = explode('-', $pendaftar->tanggal_lahir); $tanggal_lahir = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
            echo $tanggal_lahir; ?>" required>
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label for="JenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <div class="btn-group mt-2 mb-2">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_kelamin" id="p" value="p" <?php echo ($pendaftar->jenis_kelamin == 'p') ? 'checked' : ''; ?>>
              <label class="form-check-label" for="flexRadioDefault1">
                Perempuan
              </label>
            </div>
            <div class="form-check">
              <input class="ms-3 form-check-input" type="radio" name="jenis_kelamin" id="l" value="l" <?php echo ($pendaftar->jenis_kelamin == 'l') ? 'checked' : ''; ?>>
              <label class="ms-2 form-check-label" for="flexRadioDefault2">
                Laki-Laki
              </label>
            </div>
          </div>
        </div>
        <label for="Agama" class="col-sm-2 col-form-label">Agama & Kepercayaan<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="agama" id="agama" required>
            <option selected value="">.:Pilih Agama & Kepercayaan:.</option>
            <?php
            foreach ($agama as $row) {
              $stat = ($pendaftar->agama == $row->id) ? 'selected' : '';
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <label for="BerkebutuhanKhusus" class="col-sm-2 col-form-label">Berkebutuhan Khusus</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="berkebutuhan_khusus" id="berkebutuhan_khusus">
            <option selected value="">.:Pilih Kebutuhan Khusus:.</option>
            <?php
            foreach ($berkebutuhan_khusus as $row) {
              $stat = ($pendaftar->berkebutuhan_khusus == $row->id) ? 'selected' : '';
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <h5 class="mt-3 border-top pt-3 text-start">Data Kontak</h5>
      <div class="row mb-3">
        <label for="Alamat" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <textarea class="form-control" name="alamat" id="alamat" rows="3" required><?= $pendaftar->alamat ?></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="provinsi" id="provinsi" required>
            <option selected value="">.:Pilih Provinsi:.</option>
            <?php
            foreach ($country as $row) {
              $stat = ($pendaftar->provinsi == $row['prov_id']) ? 'selected' : '';
              echo '<option value="' . $row['prov_id'] . '" ' . $stat . '>' . $row['prov_name'] . '</option>';
            }
            ?>
          </select>
        </div>
        <label for="Kabupaten" class="col-sm-2 col-form-label">Kabupaten<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="kabupaten" id="kabupaten" value="<?= set_value('kabupaten') ?>" required>
            <option selected value="">.:Pilih Kabupaten:.</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="kecamatan" id="kecamatan" value="<?= set_value('kecamatan') ?>" required>
            <option selected value="">.:Pilih Kecamatan:.</option>
          </select>
        </div>
        <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan<span class="text-danger">*</span></label>
        <div class="col-sm-4">
          <select class="form-select" aria-label="Default select example" name="kelurahan" id="kelurahan" value="<?= set_value('kelurahan') ?>" required>
            <option selected value="">.:Pilih Kelurahan:.</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="KodePos" class="col-sm-2 col-form-label">Kode Pos<span class="text-danger">*</span></label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos" value="<?= set_value('kode_pos') ?>" readonly>
        </div>
        <label for="RT" class="col-sm-1 col-form-label">RT<span class="text-danger">*</span></label>
        <div class="col-sm-1">
          <input type="text" class="form-control" id="rt" name="rt" value="<?= $pendaftar->rt ?>" maxlength="5" required>
        </div>
        <label for="RW" class="col-sm-1 col-form-label">RW<span class="text-danger">*</span></label>
        <div class="col-sm-1">
          <input type="text" class="form-control" id="rw" name="rw" value="<?= $pendaftar->rw ?>" maxlength="5" required>
        </div>
      </div>

      <div class="row mb-3">
        <label for="NoHP" class="col-sm-2 col-form-label">No. HP</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?= $pendaftar->nomor_hp ?>" maxlength="20">
        </div>
      </div>
      <div class="row mb-3">
        <label for="Email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="email" value="<?= $pendaftar->email ?>" maxlength="50" disabled>
        </div>
      </div>
      <h4 class="mt-3">Data Orang Tua</h4>
      <h5 class="mt-3 pt-3 text-start">Data Ayah</h5>
      <div class="text-start fst-italic mb-1 text-danger">
        <span>*kosongkan jika hanya memiliki wali*</span>
      </div>
      <div class="row mb-3">
        <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?php if (!empty($ayah->nama)) echo $ayah->nama ?>" maxlength="255">
        </div>
      </div>

      <div class="row mb-3">
        <label for="PendidikanAyah" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pendidikan_ayah" id="pendidikan_ayah">
            <option selected value="">.:Pilih Pendidikan:.</option>
            <?php
            foreach ($pendidikan as $row) {
              if (!empty($ayah)) {
                $stat = ($ayah->pendidikan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="PekerjaanAyah" class="col-sm-2 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pekerjaan_ayah" id="pekerjaan_ayah">
            <option selected value="">.:Pilih Pekerjaan:.</option>
            <?php
            foreach ($pekerjaan as $row) {
              if (!empty($ayah)) {
                $stat = ($ayah->pekerjaan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <textarea class="form-control" name="alamat_ayah" id="alamat-ayah" rows="3" maxlength="100"><?php if (!empty($ayah->alamat)) echo $ayah->alamat ?></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NoHPAyah" class="col-sm-2 col-form-label">No. HP</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nomor_hp_ayah" name="nomor_hp_ayah" value="<?php if (!empty($ayah->nomor_hp)) echo $ayah->nomor_hp ?>" maxlength="15">
        </div>
      </div>

      <h5 class="mt-3 border-top pt-3 text-start">Data Ibu</h5>
      <div class="text-start fst-italic mb-1 text-danger">
        <span>*kosongkan jika hanya memiliki wali*</span>
      </div>
      <div class="row mb-3">
        <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?php if (!empty($ibu->nama)) echo $ibu->nama ?>" maxlength="255">
        </div>
      </div>
      <div class="row mb-3">
        <label for="PendidikanIbu" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pendidikan_ibu" id="pendidikan_ibu">
            <option selected value="">.:Pilih Pendidikan:.</option>
            <?php
            foreach ($pendidikan as $row) {
              if (!empty($ibu)) {
                $stat = ($ibu->pendidikan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pekerjaan_ibu" id="pekerjaan_ibu">
            <option selected value="">.:Pilih Pekerjaan:.</option>
            <?php
            foreach ($pekerjaan as $row) {
              if (!empty($ibu)) {
                $stat = ($ibu->pekerjaan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <textarea class="form-control" name="alamat_ibu" id="alamat_ibu" rows="3" maxlength="100"><?php if (!empty($ibu->alamat)) echo $ibu->alamat ?></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NoHPIbu" class="col-sm-2 col-form-label">No. HP</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nomor_hp_ibu" name="nomor_hp_ibu" value="<?php if (!empty($ibu->nomor_hp)) echo $ibu->nomor_hp ?>" maxlength="15">
        </div>
      </div>
      <h5 class="mt-3 border-top pt-3 text-start">Data Wali</h5>
      <div class="text-start fst-italic mb-1 text-danger">
        <span>*kosongkan jika tidak memiliki wali*</span>
      </div>
      <div class="row mb-3">
        <label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?php if (!empty($wali->nama)) echo $wali->nama ?>" maxlength="255">
        </div>
      </div>
      <div class="row mb-3">
        <label for="PendidikanWali" class="col-sm-2 col-form-label">Pendidikan</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pendidikan_wali" id="pendidikan_wali">
            <option selected value="">.:Pilih Pendidikan:.</option>
            <?php
            foreach ($pendidikan as $row) {
              if (!empty($wali)) {
                $stat = ($wali->pendidikan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="pekerjaan_wali" id="pekerjaan_wali">
            <option selected value="">.:Pilih Pekerjaan:.</option>
            <?php
            foreach ($pekerjaan as $row) {
              if (!empty($wali)) {
                $stat = ($wali->pekerjaan == $row->id) ? 'selected' : '';
              } else $stat = "";
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_opsi . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="alamat_wali" id="alamat_wali" rows="3" maxlength="100"><?php if (!empty($wali->alamat)) echo $wali->alamat ?></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label for="NoHPWali" class="col-sm-2 col-form-label">No. HP</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nomor_hp_wali" name="nomor_hp_wali" value="<?php if (!empty($wali->nomor_hp)) echo $wali->nomor_hp ?>" maxlength="15">
        </div>
      </div>
      <h5 class="mt-3 border-top pt-3 text-start">Data Registrasi</h5>
      <div class="row mb-3">
        <label for="AsalSekolah" class="col-sm-2 col-form-label">Asal Sekolah<span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="<?= $pendaftar->asal_sekolah ?>" maxlength="30" required>
        </div>
      </div>
      <div class="row mb-3">
        <label for="Jurusan" class="col-sm-2 col-form-label">Jurusan/Keahlian</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" name="jurusan" id="jurusan" required>
            <?php
            foreach ($jurusan as $row) { 
              $stat = ($pendaftar->jurusan == $row->id) ? 'selected' : '';
              echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_jurusan . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
    <?php } ?>

    
    <div class="d-flex justify-content-end mb-3">
      <a href="<?= site_url('data-pendaftar/' . $pendaftar->jalur) ?>" name="simpan" id="simpan" class="btn btn-secondary mt-3 me-2">Batalkan</a>
      <a class="btn btn-primary mt-3 me-2" data-bs-toggle="modal" data-bs-target="#alertModalEdit">Simpan</a>
    </div>
    <div class="modal fade" id="alertModalEdit" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="kalenderModalLabel">Simpan Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="">Apakah anda data yang dimasukkan sudah lengkap?</p>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
              <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
    <?php } else { ?>
      <ul class="alert alert-success list-unstyled">
        <li>Anda sudah melakukan daftar ulang.</li>
      </ul>
    <?php } ?>
  <?php } else { ?>
    <ul class="alert alert-success list-unstyled">
      <li>Anda sudah melakukan daftar ulang.</li>
    </ul>
  <?php } ?>
<?php } else { ?>
  <ul class="alert alert-success list-unstyled">
    <li>Anda sudah melakukan daftar ulang.</li>
  </ul>
<?php } ?>

</div>


<?= $this->endSection() ?>