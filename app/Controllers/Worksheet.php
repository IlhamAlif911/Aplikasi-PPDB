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
use App\Models\Pendaftar;
use App\Models\DataSekolah;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Worksheet extends Base
{    

    public function export($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->where('pendaftaran.tahap', $id)->findAll();
        
        $tahap = new DataTahap;

        $tahapan = $tahap->where('id', $id)->first();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
// merge
        $sheet->mergeCells('A1:K1');
// nama kolom
        $sheet->setCellValue('A1', 'DATA PENDAFTAR SMK YPE KROYA');
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama Lengkap');
        $sheet->setCellValue('C3', 'NISN');
        $sheet->setCellValue('D3', 'NIK/No. KTP');
        $sheet->setCellValue('E3', 'Tempat Lahir');
        $sheet->setCellValue('F3', 'Tanggal Lahir');
        $sheet->setCellValue('G3', 'Jenis Kelamin');
        $sheet->setCellValue('H3', 'Alamat');
        $sheet->setCellValue('I3', 'No. HP');
        $sheet->setCellValue('J3', 'Email');
        $sheet->setCellValue('K3', 'Asal Sekolah');

        $column = 4; //kolom start
        $i = 1;
        foreach ($data_pendaftar as $key => $value) {
        // isi kolom 
            if ($value->type_asal_sekolah == 'off') {
                $asal = $value->asal_sekolah;
            } else {
                $asal = $value->asal_sekolah_manual;
            }
            


            $sheet->setCellValue('A'. $column, $i++);
            $sheet->setCellValue('B'. $column, $value->nama_lengkap);
            $sheet->setCellValue('C'. $column, $value->nisn);
            $sheet->setCellValue('D'. $column, $value->nik);
            $sheet->setCellValue('E'. $column, $value->tempat_lahir);
            $sheet->setCellValue('F'. $column, $value->tanggal_lahir);
            $sheet->setCellValue('G'. $column, $value->jenis_kelamin);
            $sheet->setCellValue('H'. $column, $value->alamat);
            $sheet->setCellValue('I'. $column, $value->nomor_hp);
            $sheet->setCellValue('J'. $column, $value->email);
            $sheet->setCellValue('K'. $column, $asal);
            $column++;
        }
        //style
        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $sheet->getStyle('A3:K3')->applyFromArray($styleArray);

        $styleArray1 = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $sheet->getStyle('A1')->applyFromArray($styleArray1);
        $styleArray2 = [
            'borders' => [
                'allBorders' =>[
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ],
            ],
        ];

        $sheet->getStyle('A3:K'.($column-1))->applyFromArray($styleArray2);
        $sheet->getStyle('A3:K3')
        ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

        // auto size kolom    
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-H-i-s') .'-All Data Pendaftar-'.$tahapan->nama_tahap ;
        // auto download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
    public function export_diterima($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $pendaftar = new DataPendaftar();
        $stat = $this->codeWithName('Pembayaran Berhasil');
        $data_pendaftar = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->where('pendaftaran.tahap', $id)->where('data_pendaftar.status_penerimaan', $stat->id)->findAll();
        
        $tahap = new DataTahap;

        $tahapan = $tahap->where('id', $id)->first();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
// merge
        $sheet->mergeCells('A1:K1');
// nama kolom
        $sheet->setCellValue('A1', 'DATA PENDAFTAR SMK YPE KROYA');
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama Lengkap');
        $sheet->setCellValue('C3', 'NISN');
        $sheet->setCellValue('D3', 'NIK/No. KTP');
        $sheet->setCellValue('E3', 'Tempat Lahir');
        $sheet->setCellValue('F3', 'Tanggal Lahir');
        $sheet->setCellValue('G3', 'Jenis Kelamin');
        $sheet->setCellValue('H3', 'Alamat');
        $sheet->setCellValue('I3', 'No. HP');
        $sheet->setCellValue('J3', 'Email');
        $sheet->setCellValue('K3', 'Asal Sekolah');

        $column = 4; //kolom start
        $i = 1;
        foreach ($data_pendaftar as $key => $value) {
        // isi kolom 
            if ($value->type_asal_sekolah == 'off') {
                $asal = $value->asal_sekolah;
            } else {
                $asal = $value->asal_sekolah_manual;
            }
            


            $sheet->setCellValue('A'. $column, $i++);
            $sheet->setCellValue('B'. $column, $value->nama_lengkap);
            $sheet->setCellValue('C'. $column, $value->nisn);
            $sheet->setCellValue('D'. $column, $value->nik);
            $sheet->setCellValue('E'. $column, $value->tempat_lahir);
            $sheet->setCellValue('F'. $column, $value->tanggal_lahir);
            $sheet->setCellValue('G'. $column, $value->jenis_kelamin);
            $sheet->setCellValue('H'. $column, $value->alamat);
            $sheet->setCellValue('I'. $column, $value->nomor_hp);
            $sheet->setCellValue('J'. $column, $value->email);
            $sheet->setCellValue('K'. $column, $asal);
            $column++;
        }
        //style
        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $sheet->getStyle('A3:K3')->applyFromArray($styleArray);

        $styleArray1 = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $sheet->getStyle('A1')->applyFromArray($styleArray1);
        $styleArray2 = [
            'borders' => [
                'allBorders' =>[
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ],
            ],
        ];

        $sheet->getStyle('A3:K'.($column-1))->applyFromArray($styleArray2);
        $sheet->getStyle('A3:K3')
        ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

        // auto size kolom    
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-H-i-s') .'-Data Pendaftar Diterima-'.$tahapan->nama_tahap ;
        // auto download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
    public function import($id)
    {
        // proteksi halaman
        if (! session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda Belum Login !');
            return redirect()->to('/login');
        }
        $countryModel = new Provinces();
        $data['country'] = $countryModel->orderBy('prov_name', 'ASC')->findAll();

    // get input nomor pendaftar
        $tahap = new DataTahap();
        $jalur = new DataJalur();
        $user = new Users();
        $pendaftaran = new DataPendaftaran();
        $data['tahap'] = $tahap->where('id',$id)->first();
        $data['jalur1'] = $jalur->where('id_tahap', $data['tahap']->id)->first();
        $periode = new DataPeriode();
        $data['periode'] = $periode->where('id', $data['tahap']->id_periode)->first();
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->orderBy('id', 'DESC')->first();
        if ($data_pendaftar != null) {
            $id_pendaftar = $data_pendaftar->id;
        } else $id_pendaftar = '0';
        // get password
        $pass = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        $data['nomor_pendaftar'] = $data['periode']->id . $data['tahap']->id . $data['jalur1']->id . '000' . $id_pendaftar;
        // end
        
        $file = $this->request->getFile('fileexcel');
        $extension = $file->getClientExtension();
        if ($extension == 'xlsx' || $extension == 'xls') {
            if($extension == 'xls'){
                $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file);
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();
            
            foreach ($sheetdata as $key => $value) {
                if ($key==0) {
                    continue;
                }
                $email = $pendaftar->where('email',$value[9])->first();
                $nisn = $pendaftar->where('nisn',$value[2])->first();
                $nik = $pendaftar->where('nik',$value[3])->first();

                $sekolah = new DataSekolah();
                $getsekolah = $sekolah->first();

                if ($value[10] == $getsekolah->nama_sekolah) {
                    $state = 'off';
                } else {
                    $state = 'on';
                }
                if ($value[10] == $getsekolah->nama_sekolah) {
                    $asal_sekolah = $value[10];
                    $asal_sekolah_manual = null;
                } else {
                    $asal_sekolah = null;
                    $asal_sekolah_manual = $value[10];
                }
                

                if (!$email) {
                    if (!$nisn) {
                        if (!$nik) {
                            $pendaftar->insert([
                                "nama_lengkap" =>$value[1],
                                "nisn" =>$value[2],
                                "nik" =>$value[3],
                                "tempat_lahir" =>$value[4],
                                "tanggal_lahir" =>$value[5],
                                "jenis_kelamin" =>$value[6],
                                "alamat" =>$value[7],
                                "nomor_hp" =>$value[8],
                                "email" =>$value[9],
                                "asal_sekolah" => $asal_sekolah,
                                "asal_sekolah_manual" => $asal_sekolah_manual,
                                "type_asal_sekolah" => $state,
                                "status_penerimaan" => 101,
                                "type_registration" => 2,
                            ]);
                            $pendaftar_id = $pendaftar->getInsertID();
                            $pendaftaran->insert([
                                "id_pendaftar" => $pendaftar_id,
                                "periode" => $this->request->getPost('periode'),
                                "tahap" => $this->request->getPost('tahap'),
                                "jalur" => $this->request->getPost('jalur'),
                            ]);
                            $user->insert([
                                "role" => '2',
                                "id_ref" => $pendaftar_id,
                                "status" => 'aktif',
                                "password" => $pass,
                                "nomor_pendaftaran" => $data['periode']->id . $data['tahap']->id . $data['jalur1']->id . '000' . $pendaftar_id,
                                "email" => $value[9],
                            ]);
                        } else {
                            session()->setFlashdata('error', 'Perhatian !!! NIK Telah Terdaftar di Sistem, cek kembali pada file yang akan di upload');
                            return redirect()->to('data-pendaftar/' . $id);
                        }
                        
                    } else {
                        session()->setFlashdata('error', 'Perhatian !!! NISN Telah Terdaftar di Sistem, cek kembali pada file yang akan di upload');
                        return redirect()->to('data-pendaftar/' . $id);
                    }
                    
                    
                } else {
                    session()->setFlashdata('error', 'Perhatian !!! Email Telah Terdaftar di Sistem, cek kembali pada file yang akan di upload');
                    return redirect()->to('data-pendaftar/' . $id);
                }
                
                
            }
            session()->setFlashdata('alert', 'Import Data Pendaftar berhasil');
            return redirect()->to('data-pendaftar/' . $id);
            
        } else {
            session()->setFlashdata('error', 'Format file tidak sesuai');
            return redirect()->to('data-pendaftar/' . $id);
        }

    }
}
?>