<?php

namespace App\Http\Controllers;

use App\Prodi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Prodi $prodi)
    {
        $dataMhs = User::where('prodi_kode', $prodi->kode)->where('role', 'Mahasiswa')->OrWhere('role', 'Alumni')->get();
        return view('mahasiswa.index', [
            'mhs' => $dataMhs,
        ]);
    }

    public function tambah()
    {
        return view('mahasiswa.tambah');
    }
    public function store(Request $request)
    {
        $att = [
            'name' => $request->name,
            'role' => $request->role,
            'prodi_kode' => $request->prodi_kode,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->prodi_kode == "0") {
            $att['prodi_kode'] = "-";
            $att['prodi_name'] = "-";
        } else {
            $prodi = Prodi::where('kode', $request->prodi_kode)->first();
            $att['prodi_name'] = $prodi->name;
        }

        User::create($att);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Ditambahkan</strong>
    </div>');
        return redirect()->to('data/mahasiswa/' . Auth::user()->prodi_kode);

    }
}
