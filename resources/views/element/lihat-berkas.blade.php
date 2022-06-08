@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Berkas</h6>
                </div>
                <div class="card-body">
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th width="150px">Dec</th>
                                    <th width="150px">Score</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th width="150px">Dec</th>
                                    <th width="150px">Score</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($berkas as $i)
                                    <tr>
                                        <td><a href="{{ url('berkas/' . $i->id) }}"
                                                target="_blank">{{ $i->file_name }}</a>
                                        </td>
                                        <td>{!! $i->dec !!}</td>
                                        <td>{{ $i->score }}</td>
                                    </tr>
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
                    <h4 class="card-title">Rata - Rata</h4>
                    {{ $avg }}
                    <hr>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#resetNilai">
                        Reset Nilai
                    </button>
                    <hr>
                    <a href="{{ url('element/unggah-berkas/' . $element->id) }}" class="btn btn-info btn-sm">
                        Unggah Berkas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="resetNilai" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/element/reset/{{ $element->id }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('delete')
                        Jika kamu melakukan reset data maka nilai pencapaian, data berkas dan data nilai ketentuan akan
                        dihapus secara permanent pada
                        sistem.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Tetap Reset
                            !!!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
