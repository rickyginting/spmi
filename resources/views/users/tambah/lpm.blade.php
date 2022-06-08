@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Ketua LPM</h4>
                    <form action="/users/store" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama User</label>
                            <input type="text" name="name" class="form-control" aria-describedby="helpId" required>
                            <input type="text" name="role" class="form-control" aria-describedby="helpId" value="Ketua LPM"
                                hidden required>
                        </div>
                        <div class="form-group">
                            <label for="">Program Studi</label>
                            <select class="form-control" name="prodi_kode">
                                @foreach ($prodi as $i)
                                    <option value="{{ $i->kode }}">{{ $i->name }} - <b>({{ $i->kode }})</b>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" aria-describedby="helpId" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control" aria-describedby="helpId" required>
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
