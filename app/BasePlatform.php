<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Platform;




class BasePlatform extends Model
{

    use SoftDeletes;

    protected $table = 'platform';

    protected $fillable = ['id', 'name', 'interest', 'total_invest_amounts', 'total_invest_persons', 'total_profits'];

    protected $dates = ['deleted_at'];


    public function volumeData() {
        return $this->has
    }
}
