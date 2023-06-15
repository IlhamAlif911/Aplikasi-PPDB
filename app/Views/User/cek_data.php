<?= $this->extend('User/index.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-5 mb-4">
    <div class="container">
        <div class="mt-5 mb-5">
            <h2 class="">Cek Data</h2>
            <p>Silakan memasukkan nama lengkap dan nomor pendaftaran pada form yang tersedia untuk mengetahui status pendaftaran anda.</p>
        </div>
        <div class="d-flex justify-content-center">
            <form action="" style="width: 45rem;">
                <div class="mb-3">
                    <input type="text" id="nama" name="nama" class="form-control form-control-lg" placeholder="Nama Lengkap" value="" required>
                </div>
                <div class="mb-3">
                    <input type="text" id="nomor_pendaftaran" name="nomor_pendaftaran" class="form-control form-control-lg" placeholder="Nomor Pendaftaran" value="" required>
                </div>
                <div class="">
                    <button class="btn btn-primary btn-lg col-12" type="button" id="cek_data" name="cek_data">Cek Data</button>
                </div>
            </form>
        </div>
        <div class="mt-5 border-top border-1 d-flex justify-content-center">
            <div name="result_data" id="result_data">
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>