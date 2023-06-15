<?= $this->extend('User/index.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-5 mb-4">
    <div class="container">
        <div class="mt-5 mb-5">
            <h2 class="">Pilih Tahap Pendaftaran</h2>
            <p>Silakan memilih tahap pendaftaran pada PPDB 2023/2024.</p>
        </div>
        <div class="d-flex justify-content-center flex-wrap">
            <?php $date = date('Y-m-d');
            foreach ($tahap as $t) :
                if ($t->tanggal_mulai <= $date && $t->tanggal_selesai >= $date) { ?>
                    <div class="mt-2 mb-2">
                        <a href="<?= site_url('jalur/' . $t->id) ?>" class="text-decoration-none">
                            <div class="card border-primary btn btn-outline-primary rounded-4" style="width:20rem;height:20rem;">
                                <h3 class="mt-3 card-title">Tahap <?= $t->nama_tahap ?></h3>
                            </div>
                        </a>
                    </div>
            <?php }
            endforeach ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>