<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Result;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PollingBoothController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        $userId = Auth::user()->id;

        $user = User::where("id", $userId)->first();
        $isVote = Result::where("user_id", $user->id)->count();

        $confTitle = 'Peringatan!';
        $confText = "Apakah Anda yakin ingin memilih calon tersebut?";

        confirmDelete($confTitle, $confText);

        if($isVote == 0) {
            return view('master.polling-booth.index', compact('candidates', 'isVote', 'user'));
        } else {
            return view('master.polling-booth.index', compact('candidates', 'isVote'));
        }
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
        try {
            $candidateId = Crypt::decrypt($id);
            $user = User::where('id', Auth::user()->id)->first();

            Result::create([
                'user_id' => Auth::user()->id,
                'candidate_id' => $candidateId,
            ]);

            $user->election_status = true;
            $user->save();

            Alert::success('Selamat', 'Terima kasih Anda telah menggunakan hak suara');
            return redirect()->route('polling-booth.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('polling-booth.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Pemilihan: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat melakukan pemilihan.');
            return redirect()->back()->withInput();
        }
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
