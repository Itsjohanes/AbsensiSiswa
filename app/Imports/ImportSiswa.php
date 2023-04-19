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
        foreach ($collection as $row) {

            $user = User::create([
                'name' => $row[1],
                'level' => 'siswa',
                'email' => $row[3],
                'password' => $row[4]
            ]);
        }
        foreach ($collection as $row) {

            $siswa = Siswa::create([
                'id_user' => $row['0'],
                'nisn' => $row['5'],
                'nis' => $row['6'],
                'tahun_masuk' => $row['7'],
                'id_kelas' => $row['8'],
                'no_hp' => $row['9'],
                'alamat' => $row['10']
            ]);
        }
    }
}
