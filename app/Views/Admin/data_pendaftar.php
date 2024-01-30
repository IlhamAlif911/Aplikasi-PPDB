<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <div class="header-title">
          <h3 class="border-bottom pb-3">Data Siswa <?= $tahap->nama_tahap ?></h3>
          <?php if (session()->has('error')) { ?>
            <ul id="alert" class="alert alert-danger list-unstyled">
              <li><?= session('error') ?></li>
            </ul>
          <?php } elseif (session()->has('alert')) { ?>
            <ul id="alert" class="alert alert-success list-unstyled">
              <li><?= session('alert') ?></li>
            </ul>
          <?php } ?>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
          <?php if (!$jalur1) { ?>
            <ul class="alert alert-danger list-unstyled">
              <li><?= $tahap->nama_tahap ?> Belum Memiliki Jalur, <a href="<?= site_url('data-jalur') ?>">Klik Disini</a> Untuk Tambah Jalur <?= $tahap->nama_tahap?></li>
            </ul>
          <?php } else { ?>
            
            <ul class="d-flex nav nav-pills mb-0 text-center profile-tab" data-toggle="slider-tab" id="profile-pills-tab" role="tablist">
              <?php $nomor = 1;
              foreach ($jalur as $j) {
                if ($nomor == 1) { ?>
                  <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" href="#profile-feed<?= $j->id ?>" role="tab" aria-selected="false"><?= $j->nama_jalur ?></a>
                  </li>
                <?php } else { ?>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#profile-feed<?= $j->id ?>" role="tab" aria-selected="false"><?= $j->nama_jalur ?></a>
                  </li>
                <?php }
                $nomor++;
              } ?>
            </ul>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <?php if (!$jalur1): ?>
      <div class="card">
        <div class="card-header">
          <h4>Data Pendaftar Kosong !</h4>
        </div>
      </div>
    <?php else: ?>
      <div class="profile-content tab-content iq-tab-fade-up">
        <?php $nomor = 1;
        foreach ($jalur as $j) {
          if ($nomor == 1) { ?>
            <div class="tab-pane fade show active" id="profile-feed<?= $j->id ?>" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
              <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between pb-4">
                  <div class="header-title">
                    <div class="btn-group">
                      <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-file-download"></i>&nbsp;&nbsp;Ekspor
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= site_url('export/'. $tahap->id)?>">Semua Data Pendaftar</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('export-accepted/'. $tahap->id)?>">Data Pendaftar Yang Diterima</a></li>
                      </ul>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#sliderModal<?= $j->id ?>">
                        <i class="fas fa-file-upload"></i>&nbsp;&nbsp;Impor
                      </button>
                    </div>
                  </div>

                </div>
                <div class="card-body py-0">
                  <div class="table-responsive">
                    <table id="datatable" class="table" data-toggle="data-table">
                      <thead>
                        <tr>
                          <th>Nomor Pendaftaran</th>
                          <th>Nama</th>
                          <th>Jenis Kelamin</th>
                          <th>Status Pendaftaran</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($pendaftaran as $p) {
                          if ($j->id == $p->jalur) {
                            foreach ($pendaftar as $pd) {
                              if ($p->id_pendaftar  == $pd->id_ref) { ?>
                                <tr>
                                  <td><?= $pd->nomor_pendaftaran ?></td>
                                  <td><?= $pd->nama_lengkap ?></td>
                                  <td><?= $pd->jenis_kelamin ?></td>
                                  <td>
                                    <?php foreach ($stat as $s) {
                                      if ($s->id == $pd->status_penerimaan) { ?>
                                        <span class="badge rounded-pill bg-primary"><?=$s->nama_opsi;?></span>
                                      <?php } ?>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalVerifikasi<?= $pd->id_ref ?>">Ubah Status</a>
                                    <a href="<?= site_url('profil-siswa/' . $pd->id_ref) ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalEdit<?= $pd->id_ref ?>">Hapus</a>
                                  </td>
                                </tr>

                              <?php } ?>
                              <div class="modal fade" id="alertModalVerifikasi<?= $pd->id_ref ?>" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="kalenderModalLabel">Ubah Status</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/status-penerimaan/<?= $pd->id_ref ?>">
                                        <div class="row mb-2">
                                          <label for="Status" class="col-3 col-form-label">Status<span class="text-danger">*</span></label>
                                          <div class="col-9">
                                            <select class="form-select" aria-label="Default select example" name="status" id="status" required>
                                              <?php foreach ($stat as $s) {
                                                if ($s->id == $pd->status_penerimaan) {
                                                  echo '<option selected value="' . $s->id . '">' . $s->nama_opsi . '</option>';
                                                } else echo '<option value="' . $s->id . '">' . $s->nama_opsi . '</option>';
                                              } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" class="btn btn-success">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal fade" id="alertModalEdit<?= $pd->id_ref ?>" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="kalenderModalLabel">Hapus Data Pendaftar</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/delete-pendaftar/<?= $pd->id_ref ?>">
                                        <p class="">Apakah anda yakin menghapus pendaftar '<?= $pd->nama_lengkap ?>'?</p>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="sliderModal<?= $j->id ?>" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="sliderModalLabel">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post" action="<?= site_url('import/'. $tahap->id)?>" enctype="multipart/form-data">
                    <div class="modal-body">
                      <a href="<?= base_url('FILE_TEMPLATE.xlsx')?>" class="btn btn-sm btn-success">Download File Template</a>
                      <br>
                      <div class="form-group pt-3">
                        <label>File Excel</label>
                        <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx">
                        <small class="text-danger">*Pastikan data yang di import sesuai dengan format</small>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                    <input type="text" class="form-control border-0" id="periode" name="periode" value="<?= $periode->id ?>" hidden>
                    <input type="text" class="form-control border-0" id="tahap" name="tahap" value="<?= $tahap->id ?>" hidden>
                    <input type="text" class="form-control border-0" id="jalur" name="jalur" value="<?= $jalur1->id ?>" hidden>
                    <input type="text" id="nomor_pendaftaran" name="nomor_pendaftaran" class="border-0 form-control fw-bold" value="<?= $nomor_pendaftar ?>" hidden>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="123456" hidden>
                  </form>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="tab-pane fade show active" id="profile-feed<?= $j->id ?>" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
              <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between pb-4">
                  <div class="header-title">
                    <div class="btn-group">
                      <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-file-download"></i>&nbsp;&nbsp;Ekspor
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= site_url('export/'. $tahap->id)?>">Semua Data Pendaftar</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('export-accepted/'. $tahap->id)?>">Data Pendaftar Yang Diterima</a></li>
                      </ul>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#sliderModal<?= $j->id ?>">
                        <i class="fas fa-file-upload"></i>&nbsp;&nbsp;Impor
                      </button>
                    </div>
                  </div>

                </div>
                <div class="card-body py-0">
                  <div class="table-responsive">
                    <table id="datatable" class="table" data-toggle="data-table">
                      <thead>
                        <tr>
                          <th>Nomor Pendaftaran</th>
                          <th>Nama</th>
                          <th>Jenis Kelamin</th>
                          <th>Status Pendaftaran</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($pendaftaran as $p) {
                          if ($j->id == $p->jalur) {
                            foreach ($pendaftar as $pd) {
                              if ($p->id_pendaftar  == $pd->id_ref) { ?>
                                <tr>
                                  <td><?= $pd->nomor_pendaftaran ?></td>
                                  <td><?= $pd->nama_lengkap ?></td>
                                  <td><?= $pd->jenis_kelamin ?></td>
                                  <td>
                                    <?php foreach ($stat as $s) {
                                      if ($s->id == $pd->status_penerimaan) { ?>
                                        <span class="badge rounded-pill bg-primary"><?=$s->nama_opsi;?></span>
                                      <?php } ?>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalVerifikasi<?= $pd->id_ref ?>">Ubah Status</a>
                                    <a href="<?= site_url('profil-siswa/' . $pd->id_ref) ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalEdit<?= $pd->id_ref ?>">Hapus</a>
                                  </td>
                                </tr>

                              <?php } ?>
                              <div class="modal fade" id="alertModalVerifikasi<?= $pd->id_ref ?>" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="kalenderModalLabel">Ubah Status</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/status-penerimaan/<?= $pd->id_ref ?>">
                                        <div class="row mb-2">
                                          <label for="Status" class="col-3 col-form-label">Status<span class="text-danger">*</span></label>
                                          <div class="col-9">
                                            <select class="form-select" aria-label="Default select example" name="status" id="status" required>
                                              <?php foreach ($stat as $s) {
                                                if ($s->id == $pd->status_penerimaan) {
                                                  echo '<option selected value="' . $s->id . '">' . $s->nama_opsi . '</option>';
                                                } else echo '<option value="' . $s->id . '">' . $s->nama_opsi . '</option>';
                                              } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" class="btn btn-success">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal fade" id="alertModalEdit<?= $pd->id_ref ?>" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="kalenderModalLabel">Hapus Data Pendaftar</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/delete-pendaftar/<?= $pd->id_ref ?>">
                                        <p class="">Apakah anda yakin menghapus pendaftar '<?= $pd->nama_lengkap ?>'?</p>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="sliderModal<?= $j->id ?>" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="sliderModalLabel">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post" action="<?= site_url('import/'. $tahap->id)?>" enctype="multipart/form-data">
                    <div class="modal-body">
                      <a href="<?= base_url('FILE_TEMPLATE.xlsx')?>" class="btn btn-sm btn-success">Download File Template</a>
                      <br>
                      <div class="form-group pt-3">
                        <label>File Excel</label>
                        <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx">
                        <small class="text-danger">*Pastikan data yang di import sesuai dengan format</small>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                    <input type="text" class="form-control border-0" id="periode" name="periode" value="<?= $periode->id ?>" hidden>
                    <input type="text" class="form-control border-0" id="tahap" name="tahap" value="<?= $tahap->id ?>" hidden>
                    <input type="text" class="form-control border-0" id="jalur" name="jalur" value="<?= $jalur1->id ?>" hidden>
                    <input type="text" id="nomor_pendaftaran" name="nomor_pendaftaran" class="border-0 form-control fw-bold" value="<?= $nomor_pendaftar ?>" hidden>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="123456" hidden>
                  </form>
                </div>
              </div>
            </div>
          <?php }
          $nomor++;
        } ?>
      </div>
    <?php endif ?>

  </div>
</div>
<?= $this->endSection() ?>