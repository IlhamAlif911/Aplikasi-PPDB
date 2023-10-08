<?php

namespace App\Controllers;
use App\Models\KategoriKode;
use App\Models\KodeAplikasi;


class Opsi extends BaseController
{
    public function edit_kategori($id)
    {
        $kode_aplikasi = new KodeAplikasi();

        $kategori = new KategoriKode();

        $data['page'] = 'kategori';
        $data['title'] = 'Kategori';

        $data['kategori'] = $kategori->where('id',$id)->first();

		$data['kode_aplikasi'] = $kode_aplikasi->where('id_kategori',$id)->findall();

        return view('Admin/kode_aplikasi',$data);
    }

    public function update_kategori($id)
    {
        $kategori = new KategoriKode();

        $data['kategori'] = $kategori->where('id',$id)->findall();

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
        $kode_aplikasi = new KodeAplikasi();

        $data['kode_aplikasi'] = $kode_aplikasi->where('id',$id)->first();

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

        return redirect()->to('edit-kategori/'.$data['kode_aplikasi']->id_kategori);
    }

    public function add_opsi($id){
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
        $kode_aplikasi=new KodeAplikasi();

        $data['kode_aplikasi']=$kode_aplikasi->where(['id'=>$id])->first();

        $kode_aplikasi->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('edit-kategori/'.$data['kode_aplikasi']->id_kategori);
    }
}