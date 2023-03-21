<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = ['kelas'];


    /*
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function siswa_absen()
    {
        return $this->hasMany(SiswaAbsen::class, 'id_siswa');
    }
    */
}
