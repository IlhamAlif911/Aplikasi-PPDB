<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<div class="container border-0 pt-4 pb-4 ps-0">
    <div class="pb-3">
        <h3 class="border-bottom pb-3">Data Siswa <?= $tahap->nama_tahap ?></h3>
        <?php if (session()->has('error')) : ?>
        <ul id="alert" class="alert alert-danger list-unstyled">
            <li><?= session('error') ?></li>
        </ul>
            <?php elseif (session()->has('alert')) : ?>
            <ul id="alert" class="alert alert-success list-unstyled">
                <li><?= session('alert') ?></li>
            </ul>
        <?php endif ?>
    </div>

<div class="pb-3">
    <div class="d-flex">
        <a href="<?= site_url('jalur/' . $tahap->id) ?>" class="btn btn-primary align-self-end">+ Tambah Data</a>
    </div>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <?php $nomor = 1;
    foreach ($jalur as $j) {
        if ($nomor == 1) { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab<?= $j->id ?>" data-bs-toggle="tab" data-bs-target="#home-tab-pane<?= $j->id ?>" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><?= $j->nama_jalur ?></button>
            </li>
        <?php } else { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="home-tab<?= $j->id ?>" data-bs-toggle="tab" data-bs-target="#home-tab-pane<?= $j->id ?>" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><?= $j->nama_jalur ?></button>
            </li>
        <?php }
        $nomor++;
    } ?>
</ul>
<div class="tab-content" id="nav-tabContent">
    <?php $nomor = 1;
    foreach ($jalur as $j) {
        if ($nomor == 1) { ?>
            <div class="tab-pane fade show active" id="home-tab-pane<?= $j->id ?>" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="flex pb-3 pt-3">
                    <div class="btn-group">
                        <a class="btn btn-success" type="button" href="<?= site_url('export/'. $tahap->id)?>">
                            <i class="fas fa-file-download"></i>&nbsp;&nbsp;Ekspor
                        </a>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#sliderModal<?= $j->id ?>">
                            <i class="fas fa-file-upload"></i>&nbsp;&nbsp;Impor
                        </button>
                    </div>
                </div>
                <div class="row pt-3">
                    <table id="" class="display table table-striped table-bordered" style="width:100%">
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
                                                <td><?php foreach ($stat as $s) {
                                                    if ($s->id == $pd->status_penerimaan) { ?>
                                                        <span class="badge badge-primary"><?=$s->nama_opsi;?></span>
                                                    <?php }
                                                } ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalVerifikasi<?= $pd->id_ref ?>">Ubah Status</a>
                                                <a href="<?= site_url('profil-siswa/' . $pd->id_ref) ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalEdit<?= $pd->id_ref ?>">Hapus</a>
                                            </td>
                                        </tr>
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

                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } else { ?>
            <div class="tab-pane fade show" id="home-tab-pane<?= $j->id ?>" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="flex pb-3 pt-3">
                    <div class="btn-group">
                        <a class="btn btn-success" type="button" href="<?= site_url('export/'. $tahap->id)?>">
                            <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp;Ekspor
                        </a>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#sliderModal<?= $j->id ?>">
                            <i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;Impor
                        </button>
                    </div>
                </div>
                <div class="row pt-3">
                    <table id="" class="display table table-striped table-bordered" style="width:100%">
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
                                                <td><?php foreach ($stat as $s) {
                                                    if ($s->id == $pd->status_penerimaan) { ?>
                                                        <span class="badge badge-primary"><?=$s->nama_opsi;?></span>
                                                    <?php }
                                                } ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalVerifikasi<?= $pd->id_ref ?>">Ubah Status</a>
                                                <a href="<?= site_url('profil-siswa/' . $pd->id_ref) ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalEdit<?= $pd->id_ref ?>">Hapus</a>
                                            </td>
                                        </tr>
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
                                        <div class="modal fade" id="sliderModal<?= $j->id ?>" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="sliderModalLabel">Import Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="">Download File Template <a href="https://ppdb.gumintang.com/file/import_data.xlsx" class="btn btn-outline-primary">Disini</a></p>
                                                        <form method="post" action="https://ppdb.gumintang.com/import/4" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label>File Excel</label>
                                                                <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
                                                            </div>
                                                            <div class="form-group">
                                                                <button class="btn btn-primary" type="submit">Upload</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                }
                            }
                        } ?>
                    </table>
                </div>
            </div>
        <?php }
        $nomor++;
    } ?>
</div>



<?= $this->endSection() ?>