<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top border-bottom p-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="<?= base_url('assets/' . 'Logo-YPE.png'); ?>" style="padding-bottom: 5px;" width="40px" alt="Logo SMK YPE" > SMK YPE KROYA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= site_url('/')?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/#alur')?>">Alur Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/#jurusan')?>">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/#jalur')?>">Jalur & Syarat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/#agenda')?>">Agenda PPDB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('cek-data')?>">Cek Data</a>
                </li>
            </ul>
        </div>
        <div class="d-flex justify-content-end" role="search">
            <?php if (session()->get('id_ref') == '') { ?>
                <a class="btn btn-outline-primary" href="<?= site_url('login')?>">Login</a>
                <?php if ($tahap) { ?>
                    <?= $daftar_nav ?>
                <?php } ?>
                
            <?php } else { ?>
                <?php if (session()->get('role') == '1') {?>
                    <a class="btn btn-outline-primary" href="<?= site_url('dashboard')?>">Dashboard</a>
                <?php } else { ?>
                    <a class="btn btn-outline-primary" href="<?= site_url('dashboard-siswa')?>">Dashboard</a>
                <?php } ?>
            <?php } ?>
            
        </div>
    </div>
</nav>