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
foreach ($arResult['ITEMS'] as &$arItem){
    if (empty($arItem['PREVIEW_TEXT'])){
        $arItem['PREVIEW_TEXT'] = strip_tags(mb_strimwidth($arItem['DETAIL_TEXT'],0,70, '...'));
    }
}
