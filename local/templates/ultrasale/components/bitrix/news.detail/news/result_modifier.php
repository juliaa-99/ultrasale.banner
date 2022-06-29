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
if (!empty($arResult['PROPERTIES']['SLIDER_PHOTO']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['SLIDER_PHOTO']['VALUE'] as &$arItem) {
        $arItem = array(
            "THUMBNAIL" => CFile::ResizeImageGet($arItem, array("width" => 512, "height" => 512)),
            "PREVIEW" => CFile::ResizeImageGet($arItem, array("width" => 512, "height" => 512)),
            "ORIGINAL" => CFile::GetFileArray($arItem)
        );
    }
}
