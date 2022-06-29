<?php
/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 12.11.2021
 */
$aResult = $arResult;
$arResult['SECTIONS'] = [];

$aResult['SECTIONS'] = array_slice($aResult['SECTIONS'],0,8);
foreach ($aResult['SECTIONS'] as $section) {
    $arResult['SECTIONS'][$section['ID']] = $section;
}