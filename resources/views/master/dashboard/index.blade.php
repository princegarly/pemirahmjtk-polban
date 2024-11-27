@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Pemira HMJTK POLBAN') }} | {{ __('Dashboard') }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Main') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
    </ol>
@endsection

@section('section-body')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="hero bg-primary text-white">
                <div class="hero-inner">
                    <h2>Selamat Datang Kembali, {{ Auth::user()->name }}!</h2>
                    <p class="lead">Ciptakan Pemilu Raya Mahasiswa yang Bersih.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    
@endsection

@push('scripts')
    
@endpush