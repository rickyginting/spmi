<?php

namespace App\Http\Controllers;

use App\Prodi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(User $user)
    {
        return view('users.index', [
            'users' => $user->all(),
        ]);
    }

    public function tambahAdmin()
    {
        return view('users.tambah.admin');
    }

    public function tambahLpm()
    {
        new Prodi;
        return view('users.tambah.lpm', [
            'prodi' => Prodi::NotIn(),
        ]);
    }

    public function tambahKaprodi()
    {
        new Prodi;
        return view('users.tambah.kaprodi', [
            'prodi' => Prodi::NotIn(),
        ]);
    }

    public function tambahDosen()
    {
        return view('users.tambah.dosen');
    }

    public function tambahUpps()
    {
        return view('users.tambah.upps');
    }

    public function tambahMhsAlm()
    {
        new Prodi;
        return view('users.tambah.mhsalm', [
            'prodi' => Prodi::NotIn(),
        ]);
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
        return redirect()->route('users');

    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'i' => $user,
        ]);
    }

    public function put(User $user, Request $request)
    {
        $att = [
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user->update($att);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dibaharui</strong>
    </div>');
        return redirect()->route('users');
    }

    public function hapus(User $user)
    {
        $user->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        return redirect()->route('users');
    }
}
