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


/*
 * ==============type===1003========**真融宝为用户赚取的收益
 */

return 0;


/**
 *  ==============type===1004========**真融宝定期产品总投资额
 */

$contents = file_get_contents('https://www.zhenrongbao.com/dingqi');
$pattern = '/<p class="line-1">(.*)<\/p>/i';
preg_match_all($pattern, $contents, $matches);
if (!empty($matches) && is_array($matches)) {
    return  str_replace('￥', '', str_replace(',', '', $matches[1][1]));
}

/**
 *  ==============type===1005========**真融宝定期产品投资总人数
 */
$contents = file_get_contents('https://www.zhenrongbao.com/dingqi');
$pattern = '/<p class="line-1">(.*)<\/p>/i';
preg_match_all($pattern, $contents, $matches);
if (!empty($matches) && is_array($matches)) {
    return  $matches[1][0];
}


/**
 *  ==============type===1006========**真融宝定期产品帮用户赚取的金额
 */

$contents = file_get_contents('https://www.zhenrongbao.com/dingqi');
$pattern = '/<p class="line-1">(.*)<\/p>/i';
preg_match_all($pattern, $contents, $matches);
if (!empty($matches) && is_array($matches)) {
    return  str_replace('￥', '', str_replace(',', '', $matches[1][2]));
}



