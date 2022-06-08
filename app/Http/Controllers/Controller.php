<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\Prodi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {

        view()->share('data', [
            'j' => Jenjang::NotIn(),
            'p' => Prodi::NotIn(),
        ]);

    }
}
