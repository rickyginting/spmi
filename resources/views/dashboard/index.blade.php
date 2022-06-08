@extends('template.BaseView')
@section('content')
    @if (Auth::user()->prodi_kode == '-')
        <div class="row">
            @foreach ($p as $i)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <a href="{{ url('prodi/' . $i->kode) }}"
                                                class="h7 mb-0 mr-3 font-weight-bold text-info text-uppercase">
                                                {{ $i->name }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">LPM Smart Sistem</h4>
                    <p class="card-text">Selamat datang <b>{{ Auth::user()->name }}</b><br>
                        @if (Auth::user()->prodi_kode == '-')
                            Kamu dapat melakukan pemberkasan dengan lebih mudah dan untuk saat ini terdapat
                            <b>{{ $p->count() }}</b> Perogram Studi yang terdaftar pada sistem.
                        @else
                            Saat ini kamu bertugas sebagai {{ Auth::user()->role }} pada Program Studi
                            {{ Auth::user()->prodi_name }}, kamu dapat melakukan peningkatan dan pemberkasan melalui menu
                            Element dan Berkas
                        @endif
                    </p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
