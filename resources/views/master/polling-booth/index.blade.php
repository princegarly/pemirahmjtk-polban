@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Pemira HMJTK POLBAN') }} | {{ __('Surat Suara') }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Bilik Suara') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Surat Suara') }}</a>
        </li>
    </ol>
@endsection

@section('section-body')
    <div class="row">
        @if ($isVote == 1)
            <div class="col-12">
                <div class="alert alert-primary alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        <span class="font-medium">Peringatan!</span> Maaf, Anda sudah melakukan pemilihan!
                    </div>
                </div>
            </div>
        @else
            @inject('carbon', 'Carbon\Carbon')

            @if($carbon::now()->between(Auth::user()->start_time, Auth::user()->end_time))
                <div class="col-12">
                    <div class="alert alert-primary alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            Silahkan gunakan hak suara Anda!
                         </div>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-primary alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                 <span>&times;</span>
                            </button>
                            <span class="font-medium">Peringatan!</span> Maaf bukan sesi Anda untuk memilih!
                        </div>
                    </div>
                </div>
            @endif
            
            @foreach($candidates as $candidate)
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $candidate->sequence_number }}</h4>

                            <div class="card-header-action">
                                @if($carbon::now()->between(Auth::user()->start_time, Auth::user()->end_time))
                                    <a href="{{ route('polling-booth.edit', Crypt::encrypt($candidate->id)) }}" class="btn btn-primary" data-confirm-delete="true">Vote</a>
                                @else

                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="mb-2 text-center">
                                <strong>{{ $candidate->name }}</strong>
                            </div>

                            <div class="chocolat-parent">
                                <div data-crop-image="285">
                                    <img alt="image" src="{{ Storage::url($candidate->photo) }}" class="img-fluid">
                                </div>
                            </div>

                            <a href="{{ $candidate->vision_and_mission }}" target="_blank" class="mt-2 btn btn-primary btn-lg btn-block">Visi Misi <i class="fas fa-arrow-right"></i></a>
                            <a href="{{ $candidate->curriculum_vitae }}" target="_blank" class="mt-2 btn btn-primary btn-lg btn-block">Curriculum Vitae <i class="fas fa-arrow-right"></i></a>
                            <a href="{{ $candidate->grand_design }}" target="_blank" class="mt-2 btn btn-primary btn-lg btn-block">Grand Design <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection