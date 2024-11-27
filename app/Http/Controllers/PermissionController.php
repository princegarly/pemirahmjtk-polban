<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        $title = "Izin - Data";

        return view('master.permission.index', compact('title'));
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

    public function data()
    {
        $data = Permission::withCount('roles')->get();

        return DataTables::of($data)
                        ->editColumn('name', function($item) {
                            return ucwords(str_replace("-", " ", $item->name));
                        })
                        ->make(true);
    }
}
