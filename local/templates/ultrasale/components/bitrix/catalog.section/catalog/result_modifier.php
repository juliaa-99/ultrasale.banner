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
//    $arItem['PROPERTIES']['JOBS_DONE']['VALUE']['TEXT'] = strip_tags(mb_strimwidth
//    ($arItem['PROPERTIES']['JOBS_DONE']['~VALUE']['TEXT'],0,
//        70, '...'));
//    $arItem['PROPERTIES']['EQUIPMENT']['VALUE']['TEXT'] = strip_tags(mb_strimwidth($arItem['PROPERTIES']['EQUIPMENT']['~VALUE']['TEXT'],0,
//        70, '...'));
}
