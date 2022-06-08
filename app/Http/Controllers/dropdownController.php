<?php

namespace App\Http\Controllers;

use App\Berkas;
use App\Indikator as Ind;
use App\Jenjang;
use App\L1;
use App\L2;
use App\L3;
use App\L4;
use App\Prodi;
use App\Score;
use Illuminate\Http\Request;

class dropdownController extends Controller
{

    //Dropdown Multiple
    public function getJen(Jenjang $jenjang)
    {
        echo "<option value=''>=== SILAHKAN PILIH JENJANG STUDI === </option>";
        foreach ($jenjang->NotIn() as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }
    }

    public function getPro(Request $request)
    {
        $data = Prodi::where('jenjang_id', $request->jenjang_id)->get();
        echo "<option value=''>=== SILAHKAN PILIH PRODI === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }
    }

    public function getIndikator(Request $request)
    {

        $data = Ind::where('jenjang_id', $request->jenjang_id)->get();
        echo "<option value=''>=== SILAHKAN PILIH INDIKATOR === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->dec . "</option>";
        }
    }

    public function getScore(Request $request)
    {
        $data = Score::where('indikator_id', $request->ind_id)->get();

        foreach ($data as $i) {
            echo "<div class='form-check'><input class='form-check-input' type='radio' name='score' value='" . $i->value . "'>
            <label class='form-check-label' >" . $i->name . "</label></div>";
        }

    }

    public function getL1(Request $request)
    {
        $jenjang_id = $request->jenjang_id;
        $jenjang = explode(',', $jenjang_id);

        $data = L1::whereIn('jenjang_id', $jenjang)->get();

        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }
    }

    public function getL2(Request $request)
    {
        $l1_id = $request->l1_id;
        $l1 = explode(',', $l1_id);

        $data = L2::whereIn('l1_id', $l1)->get();
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    public function getL3(Request $request)
    {
        $l2_id = $request->l2_id;
        $l2 = explode(',', $l2_id);

        $data = L3::whereIn('l2_id', $l2)->get();
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    public function getL4(Request $request)
    {
        $l3_id = $request->l3_id;
        $l3 = explode(',', $l3_id);

        $data = L4::whereIn('l3_id', $l3)->get();
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    // Untuk Tambah DropDown Tidak Multiple #FormEdit
    public function getL1ne(Request $request)
    {
        $id = $request->id;
        $data = Berkas::where('id', $id)->first();
        $l1 = $data->l1_id;

        $fl1 = L1::where('id', $l1)->first();
        echo "<option value='" . $fl1->id . "'>" . $fl1->name . "</option>";

        $getl1 = L1::get();
        foreach ($getl1 as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }
    }

    public function getL2ne(Request $request)
    {
        $id = $request->id;
        $data = Berkas::where('id', $id)->first();
        $l2 = $data->l2_id;

        $fl2 = L2::where('id', $l2)->first();
        echo "<option value='" . $fl2->id . "'>" . $fl2->name . "</option>";
        echo "<option value=''>=== FILE DAPAT DI UBAH SETELAH LEVEL ATAS DI ISI === </option>";

    }

    public function getL3ne(Request $request)
    {
        $id = $request->id;
        $data = Berkas::where('id', $id)->first();
        $l3 = $data->l3_id;

        $fl3 = L3::where('id', $l3)->first();
        echo "<option value='" . $fl3->id . "'>" . $fl3->name . "</option>";
        echo "<option value=''>=== FILE DAPAT DI UBAH SETELAH LEVEL ATAS DI ISI === </option>";

    }

    public function getL4ne(Request $request)
    {
        $id = $request->id;
        $data = Berkas::where('id', $id)->first();
        $l4 = $data->l4_id;

        $fl4 = L4::where('id', $l4)->first();
        echo "<option value='" . $fl4->id . "'>" . $fl4->name . "</option>";
        echo "<option value=''>=== FILE DAPAT DI UBAH SETELAH LEVEL ATAS DI ISI === </option>";

    }

    // Untuk Tambah DropDown Tidak Multiple #FormCari
    public function getjn(Jenjang $j)
    {
        echo "<option value=''> === Pilih Jenjang Dahulu === </option>";
        foreach ($j->NotIn() as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }
    }

    public function getL1n(Request $request)
    {
        $jenjang = $request->jenjang_id;
        $j = explode(',', $jenjang);

        $data = L1::whereIn('jenjang_id', $j)->get();
        echo "<option value=''> === Pilih Level 1 === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    public function getL2n(Request $request)
    {
        $l1_id = $request->l1_id;
        $l1 = explode(',', $l1_id);

        $data = L2::whereIn('l1_id', $l1)->get();
        echo "<option value=''> === Pilih Level 2 === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    public function getL3n(Request $request)
    {
        $l2_id = $request->l2_id;
        $l2 = explode(',', $l2_id);

        $data = L3::whereIn('l2_id', $l2)->get();
        echo "<option value=''> === Pilih Level 3 === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    public function getL4n(Request $request)
    {
        $l3_id = $request->l3_id;
        $l3 = explode(',', $l3_id);

        $data = L4::whereIn('l3_id', $l3)->get();
        echo "<option value=''> === Pilih Level 4 === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    // Untuk Tambah DropDown Tidak Multiple #FormEdit Level
    public function getjnu(Jenjang $j)
    {
        echo "<option value=''> === Pilih Jenjang Dahulu === </option>";
        foreach ($j->get() as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }
    }

    public function getL1nu(Request $request)
    {
        $jenjang = $request->jenjang_id;
        $j = explode(',', $jenjang);

        $data = L1::whereIn('jenjang_id', $j)->get();
        echo "<option value=''> === Pilih Level 1 === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    public function getL2u(Request $request)
    {
        $l1_id = $request->l1_id;
        $l1 = explode(',', $l1_id);

        $data = L2::whereIn('l1_id', $l1)->get();
        echo "<option value=''> === Pilih Level 2 === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    public function getL3u(Request $request)
    {
        $l2_id = $request->l2_id;
        $l2 = explode(',', $l2_id);

        $data = L3::whereIn('l2_id', $l2)->get();
        echo "<option value=''> === Pilih Level 3 === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }

    public function getL4u(Request $request)
    {
        $l3_id = $request->l3_id;
        $l3 = explode(',', $l3_id);

        $data = L4::whereIn('l3_id', $l3)->get();
        echo "<option value=''> === Pilih Level 4 === </option>";
        foreach ($data as $i) {
            echo "<option value='" . $i->id . "'>" . $i->name . "</option>";
        }

    }
}
