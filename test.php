<?php


ob_start();
require 'public/index.php';
ob_clean();
$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://www.zhenrongbao.com'
]);


$url = 'https://www.zhenrongbao.com/index/demand';
$res = $client->get($url, [], null);
$contents = $res->getBody()->getContents();


$url1 = "https://www.zhenrongbao.com/plat/assemble?pid=1";
$res1 = $client->get($url1, [], null);
$huoqiContents = $res1->getBody()->getContents();


$pattern = '/<p class="line-1">(.*)<\/p>/i';
$huoqiPattern = '/<p class="number"><span>(.*)<\/span>/i';
preg_match_all($pattern, $contents, $matches);
preg_match_all($huoqiPattern, $huoqiContents, $huoqiMatches);
$a =    [
    'product_id' => 2,
    'total_invest_amounts' => str_replace('￥', '', str_replace(',', '', $matches[1][2])),
    'total_invest_persons' => $matches[1][1],
    'total_profits' => str_replace('￥', '', str_replace(',', '', $matches[1][3])),
    'asset_count' => $huoqiMatches[1][3],
    'plat_count' => $huoqiMatches[1][2]
];



print_r($a);



