<?php

namespace App\Http\Controllers;

use App\Prodi;
use App\Target;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    public function index()
    {
        return view('target.index', [
            'p' => Prodi::get(),
        ]);
    }

    public function detail(Prodi $prodi)
    {
        $id = $prodi->id;
        return view('target.detail', [
            'target' => Target::where('prodi_id', $id)->get(),
            'prodi' => $prodi,
        ]);
    }

    public function createTarget(Prodi $prodi)
    {
        $id = $prodi->id;

        Target::insert([
            [
                'l1_id' => 1,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 2,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 3,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 4,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 5,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 6,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 7,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 8,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 9,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 10,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 11,
                'prodi_id' => $id,
                'value' => 0,
            ],
            [
                'l1_id' => 12,
                'prodi_id' => $id,
                'value' => 0,
            ],
        ]);

        return redirect()->to('target/' . $prodi->kode);
    }

    public function update(Target $target, Request $request)
    {

        $target->update([
            'value' => $request->value,
        ]);

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Target Pencapaian Telah Diperbaharui</strong>
    </div>');
        return redirect()->to('target/' . $target->prodi->kode);
    }
}
