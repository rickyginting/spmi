<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    public $fillable = ['id', 'dec', 'jenjang_id'];
    public $timestamps = false;
}
