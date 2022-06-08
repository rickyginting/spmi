@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-danger" role="alert">
                Apa kamu yakin akan menghapus data element berikut ?
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
                <p> Menghapus element dapat berakibat terhapus nya <b>{{ $element->count_berkas }}</b> dokumen yang telah
                    di simpan pada folder element dan score
                    pencapaian yang telah diraih.</p>

                <form action="/element/delete/{{ $element->id }}" method="post" class="in-line form">
                    @csrf
                    @method('DELETE')
                    <a href="{{ url('element/' . $prodi->kode) }}" class="btn btn-info btn-sm">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-danger btn-sm">
                        Hapus Element
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
