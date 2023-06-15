<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<div class="container border-0 pt-4 pb-4 ps-0">
    <div class="pb-3">
        <h3 class="border-bottom pb-3">Akun</h3>
    </div>
    <div class="pb-3">
        <div class="d-flex">
            <a href="#" class="btn btn-primary align-self-end" data-bs-toggle="modal" data-bs-target="#sliderModal">+ Tambah Data</a>
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
                    <th>Email</th>
                    <th>Role</th>
                    <th>Nomor Pendaftaran</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($user as $k) :
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $k->email ?></td>
                        <td>
                            <?php if ($k->role == '1') {
                                echo 'Admin';
                            } elseif ($k->role == '2') {
                                echo 'Siswa';
                            } ?>
                        </td>
                        <td><?= $k->nomor_pendaftaran ?></td>
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
                                    <h5 class="modal-title" id="kalenderModalLabel">Edit Akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/update-akun/<?= $k->id ?>">
                                        <div class="row mb-2">
                                            <label for="Email" class="col-3 col-form-label">Email<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input required type="email" class="form-control " id="email" name="email" value="<?= $k->email ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="Password" class="col-3 col-form-label">Ubah Password<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="KonfirmasiPassword" class="col-3 col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="password" id="konf_password" name="konf_password" class="form-control" placeholder="Konfirmasi Password">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="Status" class="col-3 col-form-label">Status<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <select class="form-select" aria-label="Default select example" name="status" id="status" required>
                                                    <option <?php if($k->status == 'aktif') echo 'selected'?> value="aktif">Aktif</option>
                                                    <option <?php if($k->status == 'tidak aktif') echo 'selected'?> value="tidak aktif">Tidak Aktif</option>
                                                </select>
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
                                    <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/delete-jalur/<?= $k->id ?>">
                                        <p class="">Apakah anda yakin menghapus akun '<?= $k->email ?>'?</p>
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
                <h5 class="modal-title" id="sliderModalLabel">Tambah Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/add-akun">
                    <div class="row mb-2">
                        <label for="Role" class="col-3 col-form-label">Role<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select class="form-select" aria-label="Default select example" name="role" id="role" required>
                                <option selected value="1">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="Email" class="col-3 col-form-label">Email<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input required type="email" class="form-control " id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="Password" class="col-3 col-form-label">Password<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="KonfirmasiPassword" class="col-3 col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="password" id="konf_password" name="konf_password" class="form-control" placeholder="Konfirmasi Password" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="Status" class="col-3 col-form-label">Status<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select class="form-select" aria-label="Default select example" name="status" id="status" required>
                                <option selected value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
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