<?php

namespace App\Controllers;

use App\Models\DataPendaftar;
use App\Models\DataPembayaran;
use App\Models\Users;
use App\Models\Cities;
use App\Models\Postalcode;

class Pembayaran extends Base
{
    public function add_konfirmasi()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pendaftar = new DataPendaftar();

        $pembayaran = new DataPembayaran();

        $user = new Users();

        $stat = $this->codeWithName('Daftar Ulang Berhasil');
        $stat1 = $this->codeWithName('Pembayaran Berhasil');

        $data_user = $user->where('nomor_pendaftaran', $this->request->getPost('nomor_pendaftaran'))->first();

        $data_pendaftar = $pendaftar->where('id', $data_user->id_ref)->first();

        if ($this->request->getPost('nama_lengkap') != $data_pendaftar->nama_lengkap) {
            session()->setFlashdata('error', 'Nama dan Nomor Pendaftaran Tidak Sesuai');
            return redirect()->to('data-pembayaran');
        }

        if($data_pendaftar->status_penerimaan != $stat->id){
            session()->setFlashdata('error', 'Siswa belum melakukan daftar ulang');
            return redirect()->to('data-pembayaran');
        }

        $tanggal_transfer = $this->request->getPost('tanggal_transfer');

        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getPost('bukti_transfer') != '') {
            $validation->setRules([
                'bukti_transfer' => [
                    'rules' => 'mime_in[bukti_transfer,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[bukti_transfer,2048]',
                    'errors' => [
                        'mime_in' => 'Format file salah',
                        'max_size' => 'Ukuran file maksimal 2 MB',
                    ]
                ],
            ]);
        } else {
            $validation->setRules([
                'nomor_pendaftaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus diisi',
                    ]
                ],
            ]);
        }

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            
            $pembayaran->insert([
                "id_pendaftar" => $data_pendaftar->id,
                "tanggal_transfer" => $tanggal_transfer,
                "nama_pemilik_rekening" => $this->request->getPost('nama_lengkap'),
                "nama_bank" => 'Tunai',
                "status" => 'settlement',
                "nominal_transfer" => $this->request->getPost('nominal_transfer'),
                
            ]);
            $pendaftar->update($data_pendaftar->id,[
                
                "status_penerimaan" => $stat1->id,
            ]);
            
            session()->setFlashdata('alert', 'Konfirmasi Pembayaran Berhasil Dilakukan. Silakan Cek Status Pendaftaran Anda');
            return redirect()->to('data-pembayaran');
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('data-pembayaran');
        }
    }

    public function add_konfirmasi_siswa()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pendaftar = new DataPendaftar();

        $pembayaran = new DataPembayaran();

        $user = new Users();

        $stat = $this->codeWithName('Menunggu Konfirmasi Pembayaran');

        $data_user = $user->where('nomor_pendaftaran', $this->request->getPost('nomor_pendaftaran'))->first();
        $data_pembayaran = $pembayaran->where('id_pendaftar', $data_user->id_ref)->first();

        $data_pendaftar = $pendaftar->where('id', $data_user->id_ref)->first();

        if ($this->request->getPost('nama_lengkap') != $data_pendaftar->nama_lengkap) {
            session()->setFlashdata('error', 'Nama dan Nomor Pendaftaran Tidak Sesuai');
            return redirect()->to('konfirmasi-pembayaran/'.$data_pendaftar->id);
        }
        if($data_pembayaran){
            session()->setFlashdata('alert', 'Anda sudah melakukan konfirmasi.');
            return redirect()->to('konfirmasi-pembayaran/'.$data_pendaftar->id);
        }

        $tanggal_transfer = $this->request->getPost('tanggal_transfer');

        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getPost('bukti_transfer') != '') {
            $validation->setRules([
                'bukti_transfer' => [
                    'rules' => 'mime_in[bukti_transfer,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[bukti_transfer,2048]',
                    'errors' => [
                        'mime_in' => 'Format file salah',
                        'max_size' => 'Ukuran file maksimal 2 MB',
                    ]
                ],
            ]);
        } else {
            $validation->setRules([
                'nomor_pendaftaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus diisi',
                    ]
                ],
            ]);
        }

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            if ($this->request->getFile('bukti_transfer') != '') {
                $dataBerkas = $this->request->getFile('bukti_transfer');
                $fileName = 'bukti_transfer_' . $dataBerkas->getName();
                $dataBerkas->move('./assets/', $fileName);

                $pembayaran->insert([
                    "id_pendaftar" => $data_pendaftar->id,
                    "tanggal_transfer" => $tanggal_transfer,
                    "nama_pemilik_rekening" => $this->request->getPost('nama_pemilik_rekening'),
                    "nama_bank" => $this->request->getPost('nama_bank'),
                    "status" => 'belum verified',
                    "nominal_transfer" => $this->request->getPost('nominal_transfer'),
                    "bukti_transfer" => $fileName,
                ]);
                $pendaftar->update($data_pendaftar->id,[
                    
                    "status_penerimaan" => $stat->id,
                ]);
            } else {
                $pembayaran->insert([
                    "id_pendaftar" => $data_pendaftar->id,
                    "tanggal_transfer" => $tanggal_transfer,
                    "nama_pemilik_rekening" => $this->request->getPost('nama_pemilik_rekening'),
                    "nama_bank" => $this->request->getPost('nama_bank'),
                    "status" => 'belum verified',
                    "nominal_transfer" => $this->request->getPost('nominal_transfer'),
                ]);
                $pendaftar->update($data_pendaftar->id,[
                    
                    "status_penerimaan" => $stat->id,
                ]);
            }
            
            session()->setFlashdata('alert', 'Konfirmasi Pembayaran Berhasil Ditambahkan');
            return redirect()->to('konfirmasi-pembayaran/'.$data_pendaftar->id);
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('konfirmasi-pembayaran/'.$data_pendaftar->id);
        }
    }

    public function update_konfirmasi($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pembayaran = new DataPembayaran();

        $user = new Users();

        $data_user = $user->where('nomor_pendaftaran', $this->request->getPost('nomor_pendaftaran'))->first();

        $tanggal_transfer = $this->request->getPost('tanggal_transfer');

        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getFile('bukti_transfer') != '') {
            $validation->setRules([
                'bukti_transfer' => [
                    'rules' => 'mime_in[bukti_transfer,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[bukti_transfer,2048]',
                    'errors' => [
                        'mime_in' => 'Format file salah',
                        'max_size' => 'Ukuran file maksimal 2 MB',
                    ]
                ],
            ]);
        } else {
            $validation->setRules([
                'nomor_pendaftaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus diisi',
                    ]
                ],
            ]);
        }

        $isDataValid = $validation->withRequest($this->request)->run();
        $data = $pembayaran->where('id',$id)->first();
        // jika data valid, simpan ke database
        if ($isDataValid) {
            if ($data->nama_bank == 'Tunai') {
                $pembayaran->update($id, [
                    "tanggal_transfer" => $tanggal_transfer,
                    "nama_pemilik_rekening" => $this->request->getPost('nama_pemilik_rekening'),
                    "nama_bank" => $this->request->getPost('nama_bank'),
                    "nominal_transfer" => $this->request->getPost('nominal_transfer'),
                                        
                ]);
            } else {
                $pembayaran->update($id, [
                    "tanggal_transfer" => $tanggal_transfer,
                    "nama_pemilik_rekening" => $this->request->getPost('nama_pemilik_rekening'),
                    "nama_bank" => $this->request->getPost('nama_bank'),
                    "nominal_transfer" => $this->request->getPost('nominal_transfer'),
                                        
                ]);
            }

                
                session()->setFlashdata('alert', 'Pembayaran Berhasil Diubah');
                return redirect()->to('data-pembayaran');
            
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('data-pembayaran');
        }
    }

    public function konfirmasi_pembayaran($id)
    {
        $user = new Users();
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }

        //view
        $pendaftar = new DataPendaftar();
        $pembayaran = new DataPembayaran();
        $city = new Cities();
        $postalcode = new Postalcode();
        $this->data['pembayaran'] = $pembayaran->where('id_pendaftar',$id)->first();

        $this->data['stat'] = $this->codeWithName('Daftar Ulang Berhasil');

        $this->data['user'] = $user->where('id_ref',$id)->first();

        $this->data['pendaftar'] = $pendaftar->where('id',$id)->first();
        
        $this->data['city'] = $city->where('city_id', $this->data['pendaftar']->kabupaten)->first();

        $this->data['postalcode'] = $postalcode->where('postal_id', $this->data['pendaftar']->kode_pos)->first();
        
        $this->data['page'] = 'Pembayaran PPDB';
        $this->data['ket'] = 'Pembayaran PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Pembayaran Pendaftar';
        $this->data['isFullCalendar'] = true;
        $this->data['activePage'] = 'pembayaran';

        return view('Admin/konfirmasi_pembayaran',$this->data);
    }

    public function status_pembayaran($id,$id_pendaftar)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pembayaran = new DataPembayaran();
        $pendaftar = new DataPendaftar();
        $stat = $this->codeWithName('Pembayaran Berhasil');
        $pendaftar->update($id_pendaftar,[
            "status_penerimaan" => $stat->id,
        ]);
        $pembayaran->update($id, [
            "status" => 'verified',
        ]);

        session()->setFlashdata('alert', 'Status Pembayaran Berhasil Diubah');
        return redirect()->to('data-pembayaran');
    }

    public function delete_pembayaran($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pembayaran = new DataPembayaran();

        $pembayaran->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('data-pembayaran');
    }
}
