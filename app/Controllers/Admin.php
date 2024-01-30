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

class Admin extends BaseController
{   

    public function dashboard()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        
        $pendaftaran = new DataPendaftaran();
        $_pendaftar = new Pendaftaran();
        $tahap = new DataTahap();
        $stateModel = new Periode();
        $tahap = new DataTahap();
        $pendaftar = new DataPendaftar();
        $periodeModel = new Periode();
        $countryModel = new Provinces();
        $this->data['state'] = $pendaftaran->join('tahap', 'tahap.id = pendaftaran.tahap')->where('pendaftaran.periode',2)->findAll();
        $this->data['query'] = $pendaftaran->select('pendaftaran.id_pendaftar, tahap.nama_tahap, id, COUNT( * ) as total')->join('tahap', 'tahap.id = pendaftaran.tahap')->where('pendaftaran.periode', 2)->groupBy('id')->findAll();
        $this->data['query_l'] = $pendaftaran->select('pendaftaran.id_pendaftar, tahap.nama_tahap, tahap.id, COUNT( * ) as total')->join('tahap', 'tahap.id = pendaftaran.tahap')->join('data_pendaftar', 'data_pendaftar.id = pendaftaran.id_pendaftar')->where('pendaftaran.periode', 2)->where('data_pendaftar.jenis_kelamin','l')->groupBy('tahap.id')->findAll();
        //test
        $this->data['cek'] = $pendaftar->select('sum(jenis_kelamin = "p") P, sum(jenis_kelamin = "l") L, tahap.nama_tahap')->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('tahap', 'tahap.id = pendaftaran.tahap')->where('pendaftaran.periode', 2)->groupBy('tahap.nama_tahap')->findAll();

        $this->data['state2'] = $tahap->where('id_periode', 2)->orderBy('id', 'ASC')->findAll();
        $state1 = $pendaftaran->findAll();
        $this->data['statedata'] = $stateModel->join('tahap', 'tahap.id_periode = periode.id')->join('pendaftaran', 'pendaftaran.periode = periode.id')->where('periode.id', 2)->findAll();
        $this->data['jml_'] = $stateModel->join('tahap', 'tahap.id_periode = periode.id')->join('pendaftaran', 'pendaftaran.periode = periode.id')->where('periode.id', 2)->findAll();
        $this->data['pendaftar_zonasi'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->where('pendaftaran.jalur', '15')->findAll();
        $this->data['pendaftar_laki_zonasi'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->where('pendaftaran.jalur', '15')->where('data_pendaftar.jenis_kelamin','l')->findAll();
        $this->data['pendaftar_p_zonasi'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->where('pendaftaran.jalur', '15')->where('data_pendaftar.jenis_kelamin','p')->findAll();
        $this->data['pendaftar'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('tahap', 'tahap.id = pendaftaran.tahap')->findAll();
        $this->data['pendaftar_laki'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('tahap', 'tahap.id = pendaftaran.tahap')->where('data_pendaftar.jenis_kelamin','l')->findAll();
        $this->data['pendaftar_p'] = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('tahap', 'tahap.id = pendaftaran.tahap')->where('data_pendaftar.jenis_kelamin','p')->findAll();
        
        $this->data['tahap'] = $tahap->findall();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['isTour'] = true;
        $this->data['isSelect2'] = true;
        $this->data['isFlatpickr'] = true;
        $this->data['page'] = 'Selamat Datang '.session()->get('nama_user').'!';
        $this->data['ket'] = 'Di Aplikasi Penerimaan Peserta Didik Baru SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Dashboard';
        $this->data['activePage'] = 'dashboard';
        $this->data['periode'] = $periodeModel->orderBy('id', 'ASC')->findAll();
        $this->data['periode_get'] = $periodeModel->orderBy('id', 'ASC')->where('status','tidak_aktif')->findAll();
        $this->data['get_periode'] = $periodeModel->where('status','aktif')->first();
        $this->data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();
        
        return view('Admin/dashboard',$this->data);
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
        $this->data['page'] = 'Selamat Datang '.session()->get('nama_user').'!';
        $this->data['ket'] = 'Di Aplikasi Penerimaan Peserta Didik Baru SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Dashboard Siswa';
        $this->data['data_pendaftar'] = $pendaftar->join('user', 'user.id_ref = data_pendaftar.id')->where('data_pendaftar.id', $getid)->first();
        $this->data['data_pendaftaran'] = $pendaftaran->join('data_pendaftar', 'data_pendaftar.id = pendaftaran.id_pendaftar')->where('data_pendaftar.id', $getid)->first();
        $this->data['data_periode'] = $periode->join('pendaftaran', 'pendaftaran.periode = periode.id')->where('pendaftaran.id_pendaftar', $getid)->first();
        $this->data['data_tahap'] = $tahap->join('pendaftaran', 'pendaftaran.tahap = tahap.id')->where('pendaftaran.id_pendaftar', $getid)->first();

        $this->data['data_jalur'] = $jalur->join('pendaftaran', 'pendaftaran.jalur = jalur.id')->where('pendaftaran.id_pendaftar', $getid)->first();
        $this->data['data_agenda'] = $agenda->first();
        $this->data['stat1'] = $this->codeWithName('Lulus Seleksi');
        $this->data['stat2'] = $this->codeWithName('Daftar Ulang Berhasil');
        $this->data['stat3'] = $this->codeWithName('Menunggu Konfirmasi Pembayaran');
        $this->data['stat4'] = $this->codeWithName('Pembayaran Berhasil');
        $this->data['title'] = 'Dashboard Siswa';
        $this->data['activePage'] = 'dashboard-siswa';
        return view('Admin/dashboard_siswa', $this->data);
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
        $this->data['tahap'] = $tahap->where('id',$id)->first();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['jalur1'] = $jalur->where('id_tahap', $this->data['tahap']->id)->first();
        $periode = new DataPeriode();
        $this->data['periode'] = $periode->where('id', $this->data['tahap']->id_periode)->first();
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->orderBy('id', 'DESC')->first();
        if ($data_pendaftar != null) {
            $id_pendaftar = $data_pendaftar->id;
        } else $id_pendaftar = '0';

        if ($this->data['jalur1']) {
            $this->data['nomor_pendaftar'] = $this->data['periode']->id . $this->data['tahap']->id . $this->data['jalur1']->id . '000' . $id_pendaftar;
            $this->data['pendaftar'] = $pendaftar->join('user', 'user.id_ref = data_pendaftar.id')->findAll();
            $id_pendaftar = $pembayaran->join('data_pendaftar', 'data_pendaftar.id = pembayaran.id_pendaftar')->where('pembayaran.id_pendaftar',$id)->first();
            $this->data['id'] = $id_pendaftar;
            
            $this->data['jalur'] = $jalur->where('id_tahap',$id)->findAll();
        }
        
        
        // end

        $this->data['stat']=$this->codeAll('STATUS PENERIMAAN');

        $this->data['pendaftaran'] = $pendaftaran->findAll();

        
        
        $this->data['page'] = 'Data Pendaftar';
        $this->data['ket'] = 'List Data Pendaftar SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Data Pendaftar';
        $this->data['activePage'] = 'pendaftar';
        
        return view('Admin/data_pendaftar', $this->data);
    }

    public function data_seleksi()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $this->data['page'] = 'seleksi';
        $this->data['title'] = 'Data Seleksi';


        return view('Admin/data_siswa', $this->data);
    }

    public function profil_siswa()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $this->data['page'] = 'pendaftar';
        $this->data['title'] = 'Profil Siswa';
        $this->data['activePage'] = 'profilsiswa';

        return view('Admin/profil_siswa', $this->data);
    }

    public function profil_pendaftar()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $this->data['title'] = 'Profil Pendaftar';
        $this->data['activePage'] = 'profilpendaftar';
        return view('Admin/profil_pendaftar', $this->data);
    }

    public function data_pembayaran()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-vMrJTbzKEfdvuviQdOvnvuC5';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $pembayaran = new DataPembayaran();
        $user = new Users();
        $tahap = new DataTahap();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['user'] = $user->findAll();
        $this->data['pembayaran'] = $pembayaran->findAll();
        $stat = $this->codeWithName('Daftar Ulang Berhasil');
        // $this->data['data_pendaftar'] = $pendaftar->where('status_penerimaan', $stat->id)->findAll();
        $this->data['data_pendaftar'] = $user->join('data_pendaftar', 'data_pendaftar.id = user.id_ref')->where('data_pendaftar.status_penerimaan',$stat->id)->findAll();
        $this->data['page'] = 'Data Pembayaran';
        $this->data['ket'] = 'Pembayaran PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Data Pembayaran';
        $this->data['isFullCalendar'] = true;
        $this->data['activePage'] = 'pembayaran';


        
        return view('Admin/data_pembayaran', $this->data);
    }

    public function kategori_kode()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $kategori = new KategoriKode();
        $tahap = new DataTahap();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['ket'] = 'Data Kategori Aplikasi PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['page'] = 'Kategori';
        $this->data['title'] = 'Kategori';
        $this->data['activePage'] = 'kategori';

        $this->data['kategori'] = $kategori->findall();

        return view('Admin/kategori_kode',$this->data);
    }
    public function periode()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $periode = new DataPeriode();
        $tahap = new DataTahap();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['page'] = 'Data Periode';
        $this->data['ket'] = 'Periode PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Data Periode';
        $this->data['isFullCalendar'] = true;
        $this->data['activePage'] = 'periode';

        $this->data['periode'] = $periode->findall();
        
        return view('Admin/data_periode',$this->data);
    }
    public function datasekolah()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $sekolah = new DataSekolah();
        $tahap = new DataTahap();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['page'] = 'Sekolah';
        $this->data['ket'] = 'Data Sekolah Asal Wilayah Kabupaten Banyumas';
        $this->data['title'] = 'Data Sekolah';
        $this->data['isFullCalendar'] = true;
        $this->data['activePage'] = 'sekolah';

        $this->data['sekolah'] = $sekolah->findall();
        
        return view('Admin/data_sekolah',$this->data);
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
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();  

        $this->data['page'] = 'Data Tahap';
        $this->data['ket'] = 'Tahap PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Data Tahap';
        $this->data['isFullCalendar'] = true;
        $this->data['activePage'] = 'tahap';

        $this->data['periode'] = $periode->findall();

        $this->data['tahap'] = $tahap->findall();
        
        return view('Admin/data_tahap',$this->data);
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
        $tahap = new DataTahap();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['page'] = 'Data Jalur';
        $this->data['ket'] = 'Jalur PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Data Jalur';
        $this->data['isFullCalendar'] = true;
        $this->data['activePage'] = 'jalur';

        $this->data['opsi_jalur'] = $this->codeAll('JALUR');

        $this->data['periode'] = $periode->findall();

        $this->data['tahap'] = $tahap->findall();

        $this->data['jalur'] = $jalur->findall();
        
        return view('Admin/data_jalur',$this->data);
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
        $tahap = new DataTahap();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['page'] = 'Akun';
        $this->data['ket'] = 'Data Akun PPDB SMK WIDYA MANDALA TAMBAK ';
        $this->data['title'] = 'Akun';
        $this->data['activePage'] = 'akun';

        $this->data['user'] = $user->findall();

        $this->data['pendaftar'] = $pendaftar->findall();
        
        return view('Admin/data_akun',$this->data);
    }

    public function konfirmasi_pembayaran($id)
    {
        $user = new Users();
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-vMrJTbzKEfdvuviQdOvnvuC5';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        //view
        $pendaftar = new DataPendaftar();
        $pembayaran = new DataPembayaran();
        $this->data['pembayaran'] = $pembayaran->where('id_pendaftar',$id)->first();

        $this->data['stat'] = $this->codeWithName('Daftar Ulang Berhasil');

        $this->data['user'] = $user->where('id_ref',$id)->first();

        $this->data['pendaftar'] = $pendaftar->where('id',$id)->first();
        
        $this->data['page'] = 'pembayaran';
        $this->data['title'] = 'Konfirmasi Pembayaran';
        $this->data['token'] = $snapToken;
        $this->data['activePage'] = 'pembayaran';

        return view('Admin/konfirmasi_pembayaran',$this->data);
    }
    public function pembayaran_selesai()
    {
        
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        
        
        $this->data['page'] = 'pembayaran';
        $this->data['title'] = 'Pembayaran Berhasil';
        

        return view('Admin/pembayaran_selesai',$this->data);
    }

    public function data_jurusan()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $jurusan = new DataJurusan();
        $tahap = new DataTahap();
        $periode = new DataPeriode();
        $this->data['periode'] = $periode->findAll();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['title'] = 'Jurusan';
        $this->data['page'] = 'Jurusan';
        $this->data['ket'] = 'Data Jurusan PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['activePage'] = 'jurusan';
        $this->data['jurusan'] = $jurusan->findAll();

        return view('Admin/data_jurusan', $this->data);
    }

    public function data_agenda()
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $agenda = new DataAgenda();
        $periode = new DataPeriode();
        $this->data['periode'] = $periode->findAll();
        $this->data['agenda'] = $agenda->findAll();
        $tahap = new DataTahap();
        $this->data['tahapan'] =$tahap->where('id_periode',session()->periode)->findAll();
        $this->data['title'] = 'Agenda';
        $this->data['page'] = 'Agenda';
        $this->data['ket'] = 'Data Agenda PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['activePage'] = 'agenda';

        return view('Admin/data_agenda', $this->data);
    }
    public function update_sekolah($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
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
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }

        $sekolah = new DataSekolah();

        $sekolah->delete($id);

        session()->setFlashdata('error', 'Data berhasil dihapus');

        return redirect()->to('data-sekolah');
    }
    
}
?>