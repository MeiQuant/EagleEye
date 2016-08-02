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
            'name',
            'amount',
            'profit', //预期收益率
            'loan_life',
            'start_date', //还款开始时间
            'end_date', //还款结束时间
            'loan_amount', //债券总额
            'type' //资产类型

        ];

    protected $dates = ['deleted_at'];
}
