<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//产品(组合)模型


class Product extends Model
{

    use SoftDeletes;

    protected $table = 'products';

    protected $fillable =
        [
            'id',
            'platform_id',
            'total_invest_amounts',
            'total_invest_persons',
            'total_profits',
            'asset_count',
            'plat_count'
        ];

    protected $dates = ['deleted_at'];
}
