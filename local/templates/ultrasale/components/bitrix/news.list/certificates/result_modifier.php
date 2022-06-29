<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) { die(); }
/**
 * @var array $arResult
 */
$aResult = $arResult;
foreach ($aResult['ITEMS'] as $key => $item) {
    if (!isset($item['PROPERTIES']['URL']['VALUE']) OR $item['PROPERTIES']['URL']['VALUE'] == "")
    $arResult['ITEMS'][$key]['PROPERTIES']['URL']['VALUE'] = '#';
}
