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

            if ($request->hasFile('photo')) {
                $tempPhoto = $photo->store('public/images/candidate/photo');

                Candidate::create([
                    'sequence_number' => $request->sequence_number,
                    'name' => $request->name,
                    'photo' => $tempPhoto,
                    'vision_and_mission' => $request->vision_and_mission,
                    'curriculum_vitae' => $request->curriculum_vitae,
                    'grand_design' => $request->grand_design
                ]);
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
