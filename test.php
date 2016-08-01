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
//$results['platCount'] = $pagePlatCount; //总的平台个数

for($i=0; $i<=$pagePlatCount; $i++) {
    $pagePlatContent = file_get_contents('https://www.zhenrongbao
    .com/plat/plat_assemble?pid=2&current_page='. $i .'&_access_token=&platform=pc');
    $pagePlatContent  = $pagePlatContent['data']['credit_plat'];

    //平台的信息如果需要可以再加
    $results['plat_id'] = $pagePlatContent['credit_plat_id']; //平台id
    $results['plat_name'] = $pageAssetContent['plat_name']; //平台名字


    //查询某个平台下面的所有资产,首先也是获取资产的分页总数
    $pageAssetData = file_get_contents('https://www.zhenrongbao.com/plat/plat_credit_assemble?pid=2&current_page=1&
    credit_plat_id='. $pagePlatContent['credit_plat_id'].'&_access_token=&platform=pc');
    $pageAssetCount = $pageAssetData['data']['page_count'];
    for ($j=0; $j<=$pageAssetCount; $j++) {
        $pageAssetContent = file_get_contents('https://www.zhenrongbao
        .com/plat/plat_credit_assemble?pid=2&current_page=1&
    credit_plat_id='. $pagePlatContent['credit_plat_id'].'&_access_token=&platform=pc');  //某个平台下某一页资产的相关信息
        $results['plat_id']['all_assets'][] = [
            'name' => $pageAssetContent['credit_name'], //资产名称
            'profit_years_percent' => round($pageAssetContent['profit_years_percent'], 2), //预期收益率
            'amount' => (int)$pageAssetContent['amount'], //投资金额
            'loan_life' => $pageAssetContent['loan_life'], //还款期限
            'start_date' => $pageAssetContent['start_date'], //还款开始时间
            'end_date' => $pageAssetContent['end_date'], //还款结束时间
            'loan_amount' => $pageAssetContent['loan_amount'], //债权总额
        ];
    }

}

