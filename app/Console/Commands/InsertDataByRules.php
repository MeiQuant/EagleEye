<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use App\Data;
use App\Rule;
use Exception;
use App\Exceptions\ProgramException;
use App\Platform;
use App\Product;

class InsertDataByRules extends Command
{

    protected $signature = 'cron:insert-data';

    protected $description = 'insert data by all rules everyday';

    static $types = [
        'platforms_info',
        'products_info'
    ];

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
                if (!in_array($rule->type, self::$types)) {
                    Log::error('规则类型不在系统中, error');
                    continue;
                }
                $data['rule_id'] = $rule->id;
                $data['type'] = $rule->type;
                $data['content'] = eval($rule->code);
                if (empty($data['content'])) {
                    Log::error('抓取内容为空');
                }
                $this->_insertData($data);
            }
        });

    }

    private function _insertData($data)
    {
        $type = $data['type'];
        $data = $data['content'];
        switch ($type) {
            case 'platforms_info':
                $platform = Platform::create(
                    [
                        'platform_id' => $data['platform_id'],
                        'total_invest_amounts' => $data['total_invest_amounts'],
                        'total_invest_persons' => $data['total_invest_persons'],
                        'total_profits' => $data['total_profits']
                    ]
                );
                Log::info('平台相关信息更新成功,id为'. $platform->id .',时间为:' . date('Y-m-d H:i:s', time()));
                break;
            case 'products_info':
                $product = Product::create(
                    [
                        'product_id' => $data['product_id'],
                        'total_invest_amounts' => $data['total_invest_amounts'],
                        'total_invest_persons' => $data['total_invest_persons'],
                        'total_profits' => $data['total_profits'],
                        'asset_count' => $data['asset_count'],
                        'plat_count' => $data['plat_count']
                    ]
                );

                Log::info('产品相关信息更新成功,id为'. $product->id .',时间为:' . date('Y-m-d H:i:s', time()));
                break;
            default:
                echo 'error';die;

        }
        echo "over\n";

    }
}
