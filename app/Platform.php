<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\BasePlatform;
use App\BaseProduct;


class Platform extends Model
{

    use SoftDeletes;

    protected $table = 'platform_data';

    protected $fillable = ['id', 'platform_id', 'interest',
        'total_invest_amounts', 'total_invest_persons',
        'total_profits'];

    protected $dates = ['deleted_at'];



//    public function platform()
//    {
//        return $this->belongsTo('App\BasePlatform', 'platform_id', 'id')->select(array('id', 'name'));
//    }



}
