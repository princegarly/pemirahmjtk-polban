<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $candidate = Candidate::get();
        $result = Result::with("user", "candidate")->GroupBy('results.candidate_id')->get();

        foreach ($result as $value) {
            $candidates = Candidate::where("id", $value->candidate_id)->get();
            foreach ($candidates as $key) {
                $Data['label'][] = $key->name;
                
            }
            $dataCount = Result::where("candidate_id", $value->candidate->id)->count();

            $data['data'][] =  (int) $dataCount;

            if($data != null) {
                $this->result = json_encode($data);
                $result = $this->result;
            }
        }

        return view('master.result.index', compact('result'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
