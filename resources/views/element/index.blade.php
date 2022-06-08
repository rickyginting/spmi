@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Element {{ $p->name }}</h6>
                </div>
                <div class="card-body">
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Element</th>
                                    <th width="150px">Berkas & Ketentuan</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Element</th>
                                    <th width="150px">Berkas & Ketentuan</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($e as $i)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        @if (($i->l2_id == 0) & ($i->l3_id == 0) & ($i->l4_id == 0))
                                            <td>
                                                <b><a
                                                        href="{{ url('element/detail/' . $i->id) }}">{{ $i->l1->name }}</a></b><br>
                                                {!! $i->indikator->dec !!}
                                            </td>
                                        @elseif($i->l3_id == 0 & $i->l4_id == 0)
                                            <td>
                                                <b><a
                                                        href="{{ url('element/detail/' . $i->id) }}">{{ $i->l1->name }}</a></b><br>
                                                {{ $i->l2->name }}<br>
                                                {!! $i->indikator->dec !!}
                                            </td>
                                        @elseif($i->l4_id == 0)
                                            <td>
                                                <b><a
                                                        href="{{ url('element/detail/' . $i->id) }}">{{ $i->l1->name }}</a></b><br>
                                                {{ $i->l2->name }}<br>
                                                {{ $i->l3->name }}<br>
                                                {!! $i->indikator->dec !!}
                                            </td>
                                        @else()
                                            <td>
                                                <b><a
                                                        href="{{ url('element/detail/' . $i->id) }}">{{ $i->l1->name }}</a></b><br>
                                                {{ $i->l2->name }}<br>
                                                {{ $i->l3->name }}<br>
                                                {{ $i->l4->name }}<br>
                                                {!! $i->indikator->dec !!}
                                            </td>
                                        @endif
                                        <td>
                                            <div class="dropdown open">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Berkas
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                                    <a class="dropdown-item"
                                                        href="{{ url('element/unggah-berkas/' . $i->id) }}">Unggah
                                                        Berkas</a>
                                                    <a class="dropdown-item"
                                                        href="{{ url('element/lihat-berkas/' . $i->id) }}">Lihat
                                                        Berkas</a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="dropdown open">
                                                <button class="btn btn-info dropdown-toggle" type="button" id="triggerId"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Ketentuan
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                                    <a class="dropdown-item"
                                                        href="{{ url('element/syarat-akreditasi/' . $i->id) }}">Syarat
                                                        Perlu Akreditasi</a>
                                                    <a class="dropdown-item"
                                                        href="{{ url('element/syarat-unggul/' . $i->id) }}">Syarat
                                                        Peringkat Unggul</a>
                                                    <a class="dropdown-item"
                                                        href="{{ url('element/syarat-baik/' . $i->id) }}">Syarat
                                                        Peringkat Baik Sekali</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Aksi</h4>
                    <a href="{{ route('tambah-element') }}" class="btn btn-primary btn-sm float-right">
                        Tambah Element
                    </a>
                </div>
                <hr>
                <div class="card-body">
                    <h4 class="card-title">Report</h4>
                    Element = {{ $count_element }}<br>
                    Berkas = {{ $count_berkas }}<br>
                    Score = {{ $score_hitung }}
                </div>
            </div>
        </div>
    </div>
@endsection
