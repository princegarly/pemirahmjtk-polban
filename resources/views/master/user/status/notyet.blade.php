@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Pemira HMJTK POLBAN') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Status Pemilihan') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('election-status.notyet.index') }}">{{ __('Sudah Memilih') }}</a>
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudElectionStatus" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('NIM') }}</th>
                                    <th class="text-center">{{ __('Nama Lengkap') }}</th>
                                    <th class="text-center">{{ __('Kelas') }}</th>
                                    <th class="text-center">{{ __('Program Studi') }}</th>
                                    <th class="text-center">{{ __('Angkatan') }}</th>
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
        var datatable = $('#crudElectionStatus').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('election-status.notyet.data') }}",
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'nim', name: 'nim', class: 'text-center', width: '10%' },
                { data: 'name', name: 'name' },
                { data: 'grade_name', name: 'grade_name', class: 'text-center', width: '10%' },
                { data: 'study_program_name', name: 'study_program_name', class: 'text-center' },
                { data: 'year_group', name: 'year_group', class: 'text-center', width: '5%' },
            ]
        })
    </script>
@endpush