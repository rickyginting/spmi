@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Target Butir Penilaian - {{ $prodi->name }}</h6>
                </div>
                <div class="card-body">
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    @if ($target->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th width="50px">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th width="50px">Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($target as $i)
                                        <tr>
                                            <td>{{ $i->l1->name }}</td>
                                            <td>{{ $i->value }}</td>
                                            <td width="150px">
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#modelEdit{{ $i->id }}">
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                        {{-- EDIT DATA --}}
                                        <div class="modal fade" id="modelEdit{{ $i->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="/target/update/{{ $i->id }}" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Target</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">Butir Target Penilaian</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $i->l1->name }}" disabled>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Nilai</label>
                                                                <input type="text" name="value" class="form-control"
                                                                    value="{{ $i->value }}" required>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-primary" role="alert">
                            <strong>Data Tidak Ditemukan</strong><br>
                            Program Studi {{ $prodi->name }} belum memiliki data target pencapaian <a
                                href="{{ url('target/create-target/' . $prodi->kode) }}">klik
                                disini</a> untuk membuat data.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>



@endsection
