<?php

namespace App\Http\Controllers;

use App\Berkas;
use App\Element;
use App\Prodi;
use App\Target;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function tabel(Prodi $prodi)
    {
        $att = Element::where('prodi_id', $prodi->id)->get();
        return view('home.berkas.prodi', [
            'p' => $prodi,
            'e' => $att,
        ]);
    }

    public function berkas(Element $element)
    {
        $att = Berkas::where('element_id', $element->id)->get();
        return view('home.berkas.berkas', [
            'e' => $element,
            'b' => $att,
        ]);
    }

    public function view(Berkas $berkas)
    {
        return view('home.berkas.view', [
            'b' => $berkas,
        ]);
    }

    public function singleSearch()
    {
        return view('home.singleSearch.index');
    }

    public function hasilsingleSearch(Request $request)
    {
        $file = Berkas::where('file_name', 'like', '%' . $request->filename . '%')->get();
        return view('home.singleSearch.hasil', [
            'berkas' => $file,
        ]);
    }

    public function multiSearch()
    {
        return view('home.multiSearch.index');
    }

    public function hasilmultiSearch(Request $request)
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

        return view('home.multiSearch.hasil', [
            'berkas' => $b,
        ]);
    }

    public function diagram()
    {
        $ass = [
            'TI' => Element::where('prodi_id', 1)->get()->sum('score_hitung'),
            'RPL' => Element::where('prodi_id', 2)->get()->sum('score_hitung'),
            'TIF' => Element::where('prodi_id', 3)->get()->sum('score_hitung'),
            'BD' => Element::where('prodi_id', 4)->get()->sum('score_hitung'),
            'TRKJ' => Element::where('prodi_id', 5)->get()->sum('score_hitung'),
            'MI' => Element::where('prodi_id', 6)->get()->sum('score_hitung'),
        ];
        return view('home.diagram.index', [
            'ass' => $ass,
        ]);
    }

    public function radarDiagram(Prodi $prodi)
    {
        $element = Element::where('prodi_id', $prodi->id);

        $target = [
            "l1" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 1)->first(),
            "l2" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 2)->first(),
            "l3" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 3)->first(),
            "l4" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 4)->first(),
            "l5" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 5)->first(),
            "l6" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 6)->first(),
            "l7" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 7)->first(),
            "l8" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 8)->first(),
            "l9" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 9)->first(),
            "l10" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 10)->first(),
            "l11" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 11)->first(),
            "l12" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 12)->first(),
        ];

        $pencapaian = [
            "l1" => Element::where('prodi_id', $prodi->id)->where('l1_id', 1)->sum('score_hitung'),
            "l2" => Element::where('prodi_id', $prodi->id)->where('l1_id', 2)->sum('score_hitung'),
            "l3" => Element::where('prodi_id', $prodi->id)->where('l1_id', 3)->sum('score_hitung'),
            "l4" => Element::where('prodi_id', $prodi->id)->where('l1_id', 4)->sum('score_hitung'),
            "l5" => Element::where('prodi_id', $prodi->id)->where('l1_id', 5)->sum('score_hitung'),
            "l6" => Element::where('prodi_id', $prodi->id)->where('l1_id', 6)->sum('score_hitung'),
            "l7" => Element::where('prodi_id', $prodi->id)->where('l1_id', 7)->sum('score_hitung'),
            "l8" => Element::where('prodi_id', $prodi->id)->where('l1_id', 8)->sum('score_hitung'),
            "l9" => Element::where('prodi_id', $prodi->id)->where('l1_id', 9)->sum('score_hitung'),
            "l10" => Element::where('prodi_id', $prodi->id)->where('l1_id', 10)->sum('score_hitung'),
            "l11" => Element::where('prodi_id', $prodi->id)->where('l1_id', 11)->sum('score_hitung'),
            "l12" => Element::where('prodi_id', $prodi->id)->where('l1_id', 12)->sum('score_hitung'),

        ];
        return view('home.diagram.radar', [
            'p' => $prodi,
            'e' => $element->get(),
            'count_element' => $element->count(),
            'count_berkas' => $element->sum("count_berkas"),
            'score_hitung' => $element->sum("score_hitung"),
            'terakreditas' => $element->where('status_akreditasi', "Y")->get(),
            'unggul' => $element->where('status_unggul', "Y")->get(),
            'baik' => $element->where('status_baik', "Y")->get(),
            'target' => $target,
            'pencapaian' => $pencapaian,
        ]);
    }
}
