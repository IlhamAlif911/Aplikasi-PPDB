<?php

namespace App\Controllers;

use App\Models\DataAfirmasi;
use App\Models\DataJalur;
use App\Models\DataJurusan;
use App\Models\KategoriKode;
use App\Models\DataPeriode;
use App\Models\DataTahap;
use App\Models\Users;
use App\Models\DataPendaftar;
use App\Models\DataPembayaran;
use App\Models\DataPendaftaran;
use App\Models\DataAgenda;
use App\Models\Provinces;
use App\Models\Periode;
use App\Models\DataSekolah;
use App\Models\Pendaftaran;

use CodeIgniter\Database\RawSql;

class Admin extends Base
{    
    public function dashboard()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        // <pre> 
        //     function tampil_kota(){ 
        //         $this->db->select('id, kota, provinsi, COUNT(provinsi) as total'); 
        //         $this->db->group_by('provinsi'); 
        //         $this->db->order_by('total', 'desc'); 
        //         $hasil = $this->db->get('tablename'); 
        //         return $hasil; 
        //     } 
        // </pre>

        // <pre> function index(){ 
        //     $b['data'] = $this->m_model->tampil_kota(); 
        //     $this-->load->view('view_tampil',$b); 
        // } 
        // </pre>
        $pendaftaran = new DataPendaftaran();
        $_pendaftar = new Pendaftaran();
        $tahap = new DataTahap();
        $data['state'] = $pendaftaran->join('tahap', 'tahap.id = pendaftaran.tahap')->where('pendaftaran.periode',2)->findAll();
        $data['query'] = $pendaftaran->select('pendaftaran.id_pendaftar, tahap.nama_tahap, id, COUNT( * ) as total')->join('tahap', 'tahap.id = pendaftaran.tahap')->where('pendaftaran.periode', 2)->groupBy('id')->findAll();
        
        $data['query_l'] = $pendaftaran->select('pendaftaran.id_pendaftar, tahap.nama_tahap, tahap.id, COUNT( * ) as total')->join('tahap', 'tahap.id = pendaftaran.tahap')->join('data_pendaftar', 'data_pendaftar.id = pendaftaran.id_pendaftar')->where('pendaftaran.periode', 2)->where('data_pendaftar.jenis_kelamin','l')->groupBy('tahap.id')->findAll();
        $data['query_p'] = $pendaftaran->select('pendaftaran.id_pendaftar, tahap.nama_tahap, tahap.id, COUNT( * ) as total')->join('tahap', 'tahap.id = pendaftaran.tahap')->join('data_pendaftar', 'data_pendaftar.id = pendaftaran.id_pendaftar')->where('pendaftaran.periode', 2)->where('data_pendaftar.jenis_kelamin','p')->groupBy('tahap.id')->findAll();
        // $data['state3'] = $pendaftaran->join('tahap', 'tahap.id = pendaftaran.tahap')->groupBy('id')->where('pendaftaran.periode',2)->selectCount('total')->findAll();
        $data['state2'] = $tahap->where('id_periode', 2)->orderBy('id', 'ASC')->findAll();
        $state1 = $pendaftaran->findAll();
        
        $stateModel = new Periode();
        $data['statedata'] = $stateModel->join('tahap', 'tahap.id_periode = periode.id')->join('pendaftaran', 'pendaftaran.periode = periode.id')->where('periode.id', 2)->findAll();
        $data['jml_'] = $stateModel->join('tahap', 'tahap.id_periode = periode.id')->join('pendaftaran', 'pendaftaran.periode = periode.id')->where('periode.id', 2)->findAll();
        // SELECT pendaftaran.id_pendaftar, tahap.nama_tahap, id, COUNT( * ) as total FROM pendaftaran JOIN tahap ON tahap.id = pendaftaran.tahap where pendaftaran.periode = 2 GROUP BY id
        // $db = \Config\Database::connect();
        // // $builder->select('(SELECT SUM(payments.amount) FROM payments WHERE payments.invoice_id=4) AS amount_paid', false);
        // // $query = $builder->get();
        // $builder = $db->table('pendaftaran');
            
        

        // $periode = new DataPeriode();

        $tahap = new DataTahap();
        $pendaftar = new DataPendaftar();
        $data['pendaftar_zonasi'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->where('pendaftaran.jalur', '15')->findAll();
        $data['pendaftar_laki_zonasi'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->where('pendaftaran.jalur', '15')->where('data_pendaftar.jenis_kelamin','l')->findAll();
        $data['pendaftar_p_zonasi'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->where('pendaftaran.jalur', '15')->where('data_pendaftar.jenis_kelamin','p')->findAll();
        
        
        $data['pendaftar'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('tahap', 'tahap.id = pendaftaran.tahap')->findAll();
        $data['pendaftar_laki'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('tahap', 'tahap.id = pendaftaran.tahap')->where('data_pendaftar.jenis_kelamin','l')->findAll();
        $data['pendaftar_p'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('tahap', 'tahap.id = pendaftaran.tahap')->where('data_pendaftar.jenis_kelamin','p')->findAll();

        $data['tahapan'] = $tahap->join('pendaftaran', 'pendaftaran.tahap = tahap.id')->where('pendaftaran.periode', '2')->findAll();
        
        $data['tahap'] = $tahap->findall();
        // $data['periode'] = $periode->where('status', 'aktif')->first();
        // $data['periode2'] = $periode->findAll();
        // $data['periode1'] = $periode->where('status', 'tidak_aktif')->findAll();


        $data['page'] = 'dashboard';
        $data['title'] = 'Dashboard';

        $periodeModel = new Periode();
        $data['periode'] = $periodeModel->orderBy('id', 'ASC')->findAll();
        $data['periode_get'] = $periodeModel->orderBy('id', 'ASC')->where('status','tidak_aktif')->findAll();
        $data['get_periode'] = $periodeModel->where('status','aktif')->first();
        $countryModel = new Provinces();
        $data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();
        
        return view('Admin/dashboard', $data);
    }

    public function dashboard_siswa()
    {
        $pendaftar = new DataPendaftar();
        $jalur = new DataJalur();
        $tahap = new DataTahap();
        $periode = new DataPeriode();
        $agenda = new DataAgenda();
        $getid = session()->get('id_ref');
        $pendaftaran = new DataPendaftaran();

        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }

        //data object       
        $data['page'] = 'dashboard-siswa';
        $data['data_pendaftar'] = $pendaftar->join('user', 'user.id_ref = data_pendaftar.id')->where('data_pendaftar.id', $getid)->first();
        $data['data_pendaftaran'] = $pendaftaran->join('data_pendaftar', 'data_pendaftar.id = pendaftaran.id_pendaftar')->where('data_pendaftar.id', $getid)->first();
        $data['data_periode'] = $periode->join('pendaftaran', 'pendaftaran.periode = periode.id')->where('pendaftaran.id_pendaftar', $getid)->first();
        $data['data_tahap'] = $tahap->join('pendaftaran', 'pendaftaran.tahap = tahap.id')->where('pendaftaran.id_pendaftar', $getid)->first();

        $data['data_jalur'] = $jalur->join('pendaftaran', 'pendaftaran.jalur = jalur.id')->where('pendaftaran.id_pendaftar', $getid)->first();
        $data['data_agenda'] = $agenda->first();
        $data['stat1'] = $this->codeWithName('Lulus Seleksi');
        $data['stat2'] = $this->codeWithName('Daftar Ulang Berhasil');
        $data['stat3'] = $this->codeWithName('Menunggu Konfirmasi Pembayaran');
        $data['stat4'] = $this->codeWithName('Pembayaran Berhasil');
        $data['title'] = 'Dashboard Siswa';
        return view('Admin/dashboard_siswa', $data);
    }

    public function data_pendaftar($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $jalur = new DataJalur();

        $tahap = new DataTahap();

        $pendaftaran = new DataPendaftaran();

        $pendaftar = new DataPendaftar();
        $pembayaran = new DataPembayaran();

        // get input nomor pendaftar
        $data['tahap'] = $tahap->where('id',$id)->first();
        $data['jalur1'] = $jalur->where('id_tahap', $data['tahap']->id)->first();
        $periode = new DataPeriode();
        $data['periode'] = $periode->where('id', $data['tahap']->id_periode)->first();
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->orderBy('id', 'DESC')->first();
        if ($data_pendaftar != null) {
            $id_pendaftar = $data_pendaftar->id;
        } else $id_pendaftar = '0';

        if ($data['jalur1']) {
            $data['nomor_pendaftar'] = $data['periode']->id . $data['tahap']->id . $data['jalur1']->id . '000' . $id_pendaftar;
            $data['pendaftar'] = $pendaftar->join('user', 'user.id_ref = data_pendaftar.id')->findAll();
            $id_pendaftar = $pembayaran->join('data_pendaftar', 'data_pendaftar.id = pembayaran.id_pendaftar')->where('pembayaran.id_pendaftar',$id)->first();
            $data['id'] = $id_pendaftar;
            
            $data['jalur'] = $jalur->where('id_tahap',$id)->findAll();
        }
        
        
        // end

        $data['stat']=$this->codeAll('STATUS PENERIMAAN');

        $data['pendaftaran'] = $pendaftaran->findAll();

        
        
        $data['page'] = 'pendaftar';
        $data['title'] = 'Data Pendaftar';
        
        return view('Admin/data_pendaftar', $data);
    }

    public function pilih_tahap($id)
    {
        
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $tahap = new DataTahap();
        $data['tahap'] = $tahap->where('id_periode',$id)->findAll();
        
        $data['page'] = 'pendaftar';
        $data['title'] = 'Pilih Tahap';
        
        return view('Admin/pilih_tahap', $data);
    }

    public function data_seleksi()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $data['page'] = 'seleksi';
        $data['title'] = 'Data Seleksi';

        return view('Admin/data_siswa', $data);
    }

    public function profil_siswa()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $data['page'] = 'pendaftar';
        $data['title'] = 'Profil Siswa';

        return view('Admin/profil_siswa', $data);
    }

    public function profil_pendaftar()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $data['title'] = 'Profil Pendaftar';
        return view('Admin/profil_pendaftar', $data);
    }

    public function data_pembayaran()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pembayaran = new DataPembayaran();
        $user = new Users();
        $data['user'] = $user->findAll();
        $data['pembayaran'] = $pembayaran->findAll();
        $stat = $this->codeWithName('Daftar Ulang Berhasil');
        // $data['data_pendaftar'] = $pendaftar->where('status_penerimaan', $stat->id)->findAll();
        $data['data_pendaftar'] = $user->join('data_pendaftar', 'data_pendaftar.id = user.id_ref')->where('data_pendaftar.status_penerimaan',$stat->id)->findAll();
        $data['page'] = 'pembayaran';
        $data['title'] = 'Data Pembayaran';

        
        return view('Admin/data_pembayaran', $data);
    }

    public function kategori_kode()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $kategori = new KategoriKode();

        $data['page'] = 'kategori';
        $data['title'] = 'Kategori';

		$data['kategori'] = $kategori->findall();

        return view('Admin/kategori_kode',$data);
    }
    public function periode()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $periode = new DataPeriode();

        $data['page'] = 'periode';
        $data['title'] = 'Periode';

		$data['periode'] = $periode->findall();
        
        return view('Admin/data_periode',$data);
    }
    public function datasekolah()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $sekolah = new DataSekolah();

        $data['page'] = 'sekolah';
        $data['title'] = 'Data Sekolah';

        $data['sekolah'] = $sekolah->findall();
        
        return view('Admin/data_sekolah',$data);
    }
    public function tahap()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $periode = new DataPeriode();

        $tahap = new DataTahap();

        $data['page'] = 'tahap';
        $data['title'] = 'Tahap';

		$data['periode'] = $periode->findall();

        $data['tahap'] = $tahap->findall();
        
        return view('Admin/data_tahap',$data);
    }

    public function jalur()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $periode = new DataPeriode();

        $tahap = new DataTahap();

        $jalur = new DataJalur();

        $data['page'] = 'tahap';
        $data['title'] = 'Jalur';

        $data['opsi_jalur'] = $this->codeAll('JALUR');

		$data['periode'] = $periode->findall();

        $data['tahap'] = $tahap->findall();

        $data['jalur'] = $jalur->findall();
        
        return view('Admin/data_jalur',$data);
    }

    public function akun()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $user = new Users();

        $pendaftar = new DataPendaftar();
        
        $data['page'] = 'akun';
        $data['title'] = 'Akun';

		$data['user'] = $user->findall();

        $data['pendaftar'] = $pendaftar->findall();
        
        return view('Admin/data_akun',$data);
    }

    public function konfirmasi_pembayaran($id)
    {
        $user = new Users();
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pendaftar = new DataPendaftar();
        $pembayaran = new DataPembayaran();
        $data['pembayaran'] = $pembayaran->where('id_pendaftar',$id)->first();

        $data['stat'] = $this->codeWithName('Daftar Ulang Berhasil');

		$data['user'] = $user->where('id_ref',$id)->first();

        $data['pendaftar'] = $pendaftar->where('id',$id)->first();
        
        $data['page'] = 'pembayaran';
        $data['title'] = 'Konfirmasi Pembayaran';

        return view('Admin/konfirmasi_pembayaran',$data);
    }

    public function data_jurusan()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $jurusan = new DataJurusan();
        $data['jurusan'] = $jurusan->findAll();

        $data['page'] = 'jurusan';
        $data['title'] = 'Data Jurusan';

        return view('Admin/data_jurusan', $data);
    }

    public function data_agenda()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $agenda = new DataAgenda();
        $data['agenda'] = $agenda->findAll();

        $data['page'] = 'agenda';
        $data['title'] = 'Data Agenda';

        return view('Admin/data_agenda', $data);
    }
    public function update_sekolah($id)
    {
        $sekolah = new DataSekolah();

        if (!$this->validate([
            'nama_sekolah' => [
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
        
        $sekolah->update($id, [
            'nama_sekolah' => $this->request->getVar('nama_sekolah'),
            
        ]);

        return redirect()->to('data-sekolah');
    }

    public function delete_sekolah($id)
    {
        $sekolah = new DataSekolah();

        $sekolah->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('data-sekolah');
    }
    
}
?>