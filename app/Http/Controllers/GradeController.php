<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class GradeController extends Controller
{
    public function index()
    {
        $title = "Kelas - Data";

        $confTitle = 'Hapus Data Subjek!';
        $confText = "Apakah Anda yakin ingin menghapus?";

        confirmDelete($confTitle, $confText);

        return view('master.grade.index', compact('title'));
    }

    public function create()
    {
        $title = "Kelas - Tambah";

        return view('master.grade.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            Grade::create([
                'name' => $request->name
            ]);

            Alert::success('Selamat', 'Anda telah berhasil menambahkan data');
            return redirect()->route('grade.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Menambahkan Kelas: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat menambahkan Kelas.');
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
            $title = "Kelas - Edit";

            $gradeId = Crypt::decrypt($id);
            $data = Grade::findOrFail($gradeId);

            return view('master.grade.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('grade.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $gradeId = Crypt::decrypt($id);
            $grade = Grade::findOrFail($gradeId);

            $grade->update([
                'name' => $request->name
            ]);
    
            Alert::success('Selamat', 'Anda telah berhasil memperbarui data');
            return redirect()->route('grade.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('grade.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Memperbarui Kelas: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui Kelas.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $gradeId = Crypt::decrypt($id);
            Grade::findOrFail($gradeId)->delete();

            Alert::success('Selamat', 'Anda telah berhasil menghapus data');
            return redirect()->route('grade.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('grade.index');
        }
    }

    public function data()
    {
        $data = Grade::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', 'master.grade.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }
}
