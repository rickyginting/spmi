@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Indikator</h6>
                </div>
                <div class="card-body">
                    <form action="/indikator/put/{{ $i->id }}" method="post">

                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Indikator</label>
                                <textarea id="name" class="form-control" name="dec">{!! $i->dec !!}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ url('indikator/' . $j->kode) }}" class="btn btn-secondary">
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
