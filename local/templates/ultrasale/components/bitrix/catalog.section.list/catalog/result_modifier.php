<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<?php
/**
 * Created by PhpStorm.
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 */
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


$aResult = $arResult;
$displayType = [];
$sectionTree = [];
$arResult['SECTIONS'] = [];
$counter = 0;

foreach ($aResult['SECTIONS'] as $section) {

    if ($section['UF_VISUAL_MULTIPLIER'] !== null) {

        if (!isset($displayType[$section['UF_VISUAL_MULTIPLIER']])) {
            $obEnum = new \CUserFieldEnum;
            $rsEnum = $obEnum->GetList(array(),
                array("USER_FIELD_NAME" => "UF_VISUAL_MULTIPLIER", "ID" => $section['UF_VISUAL_MULTIPLIER']));

            while ($arEnum = $rsEnum->Fetch()) {
                $displayType[$section['UF_VISUAL_MULTIPLIER']] = $arEnum["XML_ID"];
            }
        }
        $section['UfDisplayType'] = $displayType[$section['UF_VISUAL_MULTIPLIER']];
        if ($section['UfDisplayType'] == 'double') {
            $section['Class']['div'] = 'col-xl-6 col-lg-4 col-md-6';
        } else {
            $section['Class']['div'] = 'col-xl-3 col-lg-4 col-md-6';
        }
    } else {
        $section['Class']['div'] = 'col-xl-3 col-lg-4 col-md-6';
    }
    $arResult['SECTIONS'][$section['ID']] = $section;
    unset($section['UfDisplayType']);
}

