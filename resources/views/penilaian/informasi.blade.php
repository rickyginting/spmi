@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class=py-4>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi</h4>
                        <div class="alert alert-secondary" role="alert">
                            Target Pencapaian Pada Butir <b>{{ $label }}</b> adalah {{ $target->value }} maka untuk
                            mencapai target yang telah ditentukan nilai minimal untuk score pada setiap butir adalah
                            {{ $avg }},
                            Silahkan lakukan perbaikan dan peningkatan mutu yang memiliki nilai dibawah ketentuan tersebut.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Matrik Penilain {{ $p->name }}</h6>
                    </div>
                    <div class="card-body">
                        @if (session()->has('pesan'))
                            {!! session()->get('pesan') !!}
                        @endif
                        {{-- @foreach ($alert as $i)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                Tinggkatkan Kualitas pada <b>{{ $i->l1->name }}</b> {!! $i->indikator->dec !!} <a
                                    href="{{ url('element/unggah-berkas/' . $i->id) }}" target="_blank">Klik disini
                                    !!!</a>
                            </div>
                        @endforeach --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Element</th>
                                        <th width="70px">Score</th>
                                        <th width="70px">Bobot</th>
                                        <th width="70px">Score x Bobot</th>
                                        <th>Syarat Perlu Akreditasi</th>
                                        <th>Syarat Peringkat Unggul</th>
                                        <th>Syarat Peringkat Baik</th>
                                        <th>Kondisi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Element</th>
                                        <th width="70px">Score</th>
                                        <th width="70px">Bobot</th>
                                        <th width="70px">Score x Bobot</th>
                                        <th>Syarat Perlu Akreditasi</th>
                                        <th>Syarat Peringkat Unggul</th>
                                        <th>Syarat Peringkat Baik</th>
                                        <th>Kondisi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($e as $i)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            @if (($i->l2_id == 0) & ($i->l3_id == 0) & ($i->l4_id == 0))
                                                <td>
                                                    <b>{{ $i->l1->name }}</b><br>
                                                </td>
                                            @elseif($i->l3_id == 0 & $i->l4_id == 0)
                                                <td>
                                                    <b>{{ $i->l1->name }}</b><br>
                                                    {{ $i->l2->name }}<br>
                                                </td>
                                            @elseif($i->l4_id == 0)
                                                <td>
                                                    <b>{{ $i->l1->name }}</b><br>
                                                    {{ $i->l2->name }}<br>
                                                    {{ $i->l3->name }}<br>
                                                </td>
                                            @else()
                                                <td>
                                                    <b>{{ $i->l1->name }}</b><br>
                                                    {{ $i->l2->name }}<br>
                                                    {{ $i->l3->name }}<br>
                                                    {{ $i->l4->name }}<br>
                                                </td>
                                            @endif

                                            <td>{{ $i->score_berkas }}</td>
                                            <td>{{ $i->bobot }}</td>

                                            @if ($i->score_hitung > 10)
                                                <td>{{ $i->score_hitung }}</td>
                                            @elseif($i->score_hitung > 1)
                                                <td>{{ ltrim($i->score_hitung, 0) }}</td>
                                            @else
                                                <td> {{ $i->score_hitung }}</td>
                                            @endif

                                            @if ($i->min_akreditasi > 0)
                                                @if ($i->status_akreditasi == 'Y')
                                                    <td>
                                                        MIN = <b>{{ $i->min_akreditasi }}</b>
                                                        <hr>
                                                        <span class="badge badge-success">Terpenuhi</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        MIN = <b>{{ $i->min_akreditasi }}</b>
                                                        <hr>
                                                        <span class="badge badge-danger">Tidak Terpenuhi</span>
                                                    </td>
                                                @endif
                                            @else
                                                <td></td>
                                            @endif

                                            @if ($i->min_unggul > 0)
                                                @if ($i->status_unggul == 'Y')
                                                    <td>
                                                        MIN = <b>{{ $i->min_unggul }}</b>
                                                        <hr>
                                                        <span class="badge badge-success">Terpenuhi</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        MIN = <b>{{ $i->min_unggul }}</b>
                                                        <hr>
                                                        <span class="badge badge-danger">Tidak Terpenuhi</span>
                                                    </td>
                                                @endif
                                            @else
                                                <td></td>
                                            @endif

                                            @if ($i->min_baik > 0)
                                                @if ($i->status_baik == 'Y')
                                                    <td>
                                                        MIN = <b>{{ $i->min_baik }}</b>
                                                        <hr>
                                                        <span class="badge badge-success">Terpenuhi</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        MIN = <b>{{ $i->min_baik }}</b>
                                                        <hr>
                                                        <span class="badge badge-danger">Tidak Terpenuhi</span>
                                                    </td>
                                                @endif
                                            @else
                                                <td></td>
                                            @endif

                                            @if ($i->score_hitung > $avg)
                                                <td>
                                                    <span class="badge badge-info">Nilai Minimal Terpenuhi</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge badge-danger">Perlu dilakukan peningkatan</span>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#modelKet{{ $i->id }}">
                                                        Cek Ketentuan
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                        <?php $no++; ?>
                                        <div class="modal fade" id="modelKet{{ $i->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ketentuan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! $i->indikator->dec !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ url('element/unggah-berkas/' . $i->id) }}"
                                                            class="btn btn-primary">Unggah Berkas</a>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
