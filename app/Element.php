<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = ['prodi_id', 'l1_id', 'l2_id', 'l3_id', 'l4_id', 'bobot', 'indikator_id', 'score_berkas', 'score_hitung', 'count_berkas', 'min_akreditasi', 'status_akreditasi', 'min_unggul', 'status_unggul', 'min_baik', 'status_baik'];
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

    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }

}
