<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'users';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
