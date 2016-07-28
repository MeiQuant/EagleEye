<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rule extends Model
{

    use SoftDeletes;

    protected $table = 'rules';

    protected $fillable = ['platform_id', 'code', 'hash_id'];

    protected $dates = ['deleted_at'];
}
