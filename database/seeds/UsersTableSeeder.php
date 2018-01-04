<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('organisasi')->insert([
//            'id_organisasi' => '10100',
//            'password' => bcrypt('1234'),
//            'tipe_organisasi' => '2',
//            'nama_organisasi' => 'AREA SURABAYA BARAT',
////            'nama_daerah' => 'SURABAYA BARAT',
//            'alamat' => 'surabaya',
//            'remember_token' => str_random(10),
//        ]);
//
//        DB::table('organisasi')->insert([
//            'id_organisasi' => '10101',
//            'password' => bcrypt('1234'),
//            'tipe_organisasi' => '3',
//            'nama_organisasi' => 'RAYON TAMAN',
////            'nama_daerah' => 'TAMAN',
//            'alamat' => 'taman 1',
//            'remember_token' => str_random(10),
//        ]);
//
//        DB::table('organisasi')->insert([
//            'id_organisasi' => '10102',
//            'password' => bcrypt('1234'),
//            'tipe_organisasi' => '3',
//            'nama_organisasi' => 'RAYON TAMAN',
////            'nama_daerah' => 'TAMAN',
//            'alamat' => 'taman 2',
//            'remember_token' => str_random(10),
//        ]);
//
//        DB::table('organisasi')->insert([
//            'id_organisasi' => '10103',
//            'password' => bcrypt('1234'),
//            'tipe_organisasi' => '3',
//            'nama_organisasi' => 'RAYON TAMAN',
////            'nama_daerah' => 'TAMAN',
//            'alamat' => 'taman 3',
//            'remember_token' => str_random(10),
//        ]);
//
//        DB::table('organisasi')->insert([
//            'id_organisasi' => '10104',
//            'password' => bcrypt('1234'),
//            'tipe_organisasi' => '3',
//            'nama_organisasi' => 'RAYON TAMAN',
////            'nama_daerah' => 'TAMAN',
//            'alamat' => 'taman 4',
//            'remember_token' => str_random(10),
//        ]);
//
//        DB::table('organisasi')->insert([
//            'id_organisasi' => '10105',
//            'password' => bcrypt('1234'),
//            'tipe_organisasi' => '3',
//            'nama_organisasi' => 'RAYON KARANG PILANG',
////            'nama_daerah' => 'KARANG PILANG',
//            'alamat' => 'taman 5',
//            'remember_token' => str_random(10),
//        ]);

        DB::table('organisasi')->insert([
            'id_organisasi' => '00000',
            'password' => bcrypt('1234'),
            'tipe_organisasi' => '0',
            'nama_organisasi' => 'ADMINISTRATOR',
//            'nama_daerah' => 'JAWA TIMUR',
            'alamat' => 'SURABAYA',
            'remember_token' => str_random(10),
        ]);

        DB::table('organisasi')->insert([
            'id_organisasi' => '10000',
            'password' => bcrypt('1234'),
            'tipe_organisasi' => '1',
            'nama_organisasi' => 'DISTRIBUSI',
//            'nama_daerah' => 'JAWA TIMUR',
            'alamat' => 'SURABAYA',
            'remember_token' => str_random(10),
        ]);
    }
}
