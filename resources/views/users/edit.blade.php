@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <form action="/users/put/{{ $i->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Nama User</label>
                            <input name="id" value="{{ $i->id }}" hidden>
                            <input type="text" name="name" value="{{ $i->name }}" class="form-control"
                                aria-describedby="helpId" required>
                        </div>

                        <div class="form-group">
                            <label for="">Role</label>
                            <select class="form-control" name="role">
                                <option value="Admin">Admin</option>
                                <option value="Ketua LPM">Ketua LPM</option>
                                <option value="Ketua Program Studi">Ketua Program Studi</option>
                                <option value="Dosen">Dosen</option>
                                <option value="UPPS">UPPS</option>
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Alumni">Alumni</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ $i->email }}" class="form-control"
                                aria-describedby="helpId" required>
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
