<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    protected $fillable = ['element_id', 'prodi_id', 'l1_id', 'l2_id', 'l3_id', 'l4_id', 'file_name', 'file', 'dec', 'score'];
    public $timestamps = false;

    public function l1()
    {
        return $this->belongsTo(L1::class);
    }

    public function l2()
    {
        return $this->belongsTo(L2::class);
    }

    public function l3()
    {
        return $this->belongsTo(L3::class);
    }

    public function l4()
    {
        return $this->belongsTo(L4::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

}
