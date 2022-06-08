@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{!! $i->dec !!}</h6>
                </div>
                <div class="card-body">
                    <form action="/indikator/score/put/{{ $s->id }}" method="post">

                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Name Score</label>
                                <textarea id="name" class="form-control" name="name">{!! $s->name !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nilai</label>
                                <input type="text" class="form-control" name="value" value="{{ $s->value }}" required>
                                <small id="helpId" class="text-muted">Masukan nilai
                                    indikator dengan menambahkan titik
                                    3.50</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ url('indikator/cek-score/' . $s->id) }}" class="btn btn-secondary">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
@section('script')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('dec');
            CKEDITOR.replace('name');
        });
    </script>
@endsection
