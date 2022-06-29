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

if (!empty($arResult['PROPERTIES']['INSTRUCTION_FILE']['VALUE'])) {
    $tmp = CFile::GetFileArray($arResult['PROPERTIES']['INSTRUCTION_FILE']['VALUE']);
    $arResult['PROPERTIES']['INSTRUCTION_FILE'] = $tmp;
}

if (!empty($arResult['PROPERTIES']['COVER_PHOTO']['VALUE'])) {
    $tmp = CFile::GetFileArray($arResult['PROPERTIES']['COVER_PHOTO']['VALUE']);
    $arResult['PROPERTIES']['COVER_PHOTO'] = $tmp;
}
