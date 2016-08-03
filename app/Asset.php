<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//资产模型


class Asset extends Model
{

    use SoftDeletes;

    protected $table = 'asset_data';

    protected $fillable =
        [
            'id',
            'product_id',
            'content'

        ];

    protected $dates = ['deleted_at'];
}
