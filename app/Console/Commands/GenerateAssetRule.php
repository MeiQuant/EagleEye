<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CronTask;
use Log;
use App\Rule;
use App\Platform;
use App\Product;
use App\Asset;


class GenerateAssetRule extends Command
{

    protected $signature = 'cron:generate-rule';

    protected $description = 'generate rule by platform';



    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
     
    }
}
