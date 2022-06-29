<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

?><pre><? var_dump( $arResult["VARIABLES"]["SECTION_CODE"]) ?></pre><?

// Элементы раздела
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"services",
	array(
		"IBLOCK_TYPE"                      =>  "ultrasale",
		"IBLOCK_ID"                        =>  "17",
		"SECTION_ID"                       =>  "",
		"SECTION_USER_FIELDS"              =>  array('UF_TEXT_BLOCK','UF_VIDEO_PLACEHOLDER','UF_VIDEO_LINK','UF_BANNER','UF_MOBILE_BANNER','UF_BANNER_CAPTION','UF_BANNER_TEXT','UF_MAIN_CAPTION','UF_TOP_TEXT','UF_BOTTOM_TEXT'),
		"ELEMENT_SORT_FIELD"               =>  "sort",
		"ELEMENT_SORT_ORDER"               =>  "asc",
		"ELEMENT_SORT_FIELD2"              =>  "NAME",
		"ELEMENT_SORT_ORDER2"              =>  "asc",
		"FILTER_NAME"                      =>  "arrFilter",
		"INCLUDE_SUBSECTIONS"              =>  "N",
		"SHOW_ALL_WO_SECTION"              =>  "N",
		"HIDE_NOT_AVAILABLE"               =>  "N",
		"PAGE_ELEMENT_COUNT"               =>  "9",
		"LINE_ELEMENT_COUNT"               =>  "3",
		"PROPERTY_CODE"                    =>  array(''),
        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"SECTION_ID_VARIABLE"              =>  "SECTION_CODE_PATH",
		"CACHE_TYPE"                       =>  "A",
		"CACHE_TIME"                       =>  "36000000",
		"CACHE_NOTES"                      =>  "",
		"CACHE_GROUPS"                     =>  "Y",
		"SET_TITLE"                        =>  "Y",
		"SET_BROWSER_TITLE"                =>  "Y",
		"BROWSER_TITLE"                    =>  "-",
		"SET_META_KEYWORDS"                =>  "Y",
		"META_KEYWORDS"                    =>  "-",
		"SET_META_DESCRIPTION"             =>  "Y",
		"META_DESCRIPTION"                 =>  "-",
		"ADD_SECTIONS_CHAIN"               =>  "N",
		"SET_STATUS_404"                   =>  "N",
		"CACHE_FILTER"                     =>  "N",
		"PAGER_TEMPLATE"                   =>  "affetta",
		"DISPLAY_TOP_PAGER"                =>  "N",
		"DISPLAY_BOTTOM_PAGER"             =>  "Y",
		"PAGER_TITLE"                      =>  "Услуги",
		"PAGER_SHOW_ALWAYS"                =>  "N",
		"PAGER_DESC_NUMBERING"             =>  "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME"  =>  "36000",
		"PAGER_SHOW_ALL"                   =>  "N",
	),
    $component
);