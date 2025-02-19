<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'sequence_number',
        'name',
        'photo',
        'vision_and_mission',
        'curriculum_vitae',
        'grand_design'
    ];
}
