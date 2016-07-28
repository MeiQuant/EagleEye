<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CronTask;
use App\Exceptions\ShellException;
use Log;


class GetCronTasks extends Command
{

    protected $cronTask = null;
    protected $signature = 'cron:read';

    protected $description = 'read cron tasks from server machine everyday';

    protected $cronFile = '';

    public function __construct(CronTask $cronTask)
    {
        $this->cronTask = $cronTask;
        $this->cronFile = config('shell.cron_task_file');
        parent::__construct();
    }


    public function handle()
    {
        /**
         *  1, 将服务器上cron的脚本读出来,存取到数据库中,使之在后台可以看到
         *
         *  2, 初始化之后,每当cron有变动时才会触发该脚本
         */

        $cronFileContents = file_get_contents($this->cronFile);
        $crons = array_filter(explode("\n", $cronFileContents));

        foreach ($crons as $cron) {
            $result = $this->cronTask->create(
                [
                    'content' => $cron,
                    'description' => '暂无描述',  //等最后总结一下所有的脚本关键字再添加相应的描述
                ]
            );
            if (!isset($result->id) || empty($result->id)) {
                Log::error('cron insert error');
            } else {
                Log::info('cron insert success, id is : ' . $result->id);
            }

        }

    }
}
