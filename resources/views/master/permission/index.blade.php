@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Pemira HMJTK POLBAN') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Pengaturan') }}</li>
        <li class="breadcrumb-item">{{ __('Kelola Akun') }}</li>
        <li class="breadcrumb-item">{{ __('Izin') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('permission.index') }}">{{ __('Data') }}</a>
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
                        
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudRole" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Nama Izin') }}</th>
                                    <th class="text-center">{{ __('Nama Penjaga') }}</th>
                                    <th class="text-center">{{ __('Jumlah Peran') }}</th>
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
            ajax: "{{ route('permission.data') }}",
            order: [[3, 'asc']],
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'name', name: 'name' },
                { data: 'guard_name', name: 'guard_name', class: 'text-center', width: '10%' },
                { data: 'roles_count', name: 'roles_count', class: 'text-center', width: '10%' },
            ]
        })
    </script>
@endpush