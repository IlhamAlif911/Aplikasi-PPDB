<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<div class="container border-0 pt-4 pb-4 ps-0">
  <div class="pb-3">
    <h3 class="border-bottom pb-3">Pembayaran</h3>
  </div>
  <div class="pb-3">
    <div class="d-flex">
      <a href="#" class="btn btn-primary align-self-end" data-bs-toggle="modal" data-bs-target="#sliderModal">+ Tambah Data</a>
    </div>
  </div>
  <?php if (session()->has('error')) : ?>
  <ul class="alert alert-danger list-unstyled">
    <li><?= session('error') ?></li>
  </ul>
<?php elseif (session()->has('alert')) : ?>
<ul class="alert alert-success list-unstyled">
  <li><?= session('alert') ?></li>
</ul>
<?php endif ?>
<div class="table-responsive">
  <table id="" class="display table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nomor Pendaftaran</th>
        <th>Order ID</th>
        <th>Tanggal Transfer</th>
        <th>Nama Bank</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $tanggal_transfer = '';
      $no = 1;
      foreach ($pembayaran as $k) :
        ?>
        <tr>
          <td><?= $no ?></td>
          <td>
            <?php foreach ($user as $u) {
              if ($u->id_ref == $k->id_pendaftar) {
                echo $u->nomor_pendaftaran;
              }
            } 
            ?>

          </td>
          <td><?= $k->order_id ?></td>
          <td>
            <?php
            if ($k->tanggal_transfer != "") {
              $pecah = explode('-', $k->tanggal_transfer);
              $tanggal_transfer = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
              echo $tanggal_transfer;
            }
            ?>
          </td>
          <td><?= $k->nama_bank ?></td>
          <td class="text-center">
            <?php if ($k->status == 'pending') { ?>
              <span class="badge badge-warning">Pending</span>
            <?php } else if($k->status == 'expire') { ?>
              <span class="badge badge-danger">Kadaluarsa</span>
            <?php }else if ($k->status == 'settlement'){ ?>
              <span class="badge badge-success">Sukses</span>
            <?php } ?>
          </td>
          <td class="text-center">
            
            <button class="btn btn-success btn-sm" type="button" onclick="cek_status('<?= $k->id; ?>', '<?= $k->id_pendaftar; ?>')">Cek Status</button>
            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" value="<?= $k->id ?>" id="edit_jurusan" name="edit_jurusan" data-bs-target="#kalenderModalEdit<?= $k->id ?>">Edit</a>
            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalEdit<?= $k->id ?>">Hapus</a>
          </td>
        </tr>
        <div class="modal fade" id="kalenderModalEdit<?= $k->id ?>" tabindex="-1" aria-labelledby="kalenderModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="kalenderModalLabel">Edit Data Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/update-konfirmasi/<?= $k->id ?>">
                  <div class="row mb-3">
                    <label for="NomorPendaftaran" class="col-sm-3 col-form-label">Nomor Pendaftaran<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nomor_pendaftaran" name="nomor_pendaftaran" value="<?php foreach ($user as $u) { 
                        if ($u->id_ref == $k->id_pendaftar) { 
                          echo $u->nomor_pendaftaran;
                        }
                      } ?>" readonly>
                      
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label for="TanggalTransfer" class="col-sm-3 col-form-label">Tanggal Transfer<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_transfer" value="<?= $tanggal_transfer ?>" required>
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label for="NamaPemilik" class="col-sm-3 col-form-label">Nama Pemilik Rekening<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama_pemilik_rekening" name="nama_pemilik_rekening" value="<?= $k->nama_pemilik_rekening ?>" required>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label for="NamaBank" class="col-sm-3 col-form-label">Nama Bank<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="<?= $k->nama_bank ?>" required>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label for="NominalTransfer" class="col-sm-3 col-form-label">Nominal Transfer<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nominal_transfer" name="nominal_transfer" value="<?= $k->nominal_transfer ?>" required>
                      <span class="text-danger">Angka saja tanpa titik atau koma. Contoh : 200000</span>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label for="BuktiTransfer" class="col-sm-3 col-form-label">Bukti Transfer</label>
                    <div class="col-sm-9">
                      <img id="gambar_load2" src="<?= base_url('assets/' . $k->bukti_transfer); ?>" class="img-fluid pad" />
                      <input type="file" class="form-control" id="bukti_transfer2" name="bukti_transfer" placeholder="Bukti Transfer">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="alertModalEdit<?= $k->id ?>" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="kalenderModalLabel">Hapus Konfirmasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/delete-pembayaran/<?= $k->id ?>">
                  <p class="">Apakah anda yakin menghapus konfirmasi pembayaran '<?php foreach ($user as $u) {
                    if ($u->id_ref == $k->id_pendaftar) {
                      echo $u->nomor_pendaftaran;
                    }
                  } ?>'?</p>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <?php $no++;
      endforeach ?>
    </tbody>
  </table>
</div>
</div>
<?php foreach ($pembayaran as $key => $value) { ?>
  <div class="modal fade" id="alertModalVerifikasi<?= $value->id ?>" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kalenderModalLabel">Verifikasi Pembayaran <?php foreach ($user as $u) {
            if ($u->id_ref == $value->id_pendaftar) {
              echo $u->nomor_pendaftaran;
            }
          } ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <?php echo form_open('status-pembayaran/'. $value->id.'/'.$value->id_pendaftar) ?>
            <table class="table" width="100%" cellspacing="0">
              <tr>
                <th>Nama Bank</th>
                <th>:</th>
                <td><?= $value->nama_bank; ?></td>
              </tr>
              <tr>
                <th>Atas Nama</th>
                <th>:</th>
                <td><?= $value->nama_pemilik_rekening; ?></td>
              </tr>
              <tr>
                <th>Total Bayar</th>
                <th>:</th>
                <td>Rp. <?= number_format($value->nominal_transfer, 0); ?></td>
              </tr>

            </table>
          </div>
          <img class="img-fluid pad" src="<?= base_url('assets/' . $value->bukti_transfer); ?>" alt="">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Verifikasi</button>

          </div>
          <?php echo form_close() ?>
        </div>
      </div>
    </div>
  </div>

<?php } ?>

<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sliderModalLabel">Tambah Konfirmasi Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/add-konfirmasi">
          <div class="row mb-3">
            <label for="NomorPendaftaran" class="col-sm-3 col-form-label">Nomor Pendaftaran<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <select class="form-select" aria-label="Default select example" id="nomor_pendaftaran" name="nomor_pendaftaran" required>
                <option selected value="">.:Pilih Nomor Pendaftaran:.</option>
                <?php foreach ($data_pendaftar as $row) { ?>
                  <option value="<?= $row->nomor_pendaftaran ?>" <?= set_select('nomor_pendaftaran', $row->nomor_pendaftaran, false) ?>><?= $row->nomor_pendaftaran ?> - <?= $row->nama_lengkap ?> </option>;
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="row mb-2">
            <label for="NamaLengkap" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="TanggalTransfer" class="col-sm-3 col-form-label">Tanggal Transfer<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_transfer" required>
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label for="NamaPemilik" class="col-sm-3 col-form-label">Nama Pemilik Rekening<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama_pemilik_rekening" name="nama_pemilik_rekening" placeholder="Nama Pemilik Rekening" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="NamaBank" class="col-sm-3 col-form-label">Nama Bank<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="Nama Bank" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="NominalTransfer" class="col-sm-3 col-form-label">Nominal Transfer<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nominal_transfer" name="nominal_transfer" placeholder="Nominal Transfer" required>
              <span class="text-danger">Angka saja tanpa titik atau koma. Contoh : 200000</span>
            </div>
          </div>
          <div class="row mb-2">
            <label for="BuktiTransfer" class="col-sm-3 col-form-label">Bukti Transfer<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <img id="gambar_load" width="400px">
              <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" placeholder="Bukti Transfer" required>
            </div>
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>