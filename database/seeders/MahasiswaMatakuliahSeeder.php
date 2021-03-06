<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa_matakuliah = [
            //mahasiswa1
            [ 'mahasiswa_id' => '2041720013', 'matakuliah_id' => 1, 'nilai' => 'A', ],
            [ 'mahasiswa_id' => '2041720013', 'matakuliah_id' => 2, 'nilai' => 'A', ],
            [ 'mahasiswa_id' => '2041720013', 'matakuliah_id' => 3, 'nilai' => 'A', ],
            [ 'mahasiswa_id' => '2041720013', 'matakuliah_id' => 4, 'nilai' => 'A', ],
            //mahasiswa2
            [ 'mahasiswa_id' => '2041720014', 'matakuliah_id' => 1, 'nilai' => 'A', ],
            [ 'mahasiswa_id' => '2041720014', 'matakuliah_id' => 2, 'nilai' => 'A', ],
            [ 'mahasiswa_id' => '2041720014', 'matakuliah_id' => 3, 'nilai' => 'A', ],
            [ 'mahasiswa_id' => '2041720014', 'matakuliah_id' => 4, 'nilai' => 'A', ],

        ];

        DB::table('mahasiswa_matakuliah')->insert($mahasiswa_matakuliah);
    }
}
