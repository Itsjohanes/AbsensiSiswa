<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{
    use HasFactory;

    protected $table = 'tahunajar';

    protected $fillable = ['tahunajar'];



    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_tahunajar');
    }
}
