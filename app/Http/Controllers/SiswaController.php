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

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::with('user')->get();
        return view('pages.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //berikan value untuk kelas dan kirimkan ke view
        $kelas = DB::table('kelas')->get();
        $tahunajar = DB::table('tahunajar')->get();
        return view('pages.siswa.create', compact('kelas','tahunajar'));
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ImportSiswa, $file);
        return redirect()->back()->with('success', 'Data siswa imported successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => 'required',
            'password'              => 'required|min:8|same:konfirmasi_password',
            'konfirmasi_password'   => 'required|min:8',
            'email'                 => 'required|email|unique:users',
            'nisn'                   => 'required|numeric|unique:siswa',
            'nis'                    => 'required|numeric|unique:siswa',
            'tahun_masuk'            => 'required|numeric',
            'no_hp'                 => 'required|numeric',
            'alamat'                => 'required'
        ];


        $messages = [
            'name.required'                 => 'Nama wajib diisi',
            'password.required'             => 'Password wajib diisi',
            'password.min'                  => 'Password minimal 8 karakter',
            'password.same'                 => 'Konfirmasi password harus sama dengan password',
            'konfirmasi_password.required'  => 'Konfirmasi password wajib diisi',
            'konfirmasi_password.min'       => 'Konfirmasi password minimal 8 karakter',
            'email.required'                => 'Email wajib diisi',
            'email.email'                   => 'Email tidak valid',
            'email.unique'                  => 'Email sudah terdaftar',
            'nisn.required'                  => 'NISN wajib diisi',
            'nisn.unique'                    => 'NISN sudah terdaftar',
            'nis.required'                  => 'NIS wajib diisi',
            'nis.unique'                    => 'NIS sudah terdaftar',
            'tahun_masuk.required'                => 'Tahun Masuk wajib diisi',
            'tahun_masuk.numeric'                 => 'Tahun Masuk harus berupa angka',
            'no_hp.required'                => 'Nomor handphone wajib diisi',
            'no_hp.numeric'                 => 'Nomor handphone harus berupa angka',
            'alamat.required'               => 'Alamat wajib diisi'
        ];

        //masukan juga kelas
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level' => 'siswa',
            'password' => $request->password,
        ]);

        $input = $request->except(['name', 'email', 'password', 'konfirmasi_password','id_kelas','id_tahunajar']);
        

        Siswa::create(array_merge($input, ['id_user' => $user->id]));

        $input = $request->except(['name', 'email', 'password', 'konfirmasi_password','no_hp','alamat','nis','nisn','tahun_masuk']);

        //mendapatkan id_siswa dari tabel siswa yang id_usernya
        $siswa = Siswa::where('id_user', $user->id)->first();
        if ($siswa) {
            $id_siswa = $siswa->id;
        } 
        Transaksi::create(array_merge($input, ['id_siswa' => $id_siswa]));
        Alert::success('Berhasil', 'Siswa Berhasil Ditambahkan');
        return redirect('/siswa');
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
        $siswa = Siswa::find($id);

        if ($siswa) {
            $idSiswa = $siswa->id;

            // Mengambil riwayat kelas
            $riwayatKelas = DB::table('kelassiswa')
                ->join('kelas', 'kelassiswa.id_kelas', '=', 'kelas.id')
                ->where('kelassiswa.id_siswa', $idSiswa)
                ->pluck('kelas.kelas')
                ->toArray();

            $riwayatKelasString = implode(', ', $riwayatKelas);

            // Mengambil riwayat tahun ajaran
            $riwayatTahunAjaran = DB::table('kelassiswa')
                ->join('tahunajar', 'kelassiswa.id_tahunajar', '=', 'tahunajar.id')
                ->where('kelassiswa.id_siswa', $idSiswa)
                ->pluck('tahunajar.tahunajar')
                ->toArray();

            $riwayatTahunAjaranString = implode(', ', $riwayatTahunAjaran);
        }

        return view('pages.siswa.edit', compact('siswa','riwayatKelasString','riwayatTahunAjaranString'));
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

        $siswa = Siswa::find($id);

        $rules = [
            'name'                  => 'required',
            'password'              => 'required|min:8|same:konfirmasi_password',
            'konfirmasi_password'   => 'required|min:8',
            'email'                 => 'required|email|', Rule::unique('users')->ignore($id),
            'nisn'                   => 'required|numeric|', Rule::unique('siswa')->ignore($id),
            'nis'                   => 'required|numeric|', Rule::unique('siswa')->ignore($id),
            'tahun_masuk'            => 'required|numeric',
            'no_hp'                 => 'required|numeric',
            'alamat'                => 'required'
        ];


        $messages = [
            'name.required'                 => 'Nama wajib diisi',
            'password.required'             => 'Password wajib diisi',
            'password.min'                  => 'Password minimal 8 karakter',
            'password.same'                 => 'Konfirmasi password harus sama dengan password',
            'konfirmasi_password.required'  => 'Konfirmasi password wajib diisi',
            'konfirmasi_password.min'       => 'Konfirmasi password minimal 8 karakter',
            'email.required'                => 'Email wajib diisi',
            'email.email'                   => 'Email tidak valid',
            'email.unique'                  => 'Email sudah terdaftar',
            'nisn.required'                  => 'NIP wajib diisi',
            'nisn.numeric'                   => 'NIP harus berupa angka',
            'nisn.unique'                    => 'NIP sudah terdaftar',
            'nisn.unique'                    => 'NISN sudah terdaftar',
            'nis.required'                  => 'NIS wajib diisi',
            'nis.unique'                    => 'NIS sudah terdaftar',
            'tahun_masuk.required'          => 'Tahun Masuk wajib diisi',
            'tahun_masuk.numeric'          => 'Tahun Masuk harus berupa angka',
            'no_hp.required'                => 'Nomor handphone wajib diisi',
            'no_hp.numeric'                 => 'Nomor handphone harus berupa angka',
            'alamat.required'               => 'Alamat wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        $siswa->nisn = $request->nisn;
        $siswa->nis = $request->nis;
        $siswa->tahun_masuk = $request->tahun_masuk;
        $siswa->no_hp = $request->no_hp;
        $siswa->alamat = $request->alamat;
        $siswa->save();

        $user = User::find($siswa->id_user);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        Alert::success('Berhasil', 'Siswa berhasil diubah');

        return redirect('/siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if ($siswa->siswa_absen()->count() && $siswa->transaksi()->count()) {
            Alert::error('Gagal', 'Siswa ini sudah memiliki riwayat absen');
            return redirect()->back();
        } else {
            $user = User::where('id', $siswa->id_user)->delete();
            $siswa->delete();

            Alert::success('Berhasil', 'Siswa berhasil dihapus');

            return redirect('/siswa');
        }
    }
}
