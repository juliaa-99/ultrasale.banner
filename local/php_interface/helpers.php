<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
use \Bitrix\Main\Data\Cache;
use Bitrix\Main\Entity;
use Bitrix\Iblock;

/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 */
global $USER;

if (!defined('BRANDS_IBLOCK')) {
    /**
     * Инфоблок брендов
     */
    define ('BRANDS_IBLOCK', 14);
}
if (!defined('SERIAS_IBLOCK')) {
    /**
     * Инфоблок серий
     */
    define ('SERIAS_IBLOCK', 21);
}
if (!defined('CATALOG_IBLOCK')) {
    /**
     * Инфоблок каталога
     */
    define ('CATALOG_IBLOCK', 13);
}


function countFavs()
{
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
            'order'  => array('UF_DATE_ADD' => 'DESC'),
            'filter' => $arFilter,
        ));

        return count($rsData->fetchAll());
    } else {
        return -1;
    }
}

function isInFav($iId, $iUser = false)
{

    global $USER;
    $aResult = false;

    if (!defined('FAV_ID')) {
        define('FAV_ID', 2);
    }
    if (!defined('CATALOG_ID')) {
        define('CATALOG_ID', 13);
    }

    if (!$iUser) {
        if ($USER->IsAuthorized()) {
            $iUser = $USER->GetID();
        } else {
            return false;
        }
    }


    $obCache = \Bitrix\Main\Data\Cache::createInstance();
    $cache_time = 600;
    $cache_id = "user_favs_" . FAV_ID . "_" . $iUser . "_" . $iId;

    if ($obCache->initCache($cache_time, $cache_id, "/ultrasale/user/favs/")) {
        $aResult = $obCache->GetVars();
    } elseif ($obCache->startDataCache()) {
        if (CModule::IncludeModule('highloadblock') && CModule::IncludeModule('iblock')) {
            $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(FAV_ID)->fetch();
            $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
            $strEntityDataClass = $obEntity->getDataClass();
            // Проверяем наличие этой записи у этого юзера
            $arFilter = array('UF_USER_ID' => $iUser, 'UF_WARE' => $iId);

            $rsData = $strEntityDataClass::getList(array(
                'select' => array('ID', 'UF_WARE', 'UF_TYPE'),
                'order'  => array('UF_DATE_ADD' => 'DESC'),
                'filter' => $arFilter,
            ));

            if ($arItem = $rsData->Fetch()) {
                $aResult = true;
                $obCache->endDataCache($aResult);
            } else {
                $obCache->abortDataCache();
            }
        }
    }

    return $aResult;
}

function getFavsByUser($iId, $aSort = array('UF_DATE_ADD' => 'DESC'), $aSortParams = array())
{

    if (!defined('FAV_ID')) {
        define('FAV_ID', 2);
    }
    if (!defined('CATALOG_ID')) {
        define('CATALOG_ID', 13);
    }

    if (!$iId || (int)$iId == 0) {
        return false;
    }


    $arItems = array();

    //Подготовка:
    if (CModule::IncludeModule('highloadblock')) {
        $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(FAV_ID)->fetch();
        $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
        $strEntityDataClass = $obEntity->getDataClass();
    }

    $arFilter = array('UF_USER_ID' => $iId);

    $aRequestParams = array(
        'select' => array('ID', 'UF_WARE', 'UF_TYPE'),
        'order'  => $aSort,
        'filter' => $arFilter,
    );

    if (count($aSortParams)) {
        $iCurrentPage = (int)$_GET['PAGEN_1'];
        if ($iCurrentPage == 0) {
            $iCurrentPage = 1;
        }
        $nav = new \Bitrix\Main\UI\PageNavigation("PAGEN_1");
        $nav->allowAllRecords(false)
            ->setPageSize($aSortParams['COUNT'])->setCurrentPage($iCurrentPage);
        $arItems['NAV'] = $nav;
        $aRequestParams["offset"] = $nav->getOffset();
        $aRequestParams["limit"] = $nav->getLimit();
    }

    $rsData = $strEntityDataClass::getList($aRequestParams);

    if (count($aSortParams)) {
        $nav->setRecordCount($strEntityDataClass::getCount($arFilter));
    }

    while ($arItem = $rsData->Fetch()) {
        $arItems['ITEMS'][$arItem['UF_WARE']] = $arItem['UF_WARE'];
    }

    return $arItems;
}


function getManufacturerByCode($code) {
    if (empty($code)) {
        return false;
    }

    \Bitrix\Main\Loader::includeModule('iblock');
    $cache = Cache::createInstance(); // получаем экземпляр класса
    if ($cache->initCache(7200, "brandByCode_" . $code)) { // проверяем кеш и задаём настройки
        return $cache->getVars();
    } elseif ($cache->startDataCache()) {
        $arOrder = array('SORT' => 'ASC');
        $arFilter = array('ACTIVE'=>'Y','IBLOCK_ID'=>BRANDS_IBLOCK, 'CODE'=>$code);
        $arSelectFields = array('ID', 'NAME', 'PREVIEW_TEXT', 'DETAIL_TEXT');
        $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);
        if ($arElement = $rsElements->GetNext())
        {
            $cache->endDataCache($arElement); // записываем в кеш
            return $arElement;
        }
    }
    return false;
}

function getSectionsForBrand($id) {
    \Bitrix\Main\Loader::includeModule('iblock');

    $result = [];
    if (empty($id)) {
        return $result;
    }

    $cache = Cache::createInstance(); // получаем экземпляр класса
    if ($cache->initCache(7200, "sectionsByBrandId_" . $id)) { // проверяем кеш и задаём настройки
        $result = $cache->getVars();
    } elseif ($cache->startDataCache()) {
        $arOrder = array('SORT' => 'ASC');
        $arFilter = array('ACTIVE'=>'Y','IBLOCK_ID'=>CATALOG_IBLOCK, 'PROPERTY_BRAND'=>$id);
        $arSelectFields = array('IBLOCK_SECTION_ID');
        $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);
        while ($arElement = $rsElements->GetNext())
        {
            if (!$result[$arElement['IBLOCK_SECTION_ID']]) {
                $result[$arElement['IBLOCK_SECTION_ID']] = true;
            }
        }
        $cache->endDataCache($result); // записываем в кеш
    }
    return ($result == [])?($result):(array_keys($result));

}


function getBrandsForSection($code = '') {

    \Bitrix\Main\Loader::includeModule('iblock');

    $result = [];
    if (empty($code)) {
        return $result;
    }
    if (is_numeric($code)) {
        $id = $code;
    } else {
        if (!$id = getSectionIdByCode($code)) {
            return $result;
        }
    }

    $cache = Cache::createInstance(); // получаем экземпляр класса
    if ($cache->initCache(7200, "brandsBySectionCode_" . $id)) { // проверяем кеш и задаём настройки
        $result = $cache->getVars();
    } elseif ($cache->startDataCache()) {
        $arOrder = array('SORT' => 'ASC');
        $arFilter = array('ACTIVE'=>'Y','IBLOCK_ID'=>CATALOG_IBLOCK, 'SECTION_ID'=>$id);
        $arSelectFields = array('PROPERTY_BRAND');
        $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);
        while ($arElement = $rsElements->GetNext())
        {
            if (!$result[$arElement['PROPERTY_BRAND_VALUE']]) {
                $arOrderEx = array('SORT' => 'ASC');
                $arFilterEx = array('ACTIVE'=>'Y','IBLOCK_ID'=>BRANDS_IBLOCK, 'ID'=>$arElement['PROPERTY_BRAND_VALUE']);
                $arSelectFieldsEx = array('ID', 'ACTIVE', 'NAME', 'CODE');
                $rsElementsEx = CIBlockElement::GetList($arOrderEx, $arFilterEx, FALSE, FALSE, $arSelectFieldsEx);
                if ($arElementEx = $rsElementsEx->GetNext())
                {
                    $result[$arElement['PROPERTY_BRAND_VALUE']] = $arElementEx;
                }
            }
        }
        $cache->endDataCache($result); // записываем в кеш
    }
    return $result;

}


function getSectionIdByCode($code) {

    $arSort = array("SORT" => "ASC");
    $arFilter = array("IBLOCK_ID" => CATALOG_IBLOCK, "=CODE" => $code);
    $rsSections = CIBlockSection::GetList($arSort, $arFilter);
    if ($arSection = $rsSections->GetNext()) {
        return ($arSection['ID']);
    } else {
        return false;
    }
}

function getPropertiesForSection($id) {

    \Bitrix\Main\Loader::includeModule('iblock');

    $result = [];
    $cache = Cache::createInstance(); // получаем экземпляр класса
    if ($cache->initCache(7200, "getPropertiesForSection" . $id)) { // проверяем кеш и задаём настройки
        $result = $cache->getVars();
    } elseif ($cache->startDataCache()) {
        $res = \Bitrix\Iblock\SectionPropertyTable::getList(array('select'=>['NAME'=>'PROPERTY.NAME','CODE'=>'PROPERTY.CODE','ID'=>'PROPERTY.ID'],
                                                                  "filter"=>array("=SECTION_ID"=>$id)));
        $result = $res->fetchAll();
        $cache->endDataCache($result); // записываем в кеш
    }
    return $result;
}