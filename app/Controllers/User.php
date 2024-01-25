<?php

namespace App\Controllers;

use App\Models\Provinces;
use App\Models\DataPeriode;
use App\Models\DataTahap;
use App\Models\DataJalur;
use App\Models\DataPendaftar;
use App\Models\Users;
use App\Models\Rapot;
use App\Models\DataJurusan;
use App\Models\DataAgenda;
use App\Models\DataSekolah;

class User extends Base
{
    public function index()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $periode = new DataPeriode();
        $data['periode'] = $periode->where('status', 'aktif')->first();

        $tahap = new DataTahap();
        $date = date('Y-m-d');
        $data['tahap'] = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
        if (empty($data['tahap'])) {
            $data['tahap'] = $tahap->where('id_periode', $data['periode']->id)->orderBy('id', 'DESC')->first();
        }

        $jurusan = new DataJurusan();
        $data['jurusan'] = $jurusan->where('status', 'aktif')->findAll();

        $jalur = new DataJalur();
        $data['jalur'] = $jalur->where('id_tahap', $data['tahap']->id)->findAll();

        $agenda = new DataAgenda();
        $data['agenda'] = $agenda->findAll();

        return view('User/home', $data);
    }

    public function jalur($id)
    {
        
        $jalur = new DataJalur();
        $tahap = new DataTahap();
        $periode = new DataPeriode();
        $jurusan = new DataJurusan();
        $agenda = new DataAgenda();

        $data['periode'] = $periode->where('status', 'aktif')->first();
        $opsi_jalur = $this->codeAll('JALUR');
        $data['jurusan'] = $jurusan->where('status', 'aktif')->findAll();
        $data['agenda'] = $agenda->findAll();
        $date = date('Y-m-d');

        $data_tahap = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
        if (!$data_tahap) {
            $data['tahap'] = $tahap->where('id_periode', $data['periode']->id)->findall();
            $html1 = '<a class="ms-3 mt-3 btn btn-lg btn-warning btn-daftar" href="#">Belum ada pendaftaran pada saat ini</a>';
            $html2 = '<a class="btn btn-warning" href="#">Belum ada pendaftaran pada saat ini</a>';
            $data['isi_jalur'] = $html1;
            $data['isi_jalurbtn'] = $html2;
            $html3 = '<a class="btn btn-primary disabled" style="background-color: #4D7C0F;" href="#">Daftar</a>';
            $data['daftar_nav'] = $html3;
            $data['jalur'] = $jalur->findAll();
        } else {
            $html2 = '<a class="ms-3 btn btn-lg btn-primary mt-3 btn-daftar" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar Disini</a>';
            $html3 = '<a class="btn btn-primary" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar</a>';
            $html1 = '<a class="btn btn-light" href="'.site_url('jalur/' . $data_tahap->id).'">Isi Disini</a>';
            $data['isi_jalur'] = $html2;
            $data['isi_jalurbtn'] = $html1;
            $data['daftar_nav'] = $html3;
            $data['tahap'] = $tahap->where('id_periode', $data['periode']->id)->findall();
            $data['jalur'] = $jalur->where('id_tahap',$id)->findall();
        }

        $data['kode_zonasi'] = '';
        $data['kode_prestasi'] = '';
        $data['kode_afirmasi'] = '';
        $data['kode_custom'] = '';
        $data['kode_reguler'] = '';

        foreach ($opsi_jalur as $o) {
            if ($o->nama_opsi == "Reguler") {
                $data['kode_reguler'] = $o->id;
            } else if ($o->nama_opsi == "Prestasi") {
                $data['kode_prestasi'] = $o->id;
            } else if ($o->nama_opsi == "Afirmasi") {
                $data['kode_afirmasi'] = $o->id;
            } else
                $data['kode_custom'] = $o->id;
        }
        $data['page']= 'Jalur';

        return view('User/jalur', $data);
    }
    public function tahap($id)
    {
        $tahap = new DataTahap();

        $data['tahap'] = $tahap->where('id_periode', $id)->findall();

        return view('User/tahap', $data);
    }

    public function login()
    {   
        $periode = new DataPeriode();
        $tahap = new DataTahap();
        $jurusan = new DataJurusan();
        $jalur = new DataJalur();
        $agenda = new DataAgenda();
        $data['page'] = 'Beranda';
        $data['periode'] = $periode->where('status', 'aktif')->first();
        $data['jurusan'] = $jurusan->where('status', 'aktif')->findAll();
        $data['agenda'] = $agenda->findAll();
        $date = date('Y-m-d');

        $data_tahap = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
        if (!$data_tahap) {
            $data['tahap'] = $tahap->where('id_periode', $data['periode']->id)->orderBy('id', 'DESC')->first();
            $html1 = '<a class="ms-3 mt-3 btn btn-lg btn-warning btn-daftar" href="#">Belum ada pendaftaran pada saat ini</a>';
            $html2 = '<a class="btn btn-warning" href="#">Belum ada pendaftaran pada saat ini</a>';
            $data['isi_jalur'] = $html1;
            $data['isi_jalurbtn'] = $html2;
            $html3 = '<a class="btn btn-primary disabled" style="background-color: #4D7C0F;" href="#">Daftar</a>';
            $data['daftar_nav'] = $html3;
            $data['jalur'] = $jalur->findAll();
        } else {
            $html2 = '<a class="ms-3 btn btn-lg btn-primary mt-3 btn-daftar" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar Disini</a>';
            $html3 = '<a class="btn btn-primary" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar</a>';
            $html1 = '<a class="btn btn-light" href="'.site_url('jalur/' . $data_tahap->id).'">Isi Disini</a>';
            $data['isi_jalur'] = $html2;
            $data['isi_jalurbtn'] = $html1;
            $data['daftar_nav'] = $html3;
            $data['tahap'] = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
            $data['jalur'] = $jalur->where('id_tahap', $data_tahap->id)->findAll();
        }

        $data['page'] = 'Login';
        
        return view('login',$data);
    }

    public function cek_data()
    {
        $jalur = new DataJalur();
        $tahap = new DataTahap();
        $periode = new DataPeriode();
        $jurusan = new DataJurusan();
        $agenda = new DataAgenda();

        $data['periode'] = $periode->where('status', 'aktif')->first();
        $opsi_jalur = $this->codeAll('JALUR');
        $data['jurusan'] = $jurusan->where('status', 'aktif')->findAll();
        $data['agenda'] = $agenda->findAll();
        $date = date('Y-m-d');

        $data_tahap = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
        if (!$data_tahap) {
            $data['tahap'] = $tahap->where('id_periode', $data['periode']->id)->findall();
            $html1 = '<a class="ms-3 mt-3 btn btn-lg btn-warning btn-daftar" href="#">Belum ada pendaftaran pada saat ini</a>';
            $html2 = '<a class="btn btn-warning" href="#">Belum ada pendaftaran pada saat ini</a>';
            $data['isi_jalur'] = $html1;
            $data['isi_jalurbtn'] = $html2;
            $html3 = '<a class="btn btn-primary disabled" style="background-color: #4D7C0F;" href="#">Daftar</a>';
            $data['daftar_nav'] = $html3;
            $data['jalur'] = $jalur->findAll();
        } else {
            $html2 = '<a class="ms-3 btn btn-lg btn-primary mt-3 btn-daftar" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar Disini</a>';
            $html3 = '<a class="btn btn-primary" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar</a>';
            $html1 = '<a class="btn btn-light" href="'.site_url('jalur/' . $data_tahap->id).'">Isi Disini</a>';
            $data['isi_jalur'] = $html2;
            $data['isi_jalurbtn'] = $html1;
            $data['daftar_nav'] = $html3;
            $data['tahap'] = $tahap->where('id_periode', $data['periode']->id)->findall();
            
        }
        $data['page'] = 'Cek Data';
        
        return view('User/cek_data',$data);
    }

    public function pendaftaran_berhasil($id)
    {
        $periode = new DataPeriode();
        $tahap = new DataTahap();
        $jurusan = new DataJurusan();
        $jalur = new DataJalur();
        $agenda = new DataAgenda();
        $pendaftar = new DataPendaftar();

        $user = new Users();
        $data['page'] = 'Beranda';
        $data['periode'] = $periode->where('status', 'aktif')->first();
        $data['jurusan'] = $jurusan->where('status', 'aktif')->findAll();
        $data['agenda'] = $agenda->findAll();
        $date = date('Y-m-d');

        $data_tahap = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
        if (!$data_tahap) {
            $data['tahap'] = $tahap->where('id_periode', $data['periode']->id)->orderBy('id', 'DESC')->first();
            $html1 = '<a class="ms-3 mt-3 btn btn-lg btn-warning btn-daftar" href="#">Belum ada pendaftaran pada saat ini</a>';
            $html2 = '<a class="btn btn-warning" href="#">Belum ada pendaftaran pada saat ini</a>';
            $data['isi_jalur'] = $html1;
            $data['isi_jalurbtn'] = $html2;
            $html3 = '<a class="btn btn-primary disabled" style="background-color: #4D7C0F;" href="#">Daftar</a>';
            $data['daftar_nav'] = $html3;
            $data['jalur'] = $jalur->findAll();
        } else {
            $html2 = '<a class="ms-3 btn btn-lg btn-primary mt-3 btn-daftar" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar Disini</a>';
            $html3 = '<a class="btn btn-primary" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar</a>';
            $html1 = '<a class="btn btn-light" href="'.site_url('jalur/' . $data_tahap->id).'">Isi Disini</a>';
            $data['isi_jalur'] = $html2;
            $data['isi_jalurbtn'] = $html1;
            $data['daftar_nav'] = $html3;
            $data['tahap'] = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
            $data['jalur'] = $jalur->where('id_tahap', $data_tahap->id)->findAll();
        }

        
        $data['pendaftar'] = $pendaftar->where('id', $id)->first();
        $data['user'] = $user->where('id_ref', $id)->first();
        $data['status_penerimaan'] = $this->code($data['pendaftar']->status_penerimaan);
        
        $data['page'] = 'Pendaftaran Berhasil';
        return view('User/pendaftaran_berhasil', $data);
    }

    public function formulir_pendaftaran($id)
    {
        
        $periode = new DataPeriode();
        $tahap = new DataTahap();
        $jurusan = new DataJurusan();
        $jalur = new DataJalur();
        $agenda = new DataAgenda();
        $pendaftar = new DataPendaftar();
        $countryModel = new Provinces();
        $sekolah = new DataSekolah();
        $data['periode1'] = $periode->where('status', 'aktif')->first();
        $date = date('Y-m-d');

        $data_tahap = $tahap->where(['id_periode' => $data['periode1']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
        if (!$data_tahap) {
            $html1 = '<a class="ms-3 mt-3 btn btn-lg btn-warning btn-daftar" href="#">Belum ada pendaftaran pada saat ini</a>';
            $html2 = '<a class="btn btn-warning" href="#">Belum ada pendaftaran pada saat ini</a>';
            $data['isi_jalur'] = $html1;
            $data['isi_jalurbtn'] = $html2;
            // $html3 = '<a class="btn btn-primary disabled" href="#">Daftar</a>';
            // $data['daftar_nav'] = $html3;
            // $data['jalur'] = $jalur->findAll();
            
            $data['jalur'] = $jalur->where('id', $id)->first();

            $data['tahap'] = $tahap->where('id', $data['jalur']->id_tahap)->first();

            $data['periode'] = $periode->where('id', $data['tahap']->id_periode)->first();

            $data_pendaftar = $pendaftar->orderBy('id', 'DESC')->first();

            $data['jurusan'] = $jurusan->findAll();
            $data['sekolah'] = $sekolah->findAll();
        } else {
            $html2 = '<a class="ms-3 btn btn-lg btn-primary mt-3 btn-daftar" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar Disini</a>';
            $html3 = '<a class="btn btn-primary" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar</a>';
            $html1 = '<a class="btn btn-light" href="'.site_url('jalur/' . $data_tahap->id).'">Isi Disini</a>';
            $data['isi_jalur'] = $html2;
            $data['isi_jalurbtn'] = $html1;
            $data['daftar_nav'] = $html3;
            $data['jalur'] = $jalur->where('id', $id)->first();

            $data['tahap'] = $tahap->where('id', $data['jalur']->id_tahap)->first();

            $data['periode'] = $periode->where('id', $data['tahap']->id_periode)->first();

            $data_pendaftar = $pendaftar->orderBy('id', 'DESC')->first();

            $data['jurusan'] = $jurusan->findAll();
            $data['sekolah'] = $sekolah->findAll();
        }

        $data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();
        $data['berkebutuhan_khusus'] = $this->codeAll('KEBUTUHAN KHUSUS');
        $data['agama'] = $this->codeAll('AGAMA');
        $data['pendidikan'] = $this->codeAll('PENDIDIKAN');
        $data['pekerjaan'] = $this->codeAll('PEKERJAAN');

        if ($data_pendaftar != null) {
            $id_pendaftar = $data_pendaftar->id;
        } else $id_pendaftar = '0';

        $data['nomor_pendaftar'] = $data['periode']->id . $data['tahap']->id . $data['jalur']->id . '001' . $id_pendaftar;
        $data['page'] = 'Formulir Pendaftaran';
        return view('User/formulir_pendaftaran_zonasi', $data);
    }
    
    public function list_agenda($id)
    {
        $agenda = new DataAgenda();
        $data['agenda'] = $agenda->findAll();
        $data['page'] = "List Agenda";

        $periode = new DataPeriode();
        $tahap = new DataTahap();
        $jurusan = new DataJurusan();
        $jalur = new DataJalur();
        $data['periode'] = $periode->where('status', 'aktif')->first();
        $data['jurusan'] = $jurusan->where('status', 'aktif')->findAll();
        $date = date('Y-m-d');

        $data_tahap = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date, 'status' => 'aktif'])->first();
        
        if (!$data_tahap) {
            $data['tahap'] = $tahap->where('id_periode', $data['periode']->id)->orderBy('id', 'DESC')->first();
            $html1 = '<a class="ms-3 mt-3 btn btn-lg btn-warning btn-daftar" href="#">Belum ada pendaftaran pada saat ini</a>';
            $html2 = '<a class="btn btn-warning" href="#">Belum ada pendaftaran pada saat ini</a>';
            $html3 = '<a class="btn btn-primary disabled" style="background-color: #4D7C0F;" href="#">Daftar</a>';
            $data['isi_jalur'] = $html1;
            $data['isi_jalurbtn'] = $html2;
            $data['daftar_nav'] = $html3;
            $data['jalur'] = $jalur->findAll();
        } else {
            $html2 = '<a class="ms-3 btn btn-lg btn-primary mt-3 btn-daftar" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar Disini</a>';
            $html3 = '<a class="btn btn-primary" style="background-color: #4D7C0F;" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar</a>';
            $html1 = '<a class="btn btn-light" href="'.site_url('jalur/' . $data_tahap->id).'">Isi Disini</a>';
            $data['isi_jalur'] = $html2;
            $data['isi_jalurbtn'] = $html1;
            $data['daftar_nav'] = $html3;
            $data['tahap'] = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
            $data['jalur'] = $jalur->where('id_tahap', $data_tahap->id)->findAll();
        }     

        return view('User/list_agenda', $data);
    }
    public function cek()
    {
        $countryModel = new Provinces();

        $data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

        return view('User/cek', $data);
    }
    function action()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_data') {
                $pendaftar = new DataPendaftar();

                $user = new Users();

                $data_user = $user->where('nomor_pendaftaran', $this->request->getVar('nomor'))->first();

                $data_pendaftar = $pendaftar->where('id', $data_user->id_ref)->first();

                $status = $this->code($data_pendaftar->status_penerimaan);

                if ($this->request->getVar('nama') == $data_pendaftar->nama_lengkap) {
                    $statedata = '';
                } else $statedata = $status->nama_opsi;

                echo json_encode($statedata);
            }
        }
    }
}
