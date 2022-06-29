<?php
/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 07.12.2021
 */
/**
 * @var $APPLICATION
 */

if (!defined('CATALOG_IBLOCK')) {
    define('CATALOG_IBLOCK', 13);
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php';


/**
 *
 * Добавить
 * ?action=ADD_TO_COMPARE_LIST&id=96
 *
 * Удалить
 * ?action=DELETE_FROM_COMPARE_LIST&id=96
 *
 */

/** Чтобы по умолчанию режим ajax был включен **/
$_REQUEST["ajax_action"] = "Y";

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->isAjaxRequest()) {
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.compare.list",
        "affetta",
        array(
            "ACTION_VARIABLE"        => "action",
            "AJAX_MODE"              => "Y",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY"    => "N",
            "AJAX_OPTION_JUMP"       => "N",
            "AJAX_OPTION_STYLE"      => "Y",
            "COMPARE_URL"            => "/compare/",
            "COMPONENT_TEMPLATE"     => "affetta",
            "DETAIL_URL"             => "",
            "IBLOCK_ID"              => CATALOG_IBLOCK,
            "IBLOCK_TYPE"            => "ultrasale", //iblock_type
            "NAME"                   => 'CATALOG_COMPARE_LIST',
            "POSITION"               => "top left",
            "POSITION_FIXED"         => "Y",
            "PRODUCT_ID_VARIABLE"    => "id",
        )
    );
}