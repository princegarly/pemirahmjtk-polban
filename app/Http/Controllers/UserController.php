<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Role;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $title = "Pengguna - Data";

        $confTitle = 'Hapus Data Subjek!';
        $confText = "Apakah Anda yakin ingin menghapus?";

        confirmDelete($confTitle, $confText);

        return view('master.user.index', compact('title'));
    }

    public function create()
    {
        $title = "Pengguna - Tambah";
        $studyPrograms = StudyProgram::all();
        $grades = Grade::all();
        $roles = Role::get();

        return view('master.user.create', compact('title', 'studyPrograms', 'grades', 'roles'));
    }

    public function store(Request $request)
    {
        try {
            $studyProgram = StudyProgram::where('name', $request->studyProgram)->get()->first();
            $grade = Grade::where('name', $request->grade)->get()->first();

            $gender = $request->gender == 'male' ? true : false;

            $user = User::create([
                'study_program_id' => $studyProgram->id,
                'grade_id' => $grade->id,
                'nim' => $request->nim,
                'name' => $request->name,
                'gender' => $gender,
                'year_group' => $request->yearGroup,
                'start_time' => $request->startTime,
                'end_time' => $request->endTime,
                'election_status' => false,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->has('role')) {
                $user->assignRole($request->role);
            }

            Alert::success('Selamat', 'Anda telah berhasil menambahkan data');
            return redirect()->route('user.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Menambahkan Pengguna: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat menambahkan Pengguna.');
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
            $title = "Pengguna - Edit";

            $userId = Crypt::decrypt($id);
            $data = User::find($userId);

            return view('master.user.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('user.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $userId = Crypt::decrypt($id);
            $user = User::findOrFail($userId);

            $gender = $request->gender == 'male' ? true : false;

            $user->update([
                'name' => $request->name,
                'gender' => $gender,
                'email' => $request->email,
            ]);
    
            if ($request->has('role')) {
                $user->syncRoles($request->role);
            }

            Alert::success('Selamat', 'Anda telah berhasil memperbarui data');
            return redirect()->route('user.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('user.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Memperbarui Pengguna: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui Pengguna.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $userId = Crypt::decrypt($id);
            User::findOrFail($userId)->delete();

            Alert::success('Selamat', 'Anda telah berhasil menghapus data');
            return redirect()->route('user.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('user.index');
        }
    }

    public function data()
    {
        $data = User::with(['roles'])
                    ->select('users.*', 'grades.name as grade_name', 'study_programs.name as study_program_name')
                    ->join('grades', 'users.grade_id', '=', 'grades.id')
                    ->join('study_programs', 'users.study_program_id', '=', 'study_programs.id')
                    ->orderBy('users.name', 'asc')
                    ->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('roles', function ($item) {
                            return ucwords($item->roles->pluck('name')->implode(', '));
                        })
                        ->editColumn('gender', function ($item) {
                            return $item->gender ? 'Laki-laki' : 'Perempuan';
                        })
                        ->addColumn('action', 'master.user.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }
}
