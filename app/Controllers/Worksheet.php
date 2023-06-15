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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Worksheet extends Base
{    

    public function export($id)
    {
        $pendaftar = new DataPendaftar();
        $data_pendaftar = $pendaftar->join('pendaftaran', 'pendaftaran.id_pendaftar = data_pendaftar.id')->where('pendaftaran.tahap', $id)->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // merge
        $sheet->mergeCells('A1:I1');
        // nama kolom
        $sheet->setCellValue('A1', 'DATA PENDAFTAR SMK YPE KROYA');
        $sheet->setCellValue('A3', 'Nama Lengkap');
        $sheet->setCellValue('B3', 'NISN');
        $sheet->setCellValue('C3', 'NIK/No. KTP');
        $sheet->setCellValue('D3', 'Tempat Lahir');
        $sheet->setCellValue('E3', 'Tanggal Lahir');
        $sheet->setCellValue('F3', 'Jenis Kelamin');
        $sheet->setCellValue('G3', 'Alamat');
        $sheet->setCellValue('H3', 'Email');
        $sheet->setCellValue('I3', 'Asal Sekolah');
        
        $column = 4; //kolom start
        foreach ($data_pendaftar as $key => $value) {
            // isi kolom 
            $sheet->setCellValue('A'. $column, $value->nama_lengkap);
            $sheet->setCellValue('B'. $column, $value->nisn);
            $sheet->setCellValue('C'. $column, $value->nik);
            $sheet->setCellValue('D'. $column, $value->tempat_lahir);
            $sheet->setCellValue('E'. $column, $value->tanggal_lahir);
            $sheet->setCellValue('F'. $column, $value->jenis_kelamin);
            $sheet->setCellValue('G'. $column, $value->alamat);
            $sheet->setCellValue('H'. $column, $value->email);
            $sheet->setCellValue('I'. $column, $value->asal_sekolah);
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

        $sheet->getStyle('A3:I3')->applyFromArray($styleArray);
        
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

        $sheet->getStyle('A3:I'.($column-1))->applyFromArray($styleArray2);
        $sheet->getStyle('A3:I3')
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

        $writer = new Xlsx($spreadsheet);
        // auto download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=Data Pendaftar.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
    public function import($id)
    {
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
        $pass = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        $data['nomor_pendaftar'] = $data['periode']->id . $data['tahap']->id . $data['jalur1']->id . '000' . $id_pendaftar;
        // end

        
        $pendaftar = new DataPendaftar();
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
                $pendaftar->insert([
                    "nama_lengkap" =>$value[0],
                    "nisn" =>$value[1],
                    "nik" =>$value[2],
                    "tempat_lahir" =>$value[3],
                    "tanggal_lahir" =>$value[4],
                    "jenis_kelamin" =>$value[5],
                    "alamat" =>$value[6],
                    "nomor_hp" =>$value[7],
                    "email" =>$value[8],
                    "asal_sekolah" =>$value[9],
                    "status_penerimaan" => 101,
                    "type_registration" 2,
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
                    "email" => $value[8],
            ]);

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