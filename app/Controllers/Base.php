<?php

namespace App\Controllers;
use App\Models\KodeAplikasi;
use App\Models\KategoriKode;

class Base extends BaseController
{
    public function codeAll($nama_kategori){
        $kode = new KodeAplikasi();
        $kategori = new KategoriKode();
        $datakategori = $kategori->where('nama_kategori',$nama_kategori)->first();
        $dataKode = $kode->where('id_kategori',$datakategori->id)->findall();
        return $dataKode;
    }

    public function code($id){
        $kode = new KodeAplikasi();
        $dataKode = $kode->where('id', $id)->first();
        return $dataKode;
    }

    public function codeWithName($nama_opsi){
        $kode = new KodeAplikasi();
        $dataKode = $kode->where('nama_opsi', $nama_opsi)->first();
        return $dataKode;
    }
    
    function formatTanggal($date){
        // menggunakan class Datetime
        $pecah = explode('-', $date);
        return $pecah[2].'-'.$pecah[1].'-'.$pecah[0];
    }

    function formatTanggalReverse($date){
        // menggunakan class Datetime
        $date=str_replace("/","-",$date);
        $pecah = explode('-', $date);
        return $pecah[2].'-'.$pecah[1].'-'.$pecah[0];
    }

    function formatBulan(){
        $bulan=[
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $bulan;
    }
}
?>