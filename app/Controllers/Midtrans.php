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
use App\Models\Cities;
use App\Models\Postalcode;

use CodeIgniter\Database\RawSql;

class Midtrans extends Base
{
    

    public function index()
    {
        if (in_groups('user')) {
            $this->builder->where('user_id', user()->id);
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        } else {
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        }

        $data = [
            'title' => 'Payment List',
            'order' => $query->getResult()
        ];
        return view('midtrans/index', $data);
    }

    public function search_filter()
    {
        if ($this->request->isAJAX()) {
            $minval = $this->request->getVar('first_date');
            $maxval = $this->request->getVar('last_date');

            if (in_groups('user')) {
                $this->builder->where('user_id', user()->id);
                $this->builder->where('transaction_time >=', $minval);
                $this->builder->where('transaction_time <=', $maxval);
                $this->builder->orderBy('order_id', 'DESC');
                $query = $this->builder->get();
            } else {
                $this->builder->where('transaction_time >=', $minval);
                $this->builder->where('transaction_time <=', $maxval);
                $this->builder->orderBy('order_id', 'DESC');
                $query = $this->builder->get();
            }

            $data = [
                'order' => $query->getResult()
            ];
            $msg = [
                'data' => view('midtrans/ajax_filter_date', $data)
            ];
            echo json_encode($msg);
        } // Search Filter With ajax request
    }

    public function konfirmasi_pembayaran($id)
    {
        $user = new Users();
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }

        //view
        $pendaftar = new DataPendaftar();
        $pembayaran = new DataPembayaran();
        $city = new Cities();
        $postalcode = new Postalcode();
        $this->data['pembayaran'] = $pembayaran->where('id_pendaftar',$id)->first();

        $this->data['stat'] = $this->codeWithName('Daftar Ulang Berhasil');

        $this->data['user'] = $user->where('id_ref',$id)->first();

        $this->data['pendaftar'] = $pendaftar->where('id',$id)->first();
        
        $this->data['city'] = $city->where('city_id', $this->data['pendaftar']->kabupaten)->first();

        $this->data['postalcode'] = $postalcode->where('postal_id', $this->data['pendaftar']->kode_pos)->first();
        
        $this->data['page'] = 'Pembayaran PPDB';
        $this->data['ket'] = 'Pembayaran PPDB SMK WIDYA MANDALA TAMBAK';
        $this->data['title'] = 'Pembayaran Pendaftar';
        $this->data['isFullCalendar'] = true;
        $this->data['activePage'] = 'pembayaran';

        return view('Admin/konfirmasi_pembayaran',$this->data);
    }

    public function token()
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

        $first_name = $this->request->getVar('first_name');
        $nomor_pendaftaran = $this->request->getVar('nomor_pendaftaran');
        $email = $this->request->getVar('email');
        $phone = $this->request->getVar('phone');
        $address = $this->request->getVar('address');
        $city = $this->request->getVar('city');
        $kodepos = $this->request->getVar('kodepos');
        $nominal_bayar = $this->request->getVar('nominal_bayar');
        $nama_pembayaran = $this->request->getVar('nama_pembayaran');

        $transaction_details = array(
            'order_id' => 'PPDB-'.$nomor_pendaftaran.'-'.date('H:i:s'),
            'gross_amount' => $nominal_bayar, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => $nominal_bayar,
            'quantity' => 1,
            'name' => $nama_pembayaran
        );

        // Optional
        // $item2_details = array(
        //     'id' => 'a2',
        //     'price' => 50000,
        //     'quantity' => 1,
        //     'name' => "Orange"
        // );

        // Optional
        $item_details = array($item1_details);

        // Optional
        $billing_address = array(
            'first_name'    => $first_name,
            
            'address'       => $address,
            'city'          => $city,
            'postal_code'   => $kodepos,
            'phone'         => $phone,
            'country_code'  => 'IDN'
        );

        // Optional
        // $shipping_address = array(
        //     'first_name'    => "Obet",
        //     'last_name'     => "Supriadi",
        //     'address'       => "Manggis 90",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16601",
        //     'phone'         => "08113366345",
        //     'country_code'  => 'IDN'
        // );

        // Optional
        $customer_details = array(
            'first_name'    => $first_name,
            
            'email'         => $email,
            'phone'         => $phone,
            'billing_address'  => $billing_address,
            // 'shipping_address' => $shipping_address
        );
 
        // Optional, remove this to display all available payment methods
        //$enable_payments = array('bank_transfer','shopeepay','qris');

        // Fill transaction details
        $transaction = array(
            //'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        error_log(json_encode($transaction));
        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finish()
    {

        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pendaftar = new DataPendaftar();

        $pembayaran = new DataPembayaran();

        $user = new Users();

        $stat = $this->codeWithName('Menunggu Konfirmasi Pembayaran');
        $stat2 = $this->codeWithName('Pembayaran Berhasil');

        $data_user = $user->where('nomor_pendaftaran', $this->request->getPost('nomor_pendaftaran'))->first();
        $data_pembayaran = $pembayaran->where('id_pendaftar', $data_user->id_ref)->first();

        $data_pendaftar = $pendaftar->where('id', $data_user->id_ref)->first();
        $result = json_decode($this->request->getVar('result_data'), true);
        
        // lakukan validasi
        $validation =  \Config\Services::validation();
        if ($this->request->getPost('bukti_transfer') != '') {
            $validation->setRules([
                'bukti_transfer' => [
                    'rules' => 'mime_in[bukti_transfer,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[bukti_transfer,2048]',
                    'errors' => [
                        'mime_in' => 'Format file salah',
                        'max_size' => 'Ukuran file maksimal 2 MB',
                    ]
                ],
            ]);
        } else {
            $validation->setRules([
                'nomor_pendaftaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus diisi',
                    ]
                ],
            ]);
        }

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            if ($this->request->getFile('bukti_transfer') != '') {
                $dataBerkas = $this->request->getFile('bukti_transfer');
                $fileName = 'bukti_transfer_' . $dataBerkas->getName();
                $dataBerkas->move('./assets/', $fileName);

                $pembayaran->insert([
                    "id_pendaftar" => $data_pendaftar->id,
                    "tanggal_transfer" => $tanggal_transfer,
                    "nama_pemilik_rekening" => $this->request->getPost('nama_pemilik_rekening'),
                    "nama_bank" => $this->request->getPost('nama_bank'),
                    "status" => $result['transaction_status'],
                    "nominal_transfer" => $this->request->getPost('nominal_transfer'),
                    "bukti_transfer" => $fileName,
                ]);
                $pendaftar->update($data_pendaftar->id,[
                    
                    "status_penerimaan" => $stat->id,
                ]);
            } else {

                if ($result['payment_type'] == 'echannel') {

                    $pembayaran->insert([
                            "id_pendaftar" => $data_pendaftar->id,
                            "order_id" => $result['order_id'],
                            "tanggal_transfer" => $result['transaction_time'],
                            "nama_pemilik_rekening" => $data_pendaftar->nama_lengkap,
                            "nama_bank" => 'mandiri',
                            "status" => $result['transaction_status'],
                            "nominal_transfer" => $result['gross_amount'],
                        ]);
                    if ($result['transaction_status'] == 'settlement') {
                        $pendaftar->update($data_pendaftar->id,[
                            "status_penerimaan" => $stat2->id,
                        ]);
                    }else{
                        $pendaftar->update($data_pendaftar->id,[
                            "status_penerimaan" => $stat->id,
                        ]);
                    }

                } else if (isset($result['permata_va_number'])) {

                    $pembayaran->insert([
                            "id_pendaftar" => $data_pendaftar->id,
                            "order_id" => $result['order_id'],
                            "tanggal_transfer" => $result['transaction_time'],
                            "nama_pemilik_rekening" => $data_pendaftar->nama_lengkap,
                            "nama_bank" => 'Permata Bank',
                            "status" => $result['transaction_status'],
                            "nominal_transfer" => $result['gross_amount'],
                        ]);
                    
                    if ($result['transaction_status'] == 'settlement') {
                        $pendaftar->update($data_pendaftar->id,[
                            "status_penerimaan" => $stat2->id,
                        ]);
                    }else{
                        $pendaftar->update($data_pendaftar->id,[
                            "status_penerimaan" => $stat->id,
                        ]);
                    }

                }else if ($result['payment_type'] == 'qris') {

                    $pembayaran->insert([
                            "id_pendaftar" => $data_pendaftar->id,
                            "order_id" => $result['order_id'],
                            "tanggal_transfer" => $result['transaction_time'],
                            "nama_pemilik_rekening" => $data_pendaftar->nama_lengkap,
                            "nama_bank" => 'E-Wallet',
                            "status" => $result['transaction_status'],
                            "nominal_transfer" => $result['gross_amount'],
                        ]);
                    if ($result['transaction_status'] == 'settlement') {
                        $pendaftar->update($data_pendaftar->id,[
                            "status_penerimaan" => $stat2->id,
                        ]);
                    }else{
                        $pendaftar->update($data_pendaftar->id,[
                            "status_penerimaan" => $stat->id,
                        ]);
                    }

                } else {
                    if ($result['payment_type'] == 'bank_transfer') {
                    $banktransfer =  'bank transfer';
                    }

                    $pembayaran->insert([
                            "id_pendaftar" => $data_pendaftar->id,
                            "order_id" => $result['order_id'],
                            "tanggal_transfer" => $result['transaction_time'],
                            "nama_pemilik_rekening" => $data_pendaftar->nama_lengkap,
                            "nama_bank" => $result['va_numbers'][0]['bank'],
                            "status" => $result['transaction_status'],
                            "nominal_transfer" => $result['gross_amount'],
                        ]);
                    if ($result['transaction_status'] == 'settlement') {
                        $pendaftar->update($data_pendaftar->id,[
                            "status_penerimaan" => $stat2->id,
                        ]);
                    }else{
                        $pendaftar->update($data_pendaftar->id,[
                            "status_penerimaan" => $stat->id,
                        ]);
                    }
                }
                
            }
            
            session()->setFlashdata('alert', 'Pembayaran Berhasil Dilakukan');
            return redirect()->to('konfirmasi-pembayaran/'.$data_pendaftar->id);
        } else {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('konfirmasi-pembayaran/'.$data_pendaftar->id);
        }
    }


    public function status($id,$idPendaftar)
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
        $pendaftar = new DataPendaftar();
        $stat = $this->codeWithName('Pembayaran Berhasil');
        $cekData = $pembayaran->where('id',$id)->first();

        if ($cekData) {

            $status = \Midtrans\Transaction::status($cekData->order_id);
            $pembayaran->update($id,[
                "status" => $status->transaction_status
            ]);
            if ($status->transaction_status == 'settlement') {
                $pendaftar->update($idPendaftar,[
                    "status_penerimaan" => $stat->id,
                ]);
            }

            session()->setFlashdata('alert', 'Cek Status Berhasil');
            return redirect()->to('data-pembayaran');

        } else {
            exit('Data Tidak Ketemu');
        }
        
    }

    public function excel()
    {
        $minval = $this->request->getVar('first_date');
        $maxval = $this->request->getVar('last_date');

        if (in_groups('user')) {
            $this->builder->where('user_id', user()->id);
            $this->builder->where('transaction_time >=', $minval);
            $this->builder->where('transaction_time <=', $maxval);
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        } else {
            $this->builder->where('transaction_time >=', $minval);
            $this->builder->where('transaction_time <=', $maxval);
            $this->builder->orderBy('order_id', 'DESC');
            $query = $this->builder->get();
        }

        $data = [
            'list' => $query->getResult(),
            'title' => 'Excel'
        ];
        return view('midtrans/excel', $data);
    }
}
