<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\L3;
use Illuminate\Http\Request;

class Level3Controller extends Controller
{
    public function index()
    {
        return view('sub-kriteria.l3', [
            'j' => Jenjang::NotIn(),
            'c' => L3::NotIn(),
        ]);
    }

    public function store(Request $request)
    {

        L3::create([
            'name' => $request->name,
            'l2_id' => $request->l2_id,
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

    public function hapus(L3 $l3)
    {
        $l3->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        return redirect()->route('level3');
    }

    public function put(L3 $l3, Request $request)
    {
        $l3->update([
            'name' => $request->name,
            'l2_id' => $request->l2_id,
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
        $c = L3::where('jenjang_id', $v->id)->orderBy('id', 'ASC')->get();

        return view('sub-kriteria.l3-sort', [
            'j' => Jenjang::NotIn(),
            'c' => $c,
        ]);
    }
}
