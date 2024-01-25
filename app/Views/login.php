<?= $this->extend('User/index.php') ?>

<?= $this->section('content') ?>
<section class="d-flex justify-content-center mt-1">
    <div class="card mt-4 mb-4 shadow rounded-5" style="width:600px;">
        <div class="row g-0 justify-content-center">
            <div class="col-10 d-flex align-items-center">
                <div class="card-body p-lg-5">
                    <div class="text-center mb-3 pb-1">
                        <a href="<?= site_url('/')?>" class="text-dark h3 fw-bold mb-0">SMK WIDYA MANDALA TAMBAK</a>
                    </div>
                    <h6 class="fw-normal text-center mb-3 pb-3" style="letter-spacing: 1px;">Login untuk masuk ke dashboard</h6>
                    <?php if (session()->has('alert')) : ?>
                    <ul class="alert alert-success list-unstyled">
                        <li><?= session('alert') ?></li>
                    </ul>
                <?php elseif (session()->has('error')) : ?>
                <ul class="alert alert-danger list-unstyled">
                    <li><?= session('error') ?></li>
                </ul>
            <?php endif ?>
            <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>/masuk">
                <div class="form-outline mb-4">
                    <input type="text" id="akun" name="akun" class="form-control form-control-lg" value="<?= set_value('akun')?>" required />
                    <label class="form-label" for="form2Example17">Masukkan e-mail/nomor pendaftaran</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                    <label class="form-label" for="form2Example27">Password</label>
                </div>
                <div class="pt-1">
                    <button class="btn btn-lg btn-block text-white" style="background-color: #4D7C0F;" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</section>
<?= $this->endSection() ?>