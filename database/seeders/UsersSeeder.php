<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\StudyProgram;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $studyProgram = StudyProgram::where('name', 'D3 - Teknik Kimia')->get()->first();
        $grade = Grade::where('name', '2C - TKI')->get()->first();

        User::create([
            'study_program_id' => $studyProgram->id,
            'grade_id' => $grade->id,
            'nim' => '231411092',
            'name' => 'Synbi Pasya Octaviarine Adihartanto',
            'gender' => false,
            'year_group' => '2023',
            'start_time' => '08:00:00',
            'end_time' => '20:30:00',
            'email' => 'synbi.pasya.tki23@polban.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('59294547'),
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ])->assignRole('administrator', 'voters');
    }
}
