<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiswaAbsen;

class LaporanAbsenController extends Controller
{
    public function laporan()
    {
        return view('pages.laporan.laporan');
    }

    public function filter($tglawal, $tglakhir)
    {
        $data1 = $tglawal;
        $data2 = $tglakhir;
        $absen_pns = SiswaAbsen::whereBetween('tgl', [$tglawal, $tglakhir])->orderBy('tgl', 'ASC')->get();

        return view('pages.laporan.filter', compact('absen_pns', 'data1', 'data2'));
    }



    public function cetak($data1, $data2)
    {
        $tglawal = $data1;
        $tglakhir = $data2;

        $absen_pns = SiswaAbsen::whereBetween('tgl', [$data1, $data2])->orderBy('tgl', 'ASC')->get();

        return view('pages.laporan.cetak', compact('absen_pns', 'tglawal', 'tglakhir'));
    }
}
