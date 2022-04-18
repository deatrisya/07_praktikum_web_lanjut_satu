<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use App\Models\Kelas;


class Mahasiswa extends Model //Definisi model
{
    protected $table ="mahasiswas"; //Eloquent akan membuat model mahasiswa
    public $timestamps = false;
    protected $primaryKey ='nim'; //Memanggil isi DB dengan primarykey

    protected $fillable = [
        'nim',
        'nama',
        'foto',
        'kelas_id',
        'jurusan',
        'no_handphone',
    ];
    use HasFactory;

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function matakuliah(){
        return $this->belongsToMany(Matakuliah::class,'mahasiswa_matakuliah', 'mahasiswa_id', 'matakuliah_id')->withPivot('nilai');
    }
}
