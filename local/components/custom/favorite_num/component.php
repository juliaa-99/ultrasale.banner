<?php
if (!defined('FAV_ID')) {
define('FAV_ID', 2);
}
if (!defined('CATALOG_ID')) {
define('CATALOG_ID', 13);
}
global $USER;
if (CModule::IncludeModule('highloadblock') && CModule::IncludeModule('iblock')) {
    $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(FAV_ID)->fetch();
    $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
    $strEntityDataClass = $obEntity->getDataClass();

    $arFilter = array('UF_USER_ID' => $USER->GetID());

    $rsData = $strEntityDataClass::getList(array(
        'select' => array('ID', 'UF_WARE', 'UF_TYPE'),
        'order' => array('UF_DATE_ADD' => 'DESC'),
        'filter' => $arFilter,
    ));

    $arResult = count($rsData->fetchAll());
    $this->includeComponentTemplate();
}
