<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use Validator;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();

        return view('pages.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Method untuk Store sudah ditambahkan
        $rules = [
            'kelas' => 'required||unique:kelas',


        ];


        $messages = [
            'kelas.required' => 'Kelas wajib diisi',
            'kelas.unique' => 'Kelas sudah ada',


        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $kelas = Kelas::create([
            'kelas' => $request->kelas,
        ]);

        Alert::success('Berhasil', 'Siswa Berhasil Ditambahkan');

        return redirect('/kelas');
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
        $kelas = Kelas::find($id);

        return view('pages.kelas.edit', compact('kelas'));
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
        $kelas = Kelas::find($id);

        $rules = [
            'kelas' => 'required', Rule::unique('kelas')->ignore($id)


        ];


        $messages = [
            'kelas.required' => 'Kelas wajib diisi',
            'kelas.unique' => 'Kelas sudah ada',


        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        //ganti data kelas berdasarkan id


        $kelas = Kelas::find($kelas->id);
        $kelas->kelas = $request->kelas;
        $kelas->save();
        Alert::success('Berhasil', 'Siswa berhasil diubah');
        return redirect('/kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $kelas = Kelas::find($id);
        //hapus jika tidak ada foreignkey di table siswa
        if ($kelas->siswa->count() == 0) {
            $kelas->delete();
            Alert::success('Berhasil', 'Kelas berhasil dihapus');
            return redirect('/kelas');
        } else {
            Alert::error('Gagal', 'Kelas tidak bisa dihapus karena masih ada siswa');
            return redirect('/kelas');
        }
    }
}
