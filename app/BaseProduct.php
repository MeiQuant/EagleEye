<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class BaseProduct extends Model
{

    use SoftDeletes;

    protected $table = 'product';

    protected $fillable = ['id', 'platform_id', 'name', 'interest', 'total_invest_amounts', 'total_invest_persons',
        'total_profits'];

    protected $dates = ['deleted_at'];

    public function volumeData() {

        //最近7天的
        $startTime = date('Y-m-d', strtotime('-6 days')) . ' 00:00:00';
        $endTime = date('Y-m-d', time()) . ' 23:59:59';
        return $this->hasMany('App\Product', 'product_id')
            ->where('updated_at', '>=', $startTime)
            ->where('updated_at', '<=', $endTime)
            ->where('updated_at', 'like', '%08:00%') //只统计每天早上8点的
            ->select(array('id as data_id','total_invest_amounts as data_total_invest_amounts',
                'total_invest_persons as data_total_invest_persons',
                'updated_at as data_created_at'))
            ->orderBy('data_id', 'desc');

    }





}
