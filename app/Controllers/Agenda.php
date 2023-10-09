<?php

namespace App\Controllers;

use App\Models\DataAgenda;

class Agenda extends Base
{
    public function add_agenda()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $agenda = new DataAgenda();

        $tanggal_mulai = $this->formatTanggalReverse($this->request->getPost('tanggal_mulai'));
        $tanggal_selesai = $this->formatTanggalReverse($this->request->getPost('tanggal_selesai'));

        session()->setFlashdata('alert', 'Data berhasil ditambahkan');

        $agenda->insert([
            'nama_agenda' => $this->request->getVar('nama_agenda'),
            'sub_nama' => $this->request->getVar('sub_nama'),
            'keterangan' => $this->request->getVar('keterangan'),
            'tanggal_selesai' => $tanggal_selesai,
            'tanggal_mulai' => $tanggal_mulai,
        ]);


        return redirect()->to('data-agenda');
    }

    public function delete_agenda($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $agenda = new DataAgenda();

        $agenda->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('data-agenda');
    }

    public function update_agenda($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $agenda = new DataAgenda();
        $data_agenda = $agenda->where(['id' => $id])->first();

        $tanggal_mulai = $this->formatTanggalReverse($this->request->getPost('tanggal_mulai'));
        $tanggal_selesai = $this->formatTanggalReverse($this->request->getPost('tanggal_selesai'));

        session()->setFlashdata('alert', 'Data berhasil diedit');

        $agenda->update($id, [
            'nama_agenda' => $this->request->getVar('nama_agenda'),
            'sub_nama' => $this->request->getVar('sub_nama'),
            'keterangan' => $this->request->getVar('keterangan'),
            'tanggal_selesai' => $tanggal_selesai,
            'tanggal_mulai' => $tanggal_mulai,
        ]);


        return redirect()->to('data-agenda');
    }
}
