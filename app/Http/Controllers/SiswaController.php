<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
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
        return view('pages.siswa.create', compact('kelas'));
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
            'id_kelas'                  => 'required',
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
            'id_kelas.required'                 => 'Kelas wajib dipilih',
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

        $input = $request->except(['name', 'email', 'password', 'konfirmasi_password']);

        Siswa::create(array_merge($input, ['id_user' => $user->id]));

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
        $kelas = DB::table('kelas')->get();

        $siswa = Siswa::find($id);

        return view('pages.siswa.edit', compact('siswa', 'kelas'));
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
            'id_kelas'                  => 'required',
            'email'                 => 'required|email|', Rule::unique('users')->ignore($id),
            'nisn'                   => 'required|numeric|', Rule::unique('siswa')->ignore($id),
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
            'email.email'                   => 'Email tidak valid',
            'email.unique'                  => 'Email sudah terdaftar',
            'nisn.required'                  => 'NIP wajib diisi',
            'nisn.numeric'                   => 'NIP harus berupa angka',
            'nisn.unique'                    => 'NIP sudah terdaftar',
            'no_hp.required'                => 'Nomor handphone wajib diisi',
            'no_hp.numeric'                 => 'Nomor handphone harus berupa angka',
            'alamat.required'               => 'Alamat wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        $siswa->nisn = $request->nisn;
        $siswa->id_kelas = $request->id_kelas;
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
        if ($siswa->siswa_absen()->count()) {
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
