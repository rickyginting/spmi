<?php

namespace App\Http\Controllers;

use App\Score;

class ScoreController extends Controller
{
    public function index($num)
    {
        $data = Score::where('indikator_id', $num)->get();
        dd($data);
    }
}
