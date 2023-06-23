<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Guru;

class ImportGuru implements ToCollection
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
            'level' => 'guru',
            'email' => $row[1],
            'password' => $row[2]
        ]);
        
        $guru = Guru::create([
            'id_user' => $user->id,
            'nip' => $row[3],
            'no_hp' => $row[4],
            'alamat' => $row[5]
        ]);
       
    }
}

}
