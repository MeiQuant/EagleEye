<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Platform;
use App\BaseProduct;



class BasePlatform extends Model
{

    use SoftDeletes;

    protected $table = 'platform';

    protected $fillable = ['id', 'name', 'interest', 'total_invest_amounts', 'total_invest_persons', 'total_profits'];

    protected $dates = ['deleted_at'];


    public function volumeData() {

        //最近7天的
        $startTime = date('Y-m-d', strtotime('-6 days')) . ' 00:00:00';
        $endTime = date('Y-m-d', time()) . ' 23:59:59';

        return $this->hasMany('App\Platform', 'platform_id')
            ->where('updated_at', '>=', $startTime)
            ->where('updated_at', '<=', $endTime)
            ->where('updated_at', 'like', '%08:00%') //只统计每天早上8点的
            ->select(array('id as data_id','total_invest_amounts as data_total_invest_amounts',
                'total_invest_persons as data_total_invest_persons',
                'updated_at as data_created_at'))
            ->orderBy('data_id', 'desc');

    }


    //该平台下的产品列表
    public function productData()
    {
        return $this->hasMany('App\BaseProduct', 'platform_id')->select(array('id', 'name',
            'total_invest_amounts as volume', 'interest', 'total_profits as return'));
    }
}
