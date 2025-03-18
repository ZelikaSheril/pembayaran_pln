<?php

namespace Database\Seeders;

use App\Models\Admin; // Sesuaikan dengan model admin kamu
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Cek apakah admin sudah ada
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'), // Ganti dengan password aman
            ]
        );
    }
}
