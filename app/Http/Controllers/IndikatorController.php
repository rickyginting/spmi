<?php

namespace App\Http\Controllers;

use App\Indikator;
use App\Jenjang;
use App\Score;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    public function index(Request $request)
    {
        $kode = basename($request->path());
        $jenjang = Jenjang::where('kode', $kode)->first();
        $indikator = Indikator::where('jenjang_id', $jenjang->id)->orderBy('id', 'ASC')->get();
        return view('indikator.index', [
            'd' => $indikator,
            'j' => $jenjang,
        ]);

    }

    public function store(Request $request)
    {
        $url = $request->url;

        $request->validate([
            'dec' => 'required',
        ]);

        Indikator::create([
            'dec' => $request->dec,
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

    public function konfirmasi(Indikator $indikator)
    {
        return view('indikator.konfirmasi', [
            'i' => $indikator,
            'j' => Jenjang::where('id', $indikator->jenjang_id)->first(),
        ]);
    }

    public function hapusIndikator(Indikator $indikator)
    {
        $jenjang = Jenjang::where('id', $indikator->jenjang_id)->first();
        Score::where('indikator_id', $indikator->id)->delete();
        $indikator->delete();

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        return redirect()->route('indikator-' . $jenjang->kode);
    }

    public function editFormIndikator(Indikator $indikator)
    {
        return view('indikator.editIndikator', [
            'i' => $indikator,
            'j' => Jenjang::where('id', $indikator->jenjang_id)->first(),
        ]);
    }

    public function putIndikator(Indikator $indikator, Request $request)
    {
        $jenjang = Jenjang::where('id', $indikator->jenjang_id)->first();
        $indikator->update([
            'dec' => $request->dec,
        ]);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Diedit</strong>
    </div>');
        return redirect()->route('indikator-' . $jenjang->kode);
    }

    public function inputScore(Indikator $indikator)
    {
        return view('indikator.input-score', [
            'indikator' => $indikator,
        ]);
    }

    public function storeScore(Request $request)
    {
        $ind = Indikator::where('id', $request->indikator_id)->first();
        $jenjang = Jenjang::where('id', $ind->jenjang_id)->first();

        $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        Score::create([
            'name' => $request->name,
            'value' => floatval($request->value),
            'indikator_id' => $request->indikator_id,
        ]);

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Ditambahkan</strong>
    </div>');
        return redirect()->route('indikator-' . $jenjang->kode);
        // return redirect()->to('indikator/' . $jenjang->kode);
    }

    public function cekScore(Indikator $indikator)
    {
        $att = Score::where('indikator_id', $indikator->id)->get();
        return view('indikator.cek-score', [
            's' => $att,
        ]);
    }

    public function konfirmasiScore(Score $score)
    {
        $i = Indikator::where('id', $score->indikator_id)->first();
        $jenjang = Jenjang::where('id', $i->jenjang_id)->first();

        return view('indikator.konfirmasiScore', [
            's' => $score,
            'j' => $jenjang,
        ]);
    }

    public function hapusScore(Score $score)
    {
        $i = Indikator::where('id', $score->indikator_id)->first();
        $jenjang = Jenjang::where('id', $i->jenjang_id)->first();
        $score->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        return redirect()->route('indikator-' . $jenjang->kode);
    }

    public function editScore(Score $score)
    {

        return view('indikator.editScore', [
            's' => $score,
            'i' => Indikator::where('id', $score->indikator_id)->first(),
        ]);
    }

    public function putScore(Score $score, Request $request)
    {
        $i = Indikator::where('id', $score->indikator_id)->first();
        $score->update([
            'name' => $request->name,
            'value' => $request->value,
        ]);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Diedit</strong>
    </div>');
        return redirect()->to('/indikator/cek-score/' . $i->id);
    }
}
