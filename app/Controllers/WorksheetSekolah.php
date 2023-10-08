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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class WorksheetSekolah extends Base
{    

    public function import()
    {

        $sekolah = new DataSekolah();
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
                $sekolah->insert([
                    "nama_sekolah" =>$value[1],
                    
                ]);
                

            }
            session()->setFlashdata('alert', 'Import Data Pendaftar berhasil');
            return redirect()->to('data-sekolah');
        } else {
            session()->setFlashdata('error', 'Format file tidak sesuai');
            return redirect()->to('data-sekolah');
        }

    }
}
?>