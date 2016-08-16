<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CronTask;
use Log;
use App\Rule;
use App\Platform;
use App\Product;
use App\Asset;
use App\BasePlatform;
use App\BaseProduct;
use v2\Bases\Base;


class InsertDataByRules extends Command
{

    protected $signature = 'cron:insert-data';

    protected $description = 'insert data by all rules everyday';

    static $types = [
        'platforms_info',
        'products_info',
        'assets_info'
    ];

    public static $interest  = '6%-9%'; //平台的收益率

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
                try {
                    $data['content'] = eval($rule->code);
                    if (empty($data['content'])) {
                        throw new \Exception('抓取的内容为空');
                    }
                    $this->_insertData($data);
                } catch(\Exception $e) {
                    Log::error('数据出现错误,信息为:' . $e->getMessage() . '代码文件'. $e->getFile() .'代码行数为:' . $e->getLine());
                }

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
                        'interest' => self::$interest,
                        'total_invest_amounts' => $data['total_invest_amounts'],
                        'total_invest_persons' => $data['total_invest_persons'],
                        'total_profits' => $data['total_profits']
                    ]
                );
                $basePlatform = BasePlatform::find($data['platform_id']);
                $basePlatform->interest = self::$interest;
                $basePlatform->total_invest_amounts = $data['total_invest_amounts'];
                $basePlatform->total_invest_persons = $data['total_invest_persons'];
                $basePlatform->total_profits = $data['total_profits'];
                $basePlatform->save();
                Log::info('平台相关信息更新成功,id为'. $platform->id .',时间为:' . date('Y-m-d H:i:s', time()));
                break;
            case 'products_info':
                if(empty($data['total_invest_persons'])) {
                    throw new \Exception('平台产品抓取的投资人数为空');
                }
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
                $baseProduct = BaseProduct::find($data['product_id']);
                $baseProduct->interest = self::$interest;
                $baseProduct->total_invest_amounts = $data['total_invest_amounts'];
                $baseProduct->total_invest_persons = $data['total_invest_persons'];
                $baseProduct->total_profits = $data['total_profits'];
                $baseProduct->save();
                Log::info('产品相关信息更新成功,id为'. $product->id .',时间为:' . date('Y-m-d H:i:s', time()));
                break;
            case 'assets_info':
                //资产类型暂时先不做处理,单独写脚本
                break;
                Asset::chunk(200, function($data){
                    foreach ($data as $asset) {
                        $asset = Asset::create(
                            [
                                'product_id' => $asset['product_id'],
                                'name' => $asset['name'],
                                'amount' => $asset['amount'] * 100,
                                'profit' => $asset['profit'] * 100,
                                'loan_lift' => $asset['loan_life'],
                                'start_date' => $asset['start_date'],
                                'end_date' => $asset['end_date'],
                                'loan_amount' => $asset['loan_amount'] * 100,
                                'type' => $asset['type']
                            ]
                        );

                        Log::info('资产相关信息更新成功,id为'. $asset->id .',时间为:' . date('Y-m-d H:i:s', time()));

                    }
                });


                break;

            default:
                echo 'error';die;

        }
        echo "over\n";

    }
}
