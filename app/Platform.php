<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{

    use SoftDeletes;

    protected $table = 'platforms';

    protected $fillable = ['id', 'name', 'site', 'total_invest_amounts', 'total_invest_persons', 'total_profits'];

    protected $dates = ['deleted_at'];
}
