<?php

/*
 *  ==============type===1001========**真融宝总交易额
 */

$content = file_get_contents('https://www.zhenrongbao.com');
$pattern = '/<p><span class="icon"><\/span>累计投资总额：<span>￥(.*?)<\/span><\/p>/i';
preg_match_all($pattern, $content, $matches);
if (!empty($matches) && is_array($matches)) {
    return str_replace(',', '', $matches[1][0]);
}


/*
 *  ==============type===1002========**真融宝投资人数
 */

$content = file_get_contents('https://www.zhenrongbao.com');
$pattern = '/投资人数：<span>(.*?)人<\/span>/i';
preg_match_all($pattern, $content, $matches);
if (!empty($matches) && is_array($matches)) {
    return str_replace(',', '', $matches[1][0]);
}





