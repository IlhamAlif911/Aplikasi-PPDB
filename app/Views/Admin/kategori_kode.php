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
                <th>Nama Kategori</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($kategori as $k) :
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td>
                        <a class="text-decoration-none" href="<?= base_url(); ?>/edit-kategori/<?= $k->id ?>">
                            <?= $k->nama_kategori ?>
                        </a>
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
                                <h5 class="modal-title" id="kalenderModalLabel">Edit Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/update-kategori/<?= $k->id ?>">
                                    <div class="row mb-2">
                                        <label for="NamaKategori" class="col-3 col-form-label">Nama Kategori</label>
                                        <div class="col-9">
                                            <input required type="text" class="form-control " id="nama_kategori" name="nama_kategori" value="<?= $k->nama_kategori ?>" placeholder="Nama Kategori">
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
                                <h5 class="modal-title" id="kalenderModalLabel">Hapus Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/delete-kategori/<?= $k->id ?>">
                                    <p class="">Apakah anda yakin menghapus kategori '<?= $k->nama_kategori ?>'?</p>
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
        <h5 class="modal-title" id="sliderModalLabel">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/add-kategori">
          <div class="row mb-2">
            <label for="nama_kategori" class="col-3 col-form-label">Nama Kategori</label>
            <div class="col-9">
              <input required type="text" class="form-control " id="nama_kategori" name="nama_kategori" placeholder="Nama Kategori">
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