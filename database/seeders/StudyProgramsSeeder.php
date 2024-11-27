<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyProgramsSeeder extends Seeder
{
    public function run(): void
    {
        $studyPrograms = [
            [
                'name' => 'D3 - Teknik Kimia'
            ],
            [
                'name' => 'D3 - Analisis Kimia'
            ],
            [
                'name' => 'D4 - Teknik Kimia Produksi Bersih'
            ]
        ];
        
        foreach ($studyPrograms as $studyProgram) {
            StudyProgram::create($studyProgram);
        }
    }
}
