<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\L2;
use Illuminate\Http\Request;

class Level2Controller extends Controller
{
    public function index()
    {
        return view('sub-kriteria.l2', [
            'j' => Jenjang::NotIn(),
            'c' => L2::NotIn(),
        ]);
    }

    public function sort(Request $request)
    {
        $kode = basename($request->path());
        $v = Jenjang::where('kode', $kode)->first();
        $c = L2::where('jenjang_id', $v->id)->orderBy('id', 'ASC')->get();

        return view('sub-kriteria.l2-sort', [
            'j' => Jenjang::NotIn(),
            'c' => $c,
        ]);
    }

    public function store(Request $request)
    {

        L2::create([
            'name' => $request->name,
            'l1_id' => $request->l1_id,
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

    public function hapus(L2 $l2)
    {
        $l2->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        return redirect()->route('level2');
    }

    public function put(L2 $l2, Request $request)
    {
        $l2->update([
            'name' => $request->name,
            'l1_id' => $request->l1_id,
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
}
