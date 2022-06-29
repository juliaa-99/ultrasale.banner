<?php
/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 12.12.2021
 */
\Bitrix\Main\Loader::includeModule('iblock');

if (!empty($arResult['ITEM'])) {
    foreach ($arResult['ITEM']['PROPERTIES'] as &$property) {
        if ($property['PROPERTY_TYPE'] == 'E') {
            $arOrder = array('SORT' => 'ASC');
            $arFilter = array('ACTIVE'=>'Y','IBLOCK_ID'=>$property['LINK_IBLOCK_ID'], 'ID'=>$property['VALUE']);
            $arSelectFields = array('ID', 'ACTIVE', 'NAME','DETAIL_PAGE_URL');
            $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);
            if ($arElement = $rsElements->GetNext())
            {
                $property['VALUE'] = '<a href="'.$arElement['DETAIL_PAGE_URL'].'">'.$arElement['NAME']."</a>";
            }
        }
    }

}