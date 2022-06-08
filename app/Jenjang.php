<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    protected $fillable = ['name', 'kode'];
    public $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
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
    public function scopeNotIn($query)
    {
        return $query->whereNotIn('id', [0])->orderBy('name', 'ASC')->get();
    }
}
