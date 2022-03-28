<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Mahasiswa extends Model //Definisi model
{
    protected $table ="mahasiswas"; //Eloquent akan membuat model mahasiswa
    public $timestamps = false;
    protected $primaryKey ='nim'; //Memanggil isi DB dengan primarykey

    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'jurusan',
        'no_handphone',
    ];
    use HasFactory;
}
