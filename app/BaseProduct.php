<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseProduct extends Model
{

    use SoftDeletes;

    protected $table = 'product';

    protected $fillable = ['id', 'platform_id', 'name'];

    protected $dates = ['deleted_at'];
}
