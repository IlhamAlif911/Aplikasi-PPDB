<?php

namespace App\Controllers;

use App\Models\DataPeriode;
use App\Models\DataTahap;
use App\Models\DataJalur;


class TahapSeleksi extends Base
{
    public function add_periode()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $periode = new DataPeriode();

        $tahap = new DataTahap();

        if (!$this->validate([
            'nama_periode' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('alert', 'Data berhasil ditambahkan');
        }

        if ($this->request->getVar('status') == '') {
            $status = 'tidak_aktif';
        } else $status = 'aktif';

        $periode->insert([
            'nama_periode' => $this->request->getVar('nama_periode'),
            'status' => $status
        ]);

        return redirect()->to('data-periode');
    }

    public function add_tahap()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $tahap = new DataTahap();

        $tanggal_mulai = $this->formatTanggalReverse($this->request->getPost('tanggal_mulai'));
        $tanggal_selesai = $this->formatTanggalReverse($this->request->getPost('tanggal_selesai'));

        if (!$this->validate([
            'nama_tahap' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('alert', 'Data berhasil ditambahkan');
        }

        $tahap->insert([
            'id_periode' => $this->request->getVar('periode'),
            'nama_tahap' => $this->request->getVar('nama_tahap'),
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ]);

        return redirect()->to('data-tahap');
    }

    public function add_jalur()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $jalur = new DataJalur();

        $data_jalur = $this->request->getVar('nama_jalur');
        $data_kuota = $this->request->getVar('kuota');

        for ($i = 0; $i < count($data_jalur); $i++) {
            $jalur->insert([
                'id_tahap' => $this->request->getVar('tahap'),
                'nama_jalur' => $data_jalur[$i],
                'kuota' => $data_kuota[$i],
                'opsi_jalur' => $this->request->getVar('opsi_jalur'),
            ]);
        }

        return redirect()->to('data-jalur');
    }

    public function update_periode($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $periode = new DataPeriode();

        $data_periode = $periode->findAll();

        if (!$this->validate([
            'nama_periode' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('alert', 'Data berhasil diedit');
        }

        if ($this->request->getVar('status') != '') {
            $status = 'aktif';
        } else {
            $status = 'tidak_aktif';
        }

        $periode->update($id, [
            'nama_periode' => $this->request->getVar('nama_periode'),
            'status' => $status
        ]);

        if ($this->request->getVar('status') != '') {
            foreach ($data_periode as $dp) {
                if ($dp->id != $id) {
                    $periode->update($dp->id, [
                        'status' => 'tidak_aktif'
                    ]);
                }
            }
        }

        return redirect()->to('data-periode');
    }

    public function update_tahap($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $tahap = new DataTahap();

        $tanggal_mulai = $this->formatTanggalReverse($this->request->getPost('tanggal_mulai'));
        $tanggal_selesai = $this->formatTanggalReverse($this->request->getPost('tanggal_selesai'));

        if (!$this->validate([
            'nama_tahap' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('alert', 'Data berhasil diedit');
        }

        $tahap->update($id, [
                'id_periode' => $this->request->getVar('periode'),
                'nama_tahap' => $this->request->getVar('nama_tahap'),
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_selesai' => $tanggal_selesai,
        ]);

        return redirect()->to('data-tahap');
    }

    public function update_jalur($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $jalur = new DataJalur();

        if (!$this->validate([
            'nama_jalur' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('alert', 'Data berhasil diedit');
        }

        $jalur->update($id, [
            'nama_jalur' => $this->request->getVar('nama_jalur'),
            'kuota' => $this->request->getVar('kuota'),
            'syarat' => $this->request->getVar('syarat'),
            'opsi_jalur' => $this->request->getVar('opsi_jalur'),
        ]);

        return redirect()->to('data-jalur');
    }

    public function delete_periode($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $periode = new DataPeriode();

        $periode->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('data-periode');
    }

    public function delete_tahap($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $tahap = new DataTahap();

        $tahap->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('data-tahap');
    }

    public function delete_jalur($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $jalur = new DataJalur();

        $jalur->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('data-jalur');
    }
}
