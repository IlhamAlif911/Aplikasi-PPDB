<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<!--Container Main start-->
<div class="container border-0 pt-4 pb-4 ps-0">
    <h3 class="mb-4">Dashboard</h3>
    <h3 class="fw-bold">PPDB </h3>

    <div class="row">
        <div class="col-xl-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column text-center align-items-center">
                        <div class="flex-grow-1 pt-4">
                            <h5>Jalur Reguler</h5>
                            <div class="mb-4">
                                <span class="badge rounded-pill bg-success">In Progress</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Footer states-->
                <div class="card-footer py-0 border-top">
                    <div class="row">
                        <div class="col text-center p-3">
                            <h4 class="fs-5 mb-1"><?= count($pendaftar_p)?></h4>
                            <span class="d-block font-size-sm">Perempuan</span>
                        </div>
                        <div class="col p-3 text-center border-end border-start">
                            <h4 class="fs-5 mb-1"><?= count($pendaftar_laki)?></h4>
                            <span class="d-block font-size-sm">Laki-laki</span>
                        </div>
                        <div class="col p-3 text-center">
                            <h4 class="fs-5 mb-1"><?= count($pendaftar)?></h4>
                            <span class="d-block font-size-sm">Total</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm p-2" style="height: auto;">
                <h5 class="h5 p-2">Grafik Pendaftar</h5>    
                <select class="form-select form-select-sm mb-4" style="width: 300px;" name="dashboard_periode" id="dashboard_periode">
                    <option selected value="<?= $get_periode->id?>"><?= $get_periode->nama_periode?></option>
                        <?php
                        foreach ($periode_get as $row) { ?>
                            <option value="<?= $row->id ?>"><?= $row->nama_periode ?></option>;
                        <?php }
                        ?> 
                </select>
                <div>
                    <canvas id="perda" style="width: 900px; height: 250px; margin: 0 auto"></canvas>
                </div>
                
                
            </div>
        </div>
    </div>

    <!-- <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm p-2" style="height: 480px;">
                <h5 class="h5 p-2">Grafik Penerimaan Siswa</h5>
                <select class="form-select form-select-sm mb-4" style="width: 300px;" name="" id="">
                    <option value="">.: Pilih Periode :.</option>
                </select>
                <div class="" id="chart2">
                </div>
            </div>
        </div>
    </div> -->

</div>
<!--Container Main end-->

<?= $this->endSection() ?>