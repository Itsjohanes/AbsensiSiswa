<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Models\Koordinat;
use App\Models\Siswa;
use App\Models\SiswaAbsen;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\WebcamController;
use Illuminate\Support\Facades\App;
use Storage;

use Carbon\Carbon;


class SiswaAbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tanggal = date("d-m-Y");

        // $date = Carbon::now();

        // $carbon = $date->locale('id')->format('d-m-Y');

        // $cek = $tanggal == $carbon ? 'sama' :'tidak sama';

        // return $cek;
        $siswa = Siswa::where('id_user', auth()->user()->id)->first();
        $data_absen = SiswaAbsen::where('id_siswa', '=', $siswa->id)->get();
        return view('pages.absen-siswa.index', compact('data_absen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Mendapatkan data login dari pns
    $siswa = Siswa::where('id_user', auth()->user()->id)->first();

    // Data tanggal hari ini
    $timezone = 'Asia/Jakarta';
    $date = new DateTime('now', new DateTimeZone($timezone));
    $tanggal = $date->format('Y-m-d');
    $localtime = $date->format('H:i:s');

    // Data koordinat sekolah
    $koord = Koordinat::where('id', 1)->first();

    $jarak = $this->distance($request->lat, $request->lng, $koord->latitude, $koord->longitude, "K"); // <-- dihitung menggunakan satuan kilometer

    $siswa_absen = SiswaAbsen::where('id_siswa', '=', $siswa->id)->where('tgl', '=', $tanggal)->first();

    // Mendapatkan id_kelas terbaru dari table kelassiswa berdasarkan id_siswa
    $id_siswa = $siswa->id;
    $id_kelass = DB::table('kelassiswa')
                ->where('id_siswa', $id_siswa)
                ->latest('created_at')
                ->pluck('id_kelas')
                ->first();
    // Mendapatkan id_tahunajar terbaru dari table kelassiswa berdasarkan id_siswa
    $id_tahunajarr = DB::table('kelassiswa')
                ->where('id_siswa', $id_siswa)
                ->latest('created_at')
                ->pluck('id_tahunajar')
                ->first();

    // Melakukan pengecekan $id_tahunajarr apakah dia $id_tahunajar terbaru atau tidak dengan cara mengambil baris terakhir id tahun ajar dari table tahunajar
    $id_tahunajarr_terbaru = DB::table('tahunajar')
                ->latest('created_at')
                ->pluck('id')
                ->first();
    if ($id_tahunajarr == $id_tahunajarr_terbaru) {
        if ($siswa_absen) {
            Alert::warning('Peringatan', 'Sudah melakukan absensi masuk');
            return redirect()->back();
        } else {
            // Jika jarak lebih besar dari 0.2
            if ($jarak > 0.2) {
                Alert::error('Gagal', 'Jarak anda jauh dari sekolah!');
                return redirect()->back();
            } else {
                // Memastikan request memiliki file foto
               
                    if($request->image != null){
                        $img = $request->image;
                    $folderPath = public_path('uploads/');
                    
                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    
                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = uniqid() . '.png';
                    $namaFile = $fileName;
                    
                    $file = 'uploads/' . $fileName;
                    Storage::disk('public')->put($file, $image_base64);

                        SiswaAbsen::create([
                            'id_siswa' => $siswa->id,
                            'tgl' => $tanggal,
                            'jam_masuk' => $localtime,
                            'id_tahunajar' => $id_tahunajarr,
                            'id_kelas' => $id_kelass,
                            'gambarmasuk' => $namaFile,
                        ]);

                        Alert::success('Berhasil', 'Berhasil melakukan absen masuk');
                        return redirect('/absen-siswa');
                    }else{
                        Alert::error('Gagal', 'Foto tidak boleh kosong!');
                        return redirect()->back();
                    }
                    
                   
                
                }
            }
        }
     else {
        Alert::warning('Peringatan', 'Anda Belum terdaftar di tahun ajar terbaru');
        return redirect()->back();
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function absenKeluar(Request $request)
    {
        $siswa = Siswa::where('id_user', auth()->user()->id)->first();

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');

        // data koordinat sekolah
        $koord = Koordinat::where('id', 1)->first();

        $jarak = $this->distance($request->lat, $request->lng, $koord->latitude, $koord->longitude, "K"); // <-- dihitung menggunakan satuan kilometer

        $siswa_absen = SiswaAbsen::where('id_siswa', '=', $siswa->id)->where('tgl', '=', $tanggal)->first();

        if ($siswa_absen) {
            if ($siswa_absen->jam_keluar == "") {
                //Jika jarak lebih kecil atau sama dengan 0.2 bisa melakukan absen keluar
                if ($jarak <= 0.2) {
                    if($request->image != null){
                    $img = $request->image;
                    $folderPath = public_path('uploads/');
                    
                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    
                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = uniqid() . '.png';
                    $namaFile = $fileName;
                    /*
                    $file = $folderPath . $fileName;
                    Storage::put($file, $image_base64);
                    */
                    $file = 'uploads/' . $fileName;
                    Storage::disk('public')->put($file, $image_base64);

                    $siswa_absen->update([
                        'jam_keluar' => $localtime,
                        'gambarkeluar' => $namaFile,
                        'jam_kerja' => date('H:i:s', strtotime($localtime) - strtotime($siswa_absen->jam_masuk))
                    ]);

                    Alert::success('Berhasil', 'Sampai ketemu lagi besok :)');
                    return redirect('/absen-siswa');
                } else {
                    Alert::error('Gagal', 'Foto tidak boleh kosong!');
                    return redirect()->back();
                }
            }else{
                Alert::error('Gagal', 'Jarak anda jauh dari sekolah!');
                return redirect()->back();
            }
            } else {
                Alert::warning('Peringatan', 'Sudah melakukan absensi keluar');
                return redirect()->back();
            }
        } else {
            Alert::error('Gagal', 'Anda belum melakukan absensi masuk!');
            return redirect()->back();
        }
    }

    // menghitung jarak latitude dan longitude dari sekolah ke device absen
    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
       


    
}
