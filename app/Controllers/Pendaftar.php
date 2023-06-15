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

class Pendaftar extends Base
{
    public function edit_profil($id)
    {
        $reguler = $this->codeWithName('Reguler');
        $afirmasi = $this->codeWithName('Afirmasi');
        $prestasi = $this->codeWithName('Prestasi');
        $custom = $this->codeWithName('Custom');


        $data['jenis_prestasi'] = $this->codeAll('JENIS PRESTASI');
        $data['tingkat_prestasi'] = $this->codeAll('TINGKAT PRESTASI');
        $data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');
        $data['berkebutuhan_khusus'] = $this->codeAll('KEBUTUHAN KHUSUS');
        $data['agama'] = $this->codeAll('AGAMA');
        $data['kewarganegaraan'] = $this->codeAll('KEWARGANEGARAAN');
        $data['tempat_tinggal'] = $this->codeAll('TEMPAT TINGGAL');
        $data['moda_transportasi'] = $this->codeAll('MODA TRANSPORTASI');
        $data['pendidikan'] = $this->codeAll('PENDIDIKAN');
        $data['pekerjaan'] = $this->codeAll('PEKERJAAN');
        $data['penghasilan_bulanan'] = $this->codeAll('PENGHASILAN BULANAN');
        $data['agama'] = $this->codeAll('AGAMA');

        $data['jenis_prestasi'] = $this->codeAll('JENIS PRESTASI');
        $data['tingkat_prestasi'] = $this->codeAll('TINGKAT PRESTASI');
        $data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');

        $data['alasan_layak_pip'] = $this->codeAll('ALASAN LAYAK PIP');

        $pendaftar = new DataPendaftar();
        $data['pendaftar'] = $pendaftar->join('user', 'user.id_ref = data_pendaftar.id')->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('jalur', 'jalur.id = pendaftaran.jalur')->where('data_pendaftar.id', $id)->first();

        $orang_tua = new DataOrangTua();
        $data['ibu'] = $orang_tua->where(['id_siswa' => $data['pendaftar']->id_ref, 'jenis_orang_tua' => '2'])->first();
        $data['ayah'] = $orang_tua->where(['id_siswa' => $data['pendaftar']->id_ref, 'jenis_orang_tua' => '1'])->first();
        $data['wali'] = $orang_tua->where(['id_siswa' => $data['pendaftar']->id_ref, 'jenis_orang_tua' => '3'])->first();

        $countryModel = new Provinces();
        $data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

        $city = new Cities();
        $data['city'] = $city->where('city_id', $data['pendaftar']->kabupaten)->first();

        $district = new Districts();
        $data['district'] = $district->where('dis_id', $data['pendaftar']->kecamatan)->first();

        $subdistrict = new Subdistricts();
        $data['subdistrict'] = $subdistrict->where('subdis_id', $data['pendaftar']->kelurahan)->first();

        $jurusan = new DataJurusan();
        $data['jurusan'] = $jurusan->findAll();

        $postalcode = new Postalcode();
        $data['postalcode'] = $postalcode->where('postal_id', $data['pendaftar']->kode_pos)->first();

        $rapot = new Rapot();
        $data['rapot'] = $rapot->findAll();

        $data_prestasi = new DataPrestasi();
        $data['prestasi'] = $data_prestasi->where('id_siswa', $id)->findAll();

        $beasiswa = new DataBeasiswa();
        $data['beasiswa'] = $beasiswa->where('id_siswa', $id)->findAll();

        $data_afirmasi = new DataAfirmasi();
        $data['afirmasi'] = $data_afirmasi->where('id_pendaftar', $id)->findAll();

        $jenis_nilai = new JenisNilai();
        $data['jenis_nilai'] = $jenis_nilai->where('id_pendaftar', $id)->findAll();

        $data['page'] = 'profil';
        $data['title'] = 'Ubah Profil';

        if ($data['pendaftar']->opsi_jalur == $reguler->id) return view('Admin/profil_siswa', $data);
        if ($data['pendaftar']->opsi_jalur == $prestasi->id) return view('Admin/profil_prestasi', $data);
        if ($data['pendaftar']->opsi_jalur == $afirmasi->id) {
            return view('Admin/profil_afirmasi', $data);
        }
        if ($data['pendaftar']->opsi_jalur == $custom->id) {
            return view('Admin/profil_custom', $data);
        }
    }
    public function edit_ulang_profil($id)
    {
        $reguler = $this->codeWithName('Reguler');
        $afirmasi = $this->codeWithName('Afirmasi');
        $prestasi = $this->codeWithName('Prestasi');
        $custom = $this->codeWithName('Custom');
        
        $data['stat1'] = $this->codeWithName('Daftar Ulang Berhasil');
        $data['stat2'] = $this->codeWithName('Pembayaran Berhasil');
        $data['stat3'] = $this->codeWithName('Menunggu Konfirmasi Pembayaran');
        $data['jenis_prestasi'] = $this->codeAll('JENIS PRESTASI');
        $data['tingkat_prestasi'] = $this->codeAll('TINGKAT PRESTASI');
        $data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');
        $data['berkebutuhan_khusus'] = $this->codeAll('KEBUTUHAN KHUSUS');
        $data['agama'] = $this->codeAll('AGAMA');
        $data['kewarganegaraan'] = $this->codeAll('KEWARGANEGARAAN');
        $data['tempat_tinggal'] = $this->codeAll('TEMPAT TINGGAL');
        $data['moda_transportasi'] = $this->codeAll('MODA TRANSPORTASI');
        $data['pendidikan'] = $this->codeAll('PENDIDIKAN');
        $data['pekerjaan'] = $this->codeAll('PEKERJAAN');
        $data['penghasilan_bulanan'] = $this->codeAll('PENGHASILAN BULANAN');
        $data['agama'] = $this->codeAll('AGAMA');

        $data['jenis_prestasi'] = $this->codeAll('JENIS PRESTASI');
        $data['tingkat_prestasi'] = $this->codeAll('TINGKAT PRESTASI');
        $data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');

        $data['alasan_layak_pip'] = $this->codeAll('ALASAN LAYAK PIP');

        $pendaftar = new DataPendaftar();
        $data['pendaftar'] = $pendaftar->join('user', 'user.id_ref = data_pendaftar.id')->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('jalur', 'jalur.id = pendaftaran.jalur')->where('data_pendaftar.id', $id)->first();

        $orang_tua = new DataOrangTua();
        $data['ibu'] = $orang_tua->where(['id_siswa' => $data['pendaftar']->id_ref, 'jenis_orang_tua' => '2'])->first();
        $data['ayah'] = $orang_tua->where(['id_siswa' => $data['pendaftar']->id_ref, 'jenis_orang_tua' => '1'])->first();
        $data['wali'] = $orang_tua->where(['id_siswa' => $data['pendaftar']->id_ref, 'jenis_orang_tua' => '3'])->first();

        $countryModel = new Provinces();
        $data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

        $city = new Cities();
        $data['city'] = $city->where('city_id', $data['pendaftar']->kabupaten)->first();

        $district = new Districts();
        $data['district'] = $district->where('dis_id', $data['pendaftar']->kecamatan)->first();

        $subdistrict = new Subdistricts();
        $data['subdistrict'] = $subdistrict->where('subdis_id', $data['pendaftar']->kelurahan)->first();

        $jurusan = new DataJurusan();
        $data['jurusan'] = $jurusan->findAll();

        $postalcode = new Postalcode();
        $data['postalcode'] = $postalcode->where('postal_id', $data['pendaftar']->kode_pos)->first();

        $rapot = new Rapot();
        $data['rapot'] = $rapot->findAll();

        $data_prestasi = new DataPrestasi();
        $data['prestasi'] = $data_prestasi->where('id_siswa', $id)->findAll();

        $beasiswa = new DataBeasiswa();
        $data['beasiswa'] = $beasiswa->where('id_siswa', $id)->findAll();

        $data_afirmasi = new DataAfirmasi();
        $data['afirmasi'] = $data_afirmasi->where('id_pendaftar', $id)->findAll();

        $jenis_nilai = new JenisNilai();
        $data['jenis_nilai'] = $jenis_nilai->where('id_pendaftar', $id)->findAll();

        $data['page'] = 'profil';
        $data['title'] = 'Daftar Ulang';

        if ($data['pendaftar']->opsi_jalur == $reguler->id) return view('Admin/profil_zonasi', $data);
        if ($data['pendaftar']->opsi_jalur == $prestasi->id) return view('Admin/profil_prestasi', $data);
        if ($data['pendaftar']->opsi_jalur == $afirmasi->id) {
            return view('Admin/profil_afirmasi', $data);
        }
        if ($data['pendaftar']->opsi_jalur == $custom->id) {
            return view('Admin/profil_custom', $data);
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
        $data['page'] = 'profil';

        $tanggal_lahir = $this->formatTanggalReverse($this->request->getPost('tanggal_lahir'));

        if ($this->request->getPost('nisn') == $data_pendaftar->nisn) {
            $pendaftar->update($id, [
                "nisn" => " ",
            ]);
        }
        if ($this->request->getPost('nik') == $data_pendaftar->nik) {
            $pendaftar->update($id, [
                "nik" => " ",
            ]);
        }
        
        if ($this->request->getPost('email') == $data_pendaftar->email) {
            $pendaftar->update($id, [
                "email" => " ",
            ]);
        }
        
        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getFile('file_foto') != '') {
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
        } else {
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
                'email' => [
                    'rules' => 'is_unique[user.email]',
                    'errors' => [
                        'is_unique' => 'Email sudah digunakan sebelumnya'
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
                "asal_sekolah" => $this->request->getPost('asal_sekolah'),
                "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus'),
                "jurusan" => $this->request->getPost('jurusan'),
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
            return redirect()->to('data-pendaftar/' . $data_pendaftar->tahap);
        }
    }

    public function update_zonasi($id)
    {
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->where('id', $id)->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->first();
        
        
        $orang_tua = new DataOrangTua();
        $data_orang_tua = $orang_tua->where('id_siswa', $id)->findAll();
        $user = new Users();
        $data['page'] = 'profil';

        $tanggal_lahir = $this->formatTanggalReverse($this->request->getPost('tanggal_lahir'));

        if ($this->request->getPost('nisn') == $data_pendaftar->nisn) {
            $pendaftar->update($id, [
                "nisn" => " ",
            ]);
        }
        if ($this->request->getPost('nik') == $data_pendaftar->nik) {
            $pendaftar->update($id, [
                "nik" => " ",
            ]);
        }
        
        if ($this->request->getPost('email') == $data_pendaftar->email) {
            $pendaftar->update($id, [
                "email" => " ",
            ]);
        }
        
        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getFile('file_foto') != '') {
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
        } else {
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
                'email' => [
                    'rules' => 'is_unique[user.email]',
                    'errors' => [
                        'is_unique' => 'Email sudah digunakan sebelumnya'
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
                "asal_sekolah" => $this->request->getPost('asal_sekolah'),
                "berkebutuhan_khusus" => $this->request->getPost('berkebutuhan_khusus'),
                "jurusan" => $this->request->getPost('jurusan'),
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


    public function update_afirmasi($id)
    {
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->where('id', $id)->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->first();

        $orang_tua = new DataOrangTua();
        $data_orang_tua = $orang_tua->where('id_siswa', $id)->findAll();

        $afirmasi = new DataAfirmasi();
        $data_afirmasi = $afirmasi->where('id_pendaftar', $id)->first();

        $user = new Users();

        $data['page'] = 'profil';

        $tanggal_lahir = $this->formatTanggalReverse($this->request->getPost('tanggal_lahir'));

        if ($this->request->getPost('nisn') == $data_pendaftar->nisn) {
            $pendaftar->update($id, [
                "nisn" => " ",
            ]);
        }
        if ($this->request->getPost('nik') == $data_pendaftar->nik) {
            $pendaftar->update($id, [
                "nik" => " ",
            ]);
        }
        if ($this->request->getPost('nomor_akta') == $data_pendaftar->nomor_akta) {
            $pendaftar->update($id, [
                "nomor_akta" => " ",
            ]);
        }
        if ($this->request->getPost('nomor_seri_ijazah') == $data_pendaftar->nomor_seri_ijazah) {
            $pendaftar->update($id, [
                "nomor_seri_ijazah" => " ",
            ]);
        }
        if ($this->request->getPost('nomor_seri_skhus') == $data_pendaftar->nomor_seri_skhus) {
            $pendaftar->update($id, [
                "nomor_seri_skhus" => " ",
            ]);
        }
        if ($this->request->getPost('email') == $data_pendaftar->email) {
            $pendaftar->update($id, [
                "email" => " ",
            ]);
        }

        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getFile('file_foto') != '') {
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
        } else {
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
                'email' => [
                    'rules' => 'is_unique[user.email]',
                    'errors' => [
                        'is_unique' => 'Email sudah digunakan sebelumnya'
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

            $pendaftar->update($id, [
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
                "jurusan" => $this->request->getPost('jurusan'),
                "foto" => $fileName,
            ]);

            foreach ($data_orang_tua as $do) {
                if ($do->jenis_orang_tua == '1') {
                    $orang_tua->update($do->id, [
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
                if ($do->jenis_orang_tua == '2') {
                    $orang_tua->update($do->id, [
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
                if ($do->jenis_orang_tua == '3') {
                    $orang_tua->update($do->id, [
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
            }

            if (!empty($data_afirmasi)) {
                $afirmasi->update($data_afirmasi->id, [
                    "nomor_kks" => $this->request->getPost('nomor_kks'),
                    "nomor_kps_pkh" => $this->request->getPost('nomor_kps_pkh'),
                    "nomor_kip" => $this->request->getPost('nomor_kip'),
                    "nama_kip" => $this->request->getPost('nama_kip'),
                    "alasan_layak_pip" => $this->request->getPost('alasan_layak_pip'),
                ]);
            }

            return redirect()->to('data-pendaftar/' . $data_pendaftar->jalur);
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('data-pendaftar/' . $data_pendaftar->jalur);
        }
    }

    public function update_prestasi($id)
    {
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->where('id', $id)->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->first();

        $orang_tua = new DataOrangTua();
        $data_orang_tua = $orang_tua->where('id_siswa', $id)->findAll();

        $prestasi = new DataBeasiswa();
        $data_prestasi = $prestasi->where('id_siswa', $id)->findAll();

        $beasiswa = new DataPrestasi();
        $data_beasiswa = $beasiswa->where('id_siswa', $id)->findAll();

        $jenis_nilai = new JenisNilai();

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
        $id_prestasi = $this->request->getPost('id_prestasi');
        $id_beasiswa = $this->request->getPost('id_beasiswa');
        $rapot = $this->request->getPost('rapot');
        $jumlah_nilai = count($rapot);

        $user = new Users();

        $data['page'] = 'profil';

        $tanggal_lahir = $this->formatTanggalReverse($this->request->getPost('tanggal_lahir'));

        if ($this->request->getPost('nisn') == $data_pendaftar->nisn) {
            $pendaftar->update($id, [
                "nisn" => " ",
            ]);
        }
        if ($this->request->getPost('nik') == $data_pendaftar->nik) {
            $pendaftar->update($id, [
                "nik" => " ",
            ]);
        }
        if ($this->request->getPost('nomor_akta') == $data_pendaftar->nomor_akta) {
            $pendaftar->update($id, [
                "nomor_akta" => " ",
            ]);
        }
        if ($this->request->getPost('nomor_seri_ijazah') == $data_pendaftar->nomor_seri_ijazah) {
            $pendaftar->update($id, [
                "nomor_seri_ijazah" => " ",
            ]);
        }
        if ($this->request->getPost('nomor_seri_skhus') == $data_pendaftar->nomor_seri_skhus) {
            $pendaftar->update($id, [
                "nomor_seri_skhus" => " ",
            ]);
        }
        if ($this->request->getPost('email') == $data_pendaftar->email) {
            $pendaftar->update($id, [
                "email" => " ",
            ]);
        }

        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getFile('file_foto') != '') {
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
        } else {
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
                'email' => [
                    'rules' => 'is_unique[user.email]',
                    'errors' => [
                        'is_unique' => 'Email sudah digunakan sebelumnya'
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

            $pendaftar->update($id, [
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
                "jurusan" => $this->request->getPost('jurusan'),
                "foto" => $fileName,
            ]);

            foreach ($data_orang_tua as $do) {
                if ($do->jenis_orang_tua == '1') {
                    $orang_tua->update($do->id, [
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
                if ($do->jenis_orang_tua == '2') {
                    $orang_tua->update($do->id, [
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
                if ($do->jenis_orang_tua == '3') {
                    $orang_tua->update($do->id, [
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
            }

            for ($i = 0; $i < $jumlah_nilai; $i++) {
                $jenis_nilai->update($rapot[$i], [
                    "matematika" => $this->request->getPost($rapot[$i] . 'matematika'),
                    "ipa" => $this->request->getPost($rapot[$i] . 'ipa'),
                    "bahasa_inggris" => $this->request->getPost($rapot[$i] . 'bahasa_inggris'),
                    "bahasa_indonesia" => $this->request->getPost($rapot[$i] . 'bahasa_indonesia'),
                ]);
            }

            for ($i = 0; $i < count($id_prestasi); $i++) {
                    $prestasi->update($id_prestasi[$i],[
                        'nama_prestasi' => $nama_prestasi[$i],
                        'jenis_prestasi' => $jenis_prestasi[$i],
                        'peringkat' => $peringkat[$i],
                        'tingkat_prestasi' => $tingkat_prestasi[$i],
                        'penyelenggara' => $penyelenggara[$i],
                        'tahun' => $tahun_prestasi[$i],
                    ]);
            }

            for ($i = 0; $i < count($id_beasiswa); $i++) {
                if($tanggal_mulai[$i] != '') $tanggal_mulainya = $this->formatTanggalReverse($tanggal_mulai[$i]);
                if($tanggal_selesai[$i] != '') $tanggal_selesainya = $this->formatTanggalReverse($tanggal_selesai)[$i];
                $beasiswa->update($id_beasiswa[$i],[
                    'keterangan' => $keterangan[$i],
                    'jenis_beasiswa' => $jenis_beasiswa[$i],
                    'tanggal_mulai' => $tanggal_mulainya,
                    'tanggal_selesai' => $tanggal_selesainya,
                ]);
        }

            return redirect()->to('data-pendaftar/' . $data_pendaftar->jalur);
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('data-pendaftar/' . $data_pendaftar->jalur);
        }
    }

    public function status_penerimaan($id)
    {
        $pendaftar = new DataPendaftar();

        $periode = new DataPeriode();

        $data['periode'] = $periode->where('status', 'aktif')->first();

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
