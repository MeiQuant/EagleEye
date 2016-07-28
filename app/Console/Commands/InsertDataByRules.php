<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exceptions\ShellException;
use Log;
use App\Data;
use App\Rule;
use Exception;

class InsertDataByRules extends Command
{

    protected $signature = 'cron:insert-data';

    protected $description = 'insert data by all rules everyday';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        /*
         * 1, 根据规则表每天执行插入到数据库中
         * 2, 后期考虑分表规则
         */

        Rule::chunk(200, function ($rules) {
            foreach ($rules as $rule) {
                try {
                    $data['rule_id'] = $rule->id;
                    $data['hash_id'] = $rule->hash_id;
                    $data['content'] = eval($rule->code);
                    $this->_insertData($data);
                } catch (Exception $e) {
                    Log::error('exception :' . $e->getMessage());
                    continue;
                }
            }
        });

    }

    private function _insertData($data)
    {
        $result = Data::create(
            [
                'rule_id' => $data['rule_id'],
                'hash_id' => $data['hash_id'],
                'content' => $data['content']
            ]
        );

        //考虑下异常情况

        if (!isset($result->id) || empty($result->id)) {
            Log::error('insert error');
        } else {
            Log::info('insert success, id is :' . $result->id);
        }

    }
}
