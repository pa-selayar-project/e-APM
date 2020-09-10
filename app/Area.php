<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use softDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function eviden()
    {
        return $this->belongsTo('App\Eviden');
    }

}
