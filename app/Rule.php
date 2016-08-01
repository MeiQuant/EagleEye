<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rule extends Model
{

    use SoftDeletes;

    protected $table = 'rules';

    protected $fillable = ['platform_id', 'code', 'type'];

    protected $dates = ['deleted_at'];
}
