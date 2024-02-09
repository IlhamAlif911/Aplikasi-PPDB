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
                                <th>Nama Periode</th>
                                <th>Nama Tahap</th>
                                <th>Nama Jalur</th>
                                <th>Kuota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($jalur as $k) :
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?php
                                        foreach ($tahap as $pe) {
                                            if ($k->id_tahap == $pe->id) {
                                                foreach ($periode as $p) {
                                                    if ($pe->id_periode == $p->id) {
                                                        echo $p->nama_periode;
                                                    }
                                                } ?>

                                            </td>
                                            <td>
                                                <?php
                                                echo $pe->nama_tahap;
                                            }
                                        } ?>
                                    </td>
                                    <td><?= $k->nama_jalur ?></td>
                                    <td><?= $k->kuota ?></td>
                                    <td>
                                        <div class="text-center">
                                            <a href="#" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" value="<?= $k->id ?>" id="edit_jurusan" name="edit_jurusan" data-bs-target="#kalenderModalEdit<?= $k->id ?>">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#alertModalEdit<?= $k->id ?>">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="kalenderModalEdit<?= $k->id ?>" tabindex="-1" aria-labelledby="kalenderModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="kalenderModalLabel">Edit Jalur</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/update-jalur/<?= $k->id ?>">
                                                    <div class="row mb-2">
                                                        <label for="Tahap" class="col-3 col-form-label">Periode dan Tahap<span class="text-danger">*</span></label>
                                                        <div class="col-9">
                                                            <select class="form-select" aria-label="Default select example" name="tahap" id="tahap" required>
                                                                <option selected value="">.:Pilih Periode dan Tahap:.</option>
                                                                <?php foreach ($tahap as $p) {
                                                                    if ($p->id == $k->id_tahap) { ?>
                                                                        <option value="<?= $p->id ?>" selected><?php foreach ($periode as $pe) {
                                                                            if ($pe->id == $p->id_periode) echo $pe->nama_periode;
                                                                        } ?>/<?= $p->nama_tahap ?></option>
                                                                    <?php } else ?>
                                                                    <option value="<?= $p->id ?>"><?php foreach ($periode as $pe) {
                                                                        if ($pe->id == $p->id_periode) echo $pe->nama_periode;
                                                                    } ?>/<?= $p->nama_tahap ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="JenisForm" class="col-3 col-form-label">Jenis Form<span class="text-danger">*</span></label>
                                                        <div class="col-9">
                                                            <select class="form-select" aria-label="Default select example" name="opsi_jalur" id="opsi_jalur" required>
                                                                <option selected value="">.:Pilih Jenis Form:.</option>
                                                                <?php foreach ($opsi_jalur as $p) {
                                                                    if ($p->id == $k->opsi_jalur) { ?>
                                                                        <option value="<?= $p->id ?>" selected><?= $p->nama_opsi ?></option>
                                                                    <?php } else ?>
                                                                    <option value="<?= $p->id ?>"><?= $p->nama_opsi ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="NamaJalur" class="col-3 col-form-label">Nama Jalur<span class="text-danger">*</span></label>
                                                        <div class="col-9">
                                                            <input required type="text" class="form-control " id="nama_jalur" name="nama_jalur" value="<?= $k->nama_jalur ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="NamaKuota" class="col-3 col-form-label">Kuota</label>
                                                        <div class="col-9">
                                                            <input required type="text" class="form-control " id="kuota" name="kuota" value="<?= $k->kuota ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="Syarat" class="col-3 col-form-label">Syarat<span class="text-danger">*</span></label>
                                                        <div class="col-9">
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" aria-label="With textarea" name="syarat" rows="3"><?= $k->syarat ?></textarea>
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
                                                <h5 class="modal-title" id="kalenderModalLabel">Hapus Jalur</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/delete-jalur/<?= $k->id ?>">
                                                    <p class="">Apakah anda yakin menghapus jalur '<?= $k->nama_jalur ?>'?</p>
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
                <h5 class="modal-title" id="sliderModalLabel">Tambah Jalur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/add-jalur">
                    <div class="row mb-2">
                        <label for="Tahap" class="col-3 col-form-label">Periode dan Tahap<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select class="form-select" aria-label="Default select example" name="tahap" id="tahap" required>
                                <option selected value="">.:Pilih Periode dan Tahap:.</option>
                                <?php foreach ($tahap as $p) { ?>
                                    <option value="<?= $p->id ?>">
                                        <?php foreach ($periode as $pe) {
                                            if ($pe->id == $p->id_periode) echo $pe->nama_periode;
                                        } ?>
                                        /
                                        <?= $p->nama_tahap ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="JenisForm" class="col-3 col-form-label">Jenis Form<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select class="form-select" aria-label="Default select example" name="opsi_jalur" id="opsi_jalur" required>
                                <option selected value="">.:Pilih Jenis Form:.</option>
                                <?php foreach ($opsi_jalur as $p) { ?>
                                    <option value="<?= $p->id ?>"><?= $p->nama_opsi ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="NamaJalur" class="col-3 col-form-label">Nama Jalur<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input required type="text" class="form-control " id="nama_jalur[]" name="nama_jalur[]" placeholder="Nama Jalur" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="NamaKuota" class="col-3 col-form-label">Kuota</label>
                        <div class="col-9">
                            <input required type="number" class="form-control " id="kuota[]" name="kuota[]" placeholder="Kuota">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div id="dynamic_field_jalur">
                        </div>
                        <div class="d-flex justify-content-end mb-2">
                            <button type="button" name="add_jalur" id="add_jalur" class="btn btn-success me-2">+ Tambah Jalur</button>
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