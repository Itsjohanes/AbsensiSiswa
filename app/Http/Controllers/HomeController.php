<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use App\Models\SiswaAbsen;

class HomeController extends Controller
{
    public function index()
    {
        $timezone = 'Asia/Makassar';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');

        $admin = Admin::count();
        //$siswa = Siswa::count();
        //asumsi id pada table tahunajar yang paling besar menandakan tahun ajaran terbaru
        
        $id_tahunajar =  DB::table('tahunajar')->max('id');

        $tahunAjar = DB::table('tahunajar')
            ->where('id', $id_tahunajar)
            ->value('tahunajar');
        $siswa = Transaksi::where('id_tahunajar', $id_tahunajar)->count();
        $siswa_absen = SiswaAbsen::where('tgl', $tanggal)->count();
        $detail_siswa = SiswaAbsen::where('tgl', $tanggal)->get();
        if ($siswa == 0) {
            $persen_siswa = 0;
        } else {
            $persen_siswa = ((SiswaAbsen::where('tgl', $tanggal)->count()) / (Siswa::count())) * 100;
        }

        



        return view('pages.home', compact('admin',  'siswa', 'siswa_absen',  'detail_siswa',  'tanggal', 'persen_siswa','tahunAjar'));
    }
}
