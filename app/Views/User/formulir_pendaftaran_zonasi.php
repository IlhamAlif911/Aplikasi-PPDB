<?= $this->extend('User/index.php') ?>

<?= $this->section('content') ?>


<div class="container-fluid mt-5 mb-4">
   <div class="container">
      <div class="mt-5 mb-3">
         <h2 class="">Formulir Pendaftaran <?= $jalur->nama_jalur?></h2>
         <p>Silakan mengisi form yang tersedia dengan lengkap dan benar. <span class="text-start fst-italic mb-1 text-danger">Tanda * wajib diisi.</span></p>
      </div>
      <?php if (session()->has('alert')) : ?>
      <ul class="alert alert-success list-unstyled">
         <li><?= session('alert') ?></li>
      </ul>
   <?php elseif (session()->has('error')) : ?>
   <ul class="alert alert-danger list-unstyled">
      <li><?= session('error') ?></li>
   </ul>
<?php endif ?>
<form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/add-zonasi/<?= $jalur->id ?>">
   <div class="card" style="width: 20rem;">
      <div class="card-body">
         <table class="table m-0 p-0">
            <tr class="">
               <td class="text-center">
                  <label for="Periode" class="fw-bold form-label">Periode</label>
               </td>
               <td>
                  <input type="text" class="form-control border-0" id="periode" name="periode" value="<?= $periode->id ?>" hidden>
                  <?= $periode->nama_periode ?>
               </td>
            </tr>
            <tr class="">
               <td class="text-center">
                  <label for="Tahap" class="fw-bold form-label">Tahap</label>
               </td>
               <td>
                  <input type="text" class="form-control border-0" id="tahap" name="tahap" value="<?= $tahap->id ?>" hidden>
                  <?= $tahap->nama_tahap ?>
               </td>
            </tr>
            <tr class="">
               <td class="text-center">
                  <label for="Jalur" class="fw-bold form-label">Jalur</label>
               </td>
               <td>
                  <input type="text" class="form-control border-0" id="jalur" name="jalur" value="<?= $jalur->id ?>" hidden>
                  <?= $jalur->nama_jalur ?>
               </td>
            </tr>
         </table>
      </div>
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
            <div class="step" icon="fa fa-user" id="2">
               <div class="step-title">
                  <span class="step-number">02</span>
                  <div class="step-text">Akun</div>
               </div>
            </div>
            <div class="step" icon="fa fa-check" id="3">
               <div class="step-title">
                  <span class="step-number">03</span>
                  <div class="step-text">Konfirmasi</div>
               </div>
            </div>
         </div>
      </div>
      <div class="stepper-content-container">
         <div class="stepper-content fade-in" stepper-label="1">
            <div class="card border-1 bg-transparent text-center">
               <div class="card-body">
                  <div class="">
                     <div class="d-flex flex-wrap mb-3 justify-content-center text-center">
                        <div>
                           <img id="frame" src="<?= base_url('assets/' . 'blank-user.png'); ?>" class="card-img-top" style="object-fit: contain; width:150px; height:200px;" alt="Foto Profil" />
                           <div class="mb-3">
                              <label for="FileFoto" class="form-label">Upload File Foto<span class="text-danger">*</span></label>
                              <input class="form-control" type="file" id="file_foto" name="file_foto" onchange="preview()" required>
                              <span class="text-danger"><small>Tipe file : PNG/JPG/JPEG <br> Ukuran maks. : 2MB</small></span>
                           </div>
                        </div>
                     </div>
                     <div class="">
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
                                          <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" maxlength="255" value="<?= set_value('nama_lengkap') ?>" required>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="NISN" class="col-sm-2 col-form-label">NISN<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN" maxlength="10" value="<?= set_value('nisn') ?>" required>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="NIK" class="col-sm-2 col-form-label">NIK<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK/No. KITAS (untuk WNA)" maxlength="16" value="<?= set_value('nik') ?>" required>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
                                       <div class="col-sm-4">
                                          <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" maxlength="50" value="<?= set_value('tempat_lahir') ?>" required>
                                       </div>
                                       <label for="TanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                       <div class="col-sm-4">
                                          <div class="input-group">
                                             <input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>" required>
                                             <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
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
                                             <option selected value="">.:Pilih Agama & Kepercayaan:.</option>
                                             <?php
                                             foreach ($agama as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('agama', $row->id, false) ?>><?= $row->nama_opsi ?></option>;
                                             <?php }
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
                                             foreach ($berkebutuhan_khusus as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('berkebutuhan_khusus', $row->id, false) ?>><?= $row->nama_opsi ?></option>;
                                             <?php }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                    <h5 class="mt-3 border-top pt-3 text-start">Data Kontak</h5>
                                    <div class="row mb-3">
                                       <label for="Alamat" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <textarea class="form-control" name="alamat" id="alamat" rows="3" required><?= set_value('alamat') ?></textarea>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi<span class="text-danger">*</span></label>
                                       <div class="col-sm-4">
                                          <select class="form-select" aria-label="Default select example" name="provinsi" id="provinsi" required>
                                             <option selected value="">.:Pilih Provinsi:.</option>
                                             <?php
                                             foreach ($country as $row) { ?>
                                                <option value="<?= $row['prov_id'] ?>"><?= $row['prov_name'] ?></option>;
                                             <?php }
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
                                          <input type="text" class="form-control" id="rt" name="rt" placeholder="RT" maxlength="5" value="<?= set_value('rt') ?>" required>
                                       </div>
                                       <label for="RW" class="col-sm-1 col-form-label">RW<span class="text-danger">*</span></label>
                                       <div class="col-sm-1">
                                          <input type="text" class="form-control" id="rw" name="rw" placeholder="RW" maxlength="5" value="<?= set_value('rw') ?>" required>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="NoHP" class="col-sm-2 col-form-label">No. HP<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="No. HP" value="<?= set_value('nomor_hp') ?>" maxlength="20" required>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                       <div class="col-sm-10">
                                          <input type="email" class="form-control" id="email" name="email" placeholder="Contoh : name@example.com" maxlength="50" value="<?= set_value('email') ?>">
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
                                    <div class="text-start fst-italic mb-1 text-danger">
                                       <span>*kosongkan jika hanya memiliki wali*</span>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" value="<?= set_value('nama_ayah') ?>" maxlength="255">
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="PendidikanAyah" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <select class="form-select" aria-label="Default select example" name="pendidikan_ayah" id="pendidikan_ayah">
                                             <option selected value="">.:Pilih Pendidikan:.</option>
                                             <?php foreach ($pendidikan as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('pendidikan_ayah', $row->id, false) ?>><?= $row->nama_opsi ?></option>;
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="PekerjaanAyah" class="col-sm-2 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <select class="form-select" aria-label="Default select example" name="pekerjaan_ayah" id="pekerjaan_ayah">
                                             <option selected value="">.:Pilih Pekerjaan:.</option>
                                             <?php foreach ($pekerjaan as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('pekerjaan_ayah', $row->id, false) ?>><?= $row->nama_opsi ?></option>;
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <textarea class="form-control" name="alamat_ayah" id="alamat-ayah" rows="3" maxlength="100"><?= set_value('alamat_ayah') ?></textarea>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="NoHPAyah" class="col-sm-2 col-form-label">No. HP</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nomor_hp_ayah" name="nomor_hp_ayah" placeholder="No. HP" maxlength="15" value="<?= set_value('nomor_hp_ayah') ?>">
                                       </div>
                                    </div>
                                    <h5 class="mt-3 border-top pt-3 text-start">Data Ibu</h5>
                                    <div class="text-start fst-italic mb-1 text-danger">
                                       <span>*kosongkan jika hanya memiliki wali*</span>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" maxlength="255" value="<?= set_value('nama_ibu') ?>">
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="PendidikanIbu" class="col-sm-2 col-form-label">Pendidikan<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <select class="form-select" aria-label="Default select example" name="pendidikan_ibu" id="pendidikan_ibu">
                                             <option selected value="">.:Pilih Pendidikan:.</option>
                                             <?php foreach ($pendidikan as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('pendidikan_ibu', $row->id, false) ?>><?= $row->nama_opsi ?></option>;
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <select class="form-select" aria-label="Default select example" name="pekerjaan_ibu" id="pekerjaan_ibu">
                                             <option selected value="">.:Pilih Pekerjaan:.</option>
                                             <?php
                                             foreach ($pekerjaan as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('pekerjaan_ibu', $row->id, false) ?>><?= $row->nama_opsi ?></option>;
                                             <?php }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <textarea class="form-control" name="alamat_ibu" id="alamat_ibu" rows="3" maxlength="100"><?= set_value('alamat_ibu') ?></textarea>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="NoHPIbu" class="col-sm-2 col-form-label">No. HP</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nomor_hp_ibu" name="nomor_hp_ibu" placeholder="No. HP" maxlength="15" value="<?= set_value('nomor_hp_ibu') ?>">
                                       </div>
                                    </div>
                                    <h5 class="mt-3 border-top pt-3 text-start">Data Wali</h5>
                                    <div class="text-start fst-italic mb-1 text-danger">
                                       <span>*kosongkan jika tidak memiliki wali*</span>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Nama Wali" maxlength="255">
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="PendidikanWali" class="col-sm-2 col-form-label">Pendidikan</label>
                                       <div class="col-sm-10">
                                          <select class="form-select" aria-label="Default select example" name="pendidikan_wali" id="pendidikan_wali">
                                             <option selected value="">.:Pilih Pendidikan:.</option>
                                             <?php foreach ($pendidikan as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('pendidikan_wali', $row->id, false) ?>><?= $row->nama_opsi ?></option>;
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan</label>
                                       <div class="col-sm-10">
                                          <select class="form-select" aria-label="Default select example" name="pekerjaan_wali" id="pekerjaan_wali">
                                             <option selected value="">.:Pilih Pekerjaan:.</option>
                                             <?php foreach ($pekerjaan as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('pekerjaan_wali', $row->id, false) ?>><?= $row->nama_opsi ?></option>;
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat</label>
                                       <div class="col-sm-10">
                                          <textarea class="form-control" name="alamat_wali" id="alamat_wali" rows="3" maxlength="100"><?= set_value('alamat_wali') ?></textarea>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="NoHPWali" class="col-sm-2 col-form-label">No. HP</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" id="nomor_hp_wali" name="nomor_hp_wali" placeholder="No. HP" maxlength="15" value="<?= set_value('nomor_hp_wali') ?>">
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
                                    <h5 class="mt-3 border-top pt-3 text-start">Data Registrasi</h5>
                                    
                                    <div class="row mb-3" id="asal_sekolah_fieldselect">
                                       <label for="AsalSekolah" class="col-sm-2 col-form-label">Asal Sekolah<span class="text-danger">*</span></label>
                                       <div class="col-sm-10">
                                          <select class="form-select" aria-label="Default select example" name="asal_sekolah" id="asal_sekolah" required>
                                             <option selected value="">.:Pilih Asal Sekolah:.</option>
                                             <?php foreach ($sekolah as $row) { ?>
                                                <option value="<?= $row->nama_sekolah ?>" <?= set_select('asal_sekolah', $row->nama_sekolah, false) ?>><?= $row->nama_sekolah ?></option>;
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row" id="asal_sekolah_field">
                                       
                                    </div>
                                    <div class="row mb-3 text-left">
                                       <label for="" class="col-sm-2 col-form-label"></label>
                                       <div class="col-sm-4">
                                          <div class="form-check form-switch">
                                             <input class="form-check-input" type="checkbox" role="switch" value="on" name="asal_sekolah_check" id="asal_sekolah_check" onclick="showForm()">
                                             <label class="form-check-label" for="">
                                                <span class="text-danger">*</span>Aktifkan Jika Asal Sekolah Dari Luar Cilacap
                                             </label>
                                          </div>
                                       </div>
                                    </div>                           
                                    <div class="row mb-3">
                                       <label for="jurusan" class="col-sm-2 col-form-label">Jurusan/Keahlian</label>
                                       <div class="col-sm-10">
                                          <select class="form-select" aria-label="Default select example" name="jurusan" id="jurusan" required>
                                             <option selected value="">.:Pilih Jurusan 1:.</option>
                                             <?php foreach ($jurusan as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('jurusan', $row->id, false) ?>><?= $row->nama_jurusan ?></option>;
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="Jurusan" class="col-sm-2 col-form-label"></label>
                                       <div class="col-sm-10">
                                          <select class="form-select" aria-label="Default select example" name="jurusan2" id="jurusan2" required>
                                             <option selected value="">.:Pilih Jurusan 2:.</option>
                                             <?php foreach ($jurusan as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= set_select('jurusan2', $row->id, false) ?>><?= $row->nama_jurusan ?></option>;
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex justify-content-end">
                              <div class="d-flex align-items-center m-3">
                                 
                                 <div class="step btn btn-success" icon="fa fa-arrow-right" id="2"></div>
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
                  <h3 class="card-title">Akun</h3>
                  <div class="row mb-3">
                     <label for="NomorPendaftaran" class="col-sm-2 col-form-label">Nomor Pendaftaran</label>
                     <div class="col-sm-4">
                        <input type="text" id="nomor_pendaftaran" name="nomor_pendaftaran" class="border-0 form-control fw-bold" value="<?= $nomor_pendaftar ?>" readonly>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="Password" class="col-sm-2 col-form-label">Password<span class="text-danger">*</span></label>
                     <div class="col-sm-4">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="<?= set_value('password') ?>" required>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="KonfirmasiPassword" class="col-sm-2 col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                     <div class="col-sm-4">
                        <input type="password" id="konf_password" name="konf_password" class="form-control" placeholder="Konfirmasi Password" required>
                     </div>
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                  <div class="m-3">
                     <div class="step btn btn-success" icon="fa fa-arrow-left" id="1"></div>
                     
                  </div>
                  <div class="m-3">
                     
                     <div class="step btn btn-success" icon="fa fa-arrow-right" id="3"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="stepper-content fade-in" stepper-label="3">
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
                     <button class="btn btn-success btn-lg col-12" type="submit" id="submit" name="submit">Submit Data</button>
                  </div>
               </div>
               <div class="d-flex justify-content-start">
                  <div class="m-3">
                     <div class="step btn btn-success" icon="fa fa-arrow-left" id="2"></div>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
</div>
</div>

<?= $this->endSection() ?>