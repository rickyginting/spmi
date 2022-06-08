@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Ketua Mahasiswa / Alumni</h4>
                    <form action="/data/mahasiswa/store" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama User</label>
                            <input type="text" name="name" class="form-control" aria-describedby="helpId" required>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" name="role" id="">
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Alumni">Alumni</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Program Studi</label>
                            <select class="form-control" name="prodi_kode">
                                <option value="{{ Auth::user()->prodi_kode }}">{{ Auth::user()->prodi_name }} -
                                    <b>({{ Auth::user()->prodi_kode }})</b>
                                </option>
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
