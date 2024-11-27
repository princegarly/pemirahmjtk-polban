@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Pemira HMJTK POLBAN') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Pengaturan') }}</li>
        <li class="breadcrumb-item">{{ __('Kelola Akun') }}</li>
        <li class="breadcrumb-item">{{ __('Pengguna') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('user.create') }}">{{ __('Tambah') }}</a>
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
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('NIM*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('nim') }}" id="nim" name="nim" class="form-control" placeholder="Masukkan Nomor Induk Mahasiswa">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Nama Lengkap*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan Nama Lengkap">

                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Jenis Kelamin*') }}</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">{{ __('Laki-laki') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">{{ __('Perempuan') }}</label>
                                </div>

                                @error('gender')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Angkatan Tahun*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('yearGroup') }}" id="yearGroup" name="yearGroup" class="form-control" placeholder="Masukkan Angkatan Tahun">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Kelas*') }}</label>
                            <div class="col-sm-9">
                                <select id="grade" class="form-control select2 @error('grade') is-invalid @enderror" name="grade">
                                    <option>----- Pilih Kelas -----</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->name }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>

                                @error('grade')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Program Studi*') }}</label>
                            <div class="col-sm-9">
                                <select id="studyProgram" class="form-control select2 @error('studyProgram') is-invalid @enderror" name="studyProgram">
                                    <option>----- Pilih Program Studi -----</option>
                                    @foreach($studyPrograms as $studyProgram)
                                        <option value="{{ $studyProgram->name }}">{{ $studyProgram->name }}</option>
                                    @endforeach
                                </select>

                                @error('studyProgram')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Awal Waktu Pemilihan*</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" value="{{ old('startTime') }}" id="startTime" name="startTime" class="form-control" placeholder="Masukkan Awal Waktu Pemilihan">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Akhir Waktu Pemilihan*</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" value="{{ old('endTime') }}" id="endTime" name="endTime" class="form-control" placeholder="Masukkan Akhir Waktu Pemilihan">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Email*') }}</label>
                            <div class="col-sm-9">
                                <input type="email" id="email" name="email" class="form-control @error('grade') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan Email">

                                @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Peran*') }}</label>
                            <div class="col-sm-9">
                                <select id="role" class="form-control select2 @error('role') is-invalid @enderror" name="role[]" multiple data-placeholder=" Pilih Peran">
                                    @foreach($roles as $rrole)
                                        <option value="{{ $rrole->name }}">{{ ucwords(str_replace("-", " ", $rrole->name)) }}</option>
                                    @endforeach
                                </select>

                                @error('role')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Password*') }}</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('user.index') }}" class="btn btn-warning">{{ __('Kembali') }}</a>
                        <button type="reset" class="btn btn-danger">{{ __('Mengatur Ulang') }}</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var inputFields = ['nim', 'yearGroup'];

            inputFields.forEach(function (field) {
                var inputElement = document.getElementById(field);

                inputElement.addEventListener('input', function (event) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        });
        
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                const passwordField = $('#password');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            });
        });
    </script>
@endpush