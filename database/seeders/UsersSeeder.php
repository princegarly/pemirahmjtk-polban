<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Garly Nugraha',
            'gender' => true,
            'email' => 'garly.nugraha.tif21@polban.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('Adm!nG4r1y'),
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ])->assignRole('administrator');
    }
}
