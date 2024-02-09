<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <div class="header-title">
          <a href="#" class="card-title btn btn-primary align-self-end pb-2" data-bs-toggle="modal" data-bs-target="#sliderModal">+ Tambah Data</a>
          
        </div>
      </div>
      <div class="card-body">
        <?php if (session()->has('error')) { ?>
            <ul id="alert" class="alert alert-danger list-unstyled">
              <li><?= session('error') ?></li>
            </ul>
          <?php } elseif (session()->has('alert')) { ?>
            <ul id="alert" class="alert alert-success list-unstyled">
              <li><?= session('alert') ?></li>
            </ul>
          <?php } ?>
        <div class="table-responsive">
          <table id="datatable" class="table" data-toggle="data-table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nomor Pendaftaran</th>
                
                <th>Tanggal Transfer</th>
                <th>Jenis Pembayaran</th>
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
                  
                  <td>
                    <?php
                    if ($k->tanggal_transfer != "") {
                      $pecah = explode('-', $k->tanggal_transfer);
                      $tanggal_transfer = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
                      echo $tanggal_transfer;
                    }
                    ?>
                  </td>
                  <td><?php if ($k->nama_bank == 'bri') { ?>
                      BRI
                    <?php } else if($k->nama_bank == 'bca') { ?>
                      BCA
                    <?php }else if ($k->nama_bank == 'bni'){ ?>
                      BNI
                    <?php }else{ ?>
                      <?= $k->nama_bank ?>
                    <?php } ?>
                      
                    </td>
                  <td class="text-center">
                    <?php if ($k->status == 'pending') { ?>
                      <span class="badge bg-warning">Pending</span>
                    <?php } else if($k->status == 'expire') { ?>
                      <span class="badge bg-danger">Kadaluarsa</span>
                    <?php }else if ($k->status == 'settlement'){ ?>
                      <span class="badge bg-success">Sukses</span>
                    <?php } ?>
                  </td>
                  <td class="text-center">
                    <?php if ($k->nama_bank == 'Tunai'): ?>
                      
                    <?php else: ?>
                      <button class="btn btn-success btn-sm" type="button" onclick="cek_status('<?= $k->id; ?>', '<?= $k->id_pendaftar; ?>')">Cek Status</button>
                    <?php endif ?>
                    
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" value="<?= $k->id ?>" id="edit_jurusan" name="edit_jurusan" data-bs-target="#kalenderModalEdit<?= $k->id ?>">Edit</a>
                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalEdit<?= $k->id ?>">Hapus</a>
                  </td>
                </tr>
                <?php if ($k->nama_bank == 'Tunai'): ?>
                  <div class="modal fade" id="kalenderModalEdit<?= $k->id ?>" tabindex="-1" aria-labelledby="kalenderModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="kalenderModalLabel">Ubah Data Pembayaran Tunai</h5>
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
                            <label for="TanggalTransfer" class="col-sm-3 col-form-label">Tanggal Pembayaran<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input type="date" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_transfer" value="<?= $k->tanggal_transfer ?>" required>
                                
                              </div>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="NamaPemilik" class="col-sm-3 col-form-label">Nama<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="nama_pemilik_rekening" name="nama_pemilik_rekening" value="<?= $k->nama_pemilik_rekening ?>" required>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="NamaBank" class="col-sm-3 col-form-label">Jenis Pembayaran<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="
                              <?php if ($k->nama_bank == 'bri') { ?>BRI<?php } else if($k->nama_bank == 'bca') { ?>BCA<?php }else if ($k->nama_bank == 'bni'){ ?>BNI<?php }else{ ?><?= $k->nama_bank ?><?php } ?>" readonly>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="NominalTransfer" class="col-sm-3 col-form-label">Nominal Bayar<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="nominal_transfer" name="nominal_transfer" value="<?= $k->nominal_transfer ?>" required>
                              <span class="text-danger">Angka saja tanpa titik atau koma. Contoh : 200000</span>
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
                <?php else: ?>
                  <div class="modal fade" id="kalenderModalEdit<?= $k->id ?>" tabindex="-1" aria-labelledby="kalenderModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="kalenderModalLabel">Ubah Data Pembayaran Online</h5>
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
                            <label for="TanggalTransfer" class="col-sm-3 col-form-label">Tanggal Pembayaran<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input type="date" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_transfer" value="<?= $k->tanggal_transfer ?>" required>
                                
                              </div>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="NamaPemilik" class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="nama_pemilik_rekening" name="nama_pemilik_rekening" value="<?= $k->nama_pemilik_rekening ?>" required>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="NamaBank" class="col-sm-3 col-form-label">Jenis Pembayaran<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="<?= $k->nama_bank ?>" readonly>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="NominalTransfer" class="col-sm-3 col-form-label">Nominal Bayar<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="nominal_transfer" name="nominal_transfer" value="<?= $k->nominal_transfer ?>" readonly>
                              <span class="text-danger">Angka saja tanpa titik atau koma. Contoh : 200000</span>
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
                <?php endif ?>
                
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
    </div>
  </div>
</div>


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
            <label for="TanggalTransfer" class="col-sm-3 col-form-label">Tanggal Bayar<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="date" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_transfer" required>
                
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <label for="NominalTransfer" class="col-sm-3 col-form-label">Nominal Bayar<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nominal_transfer" name="nominal_transfer" placeholder="Nominal Transfer" required>
              <span class="text-danger">Angka saja tanpa titik atau koma. Contoh : 200000</span>
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