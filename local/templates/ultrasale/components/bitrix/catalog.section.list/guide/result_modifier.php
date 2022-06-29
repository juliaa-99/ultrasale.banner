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

$arResult['Toc'] = [];
$arResult['Toc'][] = ['value'=>'Все', 'link'=>'all'];
$arResult['Toc'][] = ['value'=>'0-9', 'link'=>'dgt'];
for ($int = ord('A'); $int<=ord('Z'); $int++) {
    $arResult['Toc'][] = ['value'=>chr($int),'link'=>chr($int)];
}
$arResult['Toc'][] = ['value'=>'А-Я', 'link'=>'cyr'];

foreach ($arResult['SECTIONS'] as $section) {
    if (ord(substr($section['NAME'],0,1)) >=48 && ord(substr($section['NAME'],0,1)) <=57) {
        $arResult['SectionByLetter']['dgt'][] = $section;
    } elseif (ord(substr($section['NAME'],0,1)) >90) {
        $arResult['SectionByLetter']['cyr'][] = $section;
    } else {
        $arResult['SectionByLetter'][chr(ord(substr($section['NAME'],0,1)))][] = $section;
    }
}

$rsElementsEx = CIBlockSection::GetList(['SORT'=>'ASC'], [
    'ACTIVE'      => 'Y',
    'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
    'IBLOCK_ID'   => (int)$arParams['IBLOCK_ID'],
]);
while ($arElementEx = $rsElementsEx->GetNext()) {

    if (ord(substr($arElementEx['NAME'], 0, 1)) >= 48 && ord(substr($arElementEx['NAME'], 0, 1)) <= 57) {
        $arResult['SectionByLetterEx']['dgt'][] = $arElementEx;
    } elseif (ord(substr($arElementEx['NAME'], 0, 1)) > 90) {
        $arResult['SectionByLetterEx']['cyr'][] = $arElementEx;
    } else {
        $arResult['SectionByLetterEx'][chr(ord(substr($arElementEx['NAME'], 0, 1)))][] = $arElementEx;
    }
}

//if (count($arResult['SECTIONS'])) {
//    $arResult['SECTIONS'] = array_slice($arResult['SECTIONS'], 0, $arParams['OWN']['LIMIT_AMOUNT']);
//}