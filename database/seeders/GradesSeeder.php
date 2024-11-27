<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradesSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            [
                'name' => '1A - ANK'
            ],
            [
                'name' => '1B - ANK'
            ],
            [
                'name' => '1A - TKI'
            ],
            [
                'name' => '1B - TKI'
            ],
            [
                'name' => '1C - TKI'
            ],
            [
                'name' => '1D - TKI'
            ],
            [
                'name' => '1A - TKPB'
            ],
            [
                'name' => '1B - TKPB'
            ],
            [
                'name' => '2A - ANK'
            ],
            [
                'name' => '2B - ANK'
            ],
            [
                'name' => '2A - TKI'
            ],
            [
                'name' => '2B - TKI'
            ],
            [
                'name' => '2C - TKI'
            ],
            [
                'name' => '2D- TKI'
            ],
            [
                'name' => '2A - TKPB'
            ],
            [
                'name' => '2B - TKPB'
            ],
            [
                'name' => '3A - ANK'
            ],
            [
                'name' => '3B - ANK'
            ],
            [
                'name' => '3A - TKI'
            ],
            [
                'name' => '3B - TKI'
            ],
            [
                'name' => '3C - TKI'
            ],
            [
                'name' => '3A - TKPB'
            ],
            [
                'name' => '3B - TKPB'
            ],
            [
                'name' => '4 - TKPB'
            ]
        ];
        
        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
