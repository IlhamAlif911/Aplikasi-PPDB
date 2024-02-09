<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<div class="row">
   <div class="col-lg-6">
      <div class="card">
         <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
               <div class="d-flex flex-column text-center align-items-center justify-content-between ">
                  <div class="fs-italic">
                     <h5> <?= $data_pendaftar->nama_lengkap?></h5>
                     <div class="text-muted-50 mb-1">
                        <small>Pendaftar</small>
                     </div>
                  </div>
                  <div class="card-profile-progress">
                     <?php if ($data_pendaftar->foto == '') {?>
                        <img src="<?= base_url('assets/logo-def.png')?>" alt="User-Profile" class="theme-color-default-img img-fluid rounded-circle card-img-top" style="width: 300px;" loading="lazy" />
                     <?php } else { ?>
                        <img src="<?= base_url('assets/' . $data_pendaftar->foto); ?>" alt="User-Profile" class="theme-color-default-img img-fluid rounded-circle card-img-top" style="contain; width: 300px;" loading="lazy"/>
                     <?php } ?>

                  </div>
                  <div class="mt-3 text-muted-50">
                     <table style="width: 95%;">
                        <tr>
                           <td class="text-start">Nomor Pendaftaran</td>
                           <td> : </td>
                           <td class="text-end"><?= $data_pendaftar->nomor_pendaftaran?></td>
                        </tr>
                        <tr>
                           <td class="text-start">Status Pendaftaran</td>
                           <td> : </td>
                           <td class="text-end"><span class="bg-success p-1 rounded-2 text-white fw-bold">
                              <?php if ($data_pendaftar->status_penerimaan == $stat1->id) {
                                 echo $stat1->nama_opsi;
                              }elseif ($data_pendaftar->status_penerimaan == $stat2->id) {
                                 echo $stat2->nama_opsi;
                              }elseif ($data_pendaftar->status_penerimaan == $stat3->id) {
                                 echo $stat3->nama_opsi;
                              }elseif ($data_pendaftar->status_penerimaan == $stat4->id) {
                                 echo $stat4->nama_opsi;
                              } ?>
                           </span></td>
                        </tr>
                        <tr>
                           <td class="text-start">Email</td>
                           <td> : </td>
                           <td class="text-end"><?= $data_pendaftar->email?></td>
                        </tr>
                     </table>
                  </div>
                  <div class="d-flex icon-pill">
                     <?php if ($data_pendaftar->status_penerimaan == $stat1->id) { ?>
                        <a href="<?= site_url('registrasi-ulang/'.session()->get('id_ref')) ?>" class="btn btn-success rounded-pill px-2 py-2 ms-2 text-white">
                           <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" height="20" viewBox="0 0 20 20" fill="#FFFFFF">
                              <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                           </svg> Daftar Ulang
                        </a>
                     <?php }elseif ($data_pendaftar->status_penerimaan == $stat2->id) { ?>
                        <a href="<?= site_url('konfirmasi-pembayaran/'.session()->get('id_ref')) ?>" class="btn btn-success rounded-pill px-2 py-2 ms-2 text-white">
                           <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="20" height="20" viewBox="0 0 20 20" fill="#FFFFFF">
                              <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                           </svg> Lakukan Pembayaran
                        </a>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer py-0 border-top bg-white">
            <div class="row">
               <div class="col text-center p-3">
                  <span class="d-block font-size-sm">Periode</span>
                  <h4 class="fs-5 mb-1"><?=$data_periode->nama_periode?></h4>
               </div>
               <div class="col p-3 text-center border-end border-start">
                  <span class="d-block font-size-sm">Tahap</span>
                  <h4 class="fs-5 mb-1"><?=$data_tahap->nama_tahap?></h4>
               </div>
               <div class="col p-3 text-center">
                  <span class="d-block font-size-sm">Jalur</span>
                  <h4 class="fs-5 mb-1"><?=$data_jalur->nama_jalur?></h4>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-6">
      <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title">
               <h4 class="card-title">Alur Pendaftaran</h4>
            </div>
         </div>
         <div class="card-body">
            <div class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
               <ul class="list-inline p-0 m-0">
                  <li>
                     <div class="timeline-dots1 border-primary text-primary">
                        <svg class="icon-20" width="20" viewBox="0 0 24 24">
                           <path fill="currentColor" d="M19,3H5C3.89,3 3,3.89 3,5V9H5V5H19V19H5V15H3V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M10.08,15.58L11.5,17L16.5,12L11.5,7L10.08,8.41L12.67,11H3V13H12.67L10.08,15.58Z" />
                        </svg>
                     </div>
                     <h6 class="float-left mb-1">Mengisi Formulir</h6>
                     <div class="d-inline-block w-100">
                        <p align="justify">Calon siswa mengisi formulir dan mengupload berkas sesuai syarat dengan benar dan lengkap.</p>
                     </div>
                  </li>
                  <li>
                     <div class="timeline-dots1 border-success text-success">
                        <svg class="icon-20" width="20" viewBox="0 0 24 24">
                           <path fill="currentColor" d="M9.5,13.09L10.91,14.5L6.41,19H10V21H3V14H5V17.59L9.5,13.09M10.91,9.5L9.5,10.91L5,6.41V10H3V3H10V5H6.41L10.91,9.5M14.5,13.09L19,17.59V14H21V21H14V19H17.59L13.09,14.5L14.5,13.09M13.09,9.5L17.59,5H14V3H21V10H19V6.41L14.5,10.91L13.09,9.5Z" />
                        </svg>
                     </div>
                     <h6 class="float-left mb-1">Menunggu Pengumuman</h6>
                     <div class="d-inline-block w-100">
                        <p align="justify">Calon siswa menunggu untuk diverifikasi oleh admin.</p>
                     </div>
                  </li>
                  <li>
                     <div class="timeline-dots1 border-danger text-danger">
                        <svg width="20" height="20"  viewBox="0 0 24 24">
                           <path fill="currentColor" d="M12 3C7.03 3 3 7.03 3 12S7.03 21 12 21C14 21 15.92 20.34 17.5 19.14L16.06 17.7C14.87 18.54 13.45 19 12 19C8.13 19 5 15.87 5 12S8.13 5 12 5 19 8.13 19 12H16L20 16L24 12H21C21 7.03 16.97 3 12 3M7.71 13.16C7.62 13.23 7.59 13.35 7.64 13.45L8.54 15C8.6 15.12 8.72 15.12 8.82 15.12L9.95 14.67C10.19 14.83 10.44 14.97 10.7 15.09L10.88 16.28C10.9 16.39 11 16.47 11.1 16.47H12.9C13 16.5 13.11 16.41 13.13 16.3L13.31 15.12C13.58 15 13.84 14.85 14.07 14.67L15.19 15.12C15.3 15.16 15.42 15.11 15.47 15L16.37 13.5C16.42 13.38 16.39 13.26 16.31 13.19L15.31 12.45C15.34 12.15 15.34 11.85 15.31 11.55L16.31 10.79C16.4 10.72 16.42 10.61 16.37 10.5L15.47 8.95C15.41 8.85 15.3 8.81 15.19 8.85L14.07 9.3C13.83 9.13 13.57 9 13.3 8.88L13.13 7.69C13.11 7.58 13 7.5 12.9 7.5H11.14C11.04 7.5 10.95 7.57 10.93 7.67L10.76 8.85C10.5 8.97 10.23 9.12 10 9.3L8.85 8.88C8.74 8.84 8.61 8.89 8.56 9L7.65 10.5C7.6 10.62 7.63 10.74 7.71 10.81L8.71 11.55C8.69 11.7 8.69 11.85 8.71 12C8.7 12.15 8.7 12.3 8.71 12.45L7.71 13.19M12 13.5H12C11.16 13.5 10.5 12.82 10.5 12C10.5 11.17 11.17 10.5 12 10.5S13.5 11.17 13.5 12 12.83 13.5 12 13.5" />
                        </svg>
                     </div>
                     <h6 class="float-left mb-1">Daftar Ulang</h6>
                     <div class="d-inline-block w-100">
                        <p align="justify">Apabila calon siswa diterima, lakukan pendaftaran ulang. Calon siswa login ke dalam aplikasi sesuai dengan nomor pendaftaran dan password yang sudah terdaftar sebelumnya, pastikan data yang dimasukkan benar dan lengkap.</p>
                     </div>
                  </li>
                  <li>
                     <div class="timeline-dots1 border-primary text-primary">
                        <svg width="20" height="20"  viewBox="0 0 24 24">
                           <path fill="currentColor" d="M20,15.5C18.8,15.5 17.5,15.3 16.4,14.9C16.3,14.9 16.2,14.9 16.1,14.9C15.8,14.9 15.6,15 15.4,15.2L13.2,17.4C10.4,15.9 8,13.6 6.6,10.8L8.8,8.6C9.1,8.3 9.2,7.9 9,7.6C8.7,6.5 8.5,5.2 8.5,4C8.5,3.5 8,3 7.5,3H4C3.5,3 3,3.5 3,4C3,13.4 10.6,21 20,21C20.5,21 21,20.5 21,20V16.5C21,16 20.5,15.5 20,15.5M5,5H6.5C6.6,5.9 6.8,6.8 7,7.6L5.8,8.8C5.4,7.6 5.1,6.3 5,5M19,19C17.7,18.9 16.4,18.6 15.2,18.2L16.4,17C17.2,17.2 18.1,17.4 19,17.4V19Z" />
                        </svg>
                     </div>
                     <h6 class="float-left mb-1">Melakukan Pembayaran</h6>
                     <div class="d-inline-block w-100">
                        <p align="justify">Setelah melakukan daftar ulang, calon siswa menyelesaikan pembayaran. Setelah pembayaran dilakukan, lakukan konfirmasi pembayaran dengan login terlebih dahulu maupun kepada penyelenggara PPDB.</p>
                     </div>
                  </li>
                  <li>
                     <div class="timeline-dots1 border-warning text-warning">
                        <svg class="icon-20" width="20" viewBox="0 0 24 24">
                           <path fill="currentColor" d="M17.5 14.33C18.29 14.33 19.13 14.41 20 14.57V16.07C19.38 15.91 18.54 15.83 17.5 15.83C15.6 15.83 14.11 16.16 13 16.82V15.13C14.17 14.6 15.67 14.33 17.5 14.33M13 12.46C14.29 11.93 15.79 11.67 17.5 11.67C18.29 11.67 19.13 11.74 20 11.9V13.4C19.38 13.24 18.54 13.16 17.5 13.16C15.6 13.16 14.11 13.5 13 14.15M17.5 10.5C15.6 10.5 14.11 10.82 13 11.5V9.84C14.23 9.28 15.73 9 17.5 9C18.29 9 19.13 9.08 20 9.23V10.78C19.26 10.59 18.41 10.5 17.5 10.5M21 18.5V7C19.96 6.67 18.79 6.5 17.5 6.5C15.45 6.5 13.62 7 12 8V19.5C13.62 18.5 15.45 18 17.5 18C18.69 18 19.86 18.16 21 18.5M17.5 4.5C19.85 4.5 21.69 5 23 6V20.56C23 20.68 22.95 20.8 22.84 20.91C22.73 21 22.61 21.08 22.5 21.08C22.39 21.08 22.31 21.06 22.25 21.03C20.97 20.34 19.38 20 17.5 20C15.45 20 13.62 20.5 12 21.5C10.66 20.5 8.83 20 6.5 20C4.84 20 3.25 20.36 1.75 21.07C1.72 21.08 1.68 21.08 1.63 21.1C1.59 21.11 1.55 21.12 1.5 21.12C1.39 21.12 1.27 21.08 1.16 21C1.05 20.89 1 20.78 1 20.65V6C2.34 5 4.18 4.5 6.5 4.5C8.83 4.5 10.66 5 12 6C13.34 5 15.17 4.5 17.5 4.5Z" />
                        </svg>
                     </div>
                     <h6 class="float-left mb-1">Verifikasi Admin</h6>
                     <div class="d-inline-block w-100">
                        <p align="justify">Calon siswa yang sudah menyelesaikan tahap pendaftaran akan diverifikasi oleh admin selama 3x24 jam.</p>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <h4>Agenda PPDB</h4>
            <p class="mt-2">
               Agenda yang sedang berlangusng
            </p>
            <div class="mb-5 pt-2">
               <p class="line-around text-gray mb-0"><span class="line-around-1"><b><?=$data_agenda->nama_agenda?></b></span></p>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="d-flex align-items-center">
                     <p class="mt-2">
                        <?=$data_agenda->sub_nama?>
                     </p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="d-flex align-items-center">
                     <p class="mt-2">
                        Tanggal Pembukaan : 
                        <?php
                        if ($data_agenda->tanggal_mulai != "") {
                           $pecah = explode('-', $data_agenda->tanggal_mulai);
                           $tanggal_mulai = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
                           echo $tanggal_mulai;
                        }
                        ?>
                        s/d 
                        <?php
                        if ($data_agenda->tanggal_selesai != "") {
                           $pecah = explode('-', $data_agenda->tanggal_selesai);
                           $tanggal_selesai = $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
                           echo $tanggal_selesai;
                        }
                        ?>
                     </p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="d-flex align-items-center">
                     <p class="mt-2">
                        <?=$data_agenda->keterangan?>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?= $this->endSection() ?>