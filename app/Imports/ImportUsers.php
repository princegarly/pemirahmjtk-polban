<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUsers implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            $dataUser = User::where('nim', $row['nim'])->first();

            $studyProgram = StudyProgram::where('name', $row['study_program'])->get()->first();
            $grade = Grade::where('name', $row['grade'])->get()->first();

            $electionStatus = $row['election_status'] == 'Sudah Memilih' ? true : false;
            $gender = $row['gender'] == 'Laki-laki' ? true : false;

            if($dataUser) {
                $user = User::where('nim', $row['nim'])->update([
                    'study_program_id' => optional($studyProgram)->id,
                    'grade_id' => optional($grade)->id,
                    'name' => $row['name'],
                    'gender' => $gender,
                    'year_group' => $row['year_group'],
                    'start_time' => $row['start_time'],
                    'end_time' => $row['end_time'],
                    'election_status' => $electionStatus,
                    'email' => $row['email'],
                    'password' => Hash::make($row['password']),
                ]);

                $roles = explode(',', $row['roles']);
                
                foreach ($roles as $role) {
                    $user->syncRoles(trim(strtolower($role)));
                }
            } else {
                $user = User::create([
                    'study_program_id' => optional($studyProgram)->id,
                    'grade_id' => optional($grade)->id,
                    'nim' => $row['nim'],
                    'name' => $row['name'],
                    'gender' => $gender,
                    'year_group' => $row['year_group'],
                    'start_time' => $row['start_time'],
                    'end_time' => $row['end_time'],
                    'election_status' => $electionStatus,
                    'email' => $row['email'],
                    'password' => Hash::make($row['password']),
                ]);

                $roles = explode(',', $row['roles']);
                
                foreach ($roles as $role) {
                    $user->assignRole(trim(strtolower($role)));
                }
            }
        }
    }
}
