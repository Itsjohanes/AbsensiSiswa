<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaAbsen extends Model
{
    use HasFactory;

    protected $table = 'siswa_absensi';

    protected $fillable = ['id_siswa','id_tahunajar','id_kelas','tgl', 'jam_masuk', 'jam_keluar', 'jam_kerja', 'lokasi_absen',
'gambarmasuk','gambarkeluar'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
     function tahunajar()
    {
        return $this->belongsTo(TahunAjar::class, 'id_tahunajar');
    }
    function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
