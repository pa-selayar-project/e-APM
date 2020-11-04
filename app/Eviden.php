<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eviden extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function kriteria()
    {
        return $this->belongsTo('App\Kriteria');
    }
    
    public function assesmen()
    {
        return $this->hasOne('App\Assesmen', 'nomor', 'nomor_urut');
    }
}
