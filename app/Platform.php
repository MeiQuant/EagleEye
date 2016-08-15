<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{

    use SoftDeletes;

    protected $table = 'platform_data';

    protected $fillable = ['id', 'platform_id', 'interest',
        'total_invest_amounts', 'total_invest_persons',
        'total_profits'];

    protected $dates = ['deleted_at'];
}
