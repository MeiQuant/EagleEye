<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasePlatform extends Model
{

    use SoftDeletes;

    protected $table = 'platform';

    protected $fillable = ['id', 'name'];

    protected $dates = ['deleted_at'];
}
