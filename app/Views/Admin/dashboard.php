<?= $this->extend($layout) ?>

<?= $this->section('content') ?>
<div class="row">
   <div class="col-md-12 col-lg-12">
      <div class="row row-cols-1">
         <div class="d-slider1 overflow-hidden ">
            <ul  class="swiper-wrapper list-inline m-0 p-0 mb-2" >
               <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                  <div class="card-body">
                     <div class="progress-detail">
                        <p class="mb-2">Total Pendaftar</p>
                        <h4 class="counter" style="visibility: visible;"><?= count($pendaftar)?></h4>
                     </div>
                     <div class="progress bg-soft-primary shadow-none w-100" style="height: 4px">
                        <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
               </li>
               <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                  <div class="card-body">
                     <div class="progress-detail">
                        <p class="mb-1">Total Pembayaran Sukses</p>
                        <h4 class="counter" style="visibility: visible;"><?= count($pendaftar_laki)?></h4>
                     </div>
                     <div class="progress bg-soft-primary shadow-none w-100" style="height: 4px">
                        <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
               </li>
               <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                  <div class="card-body">
                     <div class="progress-detail">
                        <p class="mb-1">Total Pembayaran Pending</p>
                        <h4 class="counter" style="visibility: visible;"><?= count($pendaftar_p)?></h4>
                     </div>
                     <div class="progress bg-soft-primary shadow-none w-100" style="height: 4px">
                        <div class="progress-bar bg-warning" data-toggle="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
               </li>
               <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                  <div class="card-body">
                     <div class="progress-detail">
                        <p class="mb-1">Total Pembayaran Kadaluarsa</p>
                        <h4 class="counter" style="visibility: visible;">11.2M</h4>
                     </div>
                     <div class="progress bg-soft-primary shadow-none w-100" style="height: 4px">
                        <div class="progress-bar bg-danger" data-toggle="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
               </li>
            </ul>
            <div class="swiper-button swiper-button-next"></div>
            <div class="swiper-button swiper-button-prev"></div>
         </div>
      </div>
   </div>
   <div class="col-md-12 col-lg-12">
      <div class="row">
         <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
               <div class="card-header d-flex justify-content-between flex-wrap">
                  <div class="header-title">
                     <h4 class="card-title">GRAFIK</h4>
                     <p class="mb-0">Data Pendaftar</p>
                  </div>
                  <div class="dropdown">
                  </div>
               </div>
               <div class="card-body">
                  <div id="d-main" class="d-main"></div>
               </div>
            </div>
         </div>

      </div>
   </div>

</div>
<?= $this->endSection() ?>
