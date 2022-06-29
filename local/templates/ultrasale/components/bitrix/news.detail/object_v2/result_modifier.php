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
if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => &$arItem) {
        $arItem = array(
            "THUMBNAIL" => CFile::ResizeImageGet($arItem, array("width" => 512, "height" => 512)),
            "PREVIEW" => CFile::ResizeImageGet($arItem, array("width" => 512, "height" => 512)),
            "ORIGINAL" => CFile::GetFileArray($arItem),
            'DESCRIPTION' => $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key]
        );
    }
}

if (count($arResult['PROPERTIES']['DONE_PHOTO']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['DONE_PHOTO']['VALUE'] as $key => &$item) {
        $item = array(
            "THUMBNAIL" => CFile::ResizeImageGet($item, array("width" => 512, "height" => 512)),
            "PREVIEW" => CFile::ResizeImageGet($item, array("width" => 512, "height" => 512)),
            "ORIGINAL" => CFile::GetFileArray($item),
            'DESCRIPTION' => $arResult['PROPERTIES']['DONE_PHOTO']['DESCRIPTION'][$key]
        );
    }
}

if (!empty($arResult['PROPERTIES']['VIDEO_IMG_PLACEHOLDER']['VALUE'])) {
        $tmp = array(
            "THUMBNAIL" => CFile::ResizeImageGet($arResult['PROPERTIES']['VIDEO_IMG_PLACEHOLDER']['VALUE'], array("width" => 512, "height" => 512)),
            "PREVIEW" => CFile::ResizeImageGet($arResult['PROPERTIES']['VIDEO_IMG_PLACEHOLDER']['VALUE'], array("width" => 840, "height" => 544)),
            "ORIGINAL" => CFile::GetFileArray($arResult['PROPERTIES']['VIDEO_IMG_PLACEHOLDER']['VALUE']),
        );
    $arResult['PROPERTIES']['VIDEO_IMG_PLACEHOLDER'] += $tmp;
}
