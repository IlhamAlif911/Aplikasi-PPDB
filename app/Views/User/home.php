<?= $this->extend('User/index.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid mb-4">
  <div class="container-fluid" id="home">
    <div class="d-flex flex-wrap home align-items-center bg-white">
      <div class="flex-1">
        <h2 class="ms-3 mt-4">Penerimaan Peserta Didik Baru Online </h2>
        <p class="ms-3">SMK Widya Mandala Tambak menerima siswa baru periode <?= $periode->nama_periode ?>. Pendaftaran dilakukan secara online pada website ini.</p><br>
        <?=$isi_jalur?>
        
      </div>
      <div class="flex-2 justify-content-center d-flex">
        <img src="<?= base_url('assets/' . '5836.png'); ?>" class="d-block carousel-custom" alt="Wild Landscape" />
      </div>
    </div>
  </div>

  <div class="container pt-5 pb-5 rounded-5 shadow mb-5 border-bottom border-top border-4 border-success" style="background-color: #4D7C0F;" id="alur" >
    <div class="text-center text-white">
      <h2 class="">Alur Pendaftaran</h2>
      <p>Langkah pendaftaran calon siswa mengikuti alur berikut.</p>
    </div>
    <div height="" class="d-flex flex-wrap stepper text-white" id="stepper">
      <div class="steps-container">
        <div class="steps">
          <div class="step" icon="fa fa-pencil-alt" id="1">
            <div class="step-title">
              <span class="step-number">01</span>
              <div class="step-text">Mengisi Formulir</div>
            </div>
          </div>
          <div class="step" icon="fa fa-info-circle" id="2">
            <div class="step-title">
              <span class="step-number">02</span>
              <div class="step-text">Menunggu Pengumuman</div>
            </div>
          </div>
          <div class="step" icon="fa fa-book-reader" id="3">
            <div class="step-title">
              <span class="step-number">03</span>
              <div class="step-text">Daftar Ulang</div>
            </div>
          </div>
          <div class="step" icon="fa fa-money" id="4">
            <div class="step-title">
              <span class="step-number">04</span>
              <div class="step-text">Melakukan Pembayaran</div>
            </div>
          </div>
          <div class="step" icon="fa fa-check" id="5">
            <div class="step-title">
              <span class="step-number">05</span>
              <div class="step-text">Verifikasi Admin</div>
            </div>
          </div>
        </div>
      </div>
      <div class="stepper-content-container border-top border-2 mt-3 border-white">
        <div class="stepper-content fade-in" stepper-label="1">
          <div class="card border-0 bg-transparent text-center">
            <div class="card-body">
              <h5 class="card-title">Mengisi Formulir</h5>
              <p class="card-text">Calon siswa mengisi formulir dan mengupload berkas sesuai syarat dengan benar dan lengkap.</p>
              <!-- <div class="btn-group" role="group" aria-label="Basic example">
                <?= $isi_jalurbtn?>
              </div> -->
            </div>
          </div>
        </div>
        <div class="stepper-content fade-in" stepper-label="2">
          <div class="card border-0 bg-transparent text-center">
            <div class="card-body border-white">
              <h5 class="card-title">Menunggu Pengumuman</h5>
              <p class="card-text">Calon siswa menunggu untuk diverifikasi oleh admin, calon siswa dapat mengetahui status pendaftaran pada link cek data diatas.</p>
              <!-- <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?= site_url('cek-data') ?>" class="btn btn-light">Cek Disini</a>
              </div> -->
            </div>
          </div>
        </div>
        <div class="stepper-content fade-in" stepper-label="3">
          <div class="card border-0 bg-transparent text-center">
            <div class="card-body">
              <h5 class="card-title">Daftar Ulang</h5>
              <p class="card-text">Apabila calon siswa diterima, lakukan pendaftaran ulang. Calon siswa login ke dalam aplikasi sesuai dengan nomor pendaftaran dan password yang sudah terdaftar sebelumnya, pastikan data yang dimasukkan benar dan lengkap.</p>
              <!-- <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?= site_url('login') ?>" class="btn btn-light">Klik Disini</a>
              </div> -->
            </div>
          </div>
        </div>
        <div class="stepper-content fade-in" stepper-label="4">
          <div class="card border-0 bg-transparent text-center">
            <div class="card-body">
              <h5 class="card-title">Melakukan Pembayaran</h5>
              <p class="card-text">Setelah melakukan daftar ulang, calon siswa menyelesaikan pembayaran yang tertera pada invoice. Setelah pembayaran terkirim, lakukan konfirmasi pembayaran dengan login terlebih dahulu maupun kepada penyelenggara PPDB.</p>
              <!-- <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?= site_url('login') ?>" class="btn btn-light">Klik Disini</a>
              </div> -->
            </div>
          </div>
        </div>
        <div class="stepper-content fade-in" stepper-label="5">
          <div class="card border-0 bg-transparent text-center">
            <div class="card-body">
              <h5 class="card-title">Verifikasi Admin</h5>
              <p class="card-text">Calon siswa yang sudah menyelesaikan tahap pendaftaran akan diverifikasi oleh admin selama 3x24 jam.</p>
              <!-- <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?= site_url('cek-data') ?>" class="btn btn-light">Cek Disini</a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container pt-5"  id="jurusan">
    <div class="pt-5 pb-5 mb-5 text-center ">
      <h2 class="">Jurusan PPDB Periode <?= $periode->nama_periode ?></h2>
      <p>Terdapat <?= count($jurusan) ?> jurusan yang dibuka pada periode ini.</p>
    </div>
    <div class="d-flex flex-wrap justify-content-center align-items-center">
      <?php
      foreach ($jurusan as $k) :
        ?>
        <div>
          <div class="card border-1 border-dark rounded-5 card-pengumuman">
            <img src="<?= base_url('assets/' . $k->file_foto); ?>" class="rounded mx-auto d-block pt-2" style="object-fit: contain;" alt="Jurusan SMK WIDYA MANDALA TAMBAK" />
            <div class="card-body">
              <h5 class="card-title text-center"><?= $k->nama_jurusan ?></h5>
              <p class="card-text"><?= $k->deskripsi ?></p>
            </div>
          </div>
        </div>
        <?php
      endforeach ?>
    </div>
  </div>

  <div class="container pt-5" id="jalur">
    <div class="pt-5 pb-5 text-center text-white rounded-bottom" style="border-radius: 25px;background-color: #4D7C0F;">
      <h2 class="">Jalur dan Syarat</h2>
      <p>Terdapat <?= count($jalur) ?> jalur pada PPDB <?= $periode->nama_periode ?> beserta dengan syarat dan ketentuan yang harus disiapkan.</p>
    </div>
    <div>
      <div class="d-flex align-items-start justify-content-center border-1 border-top border-left border-right border-bottom p-3 shadow">
        <div class="nav flex-column nav-pills me-3 pe-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <?php
          $nomor = 1;
          foreach ($jalur as $k) :
            if ($nomor == 1) { ?>
              <button class="nav-link active" id="v-pills-button-<?= $k->id ?>" data-bs-toggle="pill" data-bs-target="#v-pills-<?= $k->id ?>" type="button" style="background-color: #4D7C0F;" role="tab" aria-controls="v-pills-home" aria-selected="true"><?= $k->nama_jalur ?></button>
            <?php } else {
              ?>
              <button class="nav-link" id="v-pills-button-<?= $k->id ?>" data-bs-toggle="pill" data-bs-target="#v-pills-<?= $k->id ?>" type="button" style="background-color: #4D7C0F;" role="tab" aria-controls="v-pills-home" aria-selected="false"><?= $k->nama_jalur ?></button>
            <?php }
            $nomor++;
          endforeach ?>
        </div>
        <div class="vr"></div>
        <div class="tab-content" id="v-pills-tabContent">
          <?php
          $nomor = 1;
          foreach ($jalur as $k) :
            if ($nomor == 1) { ?>
              <div class="tab-pane fade show active" id="v-pills-<?= $k->id ?>" role="tabpanel" aria-labelledby="v-pills-zonasi" tabindex="0">
                <?= $k->syarat ?>
              </div>
            <?php } else {
              ?>
              <div class="tab-pane fade" id="v-pills-<?= $k->id ?>" role="tabpanel" aria-labelledby="v-pills-prestasi" tabindex="0">
                <?= $k->syarat ?>
              </div>
            <?php }
            $nomor++;
          endforeach ?>
        </div>
      </div>
    </div>
  </div>

  <div class="container pt-5 mt-5" id="agenda">
    <div class="d-flex flex-wrap align-items-center justify-content-center rounded-5 p-5 mt-3" style="background-color: #4D7C0F;">
      <div class="agenda-1">
        <img src="<?= base_url('assets/' . '6494.png'); ?>" class="d-block img-agenda" style="object-fit: contain;" alt="Wild Landscape" />
      </div>
      <div class="text-white agenda-2">
        <h2 class="text-white">Agenda PPDB <?= $periode->nama_periode ?></h2>
        <p class="text-white">SMK Widya Mandala Tambak menerima siswa baru periode <?= $periode->nama_periode ?>. Pendaftaran dilakukan secara online pada website ini.</p><br>
        <div class="card justify-content-center bg-transparent border-white">
          <div class="card-body overflow-auto p-0">
            <?php
            $nomor = 1;
            foreach ($agenda as $k) : ?>
              <div class="pane border-bottom border-white p-3">
                <div class="">
                  <h4 class="card-title mb-1">
                    <?= $k->nama_agenda ?>
                  </h4>
                  <p class="card-text mb-2"><?= $k->sub_nama ?></p>
                  <p class="card-text mb-0 small ">Waktu : <?php
                  if ($k->tanggal_mulai != "") {
                    $pecah = explode('-', $k->tanggal_mulai);
                    $tanggal_mulai = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
                    echo $tanggal_mulai;
                  }
                  ?> - <?php
                  if ($k->tanggal_selesai != "") {
                    $pecah = explode('-', $k->tanggal_selesai);
                    $tanggal_selesai = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
                    echo $tanggal_selesai;
                  }
                  ?></p>
                  <p class="card-text mb-0 small ">
                    <?= $k->keterangan ?>
                  </p>
                </div>
              </div>
              <?php
            endforeach ?>
          </div>
          <a href="<?= site_url('list-agenda/' . $periode->id) ?>" class="text-decoration-none text-white card-text p-4 text-center pointer border-top">Lihat Semua</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="sticky-lg-bottom d-flex justify-content-end">
  <a href="#home" class="btn m-4 p-2 text-decoration-none shadow" style="background-color:#4D7C0F;">
    <i class="fa fa-arrow-up fa-2x text-white"></i>
  </a>
</div>

<?= $this->endSection() ?>