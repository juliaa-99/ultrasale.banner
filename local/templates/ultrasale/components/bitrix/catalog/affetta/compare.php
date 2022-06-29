<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.compare.result",
    "affetta2",
    array(
        "ACTION_VARIABLE" => "action",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BASKET_URL" => "/personal/basket.php",
        "CONVERT_CURRENCY" => "N",
        "DETAIL_URL" => "",
        "DISPLAY_ELEMENT_SELECT_BOX" => "N",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD_BOX" => "name",
        "ELEMENT_SORT_FIELD_BOX2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER_BOX" => "asc",
        "ELEMENT_SORT_ORDER_BOX2" => "desc",
        "FIELD_CODE" => array(
            0 => "PREVIEW_PICTURE",
        ),
        "HIDE_NOT_AVAILABLE" => "N",
        "IBLOCK_ID" => "13",
        "IBLOCK_TYPE" => "ultrasale",
        "NAME" => "CATALOG_COMPARE_LIST",
        "PRICE_CODE" => array(
            0 => "BASE",
        ),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SHOW_PRICE_COUNT" => "1",
        "TEMPLATE_THEME" => "blue",
        "USE_PRICE_COUNT" => "N",
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
);?>