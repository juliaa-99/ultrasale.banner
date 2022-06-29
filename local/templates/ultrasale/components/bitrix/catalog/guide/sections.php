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

$this->setFrameMode(false);
if (!empty($_REQUEST['what']) && $_REQUEST['what']!='all') {
    if ($_REQUEST['what'] == "dgt") {
        $GLOBALS['arrSectionFilter'] = ['>NAME'=>0,'<=NAME'=>9];
    } elseif ($_REQUEST['what'] == 'cyr') {
        $GLOBALS['arrSectionFilter'] = ['>NAME'=>'А'];
    } else {
        $GLOBALS['arrSectionFilter'] = ['NAME'=>$_REQUEST['what'].'%'];
    }
}

    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "guide",
        array(
            "IBLOCK_TYPE"         => $arParams['IBLOCK_TYPE'],
            "IBLOCK_ID"           => $arParams['IBLOCK_ID'],
            "SECTION_ID"          => "",
            "SECTION_CODE"        => "",
            "COUNT_ELEMENTS"      => "N",
            "TOP_DEPTH"           => "1",
            "SECTION_FIELDS"      => array(''),
            "SECTION_USER_FIELDS" => array(''),
            "SECTION_URL"         => "",
            "CACHE_TYPE"          => "A",
            "CACHE_TIME"          => "36000000",
            "CACHE_NOTES"         => "",
            "CACHE_GROUPS"        => "Y",
            "ADD_SECTIONS_CHAIN"  => "Y",
            "FILTER_NAME"           => "arrSectionFilter"
        ),
        $component
    );
    ?>


