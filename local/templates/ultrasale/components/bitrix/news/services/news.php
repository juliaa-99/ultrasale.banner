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

$this->setFrameMode(false);

$APPLICATION->IncludeComponent(
	"bitrix:catalog.sections.top",
	"services",
	array(
		// region Основные параметры
		"IBLOCK_TYPE"                =>  "ultrasale",
		"IBLOCK_ID"                  =>  "11",
		// endregion
		// region Источник данных
		"SECTION_FIELDS"             =>  array('PICTURE','LEFT_MARGIN','RIGHT_MARGIN','IBLOCK_SECTION_ID'),
		"SECTION_USER_FIELDS"        =>  array('UF_DISPLAY_TYPE'),
		"SECTION_SORT_FIELD"         =>  "LEFT_MARGIN",
		"SECTION_SORT_ORDER"         =>  "asc",
		"ELEMENT_SORT_FIELD"         =>  "NAME",
		"ELEMENT_SORT_ORDER"         =>  "asc",
		"ELEMENT_SORT_FIELD2"        =>  "id",
		"ELEMENT_SORT_ORDER2"        =>  "desc",
		"FILTER_NAME"                =>  "arrFilter",
		"HIDE_NOT_AVAILABLE"         =>  "N",
		// endregion
		// region Внешний вид
		"SECTION_COUNT"              =>  "20",
		"ELEMENT_COUNT"              =>  "9",
		"LINE_ELEMENT_COUNT"         =>  "3",
		"PROPERTY_CODE"              =>  array(''),
		// endregion
		// region Шаблоны ссылок
		"SECTION_URL"                =>  "",
		"DETAIL_URL"                 =>  "",
		"BASKET_URL"                 =>  "",
		"ACTION_VARIABLE"            =>  "action",
		"PRODUCT_ID_VARIABLE"        =>  "id",
		"PRODUCT_QUANTITY_VARIABLE"  =>  "quantity",
		"PRODUCT_PROPS_VARIABLE"     =>  "prop",
		"SECTION_ID_VARIABLE"        =>  "SECTION_ID",
		// endregion
		// region Настройки кеширования
		"CACHE_TYPE"                 =>  "A",
		"CACHE_TIME"                 =>  "36000000",
		"CACHE_NOTES"                =>  "",
		"CACHE_FILTER"               =>  "N",
		"CACHE_GROUPS"               =>  "Y",
		// endregion
		// region Дополнительные настройки
		"DISPLAY_COMPARE"            =>  "N",
		// endregion
		// region Цены
		"PRICE_CODE"                 =>  array(''),
		"USE_PRICE_COUNT"            =>  "N",
		"SHOW_PRICE_COUNT"           =>  "1",
		"PRICE_VAT_INCLUDE"          =>  "Y",
		"PRODUCT_PROPERTIES"         =>  array(''),
		"USE_PRODUCT_QUANTITY"       =>  "N",
		"CONVERT_CURRENCY"           =>  "N",
		// endregion
	),
    $component
);

