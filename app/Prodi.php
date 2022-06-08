<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = ['name', 'kode', 'jenjang_id'];
    public $timestamps = false;

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class);
    }

    public function berkas()
    {
        return $this->belongsTo(Berkas::class);
    }

    public function scopeNotIn($query)
    {
        return $query->whereNotIn('id', [0])->orderBy('name', 'ASC')->get();
    }
}
