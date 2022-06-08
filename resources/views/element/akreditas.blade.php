@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Syarat
                        Perlu Akreditasi</h4>
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <form action="/element/put-akreditasi/{{ $element->id }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <h4 class="card-title">{{ $element->l1->name }}</h4>
                        <p class="card-text">{{ $element->l2->name }}</p>
                        <p class="card-text">{{ $element->l3->name }}</p>
                        <p class="card-text">{{ $element->l4->name }}</p>
                        <p class="card-text">{!! $element->indikator->dec !!}</p>
                        <div class="form-group">
                            <label>Score Tercapai</label>
                            @if ($element->score_hitung > 10)
                                <input class="form-control" value="{{ $element->score_hitung }}" disabled>
                                <input class="form-control" name="score" value="{{ $element->score_hitung }}" hidden>
                            @elseif($element->score_hitung > 1)
                                <input class="form-control" value="{{ ltrim($element->score_hitung, 0) }}" disabled>
                                <input class="form-control" name="score" value="{{ ltrim($element->score_hitung, 0) }}"
                                    hidden>
                            @else
                                <input class="form-control" value="{{ $element->score_hitung }}" disabled>
                                <input class="form-control" name="score" value="{{ $element->score_hitung }}" hidden>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Score Minimal</label>
                            <input class="form-control" name="min" required>
                        </div>
                        <div class="form-group">
                            <button class="btn-primary btn-sm" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
