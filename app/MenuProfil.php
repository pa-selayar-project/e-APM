<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuProfil extends Model
{
    use SoftDeletes;
    protected $table = 'menu_profil';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
