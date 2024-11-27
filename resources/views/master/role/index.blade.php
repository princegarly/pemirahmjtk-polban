@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Pemira HMJTK POLBAN') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Pengaturan') }}</li>
        <li class="breadcrumb-item">{{ __('Kelola Akun') }}</li>
        <li class="breadcrumb-item">{{ __('Peran') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('role.index') }}">{{ __('Data') }}</a>
        </li>
    </ol>
@endsection

@section('section-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col">
                        <h4><b>{{ $title }}</b></h4>
                    </div>
                    <div class="col">
                        @can('role-create')
                            <a href="{{ route('role.create') }}" class="btn btn-primary float-right mr-2">
                                <span class="fas fa-plus"></span> {{ __('Tambah') }}
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudRole" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Nama Peran') }}</th>
                                    <th class="text-center">{{ __('Nama Penjaga') }}</th>
                                    <th class="text-center">{{ __('Jumlah Pengguna') }}</th>
                                    <th class="text-center">{{ __('Jumlah Izin') }}</th>
                                    <th class="text-center">{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    
@endsection

@push('scripts')
    <script>
        var datatable = $('#crudRole').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('role.data') }}",
            order: [[3, 'asc']],
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'name', name: 'name' },
                { data: 'guard_name', name: 'guard_name', class: 'text-center', width: '10%' },
                { data: 'users_count', name: 'users_count', class: 'text-center', width: '10%' },
                { data: 'permissions_count', name: 'permissions_count', class: 'text-center', width: '10%' },
                { data: 'action', name: 'action', orderable: true, searchable: true, width: '5%' }
            ]
        })
    </script>
@endpush