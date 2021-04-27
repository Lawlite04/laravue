<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        //
        $user = [
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'level'=>'admin',
            ],
            [
                'name'=>'Petugas',
                'email'=>'petugas@gmail.com',
                'password' => Hash::make('petugas123'),
                'level'=>'petugas',
            ],
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'password' => Hash::make('user123'),
                'level'=>'user',
            ]
            ];

        foreach ($user as $key) {
            User::create($key);
        }
    }
}
