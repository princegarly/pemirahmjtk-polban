<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $title = "Peran - Data";

        $confTitle = 'Hapus Data Subjek!';
        $confText = "Apakah Anda yakin ingin menghapus?";

        confirmDelete($confTitle, $confText);

        return view('master.role.index', compact('title'));
    }

    public function create()
    {
        $title = "Peran - Tambah";

        return view('master.role.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            Role::create([
                'name' => strtolower(str_replace(" ", "-", $request->name)),
                'guard_name' => 'web'
            ]);

            Alert::success('Selamat', 'Anda telah berhasil menambahkan data');
            return redirect()->route('role.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Menambahkan Peran: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat menambahkan Peran.');
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
            $title = "Peran - Edit";

            $userId = Crypt::decrypt($id);
            $data = Role::find($userId);

            return view('master.role.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('role.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $roleId = Crypt::decrypt($id);
            $role = Role::findOrFail($roleId);

            $role->update([
                'name' => strtolower(str_replace(" ", "-", $request->name))
            ]);
    
            Alert::success('Selamat', 'Anda telah berhasil memperbarui data');
            return redirect()->route('role.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('role.index');
        } catch (\Exception $excep) {
            Log::error('Kesalahan Memperbarui Peran: ' . $excep->getMessage());
        
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui Peran.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $roleId = Crypt::decrypt($id);
            Role::findOrFail($roleId)->delete();

            Alert::success('Selamat', 'Anda telah berhasil menghapus data');
            return redirect()->route('role.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Kunci Dekripsi atau Ciphertext tidak valid.');
            return redirect()->route('role.index');
        }
    }

    public function data()
    {
        $data = Role::withCount(['users', 'permissions'])->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('name', function($item) {
                            return ucwords(str_replace("-", " ", $item->name));
                        })
                        ->addColumn('action', 'master.role.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }
}
