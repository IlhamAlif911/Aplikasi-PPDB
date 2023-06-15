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

class User extends Base
{
    public function index()
    {
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

        $data['periode'] = $periode->where('status', 'aktif')->first();
        $data['jalur'] = $jalur->where('id_tahap', $id)->findall();
        $data['tahap'] = $tahap->where('id_periode', $data['periode']->id)->findall();
        $data['page']= 'Jalur';
        $opsi_jalur = $this->codeAll('JALUR');

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
        $data['page'] = 'Login';
        return view('login',$data);
    }

    public function cek_data()
    {
        $data['page'] = 'Cek Data';
        return view('User/cek_data',$data);
    }

    public function pendaftaran_berhasil($id)
    {
        $pendaftar = new DataPendaftar();
        $data['pendaftar'] = $pendaftar->where('id', $id)->first();

        $user = new Users();
        $data['user'] = $user->where('id_ref', $id)->first();

        $data['status_penerimaan'] = $this->code($data['pendaftar']->status_penerimaan);
        $data['page'] = 'Pendaftaran Berhasil';
        return view('User/pendaftaran_berhasil', $data);
    }

    // public function formulir_pendaftaran_prestasi($id)
    // {
    //     $countryModel = new Provinces();
    //     $data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

    //     $jalur = new DataJalur();
    //     $data['jalur'] = $jalur->where('id', $id)->first();

    //     $tahap = new DataTahap();
    //     $data['tahap'] = $tahap->where('id', $data['jalur']->id_tahap)->first();

    //     $periode = new DataPeriode();
    //     $data['periode'] = $periode->where('id', $data['tahap']->id_periode)->first();

    //     $rapot = new Rapot();
    //     $data['rapot'] = $rapot->findAll();

    //     $pendaftar = new DataPendaftar();
    //     $data_pendaftar = $pendaftar->orderBy('id', 'DESC')->first();

    //     $jurusan = new DataJurusan();
    //     $data['jurusan'] = $jurusan->findAll();

    //     $data['jenis_prestasi'] = $this->codeAll('JENIS PRESTASI');

    //     $data['tingkat_prestasi'] = $this->codeAll('TINGKAT PRESTASI');

    //     $data['jenis_beasiswa'] = $this->codeAll('JENIS BEASISWA');
        
    //     $data['berkebutuhan_khusus'] = $this->codeAll('KEBUTUHAN KHUSUS');

    //     $data['agama'] = $this->codeAll('AGAMA');

    //     $data['kewarganegaraan'] = $this->codeAll('KEWARGANEGARAAN');

    //     $data['tempat_tinggal'] = $this->codeAll('TEMPAT TINGGAL');

    //     $data['moda_transportasi'] = $this->codeAll('MODA TRANSPORTASI');

    //     $data['pendidikan'] = $this->codeAll('PENDIDIKAN');

    //     $data['pekerjaan'] = $this->codeAll('PEKERJAAN');

    //     $data['penghasilan_bulanan'] = $this->codeAll('PENGHASILAN BULANAN');

    //     $data['agama'] = $this->codeAll('AGAMA');

    //     if ($data_pendaftar != null) {
    //         $id_pendaftar = $data_pendaftar->id;
    //     } else $id_pendaftar = '0';

    //     $data['nomor_pendaftar'] = $data['periode']->id . $data['tahap']->id . $data['jalur']->id . '000' . $id_pendaftar;

    //     return view('User/formulir_pendaftaran_prestasi', $data);
    //}

    public function formulir_pendaftaran($id)
    {
        $countryModel = new Provinces();
        $data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

        $jalur = new DataJalur();
        $data['jalur'] = $jalur->where('id', $id)->first();

        $tahap = new DataTahap();
        $data['tahap'] = $tahap->where('id', $data['jalur']->id_tahap)->first();

        $periode = new DataPeriode();
        $data['periode'] = $periode->where('id', $data['tahap']->id_periode)->first();

        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->orderBy('id', 'DESC')->first();

        $jurusan = new DataJurusan();
        $data['jurusan'] = $jurusan->findAll();

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
    // public function formulir_pendaftaran_afirmasi($id)
    // {
    //     $countryModel = new Provinces();
    //     $data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

    //     $jalur = new DataJalur();
    //     $data['jalur'] = $jalur->where('id', $id)->first();

    //     $tahap = new DataTahap();
    //     $data['tahap'] = $tahap->where('id', $data['jalur']->id_tahap)->first();

    //     $periode = new DataPeriode();
    //     $data['periode'] = $periode->where('id', $data['tahap']->id_periode)->first();

    //     $pendaftar = new DataPendaftar();
    //     $data_pendaftar = $pendaftar->orderBy('id', 'DESC')->first();

    //     $jurusan = new DataJurusan();
    //     $data['jurusan'] = $jurusan->findAll();

    //     $data['alasan_layak_pip'] = $this->codeAll('ALASAN LAYAK PIP');
        
    //     $data['berkebutuhan_khusus'] = $this->codeAll('KEBUTUHAN KHUSUS');

    //     $data['agama'] = $this->codeAll('AGAMA');

    //     $data['kewarganegaraan'] = $this->codeAll('KEWARGANEGARAAN');

    //     $data['tempat_tinggal'] = $this->codeAll('TEMPAT TINGGAL');

    //     $data['moda_transportasi'] = $this->codeAll('MODA TRANSPORTASI');

    //     $data['pendidikan'] = $this->codeAll('PENDIDIKAN');

    //     $data['pekerjaan'] = $this->codeAll('PEKERJAAN');

    //     $data['penghasilan_bulanan'] = $this->codeAll('PENGHASILAN BULANAN');

    //     $data['agama'] = $this->codeAll('AGAMA');

    //     if ($data_pendaftar != null) {
    //         $id_pendaftar = $data_pendaftar->id;
    //     } else $id_pendaftar = '0';

    //     $data['nomor_pendaftar'] = $data['periode']->id . $data['tahap']->id . $data['jalur']->id . '000' . $id_pendaftar;

    //     return view('User/formulir_pendaftaran_afirmasi', $data);
    // }
    public function list_agenda()
    {
        $agenda = new DataAgenda();
        $data['agenda'] = $agenda->findAll();
        $data['page'] = "List Agenda";

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
