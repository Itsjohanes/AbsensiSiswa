<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Imports\ImportSiswa;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;

class EditProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = DB::table('kelas')->get();
        $tahunajar = DB::table('tahunajar')->get();
        $id = Auth::id();
        $siswa = Siswa::find($id);

        return view('pages.siswa.editprofile', compact('siswa', 'kelas','tahunajar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //id ambil dari session 
       $id = Auth::id();

        $siswa = Siswa::find($id);

        $rules = [
            'name'                  => 'required',
            'password'              => 'required|min:8|same:konfirmasi_password',
            'konfirmasi_password'   => 'required|min:8',
            'id_kelas'                  => 'required',
            'id_tahunajar'          => 'required',
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
            'id_kelas.required'                 => 'Kelas wajib dipilih',
             'id_tahunajar.required'                 => 'Tahun Ajar wajib dipilih',
            'email.email'                   => 'Email tidak valid',
            'email.unique'                  => 'Email sudah terdaftar',
            'nisn.required'                  => 'NIP wajib diisi',
            'nisn.numeric'                   => 'NIP harus berupa angka',
            'nisn.unique'                    => 'NIP sudah terdaftar',
            'nisn.unique'                    => 'NISN sudah terdaftar',
            'nis.required'                  => 'NIS wajib diisi',
            'nis.unique'                    => 'NIS sudah terdaftar',
            'tahun_masuk.required'                => 'Tahun Masuk wajib diisi',
            'tahun_masuk.numeric'                 => 'Tahun Masuk harus berupa angka',
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
        $siswa->id_kelas = $request->id_kelas;
        $siswa->no_hp = $request->no_hp;
        $siswa->alamat = $request->alamat;
        $siswa->save();

        $user = User::find($siswa->id_user);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        Alert::success('Berhasil', 'Data Siswa berhasil diubah');

        return redirect('/');
    }
}
