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
?>
<div class="banner tw">
    <div class="banner__slider js-banner-slider">
        <div class="banner__slider-item">
            <div class="banner__slider-img"
                 style="background-image: url('<?= $arResult['UF_BANNER']['ORIGINAL']['SRC'] ?>');"></div>
            <? if (!empty($arResult['UF_MOBILE_BANNER']['PREVIEW']['src'])) { ?>
                <div class="banner__slider-img-mob"><img src="<?= $arResult['UF_MOBILE_BANNER']['PREVIEW']['src'] ?>"
                                                         alt=""></div>
            <? } ?>
            <div class="container">
                <div class="banner__slider-inner">
                    <div class="banner__slider-title"><?= $arResult['~UF_BANNER_CAPTION'] ?></div>
                    <div class="banner__slider-tx"><?= $arResult['~UF_BANNER_TEXT'] ?></div>
                    <a class="button
                    button-primary" href="#" data-toggle="modal"
                       data-target="#modalCall"><span>Оставить заявку</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/about_bits_wo_links.php",
    array(),
    array("MODE" => "html")
);
?>
<div class="about-mont">
    <div class="container">
        <h2><?= $arResult['~UF_MAIN_CAPTION'] ?></h2>
        <div class="about-mont__inner">
                <?
                // Структура разделов
                $APPLICATION->IncludeComponent(
                	"bitrix:catalog.section.list",
                	"services",
                	array(
                		"IBLOCK_TYPE"          =>  $arParams['IBLOCK_TYPE'],
                		"IBLOCK_ID"            =>  $arParams['IBLOCK_ID'],
                		"SECTION_ID"           =>  $arResult['ID'],
                		"SECTION_CODE"         =>  "",
                		"COUNT_ELEMENTS"       =>  "Y",
                		"TOP_DEPTH"            =>  "2",
                		"SECTION_FIELDS"       =>  array(''),
                		"SECTION_USER_FIELDS"  =>  array(''),
                		"SECTION_URL"          =>  "",
                		"CACHE_TYPE"           =>  "A",
                		"CACHE_TIME"           =>  "36000000",
                		"CACHE_NOTES"          =>  "",
                		"CACHE_GROUPS"         =>  "Y",
                		"ADD_SECTIONS_CHAIN"   =>  "Y",
                	),
                    $component
                );
                ?>
        </div>
    </div>
</div>
<div class="mounting">
    <div class="container">
        <div class="mounting__inner">
            <?=$arResult['~DESCRIPTION']?>
            <div class="mounting__item th">
                <?=$arResult['~UF_TEXT_BLOCK']?>
                <?=$arResult['~UF_TOP_TEXT']?>
                <?=$arResult['~UF_BOTTOM_TEXT']?>
            </div>

            <div class="mounting__item">
                <? if (!empty($arResult['UF_VIDEO_LINK'])) {?>
                    <h3>Видео об услуге</h3>
                    <div class="object__video"><a class="about-main__video-inner" href="<?=$arResult['UF_VIDEO_LINK']?>"
                                                  data-fancybox style="background-image: url('<?=$arResult['UF_VIDEO_PLACEHOLDER']['PREVIEW']['src']?>')"></a></div>
                <? } ?>
            </div>
        </div>
    </div>
</div>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "objects_inner",
    array(
        "IBLOCK_TYPE"         => "ultrasale",
        "IBLOCK_ID"           => "6",
        "SECTION_ID"          => "",
        "SECTION_CODE"        => "",
        "COUNT_ELEMENTS"      => "N",
        "TOP_DEPTH"           => "1",
        "SECTION_FIELDS"      => array(''),
        "SECTION_USER_FIELDS" => array('UF_DONE_COUNT'),
        "SECTION_URL"         => "",
        "CACHE_TYPE"          => "A",
        "CACHE_TIME"          => "36000000",
        "CACHE_NOTES"         => "",
        "CACHE_GROUPS"        => "Y",
        "ADD_SECTIONS_CHAIN"  => "Y",
        "OWN"                   => [
                'LIMIT_AMOUNT' => 3,
        ]
    ),
    $component
);
?>
<div class="services th">
    <div class="container">
        <div class="title-main">
            <h2>Еще <i>услуги</i></h2><a class="title-main__link" href="/services/">
                Смотреть все<svg><use xlink:href="#arrow2"></use></svg></a>
        </div>
        <?
        $GLOBALS['arrFilterService'] = ['!ID'=>$arResult['ID']];
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.sections.top",
            "services_misc",
            array(
                "IBLOCK_TYPE"                =>  "ultrasale",
                "IBLOCK_ID"                  =>  "11",
                "SECTION_FIELDS"             =>  array('PICTURE','LEFT_MARGIN','RIGHT_MARGIN','IBLOCK_SECTION_ID'),
                "SECTION_USER_FIELDS"        =>  array('UF_DISPLAY_TYPE'),
                "SECTION_SORT_FIELD"         =>  "LEFT_MARGIN",
                "SECTION_SORT_ORDER"         =>  "asc",
                "ELEMENT_SORT_FIELD"         =>  "NAME",
                "ELEMENT_SORT_ORDER"         =>  "asc",
                "ELEMENT_SORT_FIELD2"        =>  "id",
                "ELEMENT_SORT_ORDER2"        =>  "desc",
                "FILTER_NAME"                =>  "arrFilterService",
                "HIDE_NOT_AVAILABLE"         =>  "N",
                "SECTION_COUNT"              =>  "20",
                "ELEMENT_COUNT"              =>  "4",
                "LINE_ELEMENT_COUNT"         =>  "1",
                "PROPERTY_CODE"              =>  array(''),
                "SECTION_URL"                =>  "",
                "DETAIL_URL"                 =>  "",
                "BASKET_URL"                 =>  "",
                "ACTION_VARIABLE"            =>  "action",
                "PRODUCT_ID_VARIABLE"        =>  "id",
                "PRODUCT_QUANTITY_VARIABLE"  =>  "quantity",
                "PRODUCT_PROPS_VARIABLE"     =>  "prop",
                "SECTION_ID_VARIABLE"        =>  "SECTION_ID",
                "CACHE_TYPE"                 =>  "A",
                "CACHE_TIME"                 =>  "36000000",
                "CACHE_NOTES"                =>  "",
                "CACHE_FILTER"               =>  "N",
                "CACHE_GROUPS"               =>  "Y",
                "DISPLAY_COMPARE"            =>  "N",
                "PRICE_CODE"                 =>  array(''),
                "USE_PRICE_COUNT"            =>  "N",
                "SHOW_PRICE_COUNT"           =>  "1",
                "PRICE_VAT_INCLUDE"          =>  "Y",
                "PRODUCT_PROPERTIES"         =>  array(''),
                "USE_PRODUCT_QUANTITY"       =>  "N",
                "CONVERT_CURRENCY"           =>  "N",
            ),
            $component
        );
        ?>
    </div>
</div>
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
        "NEWS_COUNT"                      => "4",
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
        "OWN"                               => [
                'BG'                        => 'bg2',
        ]
    ),
    $component
);
?>
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
        "OWN"                               => [
            'BG'                        => 'bg3',
        ]
    ),
    $component
);
?>
