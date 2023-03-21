<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\SiswaAbsen;

class HomeController extends Controller
{
    public function index()
    {
        $timezone = 'Asia/Makassar';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');

        $admin = Admin::count();
        $guru_pns = Siswa::count();

        // menghitung guru2 yang sudah hadir hari ini
        $pns_absen = SiswaAbsen::where('tgl', $tanggal)->count();

        // mendapatkan list guru2 yang sudah absen hari ini
        $detail_pns = SiswaAbsen::where('tgl', $tanggal)->get();

        // persentase kehadiran guru pns dan ptt
        $persen_pns = ((SiswaAbsen::where('tgl', $tanggal)->count()) / (Siswa::count())) * 100;

        return view('pages.home', compact('admin',  'guru_pns', 'pns_absen',  'detail_pns',  'tanggal', 'persen_pns'));
    }
}
