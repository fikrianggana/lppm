<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'usr_id'=>'USR001',
                'usr_nama'=>'Fikri Anggana',
                'prodi_id'=>'1',
                'username'=>'fikri',
                'password'=>bcrypt('fikri'),
                'usr_role'=>'admin',
                'usr_email'=>'fikri@gmail.com',
                'usr_notelpon'=>'0812393124',
            ],
            [
                'usr_id'=>'USR002',
                'usr_nama'=>'Elfa',
                'prodi_id'=>'1',
                'username'=>'elfa',
                'password'=>bcrypt('elfa'),
                'usr_role'=>'karyawan',
                'usr_email'=>'elfa@gmail.com',
                'usr_notelpon'=>'987654323',
            ],
            [
                'usr_id'=>'USR003',
                'usr_nama'=>'Javier Muhammad',
                'prodi_id'=>'1',
                'username'=>'javier',
                'password'=>bcrypt('1234'),
                'usr_role'=>'karyawan',
                'usr_email'=>'javier@gmail.com',
                'usr_notelpon'=>'0812391324',
            ],
        ];



        foreach ($userData as $key => $val){
            User::create($val);
        }
    }
}
