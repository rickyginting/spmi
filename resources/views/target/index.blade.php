@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Target Program Studi</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($p as $i)
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <a href="{{ route('target') . '/' . $i->kode }}"
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

                </div>
            </div>
        </div>
    </div>

@endsection
