<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $fillable = ['l1_id', 'prodi_id', 'value'];
    public $timestamps = false;

    public function l1()
    {
        return $this->belongsTo(L1::class, 'l1_id', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

}
