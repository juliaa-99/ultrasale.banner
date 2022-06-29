<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
$APPLICATION->AddChainItem("Поиск", "/search/");
?>
    <div class="results-page">
        <div class="container">
<? $APPLICATION->IncludeComponent(
                "bitrix:catalog.search",
                "affetta",
                array(
                    "ACTION_VARIABLE"                 => "action",
                    "AJAX_MODE"                       => "N",
                    "AJAX_OPTION_ADDITIONAL"          => "",
                    "AJAX_OPTION_HISTORY"             => "N",
                    "AJAX_OPTION_JUMP"                => "N",
                    "AJAX_OPTION_SHADOW"              => "Y",
                    "AJAX_OPTION_STYLE"               => "N",
                    "BASKET_URL"                      => "/personal/cart/",
                    "CACHE_TIME"                      => "36000000",
                    "CACHE_TYPE"                      => "N",
                    "CHECK_DATES"                     => "N",
                    "CONVERT_CURRENCY"                => "N",
                    "DEFAULT_SORT"                    => "rank",
                    "DETAIL_URL"                      => "",
                    "DISPLAY_BOTTOM_PAGER"            => "Y",
                    "DISPLAY_COMPARE"                 => "Y",
                    "DISPLAY_TOP_PAGER"               => "N",
                    "ELEMENT_SORT_FIELD"              => "SCALED_PRICE_1",
                    "ELEMENT_SORT_FIELD2"             => "name",
                    "ELEMENT_SORT_ORDER"              => "asc",
                    "ELEMENT_SORT_ORDER2"             => "asc",
                    "HIDE_NOT_AVAILABLE"              => "N",
                    "IBLOCK_ID"                       => "13",
                    "IBLOCK_TYPE"                     => "ultrasale",
                    "LINE_ELEMENT_COUNT"              => "4",
                    "NO_WORD_LOGIC"                   => "Y",
                    "OFFERS_LIMIT"                    => "50",
                    "PAGER_DESC_NUMBERING"            => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL"                  => "Y",
                    "PAGER_SHOW_ALWAYS"               => "N",
                    "PAGER_TEMPLATE"                  => "main",
                    "PAGER_TITLE"                     => "Результаты поиска",
                    "PAGE_ELEMENT_COUNT"              => "24",
                    "PAGE_RESULT_COUNT"               => "80",
                    "PRICE_CODE"                      => array(
                        0 => "BASE",
                    ),
                    "PRICE_VAT_INCLUDE"               => "Y",
                    "PRODUCT_ID_VARIABLE"             => "id",
                    "PRODUCT_PROPERTIES"              => array(),
                    "PRODUCT_PROPS_VARIABLE"          => "prop",
                    "PRODUCT_QUANTITY_VARIABLE"       => "quantity",
                    "PROPERTY_CODE"                   => array(
                        0 => "",
                        1 => "",
                        2 => "",
                        3 => "",
                        4 => "",
                    ),
                    "RESTART"                         => "Y",
                    "SECTION_ID_VARIABLE"             => "SECTION_ID",
                    "SECTION_URL"                     => "",
                    "SHOW_ITEM_DATE_CHANGE"           => "N",
                    "SHOW_ITEM_TAGS"                  => "N",
                    "SHOW_ORDER_BY"                   => "N",
                    "SHOW_PRICE_COUNT"                => "1",
                    "SHOW_TAGS_CLOUD"                 => "N",
                    "SHOW_WHEN"                       => "N",
                    "SHOW_WHERE"                      => "N",
                    "USE_LANGUAGE_GUESS"              => "N",
                    "USE_PRICE_COUNT"                 => "N",
                    "USE_PRODUCT_QUANTITY"            => "N",
                    "USE_SUGGEST"                     => "N",
                    "USE_TITLE_RANK"                  => "N",
                    "arrFILTER"                       => array(
                        0 => "main",
                        1 => "iblock_services",
                        2 => "iblock_news",
                        3 => "iblock_catalog",
                    ),
                    "arrFILTER_iblock_catalog"        => array(
                        0 => "all",
                    ),
                    "arrFILTER_iblock_news"           => array(
                        0 => "all",
                    ),
                    "arrFILTER_iblock_services"       => array(
                        0 => "all",
                    ),
                    "arrFILTER_main"                  => "",
                    "COMPONENT_TEMPLATE"              => "bootstrap_v4",
                    "OFFERS_FIELD_CODE"               => array(
                        0 => "",
                        1 => "",
                    ),
                    "OFFERS_PROPERTY_CODE"            => array(
                        0 => "",
                        1 => "",
                    ),
                    "OFFERS_SORT_FIELD"               => "sort",
                    "OFFERS_SORT_ORDER"               => "asc",
                    "OFFERS_SORT_FIELD2"              => "id",
                    "OFFERS_SORT_ORDER2"              => "desc",
                    "OFFERS_CART_PROPERTIES"          => "",
                    "HIDE_NOT_AVAILABLE_OFFERS"       => "Y",
                    "USE_SEARCH_RESULT_ORDER"         => "N",
                ),
                false
            ); ?>
        </div>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>