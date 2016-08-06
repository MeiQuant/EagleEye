<?php

$contents = file_get_contents('https://www.midaijihua.com');
$pattern = '/<span class="pull-right">(.*?)<\/span>/i';
preg_match_all($pattern, $contents, $matches);
print_r($matches);die;
$result =  [
    'product_id' => 2,
    'total_invest_amounts' => str_replace('￥', '', str_replace(',', '', $matches[1][1])),
    'total_invest_persons' => $matches[1][0],
    'total_profits' => str_replace('￥', '', str_replace(',', '', $matches[1][2])),
    'asset_count' => $huoqiMatches[1][3],
    'plat_count' => $huoqiMatches[1][2]
];

print_r($result);die;

$contents = file_get_contents('https://www.zhenrongbao.com/dingqi');
$dingqiContents = file_get_contents('https://www.zhenrongbao.com/plat/assemble?pid=2');
$pattern = '/<p class="line-1">(.*)<\/p>/i';
$dingqiPattern = '/<p class="number"><span>(.*)<\/span>/i';
preg_match_all($pattern, $contents, $matches);
preg_match_all($dingqiPattern, $dingqiContents, $dingqiMatches);
return [
    'product_id' => 1,
    'total_invest_amounts' => str_replace('￥', '', str_replace(',', '', $matches[1][1])),
    'total_invest_persons' => $matches[1][0],
    'total_profits' => str_replace('￥', '', str_replace(',', '', $matches[1][2])),
    'asset_count' => $dingqiMatches[1][2],
    'plat_count' => $dingqiMatches[1][1]
];




