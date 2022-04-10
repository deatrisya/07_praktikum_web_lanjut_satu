<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Mahasiswa_Matakuliah extends Pivot
{
    use HasFactory;
    protected $table = "mahasiswa_matakuliah";
    public $timestamps = false;
    protected $primaryKey = "id";

    public function mhs_matkul(){
        return $this->belongsToMany(Mahasiswa::class, Mahasiswa_Matakuliah::class,'mahasiswa_id','matakuliah_id')->withPivot('nilai');
    }
    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class);
    }
    public function matakuliah(){
        return $this->belongsTo(Matakuliah::class);
    }
}
