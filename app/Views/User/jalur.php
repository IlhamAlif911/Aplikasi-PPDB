<?= $this->extend('User/index.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-5 mb-4">
    <div class="container">
        <div class="mt-5 mb-5">
            <h2 class="">Pilih Jalur Pendaftaran</h2>
            <p>Silakan memilih jalur pendaftaran pada PPDB 2023/2024.</p>
        </div>
        <div class="d-flex justify-content-center flex-wrap">
            <?php foreach ($jalur as $j) : 
                if($j->opsi_jalur == $kode_reguler){?>
                <div class="mt-2 mb-2">
                    <a href="<?= site_url('formulir-pendaftaran/'.$j->id) ?>" class="text-decoration-none">
                        <div class="card border-primary btn btn-outline-primary rounded-4" style="width:20rem;height:20rem;">
                            <i class="fa fa-map-marker fa-3x"></i>
                            <h3 class="mt-3 card-title">Jalur <?= $j->nama_jalur ?></h3>
                        </div>
                    </a>
                </div>
                <?php } else if($j->opsi_jalur == $kode_prestasi){?>
                <div class="mt-2 mb-2">
                    <a href="<?= site_url('formulir-pendaftaran-prestasi/'.$j->id) ?>" class="text-decoration-none">
                        <div class="card border-primary btn btn-outline-primary rounded-4" style="width:20rem;height:20rem;">
                            <i class="fa fa-trophy fa-3x"></i>
                            <h3 class="mt-3 card-title">Jalur <?= $j->nama_jalur ?></h3>
                        </div>
                    </a>
                </div>
                <?php } else if($j->opsi_jalur == $kode_afirmasi){?>
                <div class="mt-2 mb-2">
                    <a href="<?= site_url('formulir-pendaftaran-afirmasi/'.$j->id) ?>" class="text-decoration-none">
                        <div class="card border-primary btn btn-outline-primary rounded-4" style="width:20rem;height:20rem;">
                            <i class="fa fa-graduation-cap fa-3x"></i>
                            <h3 class="mt-3 card-title">Jalur <?= $j->nama_jalur ?></h3>
                        </div>
                    </a>
                </div>
            <?php } endforeach ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>