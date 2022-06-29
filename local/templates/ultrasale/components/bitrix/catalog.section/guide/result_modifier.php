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

$this->setFrameMode(true);

$arSort = array("SORT" => "ASC");
$arFilter = array("IBLOCK_ID"  => $arParams["IBLOCK_ID"],
                  "SECTION_ID" => $arResult['ORIGINAL_PARAMETERS']['SECTION_ID'],
);
$rsSections = CIBlockSection::GetList($arSort, $arFilter);

$worked = false;

while ($arSection = $rsSections->GetNext()) {

    $worked = true;

    $arSort2 = array("SORT" => "ASC");
    $arFilter2 = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "SECTION_ID" => $arSection['ID']);
    $rsSections2 = CIBlockSection::GetList($arSort2, $arFilter2);
    while ($arSection2 = $rsSections2->GetNext()) {
        $tmp = [];
        $arOrder = array('SORT' => 'ASC');
        $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arParams['IBLOCK_ID'], 'SECTION_ID' => $arSection2['ID']);
        $arSelectFields = array('ID', 'ACTIVE', 'NAME', 'DETAIL_PAGE_URL');
        $rsElements = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelectFields);
        $rsElements->SetUrlTemplates($arResult['ORIGINAL_PARAMETERS']['DETAIL_URL']);
        while ($arElement = $rsElements->GetNext()) {
            $tmp[] = $arElement;
        }
        $arSection2['ITEMS'] = $tmp;
        $arResult['ElementsBySubSection'][$arSection['CODE']][] = $arSection2;
        unset ($tmp);
    }
}

if ($worked == false){
    header('location: /guide/');
}