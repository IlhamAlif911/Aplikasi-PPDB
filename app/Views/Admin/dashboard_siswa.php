<?= $this->extend('Admin/index.php') ?>

<?= $this->section('content') ?>

<!--Container Main start-->
<div class="container border-0 pt-4 pb-4 ps-0">
   <h3 class="mb-4">Dashboard Siswa</h3>
   <div class="row mb-3">
      <div class="col-md-6">
         <div class="card">
            
            <div class="card-body">
               <div class="text-center">
                  <?php if ($data_pendaftar->foto == '') {?>
                     <img src="<?= base_url('assets/logo-def.png'); ?>" class="border-bottom card-img-top" style="object-fit: contain; width:400px; height:522px;" alt="...">
                  <?php } else { ?>
                     <img src="<?= base_url('assets/' . $data_pendaftar->foto); ?>" class="border-bottom card-img-top" style="object-fit: contain; width:400px; height:522px;" alt="...">
                  <?php } ?>

               </div>
               <div class="text-center mt-3">
                  <h3><?= $data_pendaftar->nama_lengkap?></h3>
               </div>
               
               <table style="width: 95%;">
                  <tr>
                     <td>Nomor Pendaftaran</td>
                     <td> : </td>
                     <td class="text-end"><?= $data_pendaftar->nomor_pendaftaran?></td>
                  </tr>
                  <tr>
                     <td>Status Pendaftaran</td>
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
                     <td>Email</td>
                     <td> : </td>
                     <td class="text-end"><?= $data_pendaftar->email?></td>
                  </tr>
               </table>
               <div class="text-center mt-3">
                  
                  <?php if ($data_pendaftar->status_penerimaan == $stat1->id) { ?>
                     <a href="<?= site_url('registrasi-ulang/'.session()->get('id_ref')) ?>" class="btn btn-primary text-center mb-3 col-6">Daftar Ulang</a>
                  <?php }elseif ($data_pendaftar->status_penerimaan == $stat2->id) { ?>
                     <a href="<?= site_url('konfirmasi-pembayaran/'.session()->get('id_ref')) ?>" class="btn btn-success text-center mb-3 col-6">Konfirmasi Pembayaran</a>
                  <?php } ?>
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
      <div class="col-md-6">
         <div class="card mb-3">
            <div class="card-header text-center bg-primary p-3 text-white fw-bold">
               <div class="text-center"><h4>Alur Pendaftaran</h4></div>
            </div>
            <div class="card-body">
               
               <table class="table">
                  <tbody>
                     <tr>
                        <td>
                           <div class="pane border-bottom border-white p-3">
                              <div class="">
                                 
                                 <h4 class="card-title mb-1">1. Mengisi Formulir</h4>
                                 <ul>
                                    <p>Calon siswa mengisi formulir dan mengupload berkas sesuai syarat dengan benar dan lengkap.</p>
                                    
                                 </ul>
                                 <h4 class="card-title mb-1">2. Menunggu Pengumuman</h4>
                                 <ul>
                                    <p>Calon siswa menunggu untuk diverifikasi oleh admin.</p>
                                    
                                 </ul>
                                 <h4 class="card-title mb-1">3. Daftar Ulang</h4>
                                 <ul>
                                    <p>Apabila calon siswa diterima, lakukan pendaftaran ulang. Calon siswa login ke dalam aplikasi sesuai dengan nomor pendaftaran dan password yang sudah terdaftar sebelumnya, pastikan data yang dimasukkan benar dan lengkap.</p>
                                    
                                 </ul>
                                 <h4 class="card-title mb-1">4. Melakukan Pembayaran</h4>
                                 <ul>
                                    <p>Setelah melakukan daftar ulang, calon siswa menyelesaikan pembayaran yang tertera pada invoice. Setelah pembayaran terkirim, lakukan konfirmasi pembayaran dengan login terlebih dahulu maupun kepada penyelenggara PPDB.</p>
                                    
                                 </ul>
                                 <h4 class="card-title mb-1">5. Verifikasi Admin</h4>
                                 <ul>
                                    <p>Calon siswa yang sudah menyelesaikan tahap pendaftaran akan diverifikasi oleh admin selama 3x24 jam.</p>
                                    
                                 </ul>
                                 
                              </div>
                           </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card mb-3" >
            <div class="card-body overflow-auto">
               <h4 class="card-title text-center bg-primary p-3 text-white fw-bold">Agenda</h4>
               <table class="table">
                  <tbody>
                     <tr>
                        <td>
                           <div class="pane border-bottom border-white p-3">
                              <div class="">
                                 <h4 class="card-title mb-1"><?=$data_agenda->nama_agenda?></h4>
                                 <p class="card-text mb-2"><?=$data_agenda->sub_nama?></p>
                                 <p class="card-text mb-0 small ">Tanggal Pembukaan : 
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
                                 <p class="card-text mb-0 small "><?=$data_agenda->keterangan?></p>
                              </div>
                           </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         
      </div>
   </div>
</div>
<!--Container Main end-->

<?= $this->endSection() ?>