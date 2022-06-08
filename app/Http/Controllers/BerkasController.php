<?php

namespace App\Http\Controllers;

use App\Berkas;
use App\Element;
use App\Indikator;
use App\Prodi;
use App\Score;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    public function index()
    {
        return view('berkas.index', [
            'berkas' => Berkas::all(),
        ]);
    }

    public function cari()
    {
        return view('berkas.cari');
    }

    public function hasil(Request $request)
    {
        $prodi = $request->prodi_id;
        $l1_id = $request->l1_id;
        $l2_id = $request->l2_id;
        $l3_id = $request->l3_id;
        $l4_id = $request->l4_id;

        if ($prodi) {
            $b = Berkas::where('prodi_id', $prodi)->get();
        }

        if (isset($_POST['l1_id'])) {
            $b = Berkas::where('prodi_id', $prodi)->whereIn('l1_id', $l1_id)->get();
        }

        if (isset($_POST['l2_id'])) {
            $b = Berkas::where('prodi_id', $prodi)->whereIn('l1_id', $l1_id)->whereIn('l2_id', $l2_id)->get();
        }

        if (isset($_POST['l3_id'])) {
            $b = Berkas::where('prodi_id', $prodi)->whereIn('l1_id', $l1_id)->whereIn('l2_id', $l2_id)->whereIn('l3_id', $l3_id)->get();

        }

        if (isset($_POST['l4_id'])) {
            $b = Berkas::where('prodi_id', $prodi)->whereIn('l1_id', $l1_id)->whereIn('l2_id', $l2_id)->whereIn('l3_id', $l3_id)->whereIn('l4_id', $l4_id)->get();

        }

        return view('berkas.index', [
            'berkas' => $b,
        ]);

    }

    public function detail(Berkas $berkas)
    {
        $data = $berkas;
        return view('berkas.detail', [
            'berkas' => $data,
        ]);
    }

    public function edit(Berkas $berkas)
    {
        $element = Element::where('id', $berkas->element_id)->first();
        return view('berkas.edit', [
            'berkas' => $berkas,
            'element' => $element,
            'score' => Score::where('indikator_id', $element->indikator_id)->get(),
            'indikator' => Indikator::where('id', $element->indikator_id)->first(),
        ]);
    }

    public function put(Berkas $berkas, Request $request)
    {

        $id = $request->element_id;
        $element = Element::where('id', $id)->first();

        $file = $request->file('file');
        if ($file == true) {
            $md5 = md5($file->getClientOriginalName());
            $ex = $file->getClientOriginalExtension();
            $namefile = $md5 . "." . $ex;
            $file->move('document', $namefile);
        } else {
            $namefile = $berkas->file;
        }

        $berkas->update([
            'file_name' => $request->file_name,
            'file' => $namefile,
            'dec' => $request->dec,
            'score' => floatval($request->score),
        ]);

        $b = Berkas::where('element_id', $element->id)->get();
        $s = $b->sum("score");

        $avg = $s / $element->count_berkas;

        $element->update([
            'score_berkas' => $avg,
        ]);

        $hasil_bobot = $element->score_berkas * $element->bobot;

        $element->update([
            'score_hitung' => $hasil_bobot,
        ]);

        if ($element->min_akreditasi > 0) {
            if ($element->score_hitung >= $element->min_akreditasi) {
                $element->update([
                    'status_akreditasi' => 'Y',
                ]);
            } else {
                $element->update([
                    'status_akreditasi' => 'N',
                ]);
            }
        }

        if ($element->min_unggul > 0) {
            if ($element->score_hitung >= $element->min_unggul) {
                $element->update([
                    'status_unggul' => 'Y',
                ]);
            } else {
                $element->update([
                    'status_unggul' => 'N',
                ]);
            }
        }

        if ($element->min_baik > 0) {
            if ($element->score_hitung >= $element->min_baik) {
                $element->update([
                    'status_baik' => 'Y',
                ]);
            } else {
                $element->update([
                    'status_baik' => 'N',
                ]);
            }
        }

        $prodi = Prodi::where('id', $element->prodi_id)->first();

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Berkas Berhasil Dibaharui <a href="/berkas/cari">Klik disini untuk mencari
                file</a></strong></div>');
        return redirect()->route('element-' . $prodi->kode);
    }

    public function hapus(Berkas $berkas)
    {
        $element = Element::where('id', $berkas->element_id)->first();
        $prodi = Prodi::where('id', $element->prodi_id)->first();
        $berkas->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Berkas Berhasil Dihapus</strong></div>');
        return redirect()->route('element-' . $prodi->kode);
    }
}
