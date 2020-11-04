<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Observasi extends Model
{
    use SoftDeletes;
    protected $table = 'lke_observasi';
    protected $guarded = ['id', 'deleted_at','created_at', 'updated_at'];
}
