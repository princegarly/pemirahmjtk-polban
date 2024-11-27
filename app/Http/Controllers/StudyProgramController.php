<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class StudyProgramController extends Controller
{
    public function index()
    {
        $title = "Program Studi - Data";

        $confTitle = 'Hapus Data Subjek!';
        $confText = "Apakah Anda yakin ingin menghapus?";

        confirmDelete($confTitle, $confText);

        return view('master.study-program.index', compact('title'));
    }

    public function create()
    {
        $title = "Program Studi - Tambah";

        return view('master.study-program.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            StudyProgram::create([
                'name' => $request->name
            ]);

            Alert::success('Selamat', 'Anda telah berhasil menambahkan data');
            return redirect()->route('study-program.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Menambahkan Program Studi: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat menambahkan Program Studi.');
            return redirect()->back()->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        try {
            $title = "Program Studi - Edit";

            $studyProgramId = Crypt::decrypt($id);
            $data = StudyProgram::find($studyProgramId);

            return view('master.study-program.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('study-program.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $studyProgramId = Crypt::decrypt($id);
            $studyProgram = StudyProgram::findOrFail($studyProgramId);

            $studyProgram->update([
                'name' => $request->name
            ]);
    
            Alert::success('Selamat', 'Anda telah berhasil memperbarui data');
            return redirect()->route('study-program.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('study-program.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Memperbarui Program Studi: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui Program Studi.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $studyProgramId = Crypt::decrypt($id);
            StudyProgram::findOrFail($studyProgramId)->delete();

            Alert::success('Selamat', 'Anda telah berhasil menghapus data');
            return redirect()->route('study-program.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('study-program.index');
        }
    }

    public function data()
    {
        $data = StudyProgram::latest()->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', 'master.study-program.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }
}
