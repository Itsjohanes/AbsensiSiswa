<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = ['id_user', 'id_kelas', 'nisn', 'no_hp', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function siswa_absen()
    {
        return $this->hasMany(SiswaAbsen::class, 'id_siswa');
    }
    function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
