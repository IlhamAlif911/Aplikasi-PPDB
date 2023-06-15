<?php

namespace App\Controllers;

use App\Models\Users;

class Akun extends Base
{
    public function add_akun()
    {
        $user = new Users();

        $data['user'] = $user->findall();

        if (!$this->validate([
            'email' => [
                'rules' => 'is_unique[user.email]',
                'errors' => [
                    'is_unique' => 'Email sudah digunakan sebelumnya'
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
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('data-akun');
        } else {
            session()->setFlashdata('alert', 'Data berhasil ditambahkan');
        }
        $user->insert([
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'nomor_pendaftaran' => '0',
            'id_ref' => '0',
            'role' => '1',
            "status" => $this->request->getPost('status'),
        ]);


        return redirect()->to('data-akun');
    }
    
    public function update_akun($id)
    {
        $user = new Users();

        $data['user'] = $user->where('id', $id)->first();
        if ($this->request->getVar('email') != $data['user']->email) {
            if (!$this->validate([
                'email' => [
                    'rules' => 'is_unique[user.email]',
                    'errors' => [
                        'is_unique' => 'Email sudah digunakan sebelumnya'
                    ]
                ],
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->to('data-akun');
            } else {
                session()->setFlashdata('alert', 'Data berhasil ditambahkan');
            }
            $user->update($id, [
                'email' => $this->request->getVar('email'),
                "status" => $this->request->getPost('status'),
            ]);
        } elseif ($this->request->getVar('password') != '') {
            if (!$this->validate([
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
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->to('data-akun');
            } else {
                session()->setFlashdata('alert', 'Data berhasil diupdate');
            }
            $user->update($id, [
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                "status" => $this->request->getPost('status'),
            ]);
        } elseif($this->request->getVar('password') == '' && $this->request->getVar('email') == $data['user']->email) {
            if (!$this->validate([
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus diisi'
                    ]
                ],
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->to('data-akun');
            } else {
                session()->setFlashdata('alert', 'Data berhasil diupdate');
            }
            $user->update($id, [
                "status" => $this->request->getPost('status'),
            ]);
        } else {
            if (!$this->validate([
                'email' => [
                    'rules' => 'is_unique[user.email]',
                    'errors' => [
                        'is_unique' => 'Email sudah digunakan sebelumnya'
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
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->to('data-akun');
            } else {
                session()->setFlashdata('alert', 'Data berhasil diupdate');
            }
            $user->update($id, [
                "status" => $this->request->getPost('status'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'email' => $this->request->getVar('email'),
            ]);
        }

        return redirect()->to('data-akun');
    }
}
?>