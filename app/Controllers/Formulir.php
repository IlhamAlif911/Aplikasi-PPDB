<?php

namespace App\Controllers;

use App\Models\DataAfirmasi;
use App\Models\DataPendaftar;
use App\Models\DataOrangTua;
use App\Models\DataPendaftaran;
use App\Models\Users;
use App\Models\DataBeasiswa;
use App\Models\DataPrestasi;
use App\Models\JenisNilai;
use App\Models\Rapot;

class Formulir extends Base
{
    public function add_zonasi($id_jalur)
    {
        $pendaftar = new DataPendaftar();

        $orang_tua = new DataOrangTua();

        $pendaftaran = new DataPendaftaran();

        $user = new Users();

        $tanggal_lahir = $this->formatTanggalReverse($this->request->getPost('tanggal_lahir'));

        $status_pendaftaran = $this->codeWithName('Menunggu Pengumuman');

        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nisn' => [
                'rules' => 'min_length[10]|is_unique[data_pendaftar.nisn]',
                'errors' => [
                    'min_length' => 'NISN Minimal 10 Karakter',
                    'is_unique' => 'NISN sudah digunakan sebelumnya'
                ]
            ],
            'nik' => [
                'rules' => 'min_length[16]|is_unique[data_pendaftar.nik]',
                'errors' => [
                    'min_length' => 'NIK Minimal 16 Karakter',
                    'is_unique' => 'NIK sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'min_length[6]',
                'errors' => [
                    'min_length' => '{field} Minimal 6 Karakter',
                ]
            ],
            'konf_password' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
            'file_foto' => [
                'rules' => 'mime_in[file_foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[file_foto,2048]',
                'errors' => [
                    'mime_in' => 'Format file salah',
                    'max_size' => 'Ukuran file maksimal 2 MB',
                ]
            ],
            'email' => [
                'rules' => 'is_unique[user.email]',
                'errors' => [
                    'is_unique' => 'Email sudah digunakan sebelumnya'
                ]
            ],
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $dataBerkas = $this->request->getFile('file_foto');
            $fileName = 'file_foto_' . $dataBerkas->getName();
            $dataBerkas->move('./assets/', $fileName);

            $pass = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);

            $pendaftar->insert([
                "nik" => $this->request->getPost('nik'),
                "nisn" => $this->request->getPost('nisn'),
                "nama_lengkap" => $this->request->getPost('nama_lengkap'),
                "jenis_kelamin" => $this->request->getPost('jenis_kelamin'),
                "tempat_lahir" => $this->request->getPost('tempat_lahir'),
                "tanggal_lahir" => $tanggal_lahir,
                "email" => $this->request->getPost('email'),
                "nomor_hp" => $this->request->getPost('nomor_hp'),
                "alamat" => $this->request->getPost('alamat'),
                "provinsi" => $this->request->getPost('provinsi'),
                "kabupaten" => $this->request->getPost('kabupaten'),
                "kecamatan" => $this->request->getPost('kecamatan'),
                "kelurahan" => $this->request->getPost('kelurahan'),
                "kode_pos" => $this->request->getPost('kode_pos'),
                "rt" => $this->request->getPost('rt'),
                "rw" => $this->request->getPost('rw'),
                "agama" => $this->request->getPost('agama'),
                "asal_sekolah" => $this->request->getPost('asal_sekolah'),
                "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus'),
                "foto" => $fileName,
                "status_penerimaan" => $status_pendaftaran->id,
                "type_registration" => 1,
            ]);
            $pendaftar_id = $pendaftar->getInsertID();

            if ($this->request->getPost('nama_ayah') != '') {
                $orang_tua->insert([
                    "id_siswa" => $pendaftar_id,
                    "jenis_orang_tua" => '1',
                    "nama" => $this->request->getPost('nama_ayah'),
                    "pendidikan" => $this->request->getPost('pendidikan_ayah'),
                    "pekerjaan" => $this->request->getPost('pekerjaan_ayah'),
                    "nomor_hp" => $this->request->getPost('nomor_hp_ayah'),
                    "alamat" => $this->request->getPost('alamat_ayah'),
                ]);
            }
            if ($this->request->getPost('nama_ibu') != '') {
                $orang_tua->insert([
                    "id_siswa" => $pendaftar_id,
                    "jenis_orang_tua" => '2',
                    "nama" => $this->request->getPost('nama_ibu'),
                    "pendidikan" => $this->request->getPost('pendidikan_ibu'),
                    "pekerjaan" => $this->request->getPost('pekerjaan_ibu'),
                    "nomor_hp" => $this->request->getPost('nomor_hp_ibu'),
                    "alamat" => $this->request->getPost('alamat_ibu'),
                ]);
            }
            if ($this->request->getPost('nama_wali') != '') {
                $orang_tua->insert([
                    "id_siswa" => $pendaftar_id,
                    "jenis_orang_tua" => '3',
                    "nama" => $this->request->getPost('nama_wali'),
                    "pendidikan" => $this->request->getPost('pendidikan_wali'),
                    "pekerjaan" => $this->request->getPost('pekerjaan_wali'),
                    "nomor_hp" => $this->request->getPost('nomor_hp_wali'),
                    "alamat" => $this->request->getPost('alamat_wali'),
                ]);
            }

            $pendaftaran->insert([
                "id_pendaftar" => $pendaftar_id,
                "periode" => $this->request->getPost('periode'),
                "tahap" => $this->request->getPost('tahap'),
                "jalur" => $this->request->getPost('jalur'),
            ]);

            $user->insert([
                "role" => '2',
                "id_ref" => $pendaftar_id,
                "status" => 'aktif',
                "password" => $pass,
                "nomor_pendaftaran" => $this->request->getPost('nomor_pendaftaran'),
                "email" => $this->request->getPost('email'),
            ]);

            return redirect()->to('pendaftaran-berhasil/' . $pendaftar_id);
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('formulir-pendaftaran-zonasi/' . $id_jalur)->withInput();
        }
    }

    public function add_prestasi($id_jalur)
    {
        $pendaftar = new DataPendaftar();

        $orang_tua = new DataOrangTua();

        $pendaftaran = new DataPendaftaran();

        $user = new Users();

        $prestasi = new DataPrestasi();

        $beasiswa = new DataBeasiswa();

        $jenis_nilai = new JenisNilai();

        $tanggal_lahir = $this->formatTanggalReverse($this->request->getPost('tanggal_lahir'));

        $status_pendaftaran = $this->codeWithName('Menunggu Pengumuman');

        $jenis_prestasi = $this->request->getPost('jenis_prestasi');
        $tingkat_prestasi = $this->request->getPost('tingkat_prestasi');
        $nama_prestasi = $this->request->getPost('nama_prestasi');
        $tahun_prestasi = $this->request->getPost('tahun_prestasi');
        $penyelenggara = $this->request->getPost('penyelenggara');
        $peringkat = $this->request->getPost('peringkat');
        $jenis_beasiswa = $this->request->getPost('jenis_beasiswa');
        $keterangan = $this->request->getPost('keterangan');
        $tanggal_mulai = $this->request->getPost('tanggal_mulai');
        $tanggal_selesai = $this->request->getPost('tanggal_selesai');
        $rapot = $this->request->getPost('rapot');
        $jumlah_nilai = count($rapot);

        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nisn' => [
                'rules' => 'min_length[10]|is_unique[data_pendaftar.nisn]',
                'errors' => [
                    'min_length' => 'NISN Minimal 10 Karakter',
                    'is_unique' => 'NISN sudah digunakan sebelumnya'
                ]
            ],
            'nik' => [
                'rules' => 'min_length[16]|is_unique[data_pendaftar.nik]',
                'errors' => [
                    'min_length' => 'NIK Minimal 16 Karakter',
                    'is_unique' => 'NIK sudah digunakan sebelumnya'
                ]
            ],
            'nomor_akta' => [
                'rules' => 'is_unique[data_pendaftar.nomor_akta]',
                'errors' => [
                    'is_unique' => 'Nomor Akta sudah digunakan sebelumnya'
                ]
            ],
            'nomor_seri_ijazah' => [
                'rules' => 'is_unique[data_pendaftar.nomor_seri_ijazah]',
                'errors' => [
                    'is_unique' => 'Nomor Seri Ijazah sudah digunakan sebelumnya'
                ]
            ],
            'nomor_seri_skhus' => [
                'rules' => 'is_unique[data_pendaftar.nomor_seri_skhus]',
                'errors' => [
                    'is_unique' => 'Nomor Seri SKHUS sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'min_length[6]',
                'errors' => [
                    'min_length' => '{field} Minimal 6 Karakter',
                ]
            ],
            'konf_password' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
            'file_foto' => [
                'rules' => 'mime_in[file_foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[file_foto,2048]',
                'errors' => [
                    'mime_in' => 'Format file salah',
                    'max_size' => 'Ukuran file maksimal 2 MB',
                ]
            ],
            'email' => [
                'rules' => 'is_unique[user.email]',
                'errors' => [
                    'is_unique' => 'Email sudah digunakan sebelumnya'
                ]
            ],
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $dataBerkas = $this->request->getFile('file_foto');
            $fileName = 'file_foto_' . $dataBerkas->getName();
            $dataBerkas->move('./assets/', $fileName);

            $pass = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);

            $pendaftar->insert([
                "nik" => $this->request->getPost('nik'),
                "nisn" => $this->request->getPost('nisn'),
                "nomor_akta" => $this->request->getPost('nomor_akta'),
                "nama_lengkap" => $this->request->getPost('nama_lengkap'),
                "jenis_kelamin" => $this->request->getPost('jenis_kelamin'),
                "tempat_lahir" => $this->request->getPost('tempat_lahir'),
                "tanggal_lahir" => $tanggal_lahir,
                "email" => $this->request->getPost('email'),
                "nomor_hp" => $this->request->getPost('nomor_hp'),
                "alamat" => $this->request->getPost('alamat'),
                "provinsi" => $this->request->getPost('provinsi'),
                "kabupaten" => $this->request->getPost('kabupaten'),
                "kecamatan" => $this->request->getPost('kecamatan'),
                "kelurahan" => $this->request->getPost('kelurahan'),
                "kode_pos" => $this->request->getPost('kode_pos'),
                "rt" => $this->request->getPost('rt'),
                "rw" => $this->request->getPost('rw'),
                "agama" => $this->request->getPost('agama'),
                "tempat_tinggal" => $this->request->getPost('tempat_tinggal'),
                "moda_transportasi" => $this->request->getPost('moda_transportasi'),
                "kewarganegaraan" => $this->request->getPost('kewarganegaraan'),
                "tinggi_badan" => $this->request->getPost('tinggi_badan'),
                "berat_badan" => $this->request->getPost('berat_badan'),
                "jarak_tinggal" => $this->request->getPost('jarak_tinggal'),
                "waktu_tempuh" => $this->request->getPost('waktu_tempuh'),
                "anak_ke" => $this->request->getPost('anak_ke'),
                "jumlah_saudara" => $this->request->getPost('jumlah_saudara'),
                "asal_sekolah" => $this->request->getPost('asal_sekolah'),
                "nomor_seri_ijazah" => $this->request->getPost('nomor_seri_ijazah'),
                "nomor_seri_skhus" => $this->request->getPost('nomor_seri_skhus'),
                "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus'),
                "foto" => $fileName,
                "status_penerimaan" => $status_pendaftaran->id,
            ]);
            $pendaftar_id = $pendaftar->getInsertID();

            if ($this->request->getPost('nama_ayah') != '') {
                $orang_tua->insert([
                    "id_siswa" => $pendaftar_id,
                    "jenis_orang_tua" => '1',
                    "nama" => $this->request->getPost('nama_ayah'),
                    "nik" => $this->request->getPost('nik_ayah'),
                    "tahun_lahir" => $this->request->getPost('tahun_lahir_ayah'),
                    "pendidikan" => $this->request->getPost('pendidikan_ayah'),
                    "pekerjaan" => $this->request->getPost('pekerjaan_ayah'),
                    "penghasilan_bulanan" => $this->request->getPost('penghasilan_bulanan_ayah'),
                    "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus_ayah'),
                    "nomor_hp" => $this->request->getPost('nomor_hp_ayah'),
                    "email" => $this->request->getPost('email_ayah'),
                    "alamat" => $this->request->getPost('alamat_ayah'),
                ]);
            }
            if ($this->request->getPost('nama_ibu') != '') {
                $orang_tua->insert([
                    "id_siswa" => $pendaftar_id,
                    "jenis_orang_tua" => '2',
                    "nama" => $this->request->getPost('nama_ibu'),
                    "nik" => $this->request->getPost('nik_ibu'),
                    "tahun_lahir" => $this->request->getPost('tahun_lahir_ibu'),
                    "pendidikan" => $this->request->getPost('pendidikan_ibu'),
                    "pekerjaan" => $this->request->getPost('pekerjaan_ibu'),
                    "penghasilan_bulanan" => $this->request->getPost('penghasilan_bulanan_ibu'),
                    "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus_ibu'),
                    "nomor_hp" => $this->request->getPost('nomor_hp_ibu'),
                    "email" => $this->request->getPost('email_ibu'),
                    "alamat" => $this->request->getPost('alamat_ibu'),
                ]);
            }
            if ($this->request->getPost('nama_wali') != '') {
                $orang_tua->insert([
                    "id_siswa" => $pendaftar_id,
                    "jenis_orang_tua" => '3',
                    "nama" => $this->request->getPost('nama_wali'),
                    "nik" => $this->request->getPost('nik_wali'),
                    "tahun_lahir" => $this->request->getPost('tahun_lahir_wali'),
                    "pendidikan" => $this->request->getPost('pendidikan_wali'),
                    "pekerjaan" => $this->request->getPost('pekerjaan_wali'),
                    "penghasilan_bulanan" => $this->request->getPost('penghasilan_bulanan_wali'),
                    "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus_wali'),
                    "nomor_hp" => $this->request->getPost('nomor_hp_wali'),
                    "email" => $this->request->getPost('email_wali'),
                    "alamat" => $this->request->getPost('alamat_wali'),
                ]);
            }
            for ($i = 0; $i < $jumlah_nilai; $i++) {
                if (!empty($this->request->getPost($rapot[$i] . 'matematika')) && !empty($this->request->getPost($rapot[$i] . 'ipa')) && !empty($this->request->getPost($rapot[$i] . 'bahasa_inggris')) && !empty($this->request->getPost($rapot[$i] . 'bahasa_indonesia'))) {
                    $jenis_nilai->insert([
                        "id_rapot" => $rapot[$i],
                        "id_pendaftar" => $pendaftar_id,
                        "matematika" => $this->request->getPost($rapot[$i] . 'matematika'),
                        "ipa" => $this->request->getPost($rapot[$i] . 'ipa'),
                        "bahasa_inggris" => $this->request->getPost($rapot[$i] . 'bahasa_inggris'),
                        "bahasa_indonesia" => $this->request->getPost($rapot[$i] . 'bahasa_indonesia'),
                    ]);
                }
            }
            
            for ($i = 0; $i < count($jenis_prestasi); $i++) {
                if($jenis_prestasi != '' || $jenis_prestasi != null){
                $prestasi->insert([
                    'id_siswa' => $pendaftar_id,
                    'nama_prestasi' => $nama_prestasi[$i],
                    'jenis_prestasi' => $jenis_prestasi[$i],
                    'peringkat' => $peringkat[$i],
                    'tingkat_prestasi' => $tingkat_prestasi[$i],
                    'penyelenggara' => $penyelenggara[$i],
                    'tahun' => $tahun_prestasi[$i],
                ]);
            }
        }

        
            for ($i = 0; $i < count($keterangan); $i++) {
                if($tanggal_mulai[$i] != '') $tanggal_mulainya = $this->formatTanggalReverse($tanggal_mulai[$i]);
                if($tanggal_selesai[$i] != '') $tanggal_selesainya = $this->formatTanggalReverse($tanggal_selesai)[$i];
                if($keterangan != '' || $keterangan != null){
                $beasiswa->insert([
                    'id_siswa' => $pendaftar_id,
                    'keterangan' => $keterangan[$i],
                    'jenis_beasiswa' => $jenis_beasiswa[$i],
                    'tanggal_mulai' => $tanggal_mulainya,
                    'tanggal_selesai' => $tanggal_selesainya,
                ]);
            }
        }

            $pendaftaran->insert([
                "id_pendaftar" => $pendaftar_id,
                "periode" => $this->request->getPost('periode'),
                "tahap" => $this->request->getPost('tahap'),
                "jalur" => $this->request->getPost('jalur'),
            ]);

            $user->insert([
                "role" => '2',
                "id_ref" => $pendaftar_id,
                "status" => 'aktif',
                "password" => $pass,
                "nomor_pendaftaran" => $this->request->getPost('nomor_pendaftaran'),
                "email" => $this->request->getPost('email'),
            ]);

            return redirect()->to('pendaftaran-berhasil/' . $pendaftar_id);
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->back();
        }
    }

    public function add_afirmasi($id_jalur)
    {
        $pendaftar = new DataPendaftar();

        $orang_tua = new DataOrangTua();

        $pendaftaran = new DataPendaftaran();

        $user = new Users();

        $afirmasi = new DataAfirmasi();

        $tanggal_lahir = $this->formatTanggalReverse($this->request->getPost('tanggal_lahir'));

        $status_pendaftaran = $this->codeWithName('Menunggu Pengumuman');

        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nisn' => [
                'rules' => 'min_length[10]|is_unique[data_pendaftar.nisn]',
                'errors' => [
                    'min_length' => 'NISN Minimal 10 Karakter',
                    'is_unique' => 'NISN sudah digunakan sebelumnya'
                ]
            ],
            'nik' => [
                'rules' => 'min_length[16]|is_unique[data_pendaftar.nik]',
                'errors' => [
                    'min_length' => 'NIK Minimal 16 Karakter',
                    'is_unique' => 'NIK sudah digunakan sebelumnya'
                ]
            ],
            'nomor_akta' => [
                'rules' => 'is_unique[data_pendaftar.nomor_akta]',
                'errors' => [
                    'is_unique' => 'Nomor Akta sudah digunakan sebelumnya'
                ]
            ],
            'nomor_seri_ijazah' => [
                'rules' => 'is_unique[data_pendaftar.nomor_seri_ijazah]',
                'errors' => [
                    'is_unique' => 'Nomor Seri Ijazah sudah digunakan sebelumnya'
                ]
            ],
            'nomor_seri_skhus' => [
                'rules' => 'is_unique[data_pendaftar.nomor_seri_skhus]',
                'errors' => [
                    'is_unique' => 'Nomor Seri SKHUS sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'min_length[6]',
                'errors' => [
                    'min_length' => '{field} Minimal 6 Karakter',
                ]
            ],
            'konf_password' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
            'file_foto' => [
                'rules' => 'mime_in[file_foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[file_foto,2048]',
                'errors' => [
                    'mime_in' => 'Format file salah',
                    'max_size' => 'Ukuran file maksimal 2 MB',
                ]
            ],
            'email' => [
                'rules' => 'is_unique[user.email]',
                'errors' => [
                    'is_unique' => 'Email sudah digunakan sebelumnya'
                ]
            ],
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $dataBerkas = $this->request->getFile('file_foto');
            $fileName = 'file_foto_' . $dataBerkas->getName();
            $dataBerkas->move('./assets/', $fileName);

            $pass = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);

            $pendaftar->insert([
                "nik" => $this->request->getPost('nik'),
                "nisn" => $this->request->getPost('nisn'),
                "nomor_akta" => $this->request->getPost('nomor_akta'),
                "nama_lengkap" => $this->request->getPost('nama_lengkap'),
                "jenis_kelamin" => $this->request->getPost('jenis_kelamin'),
                "tempat_lahir" => $this->request->getPost('tempat_lahir'),
                "tanggal_lahir" => $tanggal_lahir,
                "email" => $this->request->getPost('email'),
                "nomor_hp" => $this->request->getPost('nomor_hp'),
                "alamat" => $this->request->getPost('alamat'),
                "provinsi" => $this->request->getPost('provinsi'),
                "kabupaten" => $this->request->getPost('kabupaten'),
                "kecamatan" => $this->request->getPost('kecamatan'),
                "kelurahan" => $this->request->getPost('kelurahan'),
                "kode_pos" => $this->request->getPost('kode_pos'),
                "rt" => $this->request->getPost('rt'),
                "rw" => $this->request->getPost('rw'),
                "agama" => $this->request->getPost('agama'),
                "tempat_tinggal" => $this->request->getPost('tempat_tinggal'),
                "moda_transportasi" => $this->request->getPost('moda_transportasi'),
                "kewarganegaraan" => $this->request->getPost('kewarganegaraan'),
                "tinggi_badan" => $this->request->getPost('tinggi_badan'),
                "berat_badan" => $this->request->getPost('berat_badan'),
                "jarak_tinggal" => $this->request->getPost('jarak_tinggal'),
                "waktu_tempuh" => $this->request->getPost('waktu_tempuh'),
                "anak_ke" => $this->request->getPost('anak_ke'),
                "jumlah_saudara" => $this->request->getPost('jumlah_saudara'),
                "asal_sekolah" => $this->request->getPost('asal_sekolah'),
                "nomor_seri_ijazah" => $this->request->getPost('nomor_seri_ijazah'),
                "nomor_seri_skhus" => $this->request->getPost('nomor_seri_skhus'),
                "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus'),
                "foto" => $fileName,
                "status_penerimaan" => $status_pendaftaran->id,
            ]);
            $pendaftar_id = $pendaftar->getInsertID();

            if ($this->request->getPost('nama_ayah') != '') {
                $orang_tua->insert([
                    "id_siswa" => $pendaftar_id,
                    "jenis_orang_tua" => '1',
                    "nama" => $this->request->getPost('nama_ayah'),
                    "nik" => $this->request->getPost('nik_ayah'),
                    "tahun_lahir" => $this->request->getPost('tahun_lahir_ayah'),
                    "pendidikan" => $this->request->getPost('pendidikan_ayah'),
                    "pekerjaan" => $this->request->getPost('pekerjaan_ayah'),
                    "penghasilan_bulanan" => $this->request->getPost('penghasilan_bulanan_ayah'),
                    "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus_ayah'),
                    "nomor_hp" => $this->request->getPost('nomor_hp_ayah'),
                    "email" => $this->request->getPost('email_ayah'),
                    "alamat" => $this->request->getPost('alamat_ayah'),
                ]);
            }
            if ($this->request->getPost('nama_ibu') != '') {
                $orang_tua->insert([
                    "id_siswa" => $pendaftar_id,
                    "jenis_orang_tua" => '2',
                    "nama" => $this->request->getPost('nama_ibu'),
                    "nik" => $this->request->getPost('nik_ibu'),
                    "tahun_lahir" => $this->request->getPost('tahun_lahir_ibu'),
                    "pendidikan" => $this->request->getPost('pendidikan_ibu'),
                    "pekerjaan" => $this->request->getPost('pekerjaan_ibu'),
                    "penghasilan_bulanan" => $this->request->getPost('penghasilan_bulanan_ibu'),
                    "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus_ibu'),
                    "nomor_hp" => $this->request->getPost('nomor_hp_ibu'),
                    "email" => $this->request->getPost('email_ibu'),
                    "alamat" => $this->request->getPost('alamat_ibu'),
                ]);
            }
            if ($this->request->getPost('nama_wali') != '') {
                $orang_tua->insert([
                    "id_siswa" => $pendaftar_id,
                    "jenis_orang_tua" => '3',
                    "nama" => $this->request->getPost('nama_wali'),
                    "nik" => $this->request->getPost('nik_wali'),
                    "tahun_lahir" => $this->request->getPost('tahun_lahir_wali'),
                    "pendidikan" => $this->request->getPost('pendidikan_wali'),
                    "pekerjaan" => $this->request->getPost('pekerjaan_wali'),
                    "penghasilan_bulanan" => $this->request->getPost('penghasilan_bulanan_wali'),
                    "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus_wali'),
                    "nomor_hp" => $this->request->getPost('nomor_hp_wali'),
                    "email" => $this->request->getPost('email_wali'),
                    "alamat" => $this->request->getPost('alamat_wali'),
                ]);
            }

            $afirmasi->insert([
                "id_pendaftar" => $pendaftar_id,
                "nomor_kip" => $this->request->getPost('nomor_kip'),
                "nama_kip" => $this->request->getPost('nama_kip'),
                "nomor_kks" => $this->request->getPost('nomor_kks'),
                "nomor_kps_pkh" => $this->request->getPost('nomor_kps_pkh'),
                "alasan_layak_pip" => $this->request->getPost('alasan_layak_pip'),
            ]);

            $pendaftaran->insert([
                "id_pendaftar" => $pendaftar_id,
                "periode" => $this->request->getPost('periode'),
                "tahap" => $this->request->getPost('tahap'),
                "jalur" => $this->request->getPost('jalur'),
            ]);

            $user->insert([
                "role" => '2',
                "id_ref" => $pendaftar_id,
                "status" => 'aktif',
                "password" => $pass,
                "nomor_pendaftaran" => $this->request->getPost('nomor_pendaftaran'),
                "email" => $this->request->getPost('email'),
            ]);

            return redirect()->to('pendaftaran-berhasil/' . $pendaftar_id);
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('formulir-pendaftaran-afirmasi/' . $id_jalur);
        }
    }

    public function test()
    {
        $data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');

        $data['page']="";

        return view('User/test', $data);
    }

    public function add_test()
    {
        $beasiswa = new DataBeasiswa();

        $jenis_beasiswa = $this->request->getPost('jenis_beasiswa');
        $keterangan = $this->request->getPost('keterangan');
        $tanggal_mulai = $this->request->getPost('tanggal_mulai');
        $tanggal_selesai = $this->request->getPost('tanggal_selesai');

        /*for ($i = 0; $i < count($jenis_beasiswa); $i++) {
            $beasiswa->insert([
                'id_siswa' => '1',
                'keterangan' => $keterangan[$i],
                'jenis_beasiswa' => $jenis_beasiswa[$i],
                'tanggal_mulai' => $tanggal_mulai[$i],
                'tanggal_selesai' => $tanggal_selesai[$i],
            ]);
        }*/

    if(!empty($keterangan))$data['banyak_prestasi'] = count($keterangan);
    else $data['banyak_prestasi'] = 0;
        return view('User/coba',$data);
    }
}
