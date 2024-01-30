<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <div class="header-title">
          <a href="#" class="card-title btn btn-primary align-self-end" data-bs-toggle="modal" data-bs-target="#sliderModal">+ Tambah Data</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatable" class="table" data-toggle="data-table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Agenda</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($agenda as $k) :
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td>
                    <?= $k->nama_agenda ?>
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
                    if ($k->tanggal_selesai != "") {
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
                        <h5 class="modal-title" id="kalenderModalLabel">Edit Agenda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/update-agenda/<?= $k->id ?>">
                          <div class="row mb-2">

                            <label for="Periode" class="col-3 col-form-label">Periode<span class="text-danger">*</span></label>
                            <div class="col-9">
                              <select class="form-select" aria-label="Default select example" name="periode_id" id="periode_id" required>
                                <option selected value="">.:Pilih Periode:.</option>
                                <?php
                                foreach ($periode as $row) {
                                  $stat = ($k->periode_id == $row->id) ? 'selected' : '';
                                  echo '<option value="' . $row->id . '" ' . $stat . '>' . $row->nama_periode . '</option>';
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="NamaAgenda" class="col-3 col-form-label">Nama Agenda<span class="text-danger">*</span></label>
                            <div class="col-9">
                              <input type="text" class="form-control " id="nama_agenda" name="nama_agenda" value="<?= $k->nama_agenda ?>" maxlength="100" required>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="SubNama" class="col-3 col-form-label">Sub Nama</label>
                            <div class="col-9">
                              <input type="text" class="form-control " id="sub_nama" name="sub_nama" value="<?= $k->sub_nama ?>" maxlength="100" required>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="Deskripsi" class="col-3 col-form-label">Keterangan</label>
                            <div class="col-9">
                              <textarea class="form-control" name="keterangan" id="keterangan" rows="3"><?= $k->keterangan ?></textarea>
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
                        <h5 class="modal-title" id="kalenderModalLabel">Hapus Agenda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/delete-agenda/<?= $k->id ?>">
                          <p class="">Apakah anda yakin menghapus agenda '<?= $k->nama_agenda ?>'?</p>
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
        <h5 class="modal-title" id="sliderModalLabel">Tambah Agenda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 mt-2" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/add-agenda">
          <div class="row mb-2">
            <label for="Periode" class="col-3 col-form-label">Periode<span class="text-danger">*</span></label>

            <div class="col-9">
              <select class="form-select" aria-label="Default select example" id="periode_id" name="periode_id" required>
                <option selected value="">.:Pilih Periode:.</option>
                <?php foreach ($periode as $row) { ?>
                  <option value="<?= $row->id ?>" <?= set_select('periode_id', $row->id, false) ?>><?= $row->nama_periode ?></option>;
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row mb-2">
            <label for="NamaAgenda" class="col-3 col-form-label">Nama Agenda<span class="text-danger">*</span></label>
            <div class="col-9">
              <input type="text" class="form-control " id="nama_agenda" name="nama_agenda" maxlength="100" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="SubNama" class="col-3 col-form-label">Sub Nama</label>
            <div class="col-9">
              <input type="text" class="form-control " id="sub_nama" name="sub_nama" maxlength="100" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="Deskripsi" class="col-3 col-form-label">Keterangan</label>
            <div class="col-9">
              <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
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
