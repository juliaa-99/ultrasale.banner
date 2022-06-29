<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "ID" => $_REQUEST["ID"],
        "IBLOCK_TYPE" => "ultrasale",
        "IBLOCK_ID" => "13",
        "SECTION_URL" => "",
        "DEPTH_LEVEL" => "1",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600"
    )
);
var_dump($aMenuLinksExt);
die;
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>
