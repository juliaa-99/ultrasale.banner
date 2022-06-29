<?php
/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 12.11.2021
 */

$aResult = $arResult;
$displayType = [];
$sectionTree = [];
$arResult['SECTIONS'] = [];
$counter = 0;
if ($arParams['SECTION_SORT_FIELD'] == 'LEFT_MARGIN') {
    foreach ($aResult['SECTIONS'] as $section) {
        if (!isset($displayType[$section['UF_DISPLAY_TYPE']])) {
            $obEnum = new \CUserFieldEnum;
            $rsEnum = $obEnum->GetList(array(), array("USER_FIELD_NAME"=>"UF_DISPLAY_TYPE", "ID" =>$section['UF_DISPLAY_TYPE']));

            while($arEnum = $rsEnum->Fetch())
            {
                $displayType[$section['UF_DISPLAY_TYPE']] = $arEnum["XML_ID"];
            }
        }
        $section['UfDisplayType'] = $displayType[$section['UF_DISPLAY_TYPE']];
        $section['IsParent'] = !(($section['RIGHT_MARGIN'] - $section['LEFT_MARGIN'] == 1));
        if ($section['UfDisplayType'] == 'double') {
            $section['Class']['div'] = 'col-xl-6 col-lg-6 col-md-12 ord';
            $section['Class']['a'] = 'services__item-im';
        } else {
            if ($counter == 3 or $counter == 6) {
                $section['Class']['div'] = 'col-xl-3 col-lg-3 col-md-12 ord';
            } else {
                $section['Class']['div'] = 'col-xl-3 col-lg-3 col-md-6 ord';
            }
            $section['Class']['a'] = '';
        }
        if ($section['IBLOCK_SECTION_ID'] != NULL) {
            $arResult['SECTIONS'][$section['IBLOCK_SECTION_ID']]['Children'][] = $section;
        } else {
            $counter++;
            $arResult['SECTIONS'][$section['ID']]['Children'] = [];
            $arResult['SECTIONS'][$section['ID']] = $section;
        }
    }
}

$arResult['SECTIONS'] = array_slice($arResult['SECTIONS'], 0, 4);