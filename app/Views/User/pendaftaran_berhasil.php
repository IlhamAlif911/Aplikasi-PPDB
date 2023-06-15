<?= $this->extend('User/index.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-5 mb-4">
    <div class="container text-center">
        <div class="mt-5 mb-5">
            <h2 class="">Pendaftaran Anda Berhasil!</h2>
            <p>Silakan simpan nomor pendaftaran anda untuk mengecek status pendaftaran pada halaman <a href="<?= site_url('cek-data') ?>">Cek Data</a> atau login untuk daftar ulang</p>
        </div>
        <div class="mt-5 border-top border-1 d-flex justify-content-center">
            <div class="card mt-5 shadow" style="width: 40rem;">
                <div class="card-body text-center">
                    <p class="card-title h2 pb-3"><?= $pendaftar->nama_lengkap ?></p>
                        <p class="">No. Pendaftaran</p>
                        <p class="fw-bold"><?= $user->nomor_pendaftaran ?></p>
                        <p class="">Status Pendaftaran</p>
                        <p class="fw-bold bg-danger text-white rounded-4 p-2"><?= $status_penerimaan->nama_opsi ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>