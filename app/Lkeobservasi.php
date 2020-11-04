<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Lkeobservasi extends Model
{
    use SoftDeletes;
    protected $table = 'penilaian_observasi';
    protected $guarded = ['id', 'deleted_at','created_at', 'updated_at'];
}
