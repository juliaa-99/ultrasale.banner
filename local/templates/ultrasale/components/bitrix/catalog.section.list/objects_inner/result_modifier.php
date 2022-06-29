<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 15.11.2021
 */
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

if (count($arResult['SECTIONS'])) {
    $arResult['SECTIONS'] = array_slice($arResult['SECTIONS'], 0, $arParams['OWN']['LIMIT_AMOUNT']);
}