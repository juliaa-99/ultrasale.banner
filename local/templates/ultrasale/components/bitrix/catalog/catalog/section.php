<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
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
/** @var array $arCurSection */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
    $arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isFilter = ($arParams['USE_FILTER'] == 'Y');

if ($isFilter)
{
    $arFilter = array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
    );
    if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
        $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
    elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
        $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

    $obCache = new CPHPCache();
    if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
    {
        $arCurSection = $obCache->GetVars();
    }
    elseif ($obCache->StartDataCache())
    {
        $arCurSection = array();
        if (Loader::includeModule("iblock"))
        {
            $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

            if(defined("BX_COMP_MANAGED_CACHE"))
            {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                if ($arCurSection = $dbRes->Fetch())
                    $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

                $CACHE_MANAGER->EndTagCache();
            }
            else
            {
                if(!$arCurSection = $dbRes->Fetch())
                    $arCurSection = array();
            }
        }
        $obCache->EndDataCache($arCurSection);
    }
    if (!isset($arCurSection))
        $arCurSection = array();
}
?>
<?php
// //$sectionCode = $arResult['VARIABLES']['SECTION_CODE_PATH'];
//if (strpos($arResult['VARIABLES']['SECTION_CODE_PATH'],'/')>0) {
//    $tmp = explode('/',$arResult['VARIABLES']['SECTION_CODE_PATH']);
//    $sectionCode = $tmp[0];
//}
?>
<div class="catalog-page">
    <div class="container">
        <div class="catalog-page__inner">
            <div class="catalog-page__left">
                <div class="filter">
                    <div class="filter__top-tt">????????????</div>
                    <div class="filter__top-close js-filter-close"><img
                                src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/close.svg" alt=""></div>
                    <div class="filter__list">
                        <div class="filter__item open">
                            <div class="filter__title open">??????????????????</div>
                            <div class="filter__container">
                                <?
                                $APPLICATION->IncludeComponent(
                                	"bitrix:catalog.section.list",
                                	"catalog_sidebar",
                                	array(
                                		// region ???????????????? ??????????????????
                                		"IBLOCK_TYPE"          =>  $arParams['IBLOCK_TYPE'],
                                		"IBLOCK_ID"            =>  $arParams['IBLOCK_ID'],
                                		"SECTION_ID"           =>  $arResult["VARIABLES"]["SECTION_ID"],
                                		"SECTION_CODE"         =>  $arResult["VARIABLES"]["SECTION_CODE"],
                                		// endregion
                                		// region ???????????????? ????????????
                                		"COUNT_ELEMENTS"       =>  "N",
                                		"TOP_DEPTH"            =>  "1",
                                		"SECTION_FIELDS"       =>  array(''),
                                		"SECTION_USER_FIELDS"  =>  array(''),
                                		// endregion
                                		// region ?????????????? ????????????
                                		"SECTION_URL"          =>  "",
                                		// endregion
                                		// region ?????????????????? ??????????????????????
                                		"CACHE_TYPE"           =>  "A",
                                		"CACHE_TIME"           =>  "36000000",
                                		"CACHE_NOTES"          =>  "",
                                		"CACHE_GROUPS"         =>  "Y",
                                		// endregion
                                		// region ???????????????????????????? ??????????????????
                                		"ADD_SECTIONS_CHAIN"   =>  "Y",
                                		// endregion
                                	),
                                    $component
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "catalog", array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arCurSection['ID'],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PRICE_CODE" => $arParams["~PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "Y",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => $arParams["SEF_MODE"],
                        "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                        "DISPLAY_ELEMENT_COUNT" => 'N',
                    ),
                        $component,
                        array('HIDE_ICONS' => 'Y')
                    );
                    ?>

                </div>
            </div>
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "catalog_v2",
                array(
                    "IBLOCK_TYPE"               => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID"                 => $arParams["IBLOCK_ID"],
                    "ELEMENT_SORT_FIELD"        => $arParams["ELEMENT_SORT_FIELD"],
                    "ELEMENT_SORT_ORDER"        => $arParams["ELEMENT_SORT_ORDER"],
                    "ELEMENT_SORT_FIELD2"       => $arParams["ELEMENT_SORT_FIELD2"],
                    "ELEMENT_SORT_ORDER2"       => $arParams["ELEMENT_SORT_ORDER2"],
                    "PROPERTY_CODE"             => $arParams["LIST_PROPERTY_CODE"],
                    "META_KEYWORDS"             => $arParams["LIST_META_KEYWORDS"],
                    "META_DESCRIPTION"          => $arParams["LIST_META_DESCRIPTION"],
                    "BROWSER_TITLE"             => $arParams["LIST_BROWSER_TITLE"],
                    "SET_LAST_MODIFIED"         => $arParams["SET_LAST_MODIFIED"],
                    "INCLUDE_SUBSECTIONS"       => $arParams["INCLUDE_SUBSECTIONS"],
                    "BASKET_URL"                => $arParams["BASKET_URL"],
                    "ACTION_VARIABLE"           => $arParams["ACTION_VARIABLE"],
                    "PRODUCT_ID_VARIABLE"       => $arParams["PRODUCT_ID_VARIABLE"],
                    "SECTION_ID_VARIABLE"       => $arParams["SECTION_ID_VARIABLE"],
                    "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                    "PRODUCT_PROPS_VARIABLE"    => $arParams["PRODUCT_PROPS_VARIABLE"],
                    "FILTER_NAME"               => $arParams["FILTER_NAME"],
                    "CACHE_TYPE"                => $arParams["CACHE_TYPE"],
                    "CACHE_TIME"                => $arParams["CACHE_TIME"],
                    "CACHE_FILTER"              => $arParams["CACHE_FILTER"],
                    "CACHE_GROUPS"              => $arParams["CACHE_GROUPS"],
                    "SET_TITLE"                 => $arParams["SET_TITLE"],
                    "MESSAGE_404"               => $arParams["MESSAGE_404"],
                    "SET_STATUS_404"            => $arParams["SET_STATUS_404"],
                    "SHOW_404"                  => $arParams["SHOW_404"],
                    "FILE_404"                  => $arParams["FILE_404"],
                    "DISPLAY_COMPARE"           => $arParams["USE_COMPARE"],
                    "PAGE_ELEMENT_COUNT"        => $arParams["PAGE_ELEMENT_COUNT"],
                    "LINE_ELEMENT_COUNT"        => $arParams["LINE_ELEMENT_COUNT"],
                    "PRICE_CODE"                => $arParams["PRICE_CODE"],
                    "USE_PRICE_COUNT"           => $arParams["USE_PRICE_COUNT"],
                    "SHOW_PRICE_COUNT"          => $arParams["SHOW_PRICE_COUNT"],

                    "PRICE_VAT_INCLUDE"          => $arParams["PRICE_VAT_INCLUDE"],
                    "USE_PRODUCT_QUANTITY"       => $arParams['USE_PRODUCT_QUANTITY'],
                    "ADD_PROPERTIES_TO_BASKET"   => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                    "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                    "PRODUCT_PROPERTIES"         => $arParams["PRODUCT_PROPERTIES"],

                    "DISPLAY_TOP_PAGER"               => $arParams["DISPLAY_TOP_PAGER"],
                    "DISPLAY_BOTTOM_PAGER"            => $arParams["DISPLAY_BOTTOM_PAGER"],
                    "PAGER_TITLE"                     => $arParams["PAGER_TITLE"],
                    "PAGER_SHOW_ALWAYS"               => $arParams["PAGER_SHOW_ALWAYS"],
                    "PAGER_TEMPLATE"                  => $arParams["PAGER_TEMPLATE"],
                    "PAGER_DESC_NUMBERING"            => $arParams["PAGER_DESC_NUMBERING"],
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                    "PAGER_SHOW_ALL"                  => $arParams["PAGER_SHOW_ALL"],
                    "PAGER_BASE_LINK_ENABLE"          => $arParams["PAGER_BASE_LINK_ENABLE"],
                    "PAGER_BASE_LINK"                 => $arParams["PAGER_BASE_LINK"],
                    "PAGER_PARAMS_NAME"               => $arParams["PAGER_PARAMS_NAME"],

                    "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                    "OFFERS_FIELD_CODE"      => $arParams["LIST_OFFERS_FIELD_CODE"],
                    "OFFERS_PROPERTY_CODE"   => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                    "OFFERS_SORT_FIELD"      => $arParams["OFFERS_SORT_FIELD"],
                    "OFFERS_SORT_ORDER"      => $arParams["OFFERS_SORT_ORDER"],
                    "OFFERS_SORT_FIELD2"     => $arParams["OFFERS_SORT_FIELD2"],
                    "OFFERS_SORT_ORDER2"     => $arParams["OFFERS_SORT_ORDER2"],
                    "OFFERS_LIMIT"           => $arParams["LIST_OFFERS_LIMIT"],

                    "SECTION_ID"               => $arResult["VARIABLES"]["SECTION_ID"],
                    "SECTION_CODE"             => $arResult["VARIABLES"]["SECTION_CODE"],
                    "SECTION_URL"              => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                    "DETAIL_URL"               => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                    "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                    'CONVERT_CURRENCY'         => $arParams['CONVERT_CURRENCY'],
                    'CURRENCY_ID'              => $arParams['CURRENCY_ID'],
                    'HIDE_NOT_AVAILABLE'       => $arParams["HIDE_NOT_AVAILABLE"],

                    'LABEL_PROP'           => $arParams['LABEL_PROP'],
                    'ADD_PICT_PROP'        => $arParams['ADD_PICT_PROP'],
                    'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                    'OFFER_ADD_PICT_PROP'    => $arParams['OFFER_ADD_PICT_PROP'],
                    'OFFER_TREE_PROPS'       => $arParams['OFFER_TREE_PROPS'],
                    'PRODUCT_SUBSCRIPTION'   => $arParams['PRODUCT_SUBSCRIPTION'],
                    'SHOW_DISCOUNT_PERCENT'  => $arParams['SHOW_DISCOUNT_PERCENT'],
                    'SHOW_OLD_PRICE'         => $arParams['SHOW_OLD_PRICE'],
                    'MESS_BTN_BUY'           => $arParams['MESS_BTN_BUY'],
                    'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                    'MESS_BTN_SUBSCRIBE'     => $arParams['MESS_BTN_SUBSCRIBE'],
                    'MESS_BTN_DETAIL'        => $arParams['MESS_BTN_DETAIL'],
                    'MESS_NOT_AVAILABLE'     => $arParams['MESS_NOT_AVAILABLE'],
                    'MESS_BTN_LAZY_LOAD'     => '???????????????? ??????',
                    'LAZY_LOAD'             => 'Y',

                    'TEMPLATE_THEME'       => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                    "ADD_SECTIONS_CHAIN"   => "N",
                    'ADD_TO_BASKET_ACTION' => $basketAction,
                    'SHOW_CLOSE_POPUP'     => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                    'COMPARE_PATH'         => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                    'EXT_SORT'             => $arParams['EXT_SORT'],
                    'EXT_REV_SORT'         => $arParams['EXT_REV_SORT'],
                    'EXT_VIEW_TYPE'        => $arParams['EXT_VIEW_TYPE'],
                ),
                $component
            );
            ?>
        </div>
    </div>
</div>
