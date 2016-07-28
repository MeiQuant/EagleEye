<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetCronTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'read cron tasks from server machine everyday';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         *  1, 将服务器上cron的脚本读出来,存取到数据库中,使之在后台可以看到
         *
         *  2, 初始化之后,每当cron有变动时才会触发该脚本
         */

        
    }
}
