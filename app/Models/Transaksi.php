<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'kelassiswa';
    protected $fillable = ['id_siswa','id_kelas','id_tahunajar'];

    function tahunajar()
    {
        return $this->belongsTo(TahunAjar::class, 'id_tahunajar');
    }
    function siswa(){
        return $this->belongsTo(Siswa::class,'id_siswa');
    }
    function kelas(){
        return $this->belongsTo(Kelas::class,'id_kelas');
    }
    
}
