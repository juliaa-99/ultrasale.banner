<?php
/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 24.12.2021
 */
/**
* @var CBitrixComponentTemplate $this
* @var CatalogElementComponent $component
* @var $arResult
*/


/* Обрабатываем бренды */
if(!empty($arResult['ITEM']['PROPERTIES']['BRAND']['VALUE'])) {
    $arOrder = array('SORT' => 'ASC');
    $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => BRANDS_IBLOCK, 'ID' => $arResult['ITEM']['PROPERTIES']['BRAND']['VALUE']);
    $arSelectFields = array('ID', 'ACTIVE', 'NAME', 'DETAIL_PAGE_URL');
    $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);
    if ($arElement = $rsElements->GetNext()) {
        $arResult['ITEM']['DISPLAY_PROPERTIES']['Brand']['NAME'] = $arElement['NAME'];
        $arResult['ITEM']['DISPLAY_PROPERTIES']['Brand']['SRC'] = $arElement['DETAIL_PAGE_URL'];
    }
}

/* Обрабатываем серии */
if(!empty($arResult['ITEM']['PROPERTIES']['SERIAS3']['VALUE'])) {
    $arOrder = array('SORT' => 'ASC');
    $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => SERIAS_IBLOCK, 'ID' => $arResult['ITEM']['PROPERTIES']['SERIAS3']['VALUE']);
    $arSelectFields = array('ID', 'ACTIVE', 'NAME', 'DETAIL_PAGE_URL');
    $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);
    if ($arElement = $rsElements->GetNext()) {
        $arResult['ITEM']['DISPLAY_PROPERTIES']['Seria']['NAME'] = $arElement['NAME'];
        $arResult['ITEM']['DISPLAY_PROPERTIES']['Seria']['SRC'] = $arElement['DETAIL_PAGE_URL'];
    }
}
