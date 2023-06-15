<?php

namespace App\Controllers;

use App\Models\DataJurusan;

class Jurusan extends Base
{
    public function add_jurusan()
    {
        $jurusan = new DataJurusan();

        if (!$this->validate([
            'file_foto' => [
                'rules' => 'mime_in[file_foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[file_foto,2048]',
                'errors' => [
                    'mime_in' => 'Format file salah',
                    'max_size' => 'Ukuran file maksimal 2 MB',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('data-jurusan');
        } else {
            $dataBerkas = $this->request->getFile('file_foto');
            $fileName = 'file_foto_' . $dataBerkas->getName();
            $dataBerkas->move('./assets/', $fileName);

            session()->setFlashdata('alert', 'Data berhasil ditambahkan');
        }
        $jurusan->insert([
            'nama_jurusan' => $this->request->getVar('nama_jurusan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'file_foto' => $fileName,
            'status' => $this->request->getVar('status'),
        ]);


        return redirect()->to('data-jurusan');
    }

    public function delete_jurusan($id)
    {
        $jurusan = new DataJurusan();

        $jurusan->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('data-jurusan');
    }

    public function update_Jurusan($id)
    {
        $jurusan = new DataJurusan();
        $data_jurusan = $jurusan->where(['id' => $id])->first();

        if ($this->request->getFile('file_foto') != '') {
            if (!$this->validate([
                'file_foto' => [
                    'rules' => 'mime_in[file_foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[file_foto,2048]',
                    'errors' => [
                        'mime_in' => 'Format file salah',
                        'max_size' => 'Ukuran file maksimal 2 MB',
                    ]
                ],
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->to('data-jurusan');
            } else {
                $dataBerkas = $this->request->getFile('file_foto');
                $old_informasi = $data_jurusan->file_foto;
                if (!empty($old_informasi)) {
                    $path = './assets/' . $old_informasi;
                    chmod($path, 0777);
                    unlink($path);
                }
                $fileName = 'file_jurusan_' . $dataBerkas->getName();
                $dataBerkas->move('./assets/', $fileName);

                session()->setFlashdata('alert', 'Data berhasil diedit');
            }
        } else {
            $fileName = $data_jurusan->file_foto;
            session()->setFlashdata('alert', 'Data berhasil diedit');
        }
        $jurusan->update($id, [
            'nama_jurusan' => $this->request->getVar('nama_jurusan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'file_foto' => $fileName,
            'status' => $this->request->getVar('status'),
        ]);


        return redirect()->to('data-jurusan');
    }
}
