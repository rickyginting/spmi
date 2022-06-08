@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-primary" role="alert">
                <b>Detail Element</b>
                <hr>
                @if (($element->l2_id == 0) & ($element->l3_id == 0) & ($element->l4_id == 0))
                    <b>{{ $element->l1->name }}</b><br>
                @elseif($element->l3_id == 0 & $element->l4_id == 0)
                    <b>{{ $element->l1->name }}</b><br>
                    {{ $element->l2->name }}
                @elseif($element->l4_id == 0)
                    <b>{{ $element->l1->name }}</b><br>
                    {{ $element->l2->name }}<br>
                    {{ $element->l3->name }}
                @else()
                    <b>{{ $element->l1->name }}</b><br>
                    {{ $element->l2->name }}<br>
                    {{ $element->l3->name }}<br>
                    {{ $element->l4->name }}
                @endif
                <br>
                {!! $element->indikator->dec !!}
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Jumlah Dokument :</b></td>
                            <td></td>
                            <td>{{ $element->count_berkas }}</td>
                        </tr>
                        <tr>
                            <td><b>Nilai Bobot :</b></td>
                            <td></td>
                            <td>{{ $element->bobot }}</td>
                        </tr>
                        <tr>
                            <td><b>Nilai Tercapai :</b></td>
                            <td></td>
                            <td>{{ $element->score_hitung }}</td>
                        </tr>
                        <tr>
                            <td><b>Ketentuan Akreditasi :</b></td>
                            <td>
                                @if ($element->min_akreditasi > 0)
                                    @if ($element->status_akreditasi == 'Y')
                                        MIN = <b>{{ $element->min_akreditasi }}</b>
                                        <hr>
                                        <span class="badge badge-success">Terpenuhi</span>
                                    @else
                                        MIN = <b>{{ $element->min_akreditasi }}</b>
                                        <hr>
                                        <span class="badge badge-danger">Tidak Terpenuhi</span>
                                    @endif
                                @else
                                    Ketentuan Akreditas Tidak Di SET
                                @endif
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Ketentuan Unggul :</b></td>
                            <td>
                                @if ($element->min_unggul > 0)
                                    @if ($element->status_unggul == 'Y')
                                        MIN = <b>{{ $element->min_unggul }}</b>
                                        <hr>
                                        <span class="badge badge-success">Terpenuhi</span>
                                    @else
                                        MIN = <b>{{ $element->min_unggul }}</b>
                                        <hr>
                                        <span class="badge badge-danger">Tidak Terpenuhi</span>
                                    @endif
                                @else
                                    Ketentuan Akreditas Tidak Di SET
                                @endif
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Ketentuan Baik :</b></td>
                            <td>
                                @if ($element->min_baik > 0)
                                    @if ($element->status_baik == 'Y')
                                        MIN = <b>{{ $element->min_baik }}</b>
                                        <hr>
                                        <span class="badge badge-success">Terpenuhi</span>
                                    @else
                                        MIN = <b>{{ $element->min_baik }}</b>
                                        <hr>
                                        <span class="badge badge-danger">Tidak Terpenuhi</span>
                                    @endif
                                @else
                                    Ketentuan Akreditas Tidak Di SET
                                @endif
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ url('element/' . $prodi->kode) }}" class="btn btn-info btn-sm">
                    Kembali
                </a>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modelEdit">
                    Update Nilai Bobot
                </button>
                <a href="{{ url('element/konfirmasi/' . $element->id) }}" class="btn btn-danger btn-sm">
                    Hapus Element
                </a>


                <div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="/element/bobot/put/{{ $element->id }}" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Bobot Element</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">Bobot</label>
                                        <input type="text" name="bobot" class="form-control" aria-describedby="helpId"
                                            value="{{ $element->bobot }}" required>
                                        <small id="helpId" class="text-muted">Bobot Element</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
