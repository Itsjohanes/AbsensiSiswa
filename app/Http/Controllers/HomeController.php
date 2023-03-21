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
        $siswa = Siswa::count();

        $siswa_absen = SiswaAbsen::where('tgl', $tanggal)->count();

        $detail_siswa = SiswaAbsen::where('tgl', $tanggal)->get();

        $persen_siswa = ((SiswaAbsen::where('tgl', $tanggal)->count()) / (Siswa::count())) * 100;

        return view('pages.home', compact('admin',  'siswa', 'siswa_absen',  'detail_siswa',  'tanggal', 'persen_siswa'));
    }
}
