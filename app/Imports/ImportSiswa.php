<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Siswa;

class ImportSiswa implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
{
    foreach ($collection as $index => $row) {
        if ($index == 0) {
            continue; // Skip the first row
        }

        $user = User::create([
            'name' => $row[1],
            'level' => 'siswa',
            'email' => $row[2],
            'password' => $row[3]
        ]);
        
        $siswa = Siswa::create([
            'id_user' => $row[0],
            'nisn' => $row[4],
            'nis' => $row[5],
            'tahun_masuk' => $row[6],
            'id_tahunajar' => $row[7],
            'id_kelas' => $row[8],
            'no_hp' => $row[9],
            'alamat' => $row[10]
        ]);
    }
}

}
