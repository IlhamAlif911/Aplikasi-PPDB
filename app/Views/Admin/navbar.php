<header class="header shadow-sm bg-white header-pd" id="header">
    <div class="header_toggle"> <i class='bx bx-menu bx-x' id="header-toggle"></i> Menu </div>
    <?php if (session()->get('role') == '1') { ?>
        <div>
            <h5>Selamat Datang <?= session()->get('nama_user')?></h5>
        </div>
    <?php } else{ ?>
        <div class="row">
            <h5>Selamat datang <?= session()->get('nama_user')?></h5>
            
            
        </div>
    
    
    <?php } ?>
</header>
<div class="l-navbar border-end show-side" id="nav-bar">
    <nav class="nav-side">
        <div> <a href="<?= site_url('/') ?>" class="nav_logo"> <i class='bx bxs-school nav_logo-icon'></i> <span class="nav_logo-name">SMK YPE KROYA</span> </a>
            <?php if (session()->get('role') == '1') { ?>
                <div class="nav_list">
                    <a href="<?= site_url('dashboard') ?>" class="nav_link <?php if ($page == 'dashboard') echo 'active' ?>">
                        <i class='bx bxs-pie-chart-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                        <a href="#" class="nav_link <?php if ($page == 'tahap') echo 'active' ?>" role="button">
                            <i class='bx bx-time nav_icon'></i>
                            <span class="nav_name dropdown-toggle">Tahap PPDB</span>
                        </a>
                    </button>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse mb-3" aria-labelledby="panelsStayOpen-headingOne">
                        <ul class="list-group ms-4 list-unstyled">
                            <li><a class="list-group-item" href="<?= site_url('data-periode') ?>">Periode</a></li>
                            <li><a class="list-group-item" href="<?= site_url('data-tahap') ?>">Tahap</a></li>
                            <li><a class="list-group-item" href="<?= site_url('data-jalur') ?>">Jalur</a></li>
                        </ul>
                    </div>
                    <a href="<?= site_url('pilih-tahap/'.session()->get('periode')) ?>" class="nav_link <?php if ($page == 'pendaftar') echo 'active' ?>">
                        <i class='bx bxs-spreadsheet nav_icon'></i>
                        <span class="nav_name">Data Pendaftar</span>
                    </a>
                    <a href="<?= site_url('data-jurusan') ?>" class="nav_link <?php if ($page == 'jurusan') echo 'active' ?>">
                        <i class='bx bx-task nav_icon'></i>
                        <span class="nav_name">Jurusan/Keahlian</span>
                    </a>
                    <a href="<?= site_url('data-pembayaran') ?>" class="nav_link <?php if ($page == 'pembayaran') echo 'active' ?>">
                        <i class='bx bx-money nav_icon'></i>
                        <span class="nav_name">Pembayaran</span>
                    </a>
                    <a href="<?= site_url('data-agenda') ?>" class="nav_link <?php if ($page == 'agenda') echo 'active' ?>">
                        <i class='bx bx-calendar nav_icon'></i>
                        <span class="nav_name">Agenda</span>
                    </a>
                    <a href="<?= site_url('data-akun') ?>" class="nav_link <?php if ($page == 'akun') echo 'active' ?>">
                        <i class='bx bxs-user nav_icon'></i>
                        <span class="nav_name">Akun</span>
                    </a>
                    <a href="<?= site_url('data-sekolah') ?>" class="nav_link <?php if ($page == 'sekolah') echo 'active' ?>">
                        <i class='bx bxs-school nav_icon'></i>
                        <span class="nav_name">Data Sekolah</span>
                    </a>
                    <a href="<?= site_url('kategori-kode') ?>" class="nav_link <?php if ($page == 'kategori') echo 'active' ?>">
                        <i class='bx bx-code nav_icon'></i>
                        <span class="nav_name">Kode Opsi</span>
                    </a>
                </div>
            <?php } else{ ?>
                <div class="nav_list">
                    <a title="Dashboard" href="<?= site_url('dashboard-siswa') ?>" class="nav_link <?php if ($page == 'dashboard-siswa') echo 'active' ?>">
                        <i class='bx bxs-pie-chart-alt nav_icon'></i>
                        <span label="Dashboard" class="nav_name">Dashboard</span>
                    </a>
                    <a title="Daftar Ulang" href="<?= site_url('registrasi-ulang/'.session()->get('id_ref')) ?>" class="nav_link <?php if ($page == 'profil') echo 'active' ?>">
                        <i class='bx bxs-spreadsheet nav_icon'></i>
                        <span class="nav_name">Daftar Ulang</span>
                    </a>
                    <a title="Pembayaran" href="<?= site_url('konfirmasi-pembayaran/'.session()->get('id_ref')) ?>" class="nav_link <?php if ($page == 'pembayaran') echo 'active' ?>">
                        <i class='bx bx-money nav_icon'></i>
                        <span class="nav_name">Pembayaran</span>
                    </a>
                </div>
            <?php } ?>
                <a href="<?= site_url('logout') ?>" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Logout</span> </a>
        </div> 
    </nav>
</div>