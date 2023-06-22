<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = ['kelas'];
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }
    public function absen()
    {
        return $this->hasMany(SiswaAbsen::class, 'id_tahunajar');
    }
    public function transaksi(){

        return $this->hasMany(Transaksi::class, 'id_kelas');

    }

    
}
