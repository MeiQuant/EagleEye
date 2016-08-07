<?php

namespace App\Console\Commands;

use Cache\cache;
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

    static $userAgent = [
        'Mozilla/5.0/1.0',
        'Chrome/5.1',
        'Mactonish/1.1',
        'Safria/44.5',
        'Opera/12.3',
        'Internet/8.0',
        'Internet/9.0',
        'Internet/6.0',
        'Internet/7.0',
        'Internet/5.0',
        'Internet/10.0',
        'Internet/11.0',
        'Internet/12.0',
        'Internet/13.0',
        'Internet/14.0',
        'Internet/15.0',
        'Internet/16.0',
        'Internet/17.0',

    ];

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

        //查询平台下所有的资产信息

        foreach ($platIds as $platId) {
          self::$page = 1;
            while(true) {
                $ua = self::$userAgent[array_rand(self::$userAgent, 1)];
                $param = time()+60;
                $assetUrl = 'https://www.zhenrongbao.com/plat/plat_credit_assemble?pid=2&current_page='.self::$page.'&credit_plat_id='.$platId['id'].'&_access_token=&platform=pc&_='.$param;
                try{
                    $assetRes = $client->get($assetUrl, [
                        'headers' => [
                            'User-Agent' => $ua,
                            'Accept'     => 'application/json',
                            'X-Foo'      => ['Bar', 'Baz']
                        ]
                    ], null);
                } catch (\Exception $e) {
                    Log::error('发现异常,curl请求出现异常,内容为:' . $e->getMessage());
                    break;
                }

                $content = $assetRes->getBody()->getContents();
                if (strpos($content, 'error_message') !== false){
                    Log::error('error_message不为空,有可能出现错误信息或者该平台抓包完成,抓取到的内容为:' . $content);
                    break;
                }
                $asset = Asset::create(
                    [
                        'product_id' => 1,
                        'content' => $content
                    ]
                );
                Log::info("定期资产相关信息插入成功,id为" .$asset->id ."时间为:" . date('Y-m-d H:i:s', time()));
                self::$page++;
            }
        }

    }
}

