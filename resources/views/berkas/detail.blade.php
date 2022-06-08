@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ asset('document/' . $berkas->file) }}"
                            allowfullscreen></iframe>
                    </div>
                    <hr>
                    @if (($berkas->l2_id == 0) & ($berkas->l3_id == 0) & ($berkas->l4_id == 0))
                        {{ $berkas->l1->name }}<br>
                    @elseif($berkas->l3_id == 0 & $berkas->l4_id == 0)
                        {{ $berkas->l1->name }}<br>
                        {{ $berkas->l2->name }}
                    @elseif($berkas->l4_id == 0)
                        {{ $berkas->l1->name }}<br>
                        {{ $berkas->l2->name }}<br>
                        {{ $berkas->l3->name }}
                    @else()
                        {{ $berkas->l1->name }}<br>
                        {{ $berkas->l2->name }}<br>
                        {{ $berkas->l3->name }}<br>
                        {{ $berkas->l4->name }}
                    @endif
                    <hr>
                    {!! $berkas->dec !!}
                    <hr>
                    Program Studi : <b>{{ $berkas->prodi->name }} - ({{ $berkas->prodi->kode }})</b><br>
                    Nilai Yang Didapat : <b>{{ $berkas->score }}</b>
                </div>
            </div>
        </div>

        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Aksi</h4>
                    <a href="{{ url('berkas/edit/' . $berkas->id) }}" class="btn btn-warning btn-sm">Edit Berkas</a>
                    <hr>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#modelHapus{{ $berkas->id }}">
                        Hapus Berkas
                    </button>
                    <hr>
                    <a href="{{ url('berkas/cari') }}" class="btn btn-primary btn-sm">Kembali ke Pencarian</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modelHapus{{ $berkas->id }}" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/berkas/hapus/{{ $berkas->id }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Berkas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('delete')
                        Apa kamu yakin akan menghapus data <b>{{ $berkas->file_name }}</b>
                        penghapusan data bersifat permanet, data yang telah di hapus tidak dapat dikembalikan.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Tetap Hapus
                            !!!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
