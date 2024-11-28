@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Pemira HMJTK POLBAN') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Manajemen Data') }}</li>
        <li class="breadcrumb-item">{{ __('Kandidat') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('candidate.create') }}">{{ __('Tambah') }}</a>
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
                <form action="{{ route('candidate.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Nomor Urut*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('sequence_number') }}" id="sequence_number" name="sequence_number" class="form-control" placeholder="Masukkan Nomor Urut Kandidat">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Nama Lengkap*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('name') }}" id="name" name="name" class="form-control" placeholder="Masukkan Nama Lengkap Kandidat">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Foto*') }}</label>
                            <div class="col-sm-9">
                                <input type="file" value="{{ old('photo') }}" id="photo" name="photo" class="form-control dropify">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Visi dan Misi*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('vision_and_mission') }}" id="vision_and_mission" name="vision_and_mission" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Curriculum Vitae*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('curriculum_vitae') }}" id="curriculum_vitae" name="curriculum_vitae" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Grand Design*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('grand_design') }}" id="grand_design" name="grand_design" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('candidate.index') }}" class="btn btn-warning">{{ __('Kembali') }}</a>
                        <button type="reset" class="btn btn-danger">{{ __('Mengatur Ulang') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
