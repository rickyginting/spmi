@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-danger" role="alert">
                Apa kamu yakin akan menghapus indikator ?
                <p>{!! $i->dec !!}</p>
                <hr>
                <p>Dengan menghapus Indikator akan menghapus item Score Penilaian, dan akan mengakibatkan Query Error jika
                    data
                    telah digunakan sebagai relasi.</p>
                <form action="/indikator/hapus/{{ $i->id }}" method="post" class="in-line form">
                    @csrf
                    @method('DELETE')
                    <a href="{{ url('indikator/' . $j->kode) }}" class="btn btn-info btn-sm">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-danger btn-sm">
                        Hapus Indikator
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
