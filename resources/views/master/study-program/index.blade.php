@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Pemira HMJTK POLBAN') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Manajemen Data') }}</li>
        <li class="breadcrumb-item">{{ __('Program Studi') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('study-program.index') }}">{{ __('Data') }}</a>
        </li>
    </ol>
@endsection

@section('section-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col">
                        <h4>
                            <b>{{ $title }}</b>
                        </h4>
                    </div>
                    <div class="col">
                        <a href="{{ route('study-program.create') }}" class="btn btn-primary float-right"><span class="fas fa-plus"></span> {{ __('Tambah') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudStudyProgram" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Nama Program Studi') }}</th>
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

@push('scripts')
    <script>
        var datatable = $('#crudStudyProgram').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('study-program.data') }}",
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'name', name: 'name'},
                { data: 'action', name: 'action', orderable: true, searchable: true, width: '5%' }
            ]
        })
    </script>
@endpush