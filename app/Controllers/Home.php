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

class Home extends BaseController
{    
    public function index()
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
            $data['daftar_nav'] = $html3;
            $data['jalur'] = $jalur->where('id_tahap', $data_tahap->id)->findAll();
        } else {
            $html2 = '<a class="ms-3 btn btn-lg btn-primary mt-3 btn-daftar" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar Disini</a>';
            $html3 = '<a class="btn btn-primary" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar</a>';
            $html1 = '<a class="btn btn-light" href="'.site_url('jalur/' . $data_tahap->id).'">Isi Disini</a>';
            $data['isi_jalur'] = $html2;
            $data['isi_jalurbtn'] = $html1;
            $data['daftar_nav'] = $html3;
            $data['tahap'] = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
            $data['jalur'] = $jalur->where('id_tahap', $data_tahap->id)->findAll();
        }        

        return view('User/home', $data);
    }

    public function jalur($id)
    {
        $periode = new DataPeriode();
        $tahap = new DataTahap();
        $jurusan = new DataJurusan();
        $jalur = new DataJalur();
        $agenda = new DataAgenda();
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
            $data['daftar_nav'] = $html3;
            $data['jalur'] = $jalur->where('id_tahap',$id)->findall();
        } else {
            $html2 = '<a class="ms-3 btn btn-lg btn-primary mt-3 btn-daftar" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar Disini</a>';
            $html3 = '<a class="btn btn-primary" href="'.site_url('jalur/' . $data_tahap->id).'">Daftar</a>';
            $html1 = '<a class="btn btn-light" href="'.site_url('jalur/' . $data_tahap->id).'">Isi Disini</a>';
            $data['isi_jalur'] = $html2;
            $data['isi_jalurbtn'] = $html1;
            $data['daftar_nav'] = $html3;
            $data['tahap'] = $tahap->where(['id_periode' => $data['periode']->id, 'tanggal_mulai <=' => $date, 'tanggal_selesai >=' => $date])->first();
            $data['jalur'] = $jalur->where('id_tahap',$id)->findall();
        }

        $data['page'] = 'Pilih Jalur';
        
        
        return view('User/jalur',$data);
    }

    public function tahap($id)
    {
        $tahap = new DataTahap();

        $data['tahap'] = $tahap->where('id_periode',$id)->findall();

        return view('User/tahap',$data);
    }
    public function periode()
    {
        $periode = new DataPeriode();
        $data['periode'] = $periode->where('status', 'aktif')->first();

        return view('User/periode',$data);
    }

    public function post()
    {
        return view('post');
    }

    public function syarat()
    {
        return view('syarat');
    }

    public function pengumuman()
    {
        return view('daftar-pengumuman');
    }

    public function formulir_pendaftaran()
    {
        return view('formulir_pendaftaran');
    }
}
