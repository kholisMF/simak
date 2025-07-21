<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->insert([
            'nama'           => 'Kholis Maulana Firdaus',
            'username'       => 'kmf',
            'password'       => Hash::make('sawahpari'),
            'email'          => 'kmf029@gmail.com',
            'level'          => '1',
            'foto'           => null,
            'token'          => null,
            'last_login_at'  => null,
            'remember_token' => null,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}
