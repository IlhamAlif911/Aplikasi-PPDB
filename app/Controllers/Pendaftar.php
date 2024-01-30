<?php

namespace App\Controllers;

use App\Models\DataAfirmasi;
use App\Models\JenisNilai;
use App\Models\DataJalur;
use App\Models\DataJurusan;
use App\Models\DataPeriode;
use App\Models\DataPendaftar;
use App\Models\Provinces;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Subdistricts;
use App\Models\Postalcode;
use App\Models\DataOrangTua;
use App\Models\DataPrestasi;
use App\Models\DataBeasiswa;
use App\Models\DataPendaftaran;
use App\Models\Users;
use App\Models\Rapot;
use App\Models\DataSekolah;
use App\Models\DataTahap;


class Pendaftar extends BaseController
{
    public function edit_profil($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }

        $reguler = $this->codeWithName('Reguler');
        $afirmasi = $this->codeWithName('Afirmasi');
        $prestasi = $this->codeWithName('Prestasi');
        $custom = $this->codeWithName('Custom');


        $this->data['jenis_prestasi'] = $this->codeAll('JENIS PRESTASI');
        $this->data['tingkat_prestasi'] = $this->codeAll('TINGKAT PRESTASI');
        $this->data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');
        $this->data['berkebutuhan_khusus'] = $this->codeAll('KEBUTUHAN KHUSUS');
        $this->data['agama'] = $this->codeAll('AGAMA');
        $this->data['kewarganegaraan'] = $this->codeAll('KEWARGANEGARAAN');
        $this->data['tempat_tinggal'] = $this->codeAll('TEMPAT TINGGAL');
        $this->data['moda_transportasi'] = $this->codeAll('MODA TRANSPORTASI');
        $this->data['pendidikan'] = $this->codeAll('PENDIDIKAN');
        $this->data['pekerjaan'] = $this->codeAll('PEKERJAAN');
        $this->data['penghasilan_bulanan'] = $this->codeAll('PENGHASILAN BULANAN');
        $this->data['agama'] = $this->codeAll('AGAMA');

        $this->data['jenis_prestasi'] = $this->codeAll('JENIS PRESTASI');
        $this->data['tingkat_prestasi'] = $this->codeAll('TINGKAT PRESTASI');
        $this->data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');

        $this->data['alasan_layak_pip'] = $this->codeAll('ALASAN LAYAK PIP');

        $pendaftar = new DataPendaftar();
        $this->data['pendaftar'] = $pendaftar->join('user', 'user.id_ref = data_pendaftar.id')->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('jalur', 'jalur.id = pendaftaran.jalur')->where('data_pendaftar.id', $id)->first();

        $orang_tua = new DataOrangTua();
        $this->data['ibu'] = $orang_tua->where(['id_siswa' => $this->data['pendaftar']->id_ref, 'jenis_orang_tua' => '2'])->first();
        $this->data['ayah'] = $orang_tua->where(['id_siswa' => $this->data['pendaftar']->id_ref, 'jenis_orang_tua' => '1'])->first();
        $this->data['wali'] = $orang_tua->where(['id_siswa' => $this->data['pendaftar']->id_ref, 'jenis_orang_tua' => '3'])->first();

        $countryModel = new Provinces();
        $this->data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

        $city = new Cities();
        $this->data['city'] = $city->where('city_id', $this->data['pendaftar']->kabupaten)->first();

        $district = new Districts();
        $this->data['district'] = $district->where('dis_id', $this->data['pendaftar']->kecamatan)->first();

        $subdistrict = new Subdistricts();
        $this->data['subdistrict'] = $subdistrict->where('subdis_id', $this->data['pendaftar']->kelurahan)->first();

        $jurusan = new DataJurusan();
        $this->data['jurusan'] = $jurusan->findAll();

        $sekolah = new DataSekolah();
        $this->data['sekolah'] = $sekolah->findAll();

        $postalcode = new Postalcode();
        $this->data['postalcode'] = $postalcode->where('postal_id', $this->data['pendaftar']->kode_pos)->first();

        $rapot = new Rapot();
        $this->data['rapot'] = $rapot->findAll();

        $data_prestasi = new DataPrestasi();
        $this->data['prestasi'] = $data_prestasi->where('id_siswa', $id)->findAll();

        $beasiswa = new DataBeasiswa();
        $this->data['beasiswa'] = $beasiswa->where('id_siswa', $id)->findAll();

        $data_afirmasi = new DataAfirmasi();
        $this->data['afirmasi'] = $data_afirmasi->where('id_pendaftar', $id)->findAll();

        $jenis_nilai = new JenisNilai();
        $this->data['jenis_nilai'] = $jenis_nilai->where('id_pendaftar', $id)->findAll();

        $tahap = new DataTahap();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();

        $this->data['page'] = 'Ubah Data Pendaftar';
        $this->data['ket'] = 'Ubah Data Pendaftar SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Ubah Data Pendaftar';
        $this->data['isFullCalendar'] = true;
        $this->data['activePage'] = 'pendaftar';

        if ($this->data['pendaftar']->opsi_jalur == $reguler->id) return view('Admin/profil_siswa', $this->data);
        if ($this->data['pendaftar']->opsi_jalur == $prestasi->id) return view('Admin/profil_prestasi', $this->data);
        if ($this->data['pendaftar']->opsi_jalur == $afirmasi->id) {
            return view('Admin/profil_afirmasi', $this->data);
        }
        if ($this->data['pendaftar']->opsi_jalur == $custom->id) {
            return view('Admin/profil_custom', $this->data);
        }
    }
    public function edit_ulang_profil($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        
        $reguler = $this->codeWithName('Reguler');
        $afirmasi = $this->codeWithName('Afirmasi');
        $prestasi = $this->codeWithName('Prestasi');
        $custom = $this->codeWithName('Custom');
        
        $this->data['stat1'] = $this->codeWithName('Daftar Ulang Berhasil');
        $this->data['stat2'] = $this->codeWithName('Pembayaran Berhasil');
        $this->data['stat3'] = $this->codeWithName('Menunggu Konfirmasi Pembayaran');
        $this->data['jenis_prestasi'] = $this->codeAll('JENIS PRESTASI');
        $this->data['tingkat_prestasi'] = $this->codeAll('TINGKAT PRESTASI');
        $this->data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');
        $this->data['berkebutuhan_khusus'] = $this->codeAll('KEBUTUHAN KHUSUS');
        $this->data['agama'] = $this->codeAll('AGAMA');
        $this->data['kewarganegaraan'] = $this->codeAll('KEWARGANEGARAAN');
        $this->data['tempat_tinggal'] = $this->codeAll('TEMPAT TINGGAL');
        $this->data['moda_transportasi'] = $this->codeAll('MODA TRANSPORTASI');
        $this->data['pendidikan'] = $this->codeAll('PENDIDIKAN');
        $this->data['pekerjaan'] = $this->codeAll('PEKERJAAN');
        $this->data['penghasilan_bulanan'] = $this->codeAll('PENGHASILAN BULANAN');
        $this->data['agama'] = $this->codeAll('AGAMA');

        $this->data['jenis_prestasi'] = $this->codeAll('JENIS PRESTASI');
        $this->data['tingkat_prestasi'] = $this->codeAll('TINGKAT PRESTASI');
        $this->data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');

        $this->data['alasan_layak_pip'] = $this->codeAll('ALASAN LAYAK PIP');

        $pendaftar = new DataPendaftar();
        $this->data['pendaftar'] = $pendaftar->join('user', 'user.id_ref = data_pendaftar.id')->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('jalur', 'jalur.id = pendaftaran.jalur')->where('data_pendaftar.id', $id)->first();

        $orang_tua = new DataOrangTua();
        $this->data['ibu'] = $orang_tua->where(['id_siswa' => $this->data['pendaftar']->id_ref, 'jenis_orang_tua' => '2'])->first();
        $this->data['ayah'] = $orang_tua->where(['id_siswa' => $this->data['pendaftar']->id_ref, 'jenis_orang_tua' => '1'])->first();
        $this->data['wali'] = $orang_tua->where(['id_siswa' => $this->data['pendaftar']->id_ref, 'jenis_orang_tua' => '3'])->first();

        $countryModel = new Provinces();
        $this->data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

        $city = new Cities();
        $this->data['city'] = $city->where('city_id', $this->data['pendaftar']->kabupaten)->first();

        $district = new Districts();
        $this->data['district'] = $district->where('dis_id', $this->data['pendaftar']->kecamatan)->first();

        $subdistrict = new Subdistricts();
        $this->data['subdistrict'] = $subdistrict->where('subdis_id', $this->data['pendaftar']->kelurahan)->first();

        $jurusan = new DataJurusan();
        $this->data['jurusan'] = $jurusan->findAll();

        $sekolah = new DataSekolah();
        $this->data['sekolah'] = $sekolah->findAll();

        $postalcode = new Postalcode();
        $this->data['postalcode'] = $postalcode->where('postal_id', $this->data['pendaftar']->kode_pos)->first();

        $rapot = new Rapot();
        $this->data['rapot'] = $rapot->findAll();

        $data_prestasi = new DataPrestasi();
        $this->data['prestasi'] = $data_prestasi->where('id_siswa', $id)->findAll();

        $beasiswa = new DataBeasiswa();
        $this->data['beasiswa'] = $beasiswa->where('id_siswa', $id)->findAll();

        $data_afirmasi = new DataAfirmasi();
        $this->data['afirmasi'] = $data_afirmasi->where('id_pendaftar', $id)->findAll();

        $jenis_nilai = new JenisNilai();
        $this->data['jenis_nilai'] = $jenis_nilai->where('id_pendaftar', $id)->findAll();

        $this->data['page'] = 'Daftar Ulang';
        $this->data['ket'] = 'Daftar Ulang Pendaftar SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Daftar Ulang';
        $this->data['isFullCalendar'] = true;
        $this->data['activePage'] = 'daftar-ulang';
        

        if ($this->data['pendaftar']->opsi_jalur == $reguler->id) {
            return view('Admin/profil_zonasi', $this->data);
        }
        if ($this->data['pendaftar']->opsi_jalur == $prestasi->id) {
            return view('Admin/profil_prestasi', $this->data);
        }
        if ($this->data['pendaftar']->opsi_jalur == $afirmasi->id) {
            return view('Admin/profil_afirmasi', $this->data);
        }
        if ($this->data['pendaftar']->opsi_jalur == $custom->id) {
            return view('Admin/profil_custom', $this->data);
        }
        

    }

    public function update_profil($id)
    {
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->where('id', $id)->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->first();
        
        
        $orang_tua = new DataOrangTua();
        $data_orang_tua = $orang_tua->where('id_siswa', $id)->findAll();
        $data_ibu = $orang_tua->where(['id_siswa' => $data_pendaftar->id, 'jenis_orang_tua' => '2'])->first();
        $data_ayah = $orang_tua->where(['id_siswa' => $data_pendaftar->id, 'jenis_orang_tua' => '1'])->first();
        $data_wali = $orang_tua->where(['id_siswa' => $data_pendaftar->id, 'jenis_orang_tua' => '3'])->first();
        $user = new Users();
        $this->data['page'] = 'profil';

        $tanggal_lahir = $this->request->getPost('tanggal_lahir');

        // if ($this->request->getPost('nisn') == $data_pendaftar->nisn) {
        //     $pendaftar->update($id, [
        //         "nisn" => $this->request->getPost('nisn'),
        //     ]);
        // }
        // if ($this->request->getPost('nik') == $data_pendaftar->nik) {
        //     $pendaftar->update($id, [
        //         "nik" => $this->request->getPost('nik'),
        //     ]);
        // }
        
        // if ($this->request->getPost('email') == $data_pendaftar->email) {
        //     $pendaftar->update($id, [
        //         "email" => " ",
        //     ]);
        // }
        
        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getFile('file_foto') != '') {
            $validation->setRules([
                'nisn' => [
                    'rules' => 'min_length[10]',
                    'errors' => [
                        'min_length' => 'NISN Minimal 10 Karakter',
                        
                    ]
                ],
                'nik' => [
                    'rules' => 'min_length[16]',
                    'errors' => [
                        'min_length' => 'NIK Minimal 16 Karakter',
                        
                    ]
                ],
                'file_foto' => [
                    'rules' => 'mime_in[file_foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[file_foto,2048]',
                    'errors' => [
                        'mime_in' => 'Format file salah',
                        'max_size' => 'Ukuran file maksimal 2 MB',
                    ]
                ],
                
            ]);
        } else {
            $validation->setRules([
                'nisn' => [
                    'rules' => 'min_length[10]',
                    'errors' => [
                        'min_length' => 'NISN Minimal 10 Karakter',
                        
                    ]
                ],
                'nik' => [
                    'rules' => 'min_length[16]',
                    'errors' => [
                        'min_length' => 'NIK Minimal 16 Karakter',
                        
                    ]
                ],
            ]);
        }

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            if ($this->request->getFile('file_foto') != '') {
                $dataBerkas = $this->request->getFile('file_foto');
                $old_informasi = $data_pendaftar->foto;
                if (!empty($old_informasi)) {
                    $path = './assets/' . $old_informasi;
                    chmod($path, 0777);
                    unlink($path);
                }
                $fileName = 'file_foto_' . $dataBerkas->getName();
                $dataBerkas->move('./assets/', $fileName);
            } else {
                $fileName = $data_pendaftar->foto;
            }

            if ($this->request->getVar('asal_sekolah_check') != '') {
                $status = 'on';
            } else {
                $status = 'off';
            }
            if ($this->request->getVar('asal_sekolah') == '') {
                $results = null;
            } else $results = $this->request->getVar('asal_sekolah');

            if ($this->request->getVar('asal_sekolah_manual') == '') {
                $results_manual = null;
            } else $results_manual = $this->request->getVar('asal_sekolah_manual');

            $pendaftar->update($id, [
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
                "asal_sekolah" => $results,
                "asal_sekolah_manual" => $results_manual,
                "type_asal_sekolah" => $status,
                "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus'),
                "jurusan" => $this->request->getPost('jurusan'),
                "jurusan2" => $this->request->getPost('jurusan2'),
                "foto" => $fileName,
                
            ]);
            $pendaftar_id = $pendaftar->getInsertID();
            if ($data_orang_tua) {
                
                if (!$data_ayah) {
                    $orang_tua->insert([
                        "id_siswa" => $id,
                        "jenis_orang_tua" => '1',
                        "nama" => $this->request->getPost('nama_ayah'),
                        "pendidikan" => $this->request->getPost('pendidikan_ayah'),
                        "pekerjaan" => $this->request->getPost('pekerjaan_ayah'),
                        "nomor_hp" => $this->request->getPost('nomor_hp_ayah'),
                        "alamat" => $this->request->getPost('alamat_ayah'),
                    ]);
                }
                if (!$data_ibu) {
                    $orang_tua->insert([
                        "id_siswa" => $id,
                        "jenis_orang_tua" => '2',
                        "nama" => $this->request->getPost('nama_ibu'),
                        "pendidikan" => $this->request->getPost('pendidikan_ibu'),
                        "pekerjaan" => $this->request->getPost('pekerjaan_ibu'),
                        "nomor_hp" => $this->request->getPost('nomor_hp_ibu'),
                        "alamat" => $this->request->getPost('alamat_ibu'),
                    ]);
                }
                if (!$data_wali) {
                    $orang_tua->insert([
                        "id_siswa" => $id,
                        "jenis_orang_tua" => '3',
                        "nama" => $this->request->getPost('nama_wali'),
                        "pendidikan" => $this->request->getPost('pendidikan_wali'),
                        "pekerjaan" => $this->request->getPost('pekerjaan_wali'),
                        "nomor_hp" => $this->request->getPost('nomor_hp_wali'),
                        "alamat" => $this->request->getPost('alamat_wali'),
                    ]);
                }
                
                
                foreach ($data_orang_tua as $do) {
                    if ($do->jenis_orang_tua == '1') {
                        $orang_tua->update($do->id, [
                            "jenis_orang_tua" => '1',
                            "nama" => $this->request->getPost('nama_ayah'),
                            "pendidikan" => $this->request->getPost('pendidikan_ayah'),
                            "pekerjaan" => $this->request->getPost('pekerjaan_ayah'),
                            "nomor_hp" => $this->request->getPost('nomor_hp_ayah'),
                            "alamat" => $this->request->getPost('alamat_ayah'),
                        ]);
                    }
                    if ($do->jenis_orang_tua == '2') {
                        $orang_tua->update($do->id, [
                            "jenis_orang_tua" => '2',
                            "nama" => $this->request->getPost('nama_ibu'),
                            "pendidikan" => $this->request->getPost('pendidikan_ibu'),
                            "pekerjaan" => $this->request->getPost('pekerjaan_ibu'),
                            "nomor_hp" => $this->request->getPost('nomor_hp_ibu'),
                            "alamat" => $this->request->getPost('alamat_ibu'),
                        ]);
                    }
                    if ($do->jenis_orang_tua == '3') {
                        $orang_tua->update($do->id, [
                            "jenis_orang_tua" => '3',
                            "nama" => $this->request->getPost('nama_wali'),
                            "pendidikan" => $this->request->getPost('pendidikan_wali'),
                            "pekerjaan" => $this->request->getPost('pekerjaan_wali'),
                            "nomor_hp" => $this->request->getPost('nomor_hp_wali'),
                            "alamat" => $this->request->getPost('alamat_wali'),
                        ]);
                    }
                }
            } else {

                if ($this->request->getPost('nama_ayah') != '') {
                    $orang_tua->insert([
                        "id_siswa" => $id,
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
                        "id_siswa" => $id,
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
                        "id_siswa" => $id,
                        "jenis_orang_tua" => '3',
                        "nama" => $this->request->getPost('nama_wali'),
                        "pendidikan" => $this->request->getPost('pendidikan_wali'),
                        "pekerjaan" => $this->request->getPost('pekerjaan_wali'),
                        "nomor_hp" => $this->request->getPost('nomor_hp_wali'),
                        "alamat" => $this->request->getPost('alamat_wali'),
                    ]);
                }
            }
            
            
            
            
            session()->setFlashdata('alert', 'Data Pendaftar berhasil diubah');
            return redirect()->to('data-pendaftar/' . $data_pendaftar->tahap);
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('profil-siswa/' . $id)->withInput();
        }
    }

    public function update_zonasi($id)
    {
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->where('id', $id)->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->first();
        
        
        $orang_tua = new DataOrangTua();
        $data_orang_tua = $orang_tua->where('id_siswa', $id)->findAll();
        $user = new Users();
        $this->data['page'] = 'profil';

        $tanggal_lahir = $this->request->getPost('tanggal_lahir');

        // if ($this->request->getPost('nisn') == $data_pendaftar->nisn) {
        //     $pendaftar->update($id, [
        //         "nisn" => $this->request->getPost('nisn'),
        //     ]);
        // }
        // if ($this->request->getPost('nik') == $data_pendaftar->nik) {
        //     $pendaftar->update($id, [
        //         "nik" => $this->request->getPost('nik'),
        //     ]);
        // }
        
        // if ($this->request->getPost('email') == $data_pendaftar->email) {
        //     $pendaftar->update($id, [
        //         "email" => " ",
        //     ]);
        // }
        
        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getFile('file_foto') != '') {
            $validation->setRules([
                'nisn' => [
                    'rules' => 'min_length[10]',
                    'errors' => [
                        'min_length' => 'NISN Minimal 10 Karakter',
                        
                    ]
                ],
                'nik' => [
                    'rules' => 'min_length[16]',
                    'errors' => [
                        'min_length' => 'NIK Minimal 16 Karakter',
                        
                    ]
                ],
                'file_foto' => [
                    'rules' => 'mime_in[file_foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[file_foto,2048]',
                    'errors' => [
                        'mime_in' => 'Format file salah',
                        'max_size' => 'Ukuran file maksimal 2 MB',
                    ]
                ],
                
            ]);
        } else {
            $validation->setRules([
                'nisn' => [
                    'rules' => 'min_length[10]',
                    'errors' => [
                        'min_length' => 'NISN Minimal 10 Karakter',
                        
                    ]
                ],
                'nik' => [
                    'rules' => 'min_length[16]',
                    'errors' => [
                        'min_length' => 'NIK Minimal 16 Karakter',
                        
                    ]
                ],
            ]);
        }

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            if ($this->request->getFile('file_foto') != '') {
                $dataBerkas = $this->request->getFile('file_foto');
                $old_informasi = $data_pendaftar->foto;
                if (!empty($old_informasi)) {
                    $path = './assets/' . $old_informasi;
                    chmod($path, 0777);
                    unlink($path);
                }
                $fileName = 'file_foto_' . $dataBerkas->getName();
                $dataBerkas->move('./assets/', $fileName);
            } else {
                $fileName = $data_pendaftar->foto;
            }

            if ($this->request->getVar('asal_sekolah_check') != '') {
                $status = 'on';
            } else {
                $status = 'off';
            }
            if ($this->request->getVar('asal_sekolah') == '') {
                $results = null;
            } else $results = $this->request->getVar('asal_sekolah');

            if ($this->request->getVar('asal_sekolah_manual') == '') {
                $results_manual = null;
            } else $results_manual = $this->request->getVar('asal_sekolah_manual');


            $pendaftar->update($id, [
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
                "asal_sekolah" => $results,
                "asal_sekolah_manual" => $results_manual,
                "type_asal_sekolah" => $status,
                "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus'),
                "jurusan" => $this->request->getPost('jurusan'),
                "jurusan2" => $this->request->getPost('jurusan2'),
                "foto" => $fileName,
                "status_penerimaan" => '106'
            ]);
            $pendaftar_id = $pendaftar->getInsertID();
            if ($data_orang_tua) {
                if ($this->request->getPost('nama_ayah') != '') {
                    $orang_tua->insert([
                        "id_siswa" => $id,
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
                        "id_siswa" => $id,
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
                        "id_siswa" => $id,
                        "jenis_orang_tua" => '3',
                        "nama" => $this->request->getPost('nama_wali'),
                        "pendidikan" => $this->request->getPost('pendidikan_wali'),
                        "pekerjaan" => $this->request->getPost('pekerjaan_wali'),
                        "nomor_hp" => $this->request->getPost('nomor_hp_wali'),
                        "alamat" => $this->request->getPost('alamat_wali'),
                    ]);
                }
                foreach ($data_orang_tua as $do) {
                    if ($do->jenis_orang_tua == '1') {
                        $orang_tua->update($do->id, [
                            "jenis_orang_tua" => '1',
                            "nama" => $this->request->getPost('nama_ayah'),
                            "pendidikan" => $this->request->getPost('pendidikan_ayah'),
                            "pekerjaan" => $this->request->getPost('pekerjaan_ayah'),
                            "nomor_hp" => $this->request->getPost('nomor_hp_ayah'),
                            "alamat" => $this->request->getPost('alamat_ayah'),
                        ]);
                    }
                    if ($do->jenis_orang_tua == '2') {
                        $orang_tua->update($do->id, [
                            "jenis_orang_tua" => '2',
                            "nama" => $this->request->getPost('nama_ibu'),
                            "pendidikan" => $this->request->getPost('pendidikan_ibu'),
                            "pekerjaan" => $this->request->getPost('pekerjaan_ibu'),
                            "nomor_hp" => $this->request->getPost('nomor_hp_ibu'),
                            "alamat" => $this->request->getPost('alamat_ibu'),
                        ]);
                    }
                    if ($do->jenis_orang_tua == '3') {
                        $orang_tua->update($do->id, [
                            "jenis_orang_tua" => '3',
                            "nama" => $this->request->getPost('nama_wali'),
                            "pendidikan" => $this->request->getPost('pendidikan_wali'),
                            "pekerjaan" => $this->request->getPost('pekerjaan_wali'),
                            "nomor_hp" => $this->request->getPost('nomor_hp_wali'),
                            "alamat" => $this->request->getPost('alamat_wali'),
                        ]);
                    }
                }
            } else {

                
                if ($this->request->getPost('nama_ayah') != '') {
                    $orang_tua->insert([
                        "id_siswa" => $id,
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
                        "id_siswa" => $id,
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
                        "id_siswa" => $id,
                        "jenis_orang_tua" => '3',
                        "nama" => $this->request->getPost('nama_wali'),
                        "pendidikan" => $this->request->getPost('pendidikan_wali'),
                        "pekerjaan" => $this->request->getPost('pekerjaan_wali'),
                        "nomor_hp" => $this->request->getPost('nomor_hp_wali'),
                        "alamat" => $this->request->getPost('alamat_wali'),
                    ]);
                }
            }
            
            
            
            session()->setFlashdata('alert', 'Terima kasih anda sudah melakukan daftar Ulang');
            return redirect()->to('registrasi-ulang/' . $data_pendaftar->id);
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('registrasi-ulang/' . $data_pendaftar->id);
        }
    }

    public function status_penerimaan($id)
    {
        $pendaftar = new DataPendaftar();

        $periode = new DataPeriode();

        $this->data['periode'] = $periode->where('status', 'aktif')->first();

        $pendaftar->update($id, [
            "status_penerimaan" => $this->request->getPost('status'),
        ]);

        session()->setFlashdata('alert', 'Status Pendaftaran Berhasil Diubah');
        return redirect()->back();
    }

    public function delete_pendaftar($id)
    {
        $pendaftar = new DataPendaftar();
        $pendaftaran = new DataPendaftaran();

        $user = new Users();
        $data_user = $user->where('id_ref', $id)->first();

        $orang_tua = new DataOrangTua();
        $data_orang_tua = $orang_tua->where('id_siswa', $id)->findAll();

        $pendaftar->delete($id);
        $pendaftaran->delete($id);
        $user->delete($data_user->id);
        foreach ($data_orang_tua as $do) {
            $orang_tua->delete($do->id);
        }

        session()->setFlashdata('alert', 'Data berhasil dihapus');

        return redirect()->back();
    }
}
