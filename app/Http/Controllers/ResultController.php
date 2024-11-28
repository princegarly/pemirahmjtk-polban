<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        $Candidate = Candidate::get();

        // Fix the query to group by candidate_id and count results per candidate
        $Result = Result::select('candidate_id', DB::raw('COUNT(*) as count'))
            ->groupBy('candidate_id')
            ->with('user', 'candidate')
            ->get();

        $Data = []; // Initialize the Data array to store results

        foreach ($Result as $Value) {
            // Find the candidate by id
            $Candidates = Candidate::where("id", $Value->candidate_id)->get();
            
            foreach ($Candidates as $key) {
                // Store candidate name in the 'Label' array
                $Data['Label'][] = $key->name;
            }

            // Store the count of results for this candidate
            $Data['data'][] = (int) $Value->count;
        }

        // Check if $Data is not empty and encode to JSON
        if (!empty($Data)) {
            $this->Result = json_encode($Data);
            $Result = $this->Result;
        }

        // Return the view with the result data
        return view('master.result.index', compact('Result'));
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
