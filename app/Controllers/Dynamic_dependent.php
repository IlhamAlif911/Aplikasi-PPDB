<?php

//Dynamic_dependent.php

namespace App\Controllers;

use App\Models\Provinces;
use App\Models\Periode;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Subdistricts;
use App\Models\Postalcode;
use App\Models\DataPendaftar;
use App\Models\DataPendaftaran;
use App\Models\Pendaftaran;
use App\Models\Users;
use App\Models\DataTahap;
use App\Models\DataJalur;
use App\Models\DataSekolah;

class Dynamic_dependent extends Base
{
	function index()
	{
		$countryModel = new Provinces();

		$data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

		return view('dynamic_dependent', $data);
	}

	function action()
	{
		if ($this->request->getVar('action')) {
			$action = $this->request->getVar('action');


			if ($action == 'get_state') {
				$stateModel = new Cities();

				$statedata = $stateModel->where('prov_id', $this->request->getVar('prov_id'))->findAll();

				echo json_encode($statedata);
			}

			if ($action == 'get_city') {
				$cityModel = new Districts();
				$citydata = $cityModel->where('city_id', $this->request->getVar('city_id'))->findAll();

				echo json_encode($citydata);
			}
			if ($action == 'get_district') {
				$districtModel = new Subdistricts();

				$districtdata = $districtModel->where('dis_id', $this->request->getVar('dis_id'))->findAll();

				echo json_encode($districtdata);
			}

			if ($action == 'get_postalcode') {
				$postalModel = new Postalcode();

				$postaldata = $postalModel->where('subdis_id', $this->request->getVar('subdis_id'))->findAll();

				echo json_encode($postaldata);
			}

			if ($action == 'cek_data') {
				$stateModel = new DataPendaftar();

				$user = new Users();

				$data_user = $user->where('nomor_pendaftaran', $this->request->getVar('nomor'))->first();

				$data_pendaftar = $stateModel->where('id', $data_user->id_ref)->first();

				$status = $this->code($data_pendaftar->status_penerimaan);

				$statedata = ['nama_lengkap' => $data_pendaftar->nama_lengkap, 'status' => $status->nama_opsi];

				echo json_encode($statedata);
			}

			if ($action == 'get_tahap') {
				$stateModel = new DataTahap();

				$statedata = $stateModel->where('id_periode', $this->request->getVar('prov_id'))->findAll();

				echo json_encode($statedata);
			}


			if ($action == 'get_jalur') {
				$stateModel = new DataJalur();

				$statedata = $stateModel->where('id_tahap', $this->request->getVar('prov_id'))->findAll();

				echo json_encode($statedata);
			}
			if ($action == 'get_sekolah') {
				$stateModel = new DataSekolah();

				$statedata = $stateModel->orderBy('id','ASC')->findAll();

				echo json_encode($statedata);
			}
			if ($action == 'get_pendaftar') {
				$pendaftar = new DataPendaftar();
				$periodeModel = new Periode();
				$getPeriode = $periodeModel->where('status', 'aktif')->first();
				$query = $pendaftar->select('sum(jenis_kelamin = "p") total_p, sum(jenis_kelamin = "l") total_l, tahap.nama_tahap')->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->join('tahap', 'tahap.id = pendaftaran.tahap')->where('pendaftaran.periode', $getPeriode->id)->groupBy('tahap.nama_tahap')->findAll();
				echo json_encode($query);
			}
			

			if ($action == 'prestasi') {
				$jenis_prestasi = $this->codeAll('JENIS PRESTASI');

				$tingkat_prestasi = $this->codeAll('TINGKAT PRESTASI');

				$statedata = ['jenis_prestasi' => $jenis_prestasi, 'tingkat_prestasi' => $tingkat_prestasi];

				echo json_encode($statedata);
			}
			if ($action == 'get_data') {
				$stateModel = new Periode();
				$statedata = $stateModel->join('tahap', 'tahap.id_periode = periode.id')->join('pendaftaran', 'pendaftaran.tahap = tahap.id')->where('periode.id', $this->request->getVar('id'))->findAll();
			}
		}
	}
}
