<?php

namespace App\Http\Controllers;

use App\Berkas;
use App\Element;
use App\Indikator;
use App\Prodi;
use App\Score;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function index(Request $request)
    {
        $kode = basename($request->path());
        $prodi = Prodi::where('kode', $kode)->first();
        $element = Element::where('prodi_id', $prodi->id)->get();

        return view('element.index', [
            'p' => $prodi,
            'e' => $element,
            'count_element' => $element->count(),
            'count_berkas' => $element->sum("count_berkas"),
            'score_hitung' => $element->sum("score_hitung"),
        ]);
    }

    public function tambahElement()
    {
        return view('element.tambah');
    }

    public function store(Request $request)
    {

        $prodi = Prodi::where('id', $request->prodi_id)->first();
        $row = [];

        if ($request->l1_id & $request->l2_id == null & $request->l3_id == null & $request->l4_id == null) {
            for ($i = 0; $i < count($request->l1_id); $i++) {
                $row[] = [
                    'prodi_id' => $request->prodi_id,
                    'l1_id' => $request->l1_id[$i],
                    'l2_id' => 0,
                    'l3_id' => 0,
                    'l4_id' => 0,
                    'bobot' => floatval($request->bobot),
                    'score_berkas' => 0,
                    'score_hitung' => 0,
                    'count_berkas' => 0,
                    'indikator_id' => $request->ind_id,
                ];
            }
        } elseif ($request->l1_id & $request->l2_id & $request->l3_id == null & $request->l4_id == null) {
            for ($i = 0; $i < count($request->l1_id); $i++) {
                $row[] = [
                    'prodi_id' => $request->prodi_id,
                    'l1_id' => $request->l1_id[$i],
                    'l2_id' => $request->l2_id[$i],
                    'l3_id' => 0,
                    'l4_id' => 0,
                    'bobot' => floatval($request->bobot),
                    'score_berkas' => 0,
                    'score_hitung' => 0,
                    'count_berkas' => 0,
                    'indikator_id' => $request->ind_id,
                ];
            }
        } elseif ($request->l1_id & $request->l2_id & $request->l3_id & $request->l4_id == null) {
            for ($i = 0; $i < count($request->l1_id); $i++) {
                $row[] = [
                    'prodi_id' => $request->prodi_id,
                    'l1_id' => $request->l1_id[$i],
                    'l2_id' => $request->l2_id[$i],
                    'l3_id' => $request->l3_id[$i],
                    'l4_id' => 0,
                    'bobot' => floatval($request->bobot),
                    'score_berkas' => 0,
                    'score_hitung' => 0,
                    'count_berkas' => 0,
                    'indikator_id' => $request->ind_id,
                ];
            }
        } elseif ($request->l1_id & $request->l2_id & $request->l3_id & $request->l4_id) {
            for ($i = 0; $i < count($request->l1_id); $i++) {
                $row[] = [
                    'prodi_id' => $request->prodi_id,
                    'l1_id' => $request->l1_id[$i],
                    'l2_id' => $request->l2_id[$i],
                    'l3_id' => $request->l3_id[$i],
                    'l4_id' => $request->l4_id[$i],
                    'bobot' => floatval($request->bobot),
                    'score_berkas' => 0,
                    'score_hitung' => 0,
                    'count_berkas' => 0,
                    'indikator_id' => $request->ind_id,
                ];
            }
        } else {
            echo "Ada Kesalahan pada Sistem";
            die;
        }

        Element::insert($row);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Element Berhasil Dibuat</strong>
    </div>');
        return redirect()->route('element-' . $prodi->kode);

    }

    public function unggahBerkas(Element $element)
    {
        return view('element.unggah-berkas', [
            'element' => $element,
            'score' => Score::where('indikator_id', $element->indikator_id)->get(),
            'indikator' => Indikator::where('id', $element->indikator_id)->first(),
        ]);
    }

    public function storeBerkas(Request $request)
    {
        $id = $request->element_id;
        $element = Element::where('id', $id)->first();

        if ($request->file('file')) {
            $file = $request->file('file');
            $md5 = md5($file->getClientOriginalName());
            $ex = $file->getClientOriginalExtension();
            $namefile = $md5 . "." . $ex;

            Berkas::create([
                'element_id' => $element->id,
                'prodi_id' => $element->prodi_id,
                'l1_id' => $element->l1_id,
                'l2_id' => $element->l2_id,
                'l3_id' => $element->l3_id,
                'l4_id' => $element->l4_id,
                'file_name' => $request->file_name,
                'file' => $namefile,
                'dec' => $request->dec,
                'score' => floatval($request->score),
            ]);

            $file->move('document', $namefile);

            $berkaslama = $element->count_berkas;
            $count_berkas = $berkaslama + 1;

            $b = Berkas::where('element_id', $element->id)->get();
            $s = $b->sum("score");
            $avg = $s / $count_berkas;

            $element->update([
                'score_berkas' => $avg,
                'count_berkas' => $count_berkas,
            ]);

            $hasil_bobot = $element->score_berkas * $element->bobot;

            $element->update([
                'score_hitung' => $hasil_bobot,
            ]);
        } else {
            $element->update([
                'score_berkas' => floatval($request->score),
            ]);

            $scorexbobot = $element->score_berkas * $element->bobot;

            $element->update([
                'score_hitung' => $scorexbobot,
            ]);
        }

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
        <strong>Berkas berhasil di simpan</strong>
    </div>');
        return redirect()->route('element-' . $prodi->kode);
    }

    public function lihatBerkas(Element $element)
    {
        $berkas = Berkas::where('element_id', $element->id)->get();
        if ($berkas->count() > 1) {
            $avg = round($berkas->sum('score') / $berkas->count(), 2);
        } else {
            $avg = $element->score_berkas;
        }

        return view('element.lihat-berkas', [
            'element' => $element,
            'berkas' => $berkas,
            'avg' => $avg,
        ]);
    }

    public function akreditas(Element $element)
    {
        return view('element.akreditas', [
            'element' => $element,
        ]);
    }

    public function putAkreditas(Element $element, Request $request)
    {

        $prodi = Prodi::where('id', $element->prodi_id)->first();
        if ($request->score >= floatval($request->min)) {
            $keputusan = "Y";
            $pesan = '<div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Menurut ketentuan nilai sudah mencukupi untuk Terakreditasi</strong>
        </div>';
        } else {
            $keputusan = "N";
            $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Menurut ketentuan nilai belum mencukupi untuk Terakreditasi</strong>
        </div>';
        }

        $element->update([
            'min_akreditasi' => floatval($request->min),
            'status_akreditasi' => $keputusan,
        ]);

        session()->flash('pesan', $pesan);
        return redirect()->route('element-' . $prodi->kode);

    }

    public function unggul(Element $element)
    {
        return view('element.unggul', [
            'element' => $element,
        ]);
    }

    public function putUnggul(Element $element, Request $request)
    {

        $prodi = Prodi::where('id', $element->prodi_id)->first();
        if ($request->score >= floatval($request->min)) {
            $keputusan = "Y";
            $pesan = '<div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Menurut ketentuan nilai sudah mencukupi untuk Peringkat Unggul</strong>
        </div>';
        } else {
            $keputusan = "N";
            $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Menurut ketentuan nilai belum mencukupi untuk Peringkat Unggul</strong>
        </div>';
        }

        $element->update([
            'min_unggul' => floatval($request->min),
            'status_unggul' => $keputusan,
        ]);

        session()->flash('pesan', $pesan);
        return redirect()->route('element-' . $prodi->kode);

    }

    public function baik(Element $element)
    {
        return view('element.baik', [
            'element' => $element,
        ]);
    }

    public function putBaik(Element $element, Request $request)
    {

        $prodi = Prodi::where('id', $element->prodi_id)->first();
        if ($request->score >= floatval($request->min)) {
            $keputusan = "Y";
            $pesan = '<div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Menurut ketentuan nilai sudah mencukupi untuk Peringkat Baik Sekali</strong>
        </div>';
        } else {
            $keputusan = "N";
            $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Menurut ketentuan nilai belum mencukupi untuk Peringkat Baik Sekali</strong>
        </div>';
        }

        $element->update([
            'min_baik' => floatval($request->min),
            'status_baik' => $keputusan,
        ]);

        session()->flash('pesan', $pesan);
        return redirect()->route('element-' . $prodi->kode);

    }

    public function resetData(Element $element)
    {
        $element->update([
            'score_berkas' => 0,
            'score_hitung' => 0,
            'count_berkas' => 0,
            'min_akreditasi' => 0,
            'status_akreditasi' => "F",
            'min_unggul' => 0,
            'status_unggul' => "F",
            'min_baik' => 0,
            'status_baik' => "F",
        ]);

        Berkas::where('element_id', $element->id)->delete();

        $prodi = Prodi::where('id', $element->prodi_id)->first();

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Direset</strong></div>');
        return redirect()->route('element-' . $prodi->kode);
    }

    public function konfirHapus(Element $element)
    {
        return view('element.konfirmasi', [
            'element' => $element,
            'prodi' => Prodi::where('id', $element->prodi_id)->first(),
        ]);
    }

    public function delete(Element $element)
    {
        $prodi = Prodi::where('id', $element->prodi_id)->first();
        Berkas::where('element_id', $element->id)->delete();
        $element->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong></div>');
        return redirect()->route('element-' . $prodi->kode);
    }

    public function detailElement(Element $element)
    {
        return view('element.detail', [
            'element' => $element,
            'prodi' => Prodi::where('id', $element->prodi_id)->first(),
        ]);
    }

    public function putBobot(Element $element, Request $request)
    {
        $element->update([
            'bobot' => $request->bobot,
        ]);

        return redirect()->to('/element/detail/' . $element->id);
    }

}
