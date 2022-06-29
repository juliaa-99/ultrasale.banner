<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array /
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

$arSelect = array("ID", "NAME");
$arFilter = array("IBLOCK_ID" => 21,"CODE" => $arResult["VARIABLES"]['ELEMENT_CODE']);
$res = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false, array("nPageSize" => 1, 'iNumPage' => 1), $arSelect);
if ($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $brand = $arFields;
}

$GLOBALS['arFilter']['PROPERTY_SERIAS3'] = $brand['ID'];

$APPLICATION->SetTitle($brand['NAME']);

$GLOBALS['elementFilter'] = ['PROPERTY_BRAND'=>$brand['ID']];

$arResult["FOLDER"] = '/catalog/';
$arResult["URL_TEMPLATES"]["element"] = '#SECTION_CODE_PATH#/#ELEMENT_CODE#/';

//dump($arResult['VARIABLES']["ELEMENT_CODE"]);
$arSelect = array("ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_BRAND");
$arFilter = array("IBLOCK_ID" => 21, "CODE" => $arResult['VARIABLES']["ELEMENT_CODE"]);
$res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1), $arSelect);
if ($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arResult['PREVIEW_TEXT'] = $arFields['~PREVIEW_TEXT'];
    $arResult['DETAIL_TEXT'] = $arFields['~DETAIL_TEXT'];

//    echo $arFields['~PROPERTY_BRAND_VALUE'];

    $link_name = strip_tags($arFields['~PROPERTY_BRAND_VALUE']);
    preg_match("/href=\"(.+?)\"/",$arFields['~PROPERTY_BRAND_VALUE'],$matches);
    $link_link = $matches[1];

    $APPLICATION->AddChainItem($link_name, $link_link);
}

$APPLICATION->AddChainItem($brand['NAME'], "#");





//COOKEIE
if (!defined('BASE_PRICE_ID')) {
    define('BASE_PRICE_ID',1);
}

$GLOBALS['catalog_sorts'] = [
    'price' => [
        'CODE' => 'CATALOG_PRICE_'.BASE_PRICE_ID,
        'NAME' => 'По цене'],
    'name' => [
        'CODE' => 'NAME',
        'NAME' => 'По алфавиту',
    ],
    'popularity' => [
        'CODE' => 'SHOW_COUNTER',
        'NAME' => 'По популярности',
    ]
];




?>
<div class="catalog-page">
    <div class="container">
        <div class="title-main">
            <h1><?$APPLICATION->ShowTitle(false);?></h1>
        </div>
        <div class="custcont"><?=$arResult['PREVIEW_TEXT']?></div>

        <!--            sort line component artem-->
        <?
        $APPLICATION->IncludeComponent(
            "custom:sort_line",
            ".default",
            array(
                "SORTS" =>  $GLOBALS['catalog_sorts'],
                "VIEW_TYPES" => ['tile4','list'],

                "ELEMENT_SORT_FIELD" => (!empty($_COOKIE['sort1'])) ? $_COOKIE['sort1'] : $GLOBALS['catalog_sorts']['price']['CODE'],
                "ELEMENT_SORT_ORDER" => (!empty($_COOKIE['order1'])) ? $_COOKIE['order1'] : 'ASC',
                "ELEMENT_SORT_FIELD2" => '',
                "ELEMENT_SORT_ORDER2" => '',

                'EXT_VIEW_TYPE' => (!empty($_COOKIE['catalog_view_type'])) ? $_COOKIE['catalog_view_type'] : 'tile4',
                "PAGE_ELEMENT_COUNT" => (!empty($_COOKIE['catalog_count_to_view'])) ? $_COOKIE['catalog_count_to_view'] : '12',
//                    'HIDE_NOT_AVAILABLE' => (!empty($_COOKIE['catalog_product_quantity'])) ? $_COOKIE['catalog_product_quantity'] : 'N',

                "AVAILABLE_TYPE" => (!empty($_GET['available_type'])) ? $_GET['available_type'] : '0',
            ),
            $component
        );

        switch ($_GET['available_type']){
            case 1:
                $hide_not_available = 'Y';
                break;
            case 2:
                $GLOBALS['arFilter']['CATALOG_QUANTITY'] = 0;
                $hide_not_available = 'N';
                break;
            case 3:
                $GLOBALS['arFilter']['PROPERTY_SNIATO_Z_PROZVODSTVA_VALUE'] = 'Да';
                $hide_not_available = 'N';
                break;
            default:
                $hide_not_available = 'L';
                break;
        }
//        dump((!empty($_COOKIE['catalog_view_type'])) ? $_COOKIE['catalog_view_type'] : 'tile4');
        ?>
        <!--            /sort line component artem-->

        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "affetta",
            Array(

//                   sort_line controll
//                   sorts
                "ELEMENT_SORT_FIELD" => (!empty($_COOKIE['sort1'])) ? $_COOKIE['sort1'] : $GLOBALS['catalog_sorts']['price']['CODE'],
                "ELEMENT_SORT_ORDER" => (!empty($_COOKIE['order1'])) ? $_COOKIE['order1'] : 'ASC',
                "ELEMENT_SORT_FIELD2" => '',
                "ELEMENT_SORT_ORDER2" => '',
//                   /sorts

                'EXT_VIEW_TYPE' => (!empty($_COOKIE['catalog_view_type'])) ? $_COOKIE['catalog_view_type'] : 'tile4',
                "PAGE_ELEMENT_COUNT" => (!empty($_COOKIE['catalog_count_to_view'])) ? $_COOKIE['catalog_count_to_view'] : '12',
                'HIDE_NOT_AVAILABLE' => (!empty($hide_not_available)) ? $hide_not_available : 'N',
//                   /sort_line controll

                "ACTION_VARIABLE" => "",
                "ADD_PICT_PROP" => "-",
                "ADD_PROPERTIES_TO_BASKET" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "BACKGROUND_IMAGE" => "",
                "BASKET_URL" => "",
                "BRAND_PROPERTY" => null,
                "BROWSER_TITLE" => "-",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
                "COMPARE_PATH" => "/catalog/compare.php",
                "COMPATIBLE_MODE" => "N",
                "COMPONENT_TEMPLATE" => "affetta",
                "CONVERT_CURRENCY" => "Y",
                "CURRENCY_ID" => "RUB",
                "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                "DATA_LAYER_NAME" => null,
                "DETAIL_URL" => "/product/#ELEMENT_CODE#/",
                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                "DISCOUNT_PERCENT_POSITION" => null,
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_COMPARE" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "ENLARGE_PRODUCT" => "STRICT",
                "ENLARGE_PROP" => null,
                "FILE_404" => "",
                "FILTER_NAME" => "arFilter",
                "HIDE_NOT_AVAILABLE_OFFERS" => "Y",
                "IBLOCK_ID" => "13",
                "IBLOCK_TYPE" => "ultrasale",
                "INCLUDE_SUBSECTIONS" => "Y",
                "LABEL_PROP" => array(),
                "LABEL_PROP_MOBILE" => "",
                "LABEL_PROP_POSITION" => null,
                "LAZY_LOAD" => "N",
                "LINE_ELEMENT_COUNT" => null,
                "LOAD_ON_SCROLL" => "N",
                "MESSAGE_404" => null,
                "MESS_BTN_ADD_TO_BASKET" => "",
                "MESS_BTN_BUY" => "",
                "MESS_BTN_COMPARE" => null,
                "MESS_BTN_DETAIL" => "",
                "MESS_BTN_LAZY_LOAD" => null,
                "MESS_BTN_SUBSCRIBE" => "",
                "MESS_NOT_AVAILABLE" => "",
                "MESS_RELATIVE_QUANTITY_FEW" => null,
                "MESS_RELATIVE_QUANTITY_MANY" => null,
                "MESS_SHOW_MAX_QUANTITY" => "",
                "META_DESCRIPTION" => "",
                "META_KEYWORDS" => "",
                "OFFERS_CART_PROPERTIES" => null,
                "OFFERS_FIELD_CODE" => null,
                "OFFERS_LIMIT" => "",
                "OFFERS_PROPERTY_CODE" => null,
                "OFFERS_SORT_FIELD" => null,
                "OFFERS_SORT_FIELD2" => null,
                "OFFERS_SORT_ORDER" => null,
                "OFFERS_SORT_ORDER2" => null,
                "OFFER_ADD_PICT_PROP" => null,
                "OFFER_TREE_PROPS" => null,
                "PAGER_BASE_LINK" => null,
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_PARAMS_NAME" => null,
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "main",
                "PAGER_TITLE" => "",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(0=>"BASE",),
                "PRICE_VAT_INCLUDE" => "N",
                "PRODUCT_BLOCKS_ORDER" => null,
                "PRODUCT_DISPLAY_MODE" => null,
                "PRODUCT_ID_VARIABLE" => "",
                "PRODUCT_PROPERTIES" => null,
                "PRODUCT_PROPS_VARIABLE" => null,
                "PRODUCT_QUANTITY_VARIABLE" => null,
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "N",
                "PROPERTY_CODE" => null,
                "PROPERTY_CODE_MOBILE" => array(),
                "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                "RCM_TYPE" => "personal",
                "RELATIVE_QUANTITY_FACTOR" => null,
                "SECTION_CODE" => "",
                "SECTION_ID" => "",
                "SECTION_ID_VARIABLE" => "",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
                "SEF_MODE" => "N",
                "SET_BROWSER_TITLE" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "Y",
                "SET_TITLE" => "Y",
                "SHOW_404" => "Y",
                "SHOW_ALL_WO_SECTION" => "N",
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_FROM_SECTION" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "N",
                "SHOW_PRICE_COUNT" => "",
                "SHOW_SLIDER" => "N",
                "SLIDER_INTERVAL" => null,
                "SLIDER_PROGRESS" => null,
                "TEMPLATE_THEME" => "",
                "USE_COMPARE_LIST" => "Y",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N"
            ),
            $component
        );?>
        <div class="custcont"><?=$arResult['DETAIL_TEXT']?></div>
    </div>
</div>