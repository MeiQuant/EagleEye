<?php
ob_start();
require 'public/index.php';
ob_clean();

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://www.midaijihua.com/current'
]);


$url = 'https://www.midaijihua.com/current';
$res = $client->get($url, [], null);
$contents = $res->getBody()->getContents();


$pattern = '/<span class="display-b font-t d-blue red">(.*?)<\/span>/';
preg_match_all($pattern, $contents, $matches);


return  [
    'product_id' => 5,
    'total_invest_amounts' => trim(str_replace('￥', '', str_replace(',', '', $matches[1][0]))),
    'total_invest_persons' => str_replace(',', '', $matches[1][1]),
    'total_profits' => trim(str_replace('￥', '', str_replace(',', '', $matches[1][2]))),
    'asset_count' => 0,
    'plat_count' => 0
];
print_r($a);die;






