<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Главная");

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "slider_head",
    array(
        "DISPLAY_DATE"                    => "Y",
        "DISPLAY_NAME"                    => "Y",
        "DISPLAY_PICTURE"                 => "Y",
        "DISPLAY_PREVIEW_TEXT"            => "Y",
        "AJAX_MODE"                       => "N",
        "IBLOCK_TYPE"                     => "ultrasale",
        "IBLOCK_ID"                       => "4",
        "NEWS_COUNT"                      => "10",
        "SORT_BY1"                        => "ACTIVE_FROM",
        "SORT_ORDER1"                     => "DESC",
        "SORT_BY2"                        => "SORT",
        "SORT_ORDER2"                     => "ASC",
        "FILTER_NAME"                     => "",
        "FIELD_CODE"                      => array("ID"),
        "PROPERTY_CODE"                   => array("DESCRIPTION"),
        "CHECK_DATES"                     => "Y",
        "DETAIL_URL"                      => "",
        "PREVIEW_TRUNCATE_LEN"            => "",
        "ACTIVE_DATE_FORMAT"              => "d.m.Y",
        "SET_TITLE"                       => "N",
        "SET_BROWSER_TITLE"               => "Y",
        "SET_META_KEYWORDS"               => "Y",
        "SET_META_DESCRIPTION"            => "Y",
        "SET_LAST_MODIFIED"               => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",
        "ADD_SECTIONS_CHAIN"              => "N",
        "HIDE_LINK_WHEN_NO_DETAIL"        => "Y",
        "PARENT_SECTION"                  => "",
        "PARENT_SECTION_CODE"             => "",
        "INCLUDE_SUBSECTIONS"             => "Y",
        "CACHE_TYPE"                      => "A",
        "CACHE_TIME"                      => "3600",
        "CACHE_FILTER"                    => "Y",
        "CACHE_GROUPS"                    => "Y",
        "DISPLAY_TOP_PAGER"               => "Y",
        "DISPLAY_BOTTOM_PAGER"            => "Y",
        "PAGER_TITLE"                     => "Новости",
        "PAGER_SHOW_ALWAYS"               => "Y",
        "PAGER_TEMPLATE"                  => "",
        "PAGER_DESC_NUMBERING"            => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL"                  => "Y",
        "PAGER_BASE_LINK_ENABLE"          => "Y",
        "SET_STATUS_404"                  => "Y",
        "SHOW_404"                        => "Y",
        "MESSAGE_404"                     => "",
        "PAGER_BASE_LINK"                 => "",
        "PAGER_PARAMS_NAME"               => "arrPager",
        "AJAX_OPTION_JUMP"                => "N",
        "AJAX_OPTION_STYLE"               => "N",
        "AJAX_OPTION_HISTORY"             => "N",
        "AJAX_OPTION_ADDITIONAL"          => "",
    )
);
?>

    <div class="services">
        <div class="container">
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "affetta",
                array(
                    "IBLOCK_TYPE" => "ultrasale",
                    "IBLOCK_ID" => "19",
                    "NEWS_COUNT" => "50",
                    "SORT_BY1" => $arParams["SORT_BY1"],
                    "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                    "SORT_BY2" => $arParams["SORT_BY2"],
                    "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => $arParams["LIST_FIELD_CODE"],
                        2 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => $arParams["LIST_PROPERTY_CODE"],
                        2 => "",
                    ),
                    "DETAIL_URL" => "services/#SECTION_CODE#/#ELEMENT_CODE#/",
                    "SECTION_URL" => "services/#SECTION_CODE#/",
                    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                    "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                    "SET_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "FILE_404" => $arParams["FILE_404"],
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                    "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                    "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                    "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                    "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                    "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "CHECK_DATES" => "N",
                    "COMPONENT_TEMPLATE" => "affetta",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "STRICT_SECTION_CHECK" => "N"
                ),
                $component
            );?>
            <div class="button-center"><a class="button button-primary" href="#" data-toggle="modal" data-target="#modalCall"><span>Консультация специалиста</span></a></div>
        </div>
    </div>

<?php
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "objects_main",
    array(
        "IBLOCK_TYPE" => "ultrasale",
        "IBLOCK_ID" => "6",
        "SECTION_ID" => "",
        "SECTION_CODE" => "",
        "COUNT_ELEMENTS" => "N",
        "TOP_DEPTH" => "1",
        "SECTION_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_USER_FIELDS" => array(
            0 => "UF_DONE_COUNT",
            1 => "",
        ),
        "SECTION_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_NOTES" => "",
        "CACHE_GROUPS" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "COMPONENT_TEMPLATE" => "objects_main",
        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
        "FILTER_NAME" => "sectionsFilter",
        "CACHE_FILTER" => "N"
    ),
    false
);
?>
<?php

$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "catalog_main",
    array(
        "IBLOCK_TYPE"         => 'ultrasale',
        "IBLOCK_ID"           => 13,
        "SECTION_ID"          => "",
        "SECTION_CODE"        => "",
        "COUNT_ELEMENTS"      => "N",
        "TOP_DEPTH"           => "1",
        "SECTION_FIELDS"      => array('PICTURE','LEFT_MARGIN','RIGHT_MARGIN','IBLOCK_SECTION_ID'),
        "SECTION_USER_FIELDS" => array('UF_VISUAL_MULTIPLIER'),
        "SECTION_URL"         => "",
        "CACHE_TYPE"          => "A",
        "CACHE_TIME"          => "36000000",
        "CACHE_NOTES"         => "",
        "CACHE_GROUPS"        => "Y",
        "ADD_SECTIONS_CHAIN"  => "N",
    )
);


?>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "clients",
    array(
        "DISPLAY_DATE"                    => "N",
        "DISPLAY_NAME"                    => "Y",
        "DISPLAY_PICTURE"                 => "Y",
        "DISPLAY_PREVIEW_TEXT"            => "N",
        "AJAX_MODE"                       => "N",
        "IBLOCK_TYPE"                     => "ultrasale",
        "IBLOCK_ID"                       => "7",
        "NEWS_COUNT"                      => "16",
        "SORT_BY1"                        => "SORT",
        "SORT_ORDER1"                     => "DESC",
        "SORT_BY2"                        => "NAME",
        "SORT_ORDER2"                     => "ASC",
        "FILTER_NAME"                     => "",
        "FIELD_CODE"                      => array("ID", 'PREVIEW_PICTURE'),
        "PROPERTY_CODE"                   => array("DESCRIPTION"),
        "CHECK_DATES"                     => "Y",
        "DETAIL_URL"                      => "",
        "PREVIEW_TRUNCATE_LEN"            => "",
        "ACTIVE_DATE_FORMAT"              => "d.m.Y",
        "SET_TITLE"                       => "N",
        "SET_BROWSER_TITLE"               => "N",
        "SET_META_KEYWORDS"               => "N",
        "SET_META_DESCRIPTION"            => "N",
        "SET_LAST_MODIFIED"               => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",
        "ADD_SECTIONS_CHAIN"              => "N",
        "HIDE_LINK_WHEN_NO_DETAIL"        => "N",
        "PARENT_SECTION"                  => "",
        "PARENT_SECTION_CODE"             => "",
        "INCLUDE_SUBSECTIONS"             => "N",
        "CACHE_TYPE"                      => "A",
        "CACHE_TIME"                      => "3600",
        "CACHE_FILTER"                    => "Y",
        "CACHE_GROUPS"                    => "Y",
        "DISPLAY_TOP_PAGER"               => "Y",
        "DISPLAY_BOTTOM_PAGER"            => "Y",
        "PAGER_TITLE"                     => "Клиенты",
        "PAGER_SHOW_ALWAYS"               => "N",
        "PAGER_TEMPLATE"                  => "",
        "PAGER_DESC_NUMBERING"            => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL"                  => "N",
        "PAGER_BASE_LINK_ENABLE"          => "N",
        "SET_STATUS_404"                  => "N",
        "SHOW_404"                        => "N",
        "MESSAGE_404"                     => "",
        "PAGER_BASE_LINK"                 => "",
        "PAGER_PARAMS_NAME"               => "arrPager",
        "AJAX_OPTION_JUMP"                => "N",
        "AJAX_OPTION_STYLE"               => "N",
        "AJAX_OPTION_HISTORY"             => "N",
        "AJAX_OPTION_ADDITIONAL"          => "",
    )
);
?>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "certificates",
    array(
        "DISPLAY_DATE"                    => "N",
        "DISPLAY_NAME"                    => "Y",
        "DISPLAY_PICTURE"                 => "Y",
        "DISPLAY_PREVIEW_TEXT"            => "N",
        "AJAX_MODE"                       => "N",
        "IBLOCK_TYPE"                     => "ultrasale",
        "IBLOCK_ID"                       => "8",
        "NEWS_COUNT"                      => "30",
        "SORT_BY1"                        => "SORT",
        "SORT_ORDER1"                     => "DESC",
        "SORT_BY2"                        => "NAME",
        "SORT_ORDER2"                     => "ASC",
        "FILTER_NAME"                     => "",
        "FIELD_CODE"                      => array("ID", 'PREVIEW_PICTURE', 'DETAIL_PICTURE'),
        "PROPERTY_CODE"                   => array("DESCRIPTION"),
        "CHECK_DATES"                     => "Y",
        "DETAIL_URL"                      => "",
        "PREVIEW_TRUNCATE_LEN"            => "",
        "ACTIVE_DATE_FORMAT"              => "d.m.Y",
        "SET_TITLE"                       => "N",
        "SET_BROWSER_TITLE"               => "N",
        "SET_META_KEYWORDS"               => "N",
        "SET_META_DESCRIPTION"            => "N",
        "SET_LAST_MODIFIED"               => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",
        "ADD_SECTIONS_CHAIN"              => "N",
        "HIDE_LINK_WHEN_NO_DETAIL"        => "N",
        "PARENT_SECTION"                  => "",
        "PARENT_SECTION_CODE"             => "",
        "INCLUDE_SUBSECTIONS"             => "N",
        "CACHE_TYPE"                      => "A",
        "CACHE_TIME"                      => "3600",
        "CACHE_FILTER"                    => "Y",
        "CACHE_GROUPS"                    => "Y",
        "DISPLAY_TOP_PAGER"               => "Y",
        "DISPLAY_BOTTOM_PAGER"            => "Y",
        "PAGER_TITLE"                     => "Сертификаты",
        "PAGER_SHOW_ALWAYS"               => "N",
        "PAGER_TEMPLATE"                  => "",
        "PAGER_DESC_NUMBERING"            => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL"                  => "N",
        "PAGER_BASE_LINK_ENABLE"          => "N",
        "SET_STATUS_404"                  => "N",
        "SHOW_404"                        => "N",
        "MESSAGE_404"                     => "",
        "PAGER_BASE_LINK"                 => "",
        "PAGER_PARAMS_NAME"               => "arrPager",
        "AJAX_OPTION_JUMP"                => "N",
        "AJAX_OPTION_STYLE"               => "N",
        "AJAX_OPTION_HISTORY"             => "N",
        "AJAX_OPTION_ADDITIONAL"          => "",
        "FANCYBOX_ID"                     => "",
    )
);
?>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/about_main.php",
    array(),
    array("MODE" => "html")
); ?>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "client_reply",
    array(
        "DISPLAY_DATE"                    => "N",
        "DISPLAY_NAME"                    => "Y",
        "DISPLAY_PICTURE"                 => "Y",
        "DISPLAY_PREVIEW_TEXT"            => "N",
        "AJAX_MODE"                       => "N",
        "IBLOCK_TYPE"                     => "ultrasale",
        "IBLOCK_ID"                       => "9",
        "NEWS_COUNT"                      => "6",
        "SORT_BY1"                        => "SORT",
        "SORT_ORDER1"                     => "DESC",
        "SORT_BY2"                        => "NAME",
        "SORT_ORDER2"                     => "ASC",
        "FILTER_NAME"                     => "",
        "FIELD_CODE"                      => array("ID", 'PREVIEW_PICTURE', 'DETAIL_PICTURE'),
        "PROPERTY_CODE"                   => array("DESCRIPTION"),
        "CHECK_DATES"                     => "Y",
        "DETAIL_URL"                      => "",
        "PREVIEW_TRUNCATE_LEN"            => "",
        "ACTIVE_DATE_FORMAT"              => "d.m.Y",
        "SET_TITLE"                       => "N",
        "SET_BROWSER_TITLE"               => "N",
        "SET_META_KEYWORDS"               => "N",
        "SET_META_DESCRIPTION"            => "N",
        "SET_LAST_MODIFIED"               => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",
        "ADD_SECTIONS_CHAIN"              => "N",
        "HIDE_LINK_WHEN_NO_DETAIL"        => "N",
        "PARENT_SECTION"                  => "",
        "PARENT_SECTION_CODE"             => "",
        "INCLUDE_SUBSECTIONS"             => "N",
        "CACHE_TYPE"                      => "A",
        "CACHE_TIME"                      => "3600",
        "CACHE_FILTER"                    => "Y",
        "CACHE_GROUPS"                    => "Y",
        "DISPLAY_TOP_PAGER"               => "Y",
        "DISPLAY_BOTTOM_PAGER"            => "Y",
        "PAGER_TITLE"                     => "Отзывы",
        "PAGER_SHOW_ALWAYS"               => "N",
        "PAGER_TEMPLATE"                  => "",
        "PAGER_DESC_NUMBERING"            => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL"                  => "N",
        "PAGER_BASE_LINK_ENABLE"          => "N",
        "SET_STATUS_404"                  => "N",
        "SHOW_404"                        => "N",
        "MESSAGE_404"                     => "",
        "PAGER_BASE_LINK"                 => "",
        "PAGER_PARAMS_NAME"               => "arrPager",
        "AJAX_OPTION_JUMP"                => "N",
        "AJAX_OPTION_STYLE"               => "N",
        "AJAX_OPTION_HISTORY"             => "N",
        "AJAX_OPTION_ADDITIONAL"          => "",
        "FANCYBOX_ID"                     => "",
    )
);
?>
    <!--div.news-main
    <div class="container">
      <div class="title-main">
        <h2>Новости <i>компании</i></h2><a class="title-main__link" href="#">
          Смотреть все<svg><use xlink:href="#arrow2"></use></svg></a>
      </div>
      <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
          <div class="news__item"><a href="#"></a>
            <div class="news__item-title">Новые клапаны DANTEX для фанкойлов</div>
            <div class="news__item-tx">DANTEX представила новинку — 3-х и 2-ходовые клапаны для фанкойлов сериию...</div>
            <div class="news__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
          <div class="news__item"><a href="#"></a>
            <div class="news__item-title">Daikin поможет справиться со второй волной коронавируса</div>
            <div class="news__item-tx">DANTEX представила новинку — 3-х и 2-ходовые клапаны для фанкойлов сериию...</div>
            <div class="news__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
          <div class="news__item"><a href="#"></a>
            <div class="news__item-title">Модернизация системы вентиляции цеха завершена</div>
            <div class="news__item-tx">DANTEX представила новинку — 3-х и 2-ходовые клапаны для фанкойлов сериию...</div>
            <div class="news__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></div>
          </div>
        </div>
      </div>
      <div class="button-mob button-center">
        <div class="button button-primary"><span>Смотреть все</span></div>
    </div>
    </div>-->
<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "inline_app",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_2',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'inline_app001',
        'FORM_NAME'             => 'Свяжитесь с нами',
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            'EMAIL', // type - string
            'FILE', // type - string
            'MESSAGE,TEXT', // type - html/text
        ),
    )
); 
?>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/about_bits.php",
    array(),
    array("MODE" => "html")
); ?>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>