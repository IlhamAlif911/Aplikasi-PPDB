<?= $this->extend('User/index.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-5 mb-4">
    <div class="container">
        <div class="mt-5 mb-5">
            <h2 class="">Daftar Agenda</h2>
            <p>Daftar Agenda PPDB 2023/2024.</p>
        </div>
        <div class="card">
            <?php
            $nomor = 1;
            foreach ($agenda as $k) : ?>
                <div class="pane border-bottom p-5">
                    <div class="d-flex align-items-center ms-3">
                        <?php
                        if ($k->tanggal_mulai != "") {
                            $pecah = explode('-', $k->tanggal_mulai);
                            $tanggal_mulai = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
                        } 
                        if ($k->tanggal_selesai != "") {
                            $pecah = explode('-', $k->tanggal_selesai);
                            $tanggal_selesai = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
                        }
                        ?>
                        <div class="text-center">
                            <i class="far fa-3x fa-calendar-alt text-primary ml-2" aria-hidden="true"></i>
                        </div>
                        <div class="ms-5">
                            <h2 class="card-title mb-1" style="font-weight: 600">
                                <?= $k->nama_agenda ?>
                            </h2>
                            <p class="card-text mb-2"><?= $k->sub_nama ?></p>
                            <p class="card-text mb-0 text-muted">Waktu : <?= $tanggal_mulai ?> - <?= $tanggal_selesai ?></p>
                            <p class="card-text mb-0 text-muted">
                                <?= $k->keterangan ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
            endforeach ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>