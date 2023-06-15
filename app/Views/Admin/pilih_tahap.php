<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<div class="container border-0 pt-4 pb-4 ps-0">
    <div class="pb-3">
        <h3 class="border-bottom pb-3">Pilih Tahap</h3>
    </div>
    <div class="d-flex justify-content-center flex-wrap text-center">
        <?php $date = date('Y-m-d');
        foreach ($tahap as $t) :?>
                <div class="ms-2 me-2 text-center">
                    <a href="<?= site_url('data-pendaftar/' . $t->id) ?>" class="text-decoration-none text-center">
                        <div class="card border-primary btn btn-outline-primary rounded-4 text-center" style="width:20rem;height:10rem;">
                            <h3 class="mt-3 card-text"><?= $t->nama_tahap ?></h3>
                        </div>
                    </a>
                </div>
        <?php
        endforeach ?>
    </div>
</div>


<?= $this->endSection() ?>