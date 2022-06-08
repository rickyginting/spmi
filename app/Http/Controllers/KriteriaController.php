<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\L1;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        $kode = basename($request->path());
        $j = Jenjang::where('kode', $kode)->first();
        $c = L1::where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get();

        return view('kriteria.index', [
            'j' => $j,
            'c' => $c,
        ]);
    }

    public function store(Request $request)
    {
        $url = $request->url;
        L1::create([
            'name' => $request->name,
            'jenjang_id' => $request->jenjang,
        ]);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Ditambahkan</strong>
    </div>');
        return redirect()->to($url);
    }

    public function hapus(L1 $l1, Request $request)
    {
        $l1->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        $url = $request->url;
        return redirect()->to($url);
    }

    public function put(L1 $l1, Request $request)
    {
        $l1->update([
            'name' => $request->name,
        ]);

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Diperbaharui</strong>
    </div>');
        $url = $request->url;
        return redirect()->to($url);
    }
}
