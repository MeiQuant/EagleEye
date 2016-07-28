<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CronTask extends Model
{

    use SoftDeletes;

    protected $table = 'cron_tasks';

    protected $fillable = ['id', 'content', 'description'];

    protected $dates = ['deleted_at'];


}
