<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\TahunAjar;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use Validator;
use Illuminate\Validation\Rule;

class TahunAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunajar = TahunAjar::all();

        return view('pages.tahunajar.index', compact('tahunajar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tahunajar.create');
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
            'tahunajar' => 'required||unique:tahunajar',


        ];


        $messages = [
            'tahunajar.required' => 'Tahun Ajar wajib diisi',
            'tahunajar.unique' => 'Tahun Ajar sudah ada',


        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $tahunajar = TahunAjar::create([
            'tahunajar' => $request->tahunajar,
        ]);

        Alert::success('Berhasil', 'Tahun Ajar Berhasil Ditambahkan');

        return redirect('/tahunajar');
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
        $tahunajar = TahunAjar::find($id);

        return view('pages.tahunajar.edit', compact('tahunajar'));
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
        $tahunajar = TahunAjar::find($id);

        $rules = [
            'tahunajar' => 'required', Rule::unique('tahunajar')->ignore($id)


        ];


        $messages = [
            'tahunajar.required' => 'Tahun Ajar wajib diisi',
            'tahunajar.unique' => 'Tahun Ajar sudah ada',


        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        //ganti data kelas berdasarkan id


        $tahunajar = TahunAjar::find($tahunajar->id);
        $tahunajar->tahunajar = $request->tahunajar;
        $tahunajar->save();
        Alert::success('Berhasil', 'Tahun Ajar berhasil diubah');
        return redirect('/tahunajar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $tahunajar = TahunAjar::find($id);
        //hapus jika tidak ada foreignkey di table siswa
        if ($tahunajar->siswa->count() == 0 && $tahunajar->absen->count() == 0) {
            $tahunajar->delete();
            Alert::success('Berhasil', 'Tahun Ajar berhasil dihapus');
            return redirect('/tahunajar');
        } else {
            Alert::error('Gagal', 'Tahun Ajar tidak bisa dihapus karena masih ada siswa');
            return redirect('/tahunajar');
        }
        
    }
}
