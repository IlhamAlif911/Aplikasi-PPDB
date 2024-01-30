<?php

namespace App\Controllers;
use App\Models\KategoriKode;
use App\Models\KodeAplikasi;
use App\Models\DataTahap;


class Opsi extends BaseController
{
    public function edit_kategori($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $kode_aplikasi = new KodeAplikasi();

        $kategori = new KategoriKode();

        $this->data['page'] = 'kategori';
        $this->data['title'] = 'Kategori';
        $tahap = new DataTahap();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['ket'] = 'Kode Aplikasi PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['page'] = 'Kode Aplikasi';
        $this->data['title'] = 'kode Apiikasi';
        $this->data['activePage'] = 'kategori';

        $this->data['kategori'] = $kategori->where('id',$id)->first();

		$this->data['kode_aplikasi'] = $kode_aplikasi->where('id_kategori',$id)->findall();

        return view('Admin/kode_aplikasi',$this->data);
    }

    public function update_kategori($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $kategori = new KategoriKode();

        $this->data['kategori'] = $kategori->where('id',$id)->findall();

        if (!$this->validate([
            'nama_kategori' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
        ])) 
        {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        else{
            session()->setFlashdata('alert', 'Data berhasil diedit');
        }

        $kategori->update($id,[
            'nama_kategori' => $this->request->getVar('nama_kategori'),
        ]);

        return redirect()->to('kategori-kode');
    }

    public function add_kategori(){
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $kategori=new KategoriKode();

        if (!$this->validate([
            'nama_kategori' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
        ])) 
        {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        else{
            session()->setFlashdata('alert', 'Data berhasil ditambahkan');
        }

        $kategori->insert([
            'nama_kategori' => $this->request->getVar('nama_kategori'),
        ]);

        return redirect()->to('kategori-kode');
    }

    public function update_opsi($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $kode_aplikasi = new KodeAplikasi();

        $this->data['kode_aplikasi'] = $kode_aplikasi->where('id',$id)->first();

        if (!$this->validate([
            'nama_opsi' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
        ])) 
        {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        else{
            session()->setFlashdata('alert', 'Data berhasil diedit');
        }

        $kode_aplikasi->update($id,[
            'nama_opsi' => $this->request->getVar('nama_opsi'),
        ]);

        return redirect()->to('edit-kategori/'.$this->data['kode_aplikasi']->id_kategori);
    }

    public function add_opsi($id){
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $kode_aplikasi=new KodeAplikasi();

        if (!$this->validate([
            'nama_opsi' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
        ])) 
        {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        else{
            session()->setFlashdata('alert', 'Data berhasil ditambahkan');
        }

        $kode_aplikasi->insert([
            'nama_opsi' => $this->request->getVar('nama_opsi'),
            'id_kategori'=> $id,
        ]);

        return redirect()->to('edit-kategori/'.$id);
    }

    public function delete_opsi($id){
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $kode_aplikasi=new KodeAplikasi();

        $this->data['kode_aplikasi']=$kode_aplikasi->where(['id'=>$id])->first();

        $kode_aplikasi->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('edit-kategori/'.$this->data['kode_aplikasi']->id_kategori);
    }
}