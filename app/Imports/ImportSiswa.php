<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Transaksi;

class ImportSiswa implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
{
    foreach ($collection as $index => $row) {
        if ($index == 0) {
            continue; 
        }

        $user = User::create([
            'name' => $row[0],
            'level' => 'siswa',
            'email' => $row[1],
            'password' => $row[2]
        ]);
        
        $siswa = Siswa::create([
            'id_user' => $user->id,
            'nisn' => $row[3],
            'nis' => $row[4],
            'tahun_masuk' => $row[5],
            'no_hp' => $row[8],
            'alamat' => $row[9]
        ]);
        $transaksi = Transaksi::create([
            'id_siswa' => $siswa->id,
            'id_tahunajar' => $row[6],
            'id_kelas' => $row[7]
        ]);
    }
}

}
