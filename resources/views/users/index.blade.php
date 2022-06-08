@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
                </div>
                <div class="card-body">
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $i)
                                    <tr>
                                        <td>{{ $i->name }}</td>
                                        <td>{{ $i->role }}</td>
                                        <td width="150px">
                                            <a href="{{ url('users/edit/' . $i->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="users/hapus/{{ $i->id }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Pengguna</h4>
                    <ul>
                        @if (Auth::user()->role == 'Admin')
                            <li><a href="{{ route('tambah-admin') }}">Admin</a></li>
                        @endif
                        <li><a href="{{ route('tambah-lpm') }}">Ketua LPM</a></li>
                        <li><a href="{{ route('tambah-kaprodi') }}">Ketua Program Studi</a></li>
                        <li><a href="{{ route('tambah-dosen') }}">Dosen</a></li>
                        @if (Auth::user()->role == 'Admin')
                            <li><a href="{{ route('tambah-upps') }}">UPPS</a></li>
                        @endif
                        <li><a href="{{ route('tambah-mhsalm') }}">Mahasiswa / Alumni</a></li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
    </div>

@endsection
