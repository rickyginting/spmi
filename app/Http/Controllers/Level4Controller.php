<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\L4;
use Illuminate\Http\Request;

class Level4Controller extends Controller
{
    public function index()
    {
        return view('sub-kriteria.l4', [
            'j' => Jenjang::NotIn(),
            'c' => L4::NotIn(),
        ]);
    }

    public function store(Request $request)
    {

        L4::create([
            'name' => $request->name,
            'l3_id' => $request->l3_id,
            'jenjang_id' => $request->jenjang_id,
        ]);

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Ditambahkan</strong>
    </div>');
        return redirect()->to($request->rollbackUrl);
    }

    public function hapus(L4 $l4)
    {
        $l4->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        return redirect()->route('level4');
    }

    public function put(L4 $l4, Request $request)
    {
        $l4->update([
            'name' => $request->name,
            'l3_id' => $request->l3_id,
            'jenjang_id' => $request->jenjang_id,
        ]);

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Diperbaharui</strong>
    </div>');
        return redirect()->to($request->rollbackUrl);
    }

    public function sort(Request $request)
    {
        $kode = basename($request->path());
        $v = Jenjang::where('kode', $kode)->first();
        $c = L4::where('jenjang_id', $v->id)->orderBy('id', 'ASC')->get();

        return view('sub-kriteria.l4-sort', [
            'j' => Jenjang::NotIn(),
            'c' => $c,
        ]);
    }
}
