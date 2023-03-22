<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\SiswaAbsen;
use App\Models\Kelas;

class LaporanAbsenController extends Controller
{
    public function laporan()
    {
        //ambil data dari tabel kelas
        $kelas = DB::table('kelas')->get();

        return view('pages.laporan.laporan', compact('kelas'));
    }

    public function filter($tglawal, $tglakhir, $id_kelas)
    {
        $data1 = $tglawal;
        $data2 = $tglakhir;
        $data3 = $id_kelas;
        $kelas = DB::table('kelas')->get();

        //innerjoin 
        $absen_siswa = DB::table('siswa_absensi')
            ->join('siswa', 'siswa_absensi.id_siswa', '=', 'siswa.id')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('users', 'siswa.id_user', '=', 'users.id')
            ->where('siswa.id_kelas', $id_kelas)
            ->whereBetween('siswa_absensi.tgl', [$tglawal, $tglakhir])
            ->select('siswa_absensi.*', 'users.name', 'kelas.kelas')
            ->get();
        return view('pages.laporan.filter', compact('absen_siswa', 'data1', 'data2', 'data3', 'kelas'));
    }



    public function cetak($data1, $data2, $data3)
    {
        $tglawal = $data1;
        $tglakhir = $data2;
        $id_kelas = $data3;
        //mencari id kelas pada table kelas
        $kelas = Kelas::where('id', $id_kelas)->first();
        $absen_siswa = SiswaAbsen::whereBetween('tgl', [$data1, $data2])->orderBy('tgl', 'ASC')->get();

        return view('pages.laporan.cetak', compact('absen_siswa', 'tglawal', 'tglakhir', 'kelas', 'id_kelas'));
    }
}
