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
    "custom:custom_list",
    "",
    array(
        "IBLOCK_TYPE"         => $arParams['IBLOCK_TYPE'],
        "IBLOCK_ID"           => $arParams['IBLOCK_ID'],
        "FILTER_NAME"         => "arrSectionFilter",
        "SELECT_FIELDS"       => ['NAME', 'ACTIVE'],
        "SEF_FOLDER"            => $arParams['SEF_FOLDER'],
        "URL_TEMPLATES"        => $arParams['SEF_URL_TEMPLATES']['section'],
    ),
    $component
);
