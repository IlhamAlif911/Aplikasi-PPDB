<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<div class="container border-0 pt-4 pb-4 ps-0">
    <div class="pb-3">
        <h3 class="border-bottom pb-3">Konfirmasi Pembayaran</h3>
        
        
    </div>
    <?php if (session()->has('error')) : ?>
        <ul id="alert" class="alert alert-danger list-unstyled">
            <li><?= session('error') ?></li>
        </ul>
    <?php elseif (session()->has('alert')) : ?>
        <ul id="alert" class="alert alert-success list-unstyled">
            <li><?= session('alert') ?></li>
        </ul>
    <?php endif ?>
    <?php if (!$pembayaran) { ?>
        <?php if ($stat->id == $pendaftar->status_penerimaan) { ?>
            <p>Silakan memasukkan data pada form yang tersedia untuk konfirmasi pembayaran.</p>
            <div class="">
                <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/add-konfirmasi-siswa">
                    <div class="row mb-3">
                        <label for="NomorPendaftaran" class="col-sm-2 col-form-label">Nomor Pendaftaran<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor_pendaftaran" name="nomor_pendaftaran" value="<?= $user->nomor_pendaftaran ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="NamaLengkap" class="col-sm-2 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $pendaftar->nama_lengkap ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="TanggalTransfer" class="col-sm-2 col-form-label">Tanggal Transfer<span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_transfer" required>
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="NamaPemilik" class="col-sm-2 col-form-label">Nama Pemilik Rekening<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_pemilik_rekening" name="nama_pemilik_rekening" placeholder="Nama Pemilik Rekening" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="NamaBank" class="col-sm-2 col-form-label">Nama Bank<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="Nama Bank" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="NominalTransfer" class="col-sm-2 col-form-label">Nominal Transfer<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nominal_transfer" name="nominal_transfer" placeholder="Nominal Transfer" required>
                            <span class="text-danger">Angka saja tanpa titik atau koma. Contoh : 200000</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="BuktiTransfer" class="col-sm-2 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" placeholder="Bukti Transfer">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary btn-lg col-12" type="submit" id="submit" name="submit">Konfirmasi</button>
                    </div>
                </form>
            </div>         
        <?php } else { ?>
            <ul class="alert alert-danger list-unstyled">
                <li>Anda belum melakukan daftar ulang.</li>
            </ul>
        <?php } ?>
    <?php } else { ?>
        <ul class="alert alert-success list-unstyled">
            <li>Anda sudah melakukan konfirmasi.</li>
        </ul>
    <?php } ?>
</div>

<?= $this->endSection() ?>