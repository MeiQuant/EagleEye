<?php



$content = file_get_contents('https://www.zhenrongbao.com/plat/plat_assemble?pid=2&current_page=1&_access_token=&platform=pc');
$content = json_decode($content, true);
$pageCount = 0;
if (!empty($content) && is_array($content)) {
    $pageCount = $content['data']['page_count'];
}


