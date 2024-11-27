<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ElectionStatusController extends Controller
{
    public function already()
    {
        $title = "Sudah Memilih - Data";

        return view('master.user.status.already', compact('title'));
    }

    public function notyet()
    {
        $title = "Belum Memilih - Data";

        return view('master.user.status.notyet', compact('title'));
    }

    public function alreadyData()
    {
        $data = User::select('users.*', 'grades.name as grade_name', 'study_programs.name as study_program_name')
                    ->join('grades', 'users.grade_id', '=', 'grades.id')
                    ->join('study_programs', 'users.study_program_id', '=', 'study_programs.id')
                    ->where('users.election_status', '=', true)
                    ->orderBy('users.name', 'asc')
                    ->get();

        return DataTables::of($data)->make();
    }

    public function notyetData()
    {
        $data = User::select('users.*', 'grades.name as grade_name', 'study_programs.name as study_program_name')
                    ->join('grades', 'users.grade_id', '=', 'grades.id')
                    ->join('study_programs', 'users.study_program_id', '=', 'study_programs.id')
                    ->where('users.election_status', '=', false)
                    ->orderBy('users.name', 'asc')
                    ->get();

        return DataTables::of($data)->make();
    }
}
