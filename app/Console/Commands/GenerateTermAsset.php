<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CronTask;
use Log;
use App\Rule;
use App\Platform;
use App\Product;
use App\Asset;


class GenerateTermAsset extends Command
{

    protected $signature = 'cron:generate-term-asset';

    protected $description = 'generate term asset';

    static $page = 1;

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://www.zhenrongbao.com/plat/assemble?pid=2'
        ]);

        $platIds = [];  //所有的定期产品的平台id
        $i = 1;
        while (true) {
            $url = 'https://www.zhenrongbao.com/plat/plat_assemble?pid=2&current_page='.$i.'&_access_token=&platform=pc';
            $res = $client->get($url, [], null);
            $content = $res->getBody()->getContents();
            $content = json_decode($content, true);
            if ($content['error_no'] != 0) break; //表示到最大页数了
            foreach ($content['data']['credit_plat'] as $plat) {
                $platIds[] = [
                    'id' => $plat['credit_plat_id'],
                    'type' => $plat['plat_type_name']
                ];
            }
            $i++;
        }


        print_r($platIds);die;

        //查询平台下所有的资产信息
        $results = [];


        foreach ($platIds as $platId) {
            self::$page = 1;
            while(true) {
                $assetUrl = 'https://www.zhenrongbao.com/plat/plat_credit_assemble?pid=2&current_page='.$page.'&credit_plat_id='.$platId['id'].'&_access_token=&platform=pc&_=1470198705937';
                $assetRes = $client->get($assetUrl, [], null);
                $content = $assetRes->getBody()->getContents();
                $assetContent = json_decode($content, true);
                if ($assetContent['error_no'] != 0) break;
                if (!isset($assetContent['data']['credit_assemble']) || empty($assetContent['data']['credit_assemble'])) {
                    Log::error('wanghongjun-foreach params error, page is: ' . self::$page .', platform_id is :' . $platId['id']);
                    break;
                }
                foreach ($assetContent['data']['credit_assemble'] as $asset) {
                    $asset = Asset::create(
                        [
                            'product_id' => 1,
                            'name' => $asset['credit_name'], //资产名称
                            'profit' => round($asset['profit_years_percent'], 2) * 100, //预期收益率
                            'amount' => (int)$asset['amount'] * 100, //投资金额
                            'loan_life' => $asset['loan_life'], //还款期限
                            'start_date' => $asset['start_date'], //还款开始时间
                            'end_date' => $asset['end_date'], //还款结束时间
                            'loan_amount' => $asset['loan_amount'] * 100, //债权总额
                            'type' => $platId['type']
                        ]
                    );

                    Log::info('定期资产相关信息插入成功,id为'. $asset->id .',页码为:' . self::$page , '时间为:' . date('Y-m-d H:i:s', time()));
                }
                self::$page++;
            }
        }

    }
}
