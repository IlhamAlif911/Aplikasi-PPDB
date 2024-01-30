<?= $this->extend($layout) ?>

<?= $this->section('content') ?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
            <div class="header-title">
               <h4 class="card-title">Pembayaran PPDB</h4>
            </div>
         </div>
            <div class="card-body">
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
                <form method="post" id="payment-form" enctype="multipart/form-data" action="<?= base_url('midtrans/finish') ?>">
                    <div class="row mb-3">
                        <label for="NomorPendaftaran" class="col-sm-2 col-form-label">Nomor Pendaftaran<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor_pendaftaran" name="nomor_pendaftaran" value="<?= $user->nomor_pendaftaran ?>" readonly>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="NamaLengkap" class="col-sm-2 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $pendaftar->nama_lengkap ?>" readonly>
                            
                        </div>
                    </div>
                    <input type="hidden" id="nama_pembayaran" name="nama_pembayaran" value="Pembayaran PPDB - <?= $user->nomor_pendaftaran ?>">

                    <input type="hidden" id="email" name="email" value="<?= $pendaftar->email ?>">
                    <input type="hidden" id="address" name="address" value="<?= $pendaftar->alamat ?>">
                    <input type="hidden" id="city" name="city" value="<?= $city['city_name'] ?>">
                    <input type="hidden" id="kodepos" name="kodepos" value="<?= $postalcode['postal_id'] ?>">
                    <input type="hidden" id="phone" name="phone" value="<?= $pendaftar->nomor_hp ?>">


                    <div class="row mb-3">
                        <label for="NominalTransfer" class="col-sm-2 col-form-label">Nominal Bayar<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nominal_bayar" name="nominal_bayar" placeholder="Nominal Transfer" required>
                            <span class="text-danger">Angka saja tanpa titik atau koma. Contoh : 200000</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="BuktiTransfer" class="col-sm-2 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" placeholder="Bukti Transfer">
                        </div>
                    </div>
                    <!-- Don't Delete this element -->
                    <input type="hidden" name="result_type" id="result-type" value="">
                    <input type="hidden" name="result_data" id="result-data" value="">

                    <button type="submit" id="pay-button" class="btn btn-primary">Bayar</button>
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
        </div>
    </div>
</div>


<?= $this->endSection() ?>