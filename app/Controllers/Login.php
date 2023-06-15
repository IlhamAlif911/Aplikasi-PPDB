<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\DataPendaftar;
use App\Models\DataPeriode;

class Login extends Base
{
    public function process()
    {
        $users = new Users();
        $pendaftar = new DataPendaftar();
        $periode = new DataPeriode();
        $stat1 = $this->codeWithName('Lulus Seleksi');
        $stat2 = $this->codeWithName('Menunggu Konfirmasi Pembayaran');
        $stat3 = $this->codeWithName('Pembayaran Berhasil');
        $stat4 = $this->codeWithName('Daftar Ulang Berhasil');
        $akun = $this->request->getVar('akun');
        $password = $this->request->getVar('password');
        $data_user = $users->where([
            'email' => $akun,
            'status' => 'aktif',
        ])->first();
        if ($data_user == null || $data_user == '') {
            $data_user = $users->where([
                'nomor_pendaftaran' => $akun,
                'status' => 'aktif',
            ])->first();
        }
        if ($data_user) {
            if (password_verify($password, $data_user->password)) {
                $data_pendaftar = $pendaftar->where('id', $data_user->id_ref)->first();
                $data_periode = $periode->where('status', 'aktif')->first();
                if ($data_pendaftar != null || $data_pendaftar != '') {
                    $nama_user = $data_pendaftar->nama_lengkap;
                } else {
                    $nama_user = 'Admin';
                }
                session()->set([
                    'id' => $data_user->id,
                    'id_ref' => $data_user->id_ref,
                    'role' => $data_user->role,
                    'data_pendaftar' => $data_pendaftar,
                    
                    'nama_user' => $nama_user,
                    'periode' => $data_periode->id,
                    'logged_in' => TRUE
                ]);
                
                if ($data_user->role == '1') {
                    return redirect()->to('dashboard');
                }
                if ($data_user->role == '2') {
                    if ($data_pendaftar->status_penerimaan == $stat1->id || $data_pendaftar->status_penerimaan == $stat2->id || $data_pendaftar->status_penerimaan == $stat3->id || $data_pendaftar->status_penerimaan == $stat4->id) {
                        return redirect()->to('dashboard-siswa');
                    }else {
                        session()->setFlashdata('error', 'Permintaan Anda Ditolak');
                        return redirect()->back()->withInput();
                    }
                }
            } else {
                session()->setFlashdata('error', 'E-mail/Nomor Pendaftaran atau Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'E-mail/Nomor Pendaftaran belum terdaftar atau belum aktif');
            return redirect()->back();
        }
    }

    // public function proteksi_halaman()
    // {
    //     if (session()->has('nama_user') == '') {
    //         session()->set_flashdata('error', 'Anda Belum Login !!!!');
    //         return redirect()->to('login');
    //     }
    // }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
