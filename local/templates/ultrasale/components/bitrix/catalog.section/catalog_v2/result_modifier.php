<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent  $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


if ((count($GLOBALS[$arParams['FILTER_NAME']])>0 and count($GLOBALS[$arParams['FILTER_NAME']])<3 and
        count($GLOBALS[$arParams['FILTER_NAME']]['=PROPERTY_33']) == 1
        and $GLOBALS[$arParams['FILTER_NAME']]['["><CATALOG_PRICE_1"]'][0] == $GLOBALS[$arParams['FILTER_NAME']]['["><CATALOG_PRICE_1"]'][1]
    ) or empty($GLOBALS[$arParams['FILTER_NAME']])) {
    $arResult['Tags'] = getBrandsForSection($arResult['ORIGINAL_PARAMETERS']['SECTION_ID']);
    if ($arResult['Tags'] == []) {
        unset ($arResult['Tags']);
    }
}
