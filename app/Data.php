<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Data extends Model
{

    use SoftDeletes;

    protected $table = 'data';

    protected $fillable = ['id', 'rule_id', 'hash_id', 'content'];

    protected $dates = ['deleted_at'];


}
