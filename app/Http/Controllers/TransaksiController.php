<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Transaksi;
use App\Imports\ImportSiswa;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;

use Validator;
use Illuminate\Validation\Rule;

/*
    Johannes Alexander Putra
    johannesap@upi.edu


*/

class TransaksiController extends Controller
{
    public function index()
    {
        $kelas = DB::table('kelas')->get();
        $tahunajar = DB::table('tahunajar')->get();
        return view('pages.transaksi.index', compact('kelas','tahunajar'));
    }
    
    
    public function store(Request $request){
        
        $rules = [
            'id_kelas'               => 'required',
            'id_tahunajar'          => 'required'
            
        ];
        $messages = [
            'id_kelas.required'                 => 'Kelas Wajib dipilih',
            'id_tahunajar.required'             => 'Tahun Ajar Wajib dipilih'
            
        ];

        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $id_transaksi = $request->id_transaksi;
        if ($id_transaksi == NULL) {
             return redirect()->back()->withErrors(['id_transaksi' => 'Siswa wajib dipilih']);
        
        }

        //dari id_transaksi yang berupa array pecah dan ambil id_siswanya dari table transaksi
        
        foreach ($id_transaksi as $id) {
            $transaksi = Transaksi::find($id);
            if ($transaksi) {
            $id_siswa[] = $transaksi->id_siswa;
            }
        }
        foreach ($id_siswa as $id) {
            $transaksi = Transaksi::create([
            'id_siswa' => $id,
            'id_kelas' => $request->id_kelas,
            'id_tahunajar' => $request->id_tahunajar
            ]);
        }

         Alert::success('Berhasil', 'Transaksi Kelas Berhasil Ditambahkan');
        return redirect('/transaksi');
    }


     public function filter($id_kelas, $id_tahunajar)
    {
       
        $data1 = $id_kelas;
        $data2 = $id_tahunajar;
        $kelas = DB::table('kelas')->get();
        $tahunajar = DB::table('tahunajar')->get();

        //innerjoin 
        // Query ke database untuk mendapatkan data transaksi
    $transaksi = DB::table('kelassiswa')
        ->join('siswa', 'kelassiswa.id_siswa', '=', 'siswa.id')
        ->join('users', 'siswa.id_user', '=', 'users.id')
        ->join('kelas', 'kelassiswa.id_kelas', '=', 'kelas.id')
        ->join('tahunajar', 'kelassiswa.id_tahunajar', '=', 'tahunajar.id')
        ->where('kelassiswa.id_kelas', $id_kelas)
        ->where('kelassiswa.id_tahunajar', $id_tahunajar)
        ->select('kelassiswa.*', 'users.name', 'kelas.kelas', 'tahunajar.tahunajar')
        ->get();

    // Inisialisasi variabel
    $riwayatKelasString = "";
    $riwayatTahunAjaranString = "";
    $riwayatKelasString = [];
    $riwayatTahunAjaranString = [];

    if ($transaksi->count() > 0) {
        foreach ($transaksi as $data) {
            $riwayatKelas = DB::table('kelas')
                ->join('kelassiswa', 'kelassiswa.id_kelas', '=', 'kelas.id')
                ->join('tahunajar', 'kelassiswa.id_tahunajar', '=', 'tahunajar.id')
                ->where('kelassiswa.id_siswa', $data->id_siswa)
                ->select('kelas.kelas', 'tahunajar.tahunajar')
                ->get();

            if ($riwayatKelas->count() > 0) {
                $kelasTahunAjar = [];
                foreach ($riwayatKelas as $riwayat) {
                    $kelasTahunAjar[] = $riwayat->kelas;
                }
                $riwayatKelasString[$data->id_siswa] = implode(', ', $kelasTahunAjar);
            }

            $riwayatTahunAjaran = DB::table('tahunajar')
                ->join('kelassiswa', 'kelassiswa.id_tahunajar', '=', 'tahunajar.id')
                ->where('kelassiswa.id_siswa', $data->id_siswa)
                ->distinct('tahunajar.tahunajar')
                ->pluck('tahunajar.tahunajar');

            if ($riwayatTahunAjaran->count() > 0) {
                $tahunAjaran = $riwayatTahunAjaran->toArray();
                $riwayatTahunAjaranString[$data->id_siswa] = implode(', ', $tahunAjaran);
            }
        }
    }

    return view('pages.transaksi.filter', compact('data1', 'data2', 'kelas', 'tahunajar', 'transaksi', 'riwayatKelasString', 'riwayatTahunAjaranString'));

    }

    public function hapus($id_kelas, $id_tahunajar)
    {
       
        $data1 = $id_kelas;
        $data2 = $id_tahunajar;
        $kelas = DB::table('kelas')->get();
        $tahunajar = DB::table('tahunajar')->get();

        // Inisialisasi variabel
    $riwayatKelasString = "";
    $riwayatTahunAjaranString = "";
    $riwayatKelasString = [];
    $riwayatTahunAjaranString = [];
     $transaksi = DB::table('kelassiswa')
        ->join('siswa', 'kelassiswa.id_siswa', '=', 'siswa.id')
        ->join('users', 'siswa.id_user', '=', 'users.id')
        ->join('kelas', 'kelassiswa.id_kelas', '=', 'kelas.id')
        ->join('tahunajar', 'kelassiswa.id_tahunajar', '=', 'tahunajar.id')
        ->where('kelassiswa.id_kelas', $id_kelas)
        ->where('kelassiswa.id_tahunajar', $id_tahunajar)
        ->select('kelassiswa.*', 'users.name', 'kelas.kelas', 'tahunajar.tahunajar')
        ->get();

    if ($transaksi->count() > 0) {
        foreach ($transaksi as $data) {
            $riwayatKelas = DB::table('kelas')
                ->join('kelassiswa', 'kelassiswa.id_kelas', '=', 'kelas.id')
                ->join('tahunajar', 'kelassiswa.id_tahunajar', '=', 'tahunajar.id')
                ->where('kelassiswa.id_siswa', $data->id_siswa)
                ->select('kelas.kelas', 'tahunajar.tahunajar')
                ->get();

            if ($riwayatKelas->count() > 0) {
                $kelasTahunAjar = [];
                foreach ($riwayatKelas as $riwayat) {
                    $kelasTahunAjar[] = $riwayat->kelas;
                }
                $riwayatKelasString[$data->id_siswa] = implode(', ', $kelasTahunAjar);
            }

            $riwayatTahunAjaran = DB::table('tahunajar')
                ->join('kelassiswa', 'kelassiswa.id_tahunajar', '=', 'tahunajar.id')
                ->where('kelassiswa.id_siswa', $data->id_siswa)
                ->distinct('tahunajar.tahunajar')
                ->pluck('tahunajar.tahunajar');

            if ($riwayatTahunAjaran->count() > 0) {
                $tahunAjaran = $riwayatTahunAjaran->toArray();
                $riwayatTahunAjaranString[$data->id_siswa] = implode(', ', $tahunAjaran);
            }
        }
    }

    return view('pages.transaksi.hapus', compact('data1', 'data2', 'kelas', 'tahunajar', 'transaksi', 'riwayatKelasString', 'riwayatTahunAjaranString'));
    }
    public function destroy($id)
    {
       
            $transaksi = Transaksi::find($id);
            $transaksi->delete();
            Alert::success('Berhasil', 'Transaksi berhasil dihapus');

            return redirect()->back();
        
    }
    
}
