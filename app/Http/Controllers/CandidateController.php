<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CandidateController extends Controller
{
    public function index()
    {
        $title = "Kandidat - Data";

        $confTitle = 'Hapus Data Subjek!';
        $confText = "Apakah Anda yakin ingin menghapus?";

        confirmDelete($confTitle, $confText);

        return view('master.candidate.index', compact('title'));
    }

    public function create()
    {
        $title = "Tambah Kandidat";

        return view('master.candidate.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $photo = $request->file('photo');
            $visionAndMission = $request->file('vision_and_mission');
            $curriculumVitae = $request->file('curriculum_vitae');
            $grandDesign = $request->file('grand_design');

            if ($request->hasFile('photo')) {
                $tempPhoto = $photo->store('public/images/candidate/photo');

                if ($request->hasFile('vision_and_mission')) {
                    $tempVisionAndMission = $visionAndMission->store('public/document/candidate/vision_and_mission');
    
                    if ($request->hasFile('curriculum_vitae')) {
                        $tempCurriculumVitae = $curriculumVitae->store('public/document/candidate/curriculum_vitae');
        
                        if ($request->hasFile('grand_design')) {
                            $tempGrandDesign = $grandDesign->store('public/document/candidate/grand_design');
            
                            Candidate::create([
                                'sequence_number' => $request->sequence_number,
                                'name' => $request->name,
                                'photo' => $tempPhoto,
                                'vision_and_mission' => $tempVisionAndMission,
                                'curriculum_vitae' => $tempCurriculumVitae,
                                'grand_design' => $tempGrandDesign
                            ]);
                        }
                    }
                }
            }

            Alert::success('Selamat', 'Anda telah berhasil menambahkan data');
            return redirect()->route('candidate.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Menambahkan Kandidate: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat menambahkan Kandidat.');
            return redirect()->back()->withInput();
        }
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
        try {
            $candidateId = Crypt::decrypt($id);
            Candidate::findOrFail($candidateId)->delete();

            Alert::success('Selamat', 'Anda telah berhasil menghapus data');
            return redirect()->route('candidate.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('candidate.index');
        }
    }

    public function data()
    {
        $data = Candidate::all();

            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', 'master.candidate.action')
                            ->rawColumns(['action'])
                            ->make(true);
    }
}
