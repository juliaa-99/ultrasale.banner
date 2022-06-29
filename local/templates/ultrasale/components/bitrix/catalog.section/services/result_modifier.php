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

if (!empty($arResult['UF_BANNER'])) {
    $tmp = array(
        "THUMBNAIL" => CFile::ResizeImageGet($arResult['UF_BANNER'], array("width" => 512, "height" => 512)),
        "PREVIEW" => CFile::ResizeImageGet($arResult['UF_BANNER'], array("width" => 758, "height" => 462)),
        "ORIGINAL" => CFile::GetFileArray($arResult['UF_BANNER']),
    );
    unset ($arResult['UF_BANNER']);
    $arResult['UF_BANNER'] = $tmp;
    unset ($tmp);
}

if (!empty($arResult['UF_MOBILE_BANNER'])) {
    $tmp = array(
        "THUMBNAIL" => CFile::ResizeImageGet($arResult['UF_MOBILE_BANNER'], array("width" => 512, "height" => 512)),
        "PREVIEW" => CFile::ResizeImageGet($arResult['UF_MOBILE_BANNER'], array("width" => 512, "height" => 512)),
        "ORIGINAL" => CFile::GetFileArray($arResult['UF_MOBILE_BANNER']),
    );
    unset ($arResult['UF_MOBILE_BANNER']);
    $arResult['UF_MOBILE_BANNER'] = $tmp;
    unset ($tmp);
}

if (!empty($arResult['UF_VIDEO_PLACEHOLDER'])) {
    $tmp = array(
        "THUMBNAIL" => CFile::ResizeImageGet($arResult['UF_VIDEO_PLACEHOLDER'], array("width" => 512, "height" => 512)),
        "PREVIEW" => CFile::ResizeImageGet($arResult['UF_VIDEO_PLACEHOLDER'], array("width" => 840, "height" => 544)),
        "ORIGINAL" => CFile::GetFileArray($arResult['UF_VIDEO_PLACEHOLDER']),
    );
    unset ($arResult['UF_VIDEO_PLACEHOLDER']);
    $arResult['UF_VIDEO_PLACEHOLDER'] = $tmp;
    unset ($tmp);
}