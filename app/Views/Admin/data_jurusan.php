<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<div class="container border-0 pt-4 pb-4 ps-0">
    <div class="pb-3">
        <h3 class="border-bottom pb-3">Jurusan/Keahlian</h3>
    </div>
    <div class="pb-3">
        <div class="d-flex">
            <a href="#" class="btn btn-primary align-self-end" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Tambah Data</a>
        </div>
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
    <div class="table-responsive">
        <table id="" class="display table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Jurusan</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($jurusan as $k) :
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td>
                            <?= $k->nama_jurusan ?>
                        </td>
                        <td><?= $k->status ?></td>
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
                                    <h5 class="modal-title" id="kalenderModalLabel">Edit Jurusan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/update-jurusan/<?= $k->id ?>">
                                        <div class="row mb-2">
                                            <label for="NamaPriode" class="col-3 col-form-label">Nama Jurusan<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="text" class="form-control " id="nama_jurusan" name="nama_jurusan" value="<?= $k->nama_jurusan ?>" maxlength="30" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="Deskripsi" class="col-3 col-form-label">Deskripsi</label>
                                            <div class="col-9">
                                            <textarea id="tiny" name="deskripsi"><?= $k->deskripsi ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="FileGambar" class="col-3 col-form-label">File Gambar<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <img id="frame" src="<?= base_url('assets/' . $k->file_foto); ?>" class="card-img-top" style="object-fit: contain; width:150px; height:200px;" alt="Foto Profil" />
                                                <input class="form-control" type="file" id="file_foto" name="file_foto" required>
                                                <span class="text-danger"><small>Tipe file : PNG/JPG/JPEG <br> Ukuran maks. : 2MB</small></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="Status" class="col-3 col-form-label">Status<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="aktif" name="status" <?php echo ($k->status == 'aktif') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Aktif</label>
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
                                    <h5 class="modal-title" id="kalenderModalLabel">Hapus Jurusan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/delete-jurusan/<?= $k->id ?>">
                                        <p class="">Apakah anda yakin menghapus jurusan '<?= $k->nama_jurusan ?>'?</p>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sliderModalLabel">Tambah Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/add-jurusan">
                    <div class="row mb-2">
                        <label for="NamaJurusan" class="col-3 col-form-label">Nama Jurusan<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input required type="text" class="form-control " id="nama_jurusan" name="nama_jurusan" placeholder="Nama Jurusan" maxlength="30">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="Deskripsi" class="col-3 col-form-label">Deskripsi<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <textarea id="tiny" name="deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="FileGambar" class="col-3 col-form-label">File Gambar<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <img id="frame" src="<?= base_url('assets/' . 'blank-user.png'); ?>" class="card-img-top" style="object-fit: contain; width:150px; height:200px;" alt="Foto Profil" />
                            <input class="form-control" type="file" id="file_foto" name="file_foto" onchange="preview()" required>
                            <span class="text-danger"><small>Tipe file : PNG/JPG/JPEG <br> Ukuran maks. : 2MB</small></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="Status" class="col-3 col-form-label">Status</label>
                        <div class="col-9">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="aktif" name="status" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Aktif</label>
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