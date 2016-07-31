<?php

$content = file_get_contents('https://www.zhenrongbao.com/plat/plat_assemble?pid=2&current_page=1&_access_token=&platform=pc');
$content = json_decode($content, true);
$pagePlatCount = 0;
if (!empty($content) && is_array($content)) {
    $pagePlatCount = $content['data']['page_count'];
}

$i = 0;
$pagePlatData = ''; //每一页的数据
$results = [];

for($i=0; $i<=$pagePlatCount; $i++) {
    $pagePlatContent = file_get_contents('https://www.zhenrongbao
    .com/plat/plat_assemble?pid=2&current_page='. $i .'&_access_token=&platform=pc');
    $pagePlatContent  = $pagePlatContent['data']['credit_plat'];
    $platformName = $pagePlatContent['plat_name'];
    $platPercent = $pagePlatContent['plat_amount_percent'];
    $platNum     = $pagePlatContent['plat_credit_amount']; //资产数
    //查询相应平台下面的所有资产,首先也是获取资产的总数
    $pageAssetData = file_get_contents('https://www.zhenrongbao.com/plat/plat_credit_assemble?pid=2&current_page=1&
    credit_plat_id='. $pagePlatContent['credit_plat_id'].'&_access_token=&platform=pc');
    $pageAssetCount = $pageAssetData['data']['page_count'];
    for ($j=0; $j<=$pageAssetCount; $j++) {
        $pageAssetContent = file_get_contents('https://www.zhenrongbao
        .com/plat/plat_credit_assemble?pid=2&current_page=1&
    credit_plat_id='. $pagePlatContent['credit_plat_id'].'&_access_token=&platform=pc');  //某个平台下某个资产的相关信息
        
    }

}

