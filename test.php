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


for($i=1; $i<=$pagePlatCount; $i++) {
    $pagePlatContent = file_get_contents('https://www.zhenrongbao.com/plat/plat_assemble?pid=2&current_page='. $i .'&_access_token=&platform=pc');
    $pagePlatContent = json_decode($pagePlatContent, true);
    $pagePlatContent  = $pagePlatContent['data']['credit_plat'];

    foreach ($pagePlatContent as $platInfo) {
        //平台的信息如果需要可以再加
        $platId = $platInfo['credit_plat_id']; //平台id
        $platName = $platInfo['plat_name']; //平台名字
        $assetType = $platInfo['plat_type_name']; //平台资产类型

        //查询某个平台下面的所有资产,首先也是获取资产的分页总数

        $pageAssetData = file_get_contents('https://www.zhenrongbao.com/plat/plat_credit_assemble?pid=2&current_page=1&credit_plat_id='. $platId .'&_access_token=&platform=pc');
        $pageAssetData = json_decode($pageAssetData, true);
        $pageAssetCount = $pageAssetData['data']['page_count'];
        for ($j=1; $j<=$pageAssetCount; $j++) {
            $pageAssetContent = file_get_contents('https://www.zhenrongbao.com/plat/plat_credit_assemble?pid=2&current_page=1&credit_plat_id='. $platId .'&_access_token=&platform=pc');  //某个平台下某一页资产的相关信息
            $pageAssetContent = json_decode($pageAssetContent, true);
            $pageAssetContent = $pageAssetContent['data']['credit_assemble'];
            foreach ($pageAssetContent as $assetInfo) {
                file_put_contents('/tmp/asset.log', $assetInfo['credit_name'] . "\n");
                $results[$platName][] = [
                    'name' => $assetInfo['credit_name'], //资产名称
                    'profit' => round($assetInfo['profit_years_percent'], 2), //预期收益率
                    'amount' => (int)$assetInfo['amount'], //投资金额
                    'loan_life' => $assetInfo['loan_life'], //还款期限
                    'start_date' => $assetInfo['start_date'], //还款开始时间
                    'end_date' => $assetInfo['end_date'], //还款结束时间
                    'loan_amount' => $assetInfo['loan_amount'], //债权总额
                    'asset_type' => $assetType
                ];
            }

        }


    }






}

return $results;

