<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\SiswaAbsen;
use App\Models\Kelas;
use App\Models\TahunAjar;
use Illuminate\Support\Facades\Storage;


class LaporanAbsenController extends Controller
{
    public function laporan()
    {
        //ambil data dari tabel kelas
        $kelas = DB::table('kelas')->get();
        $tahunajar = DB::table('tahunajar')->get();

        return view('pages.laporan.laporan', compact('kelas','tahunajar'));
    }

    public function filter($tglawal, $tglakhir, $id_kelas, $id_tahunajar)
    {
        $data1 = $tglawal;
        $data2 = $tglakhir;
        $data3 = $id_kelas;
        $data4 = $id_tahunajar;
        $kelas = DB::table('kelas')->get();
        $tahunajar = DB::table('tahunajar')->get();

        //innerjoin 
        $absen_siswa = DB::table('siswa_absensi')
            ->join('siswa', 'siswa_absensi.id_siswa', '=', 'siswa.id')
            ->join('users', 'siswa.id_user', '=', 'users.id')
            ->where('siswa_absensi.id_kelas', $id_kelas)
            ->where('siswa_absensi.id_tahunajar', $id_tahunajar)
            ->whereBetween('siswa_absensi.tgl', [$tglawal, $tglakhir])
            ->select('siswa_absensi.*', 'users.name')
            ->get();
        return view('pages.laporan.filter', compact('absen_siswa', 'data1', 'data2', 'data3', 'data4', 'kelas','tahunajar'));
    }

    



    public function cetak($data1, $data2, $data3,$data4)
    {
        $tglawal = $data1;
        $tglakhir = $data2;
        $id_kelas = $data3;
        $id_tahunajar = $data4;
        $tahunajar =  TahunAjar::where('id', $id_tahunajar)->first();
        //mencari id kelas pada table kelas
        $kelas = Kelas::where('id', $id_kelas)->first();
        $absen_siswa = SiswaAbsen::whereBetween('tgl', [$data1, $data2])->orderBy('tgl', 'ASC')->get();

        return view('pages.laporan.cetak', compact('absen_siswa', 'tglawal', 'tglakhir', 'kelas', 'id_kelas','tahunajar','id_tahunajar'));
    }
}
