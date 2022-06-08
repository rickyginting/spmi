<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class L2 extends Model
{
    protected $fillable = ['name', 'l1_id', 'jenjang_id'];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class);
    }

    public function scopeNotIn($query)
    {
        return $query->whereNotIn('id', [0])->get();
    }
}
