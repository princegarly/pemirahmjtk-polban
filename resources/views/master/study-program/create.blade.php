@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Pemira HMJTK POLBAN') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Manajemen Data') }}</li>
        <li class="breadcrumb-item">{{ __('Program Studi') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('study-program.create') }}">{{ __('Tambah') }}</a>
        </li>
    </ol>
@endsection

@section('section-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <b>{{ $title }}</b>
                    </h4>
                </div>
                
                <form action="{{ route('study-program.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Nama Program Studi*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('name') }}" id="name" name="name" class="form-control" placeholder="Masukkan Nama Program Studi" required>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('study-program.index') }}" class="btn btn-warning">{{ __('Kembali') }}</a>
                        <button type="reset" class="btn btn-danger">{{ __('Reset') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    
@endsection

@push('scripts')
    
@endpush