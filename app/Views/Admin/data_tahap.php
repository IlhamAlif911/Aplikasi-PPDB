<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<div class="container border-0 pt-4 pb-4 ps-0">
    <div class="pb-3">
        <h3 class="border-bottom pb-3">Tahap PPDB</h3>
    </div>
    <div class="pb-3">
        <div class="d-flex">
            <a href="#" class="btn btn-primary align-self-end" data-bs-toggle="modal" data-bs-target="#sliderModal">+ Tambah Data</a>
        </div>
    </div>
    <div class="table-responsive">
    <table id="" class="display table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Periode</th>
                <th>Nama Tahap</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $tanggal_mulai = "";
            $tanggal_selesai ="";
            foreach ($tahap as $k) :
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td>
                        <?php
                        foreach ($periode as $p) {
                            if ($k->id_periode == $p->id) {
                                echo $p->nama_periode;
                            }
                        } ?>
                    </td>
                    <td>
                        <?= $k->nama_tahap ?>
                    </td>
                    <td>
                        <?php
                        if ($k->tanggal_mulai != "") {
                            $pecah = explode('-', $k->tanggal_mulai);
                            $tanggal_mulai = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
                            echo $tanggal_mulai;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($k->tanggal_mulai != "") {
                            $pecah = explode('-', $k->tanggal_selesai);
                            $tanggal_selesai = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
                            echo $tanggal_selesai;
                        }
                        ?>
                    </td>
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
                                <h5 class="modal-title" id="kalenderModalLabel">Edit Periode</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/update-tahap/<?= $k->id ?>">
                                    <div class="row mb-2">
                                        <label for="Periode" class="col-3 col-form-label">Periode</label>
                                        <div class="col-9">
                                            <select class="form-select" aria-label="Default select example" name="periode" id="periode" required>
                                                <option selected>.:Pilih Periode:.</option>
                                                <?php foreach ($periode as $p) {
                                                    if ($p->id == $k->id_periode) { ?>
                                                        <option value="<?= $p->id ?>" selected><?= $p->nama_periode ?></option>
                                                    <?php } else ?>
                                                    <option value="<?= $p->id ?>"><?= $p->nama_periode ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="NamaTahap" class="col-3 col-form-label">Nama Tahap<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <input required type="text" class="form-control " id="nama_tahap" name="nama_tahap" value="<?= $k->nama_tahap ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="input-group input-daterange">
                                            <div class="row">
                                                <label for="TanggalMulai" class="col-3 col-form-label">Tanggal Mulai<span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control mb-0" id="autoSizingInputGroup" name="tanggal_mulai" value="<?= $tanggal_mulai ?>" required>
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                                <label for="TanggalSelesai" class="mb-2 col-3 col-form-label">Tanggal Selesai<span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control mb-0" id="autoSizingInputGroup" name="tanggal_selesai" value="<?= $tanggal_selesai ?>" required>
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
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
                                <h5 class="modal-title" id="kalenderModalLabel">Hapus Periode</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/delete-tahap/<?= $k->id ?>">
                                    <p class="">Apakah anda yakin menghapus tahap '<?= $k->nama_tahap ?>'?</p>
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

<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sliderModalLabel">Tambah Tahap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/add-tahap">
                    <div class="row mb-2">
                        <label for="Periode" class="col-3 col-form-label">Periode</label>
                        <div class="col-9">
                            <select class="form-select" aria-label="Default select example" name="periode" id="periode" required>
                                <option selected value="">.:Pilih Periode:.</option>
                                <?php foreach ($periode as $p) { ?>
                                    <option value="<?= $p->id ?>"><?= $p->nama_periode ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="NamaTahap" class="col-3 col-form-label">Nama Tahap<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input required type="text" class="form-control " id="nama_tahap" name="nama_tahap" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-daterange">
                            <div class="row">
                                <label for="TanggalMulai" class="col-3 col-form-label">Tanggal Mulai<span class="text-danger">*</span></label>
                                <div class="col-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control mb-0" id="autoSizingInputGroup" name="tanggal_mulai" required>
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <label for="TanggalSelesai" class="mb-2 col-3 col-form-label">Tanggal Selesai<span class="text-danger">*</span></label>
                                <div class="col-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control mb-0" id="autoSizingInputGroup" name="tanggal_selesai" required>
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
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