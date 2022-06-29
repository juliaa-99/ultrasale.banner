<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Избранное");

if (!defined('CATALOG_ID')) {
    define('CATALOG_ID', 13);
}

$aTmp = getFavsByUser($USER->GetID(), array('UF_DATE_ADD' => "DESC"));
$aSelected = $aTmp['ITEMS'];

if (count($aSelected)) {
    $arrFilterFavorites = array('ID' => array_values($aSelected));
} else {
    $arrFilterFavorites = array('ID' => false);
}

?>
    <div class="container">
        <h1>Избранное</h1>
        <script>
            $(document).ready(function() {
                $('.catalog__item-fav').click(function () {
                    if ($(this).hasClass('active')) $(this).parent().parent().parent().parent().remove();
                })
            })
        </script>
        <?php
//dump($arrFilterFavorites['ID']);
if($arrFilterFavorites['ID']) {
    $APPLICATION->IncludeComponent(
        'bitrix:catalog.section',
        'affetta',
        array(
            "EXT_VIEW_TYPE" => "tile4",
            "IBLOCK_TYPE"                     => CATALOG_TYPE,
            "IBLOCK_ID"                       => CATALOG_ID,
            "SECTION_ID"                      => "",
            "SECTION_CODE"                    => "",
            "SECTION_USER_FIELDS"             => array(''),
            "ELEMENT_SORT_FIELD"              => "sort",
            "ELEMENT_SORT_ORDER"              => "asc",
            "ELEMENT_SORT_FIELD2"             => "id",
            "ELEMENT_SORT_ORDER2"             => "desc",
            "FILTER_NAME"                     => "arrFilterFavorites",
            "INCLUDE_SUBSECTIONS"             => "Y",
            "SHOW_ALL_WO_SECTION"             => "Y",
            "HIDE_NOT_AVAILABLE"              => "N",
            "PAGE_ELEMENT_COUNT"              => "30",
            "LINE_ELEMENT_COUNT"              => "3",
            "PROPERTY_CODE"                   => array(''),
            "SECTION_URL"                     => "",
            "DETAIL_URL"                      => "",
            "SECTION_ID_VARIABLE"             => "SECTION_ID",
            "CACHE_TYPE"                      => "A",
            "CACHE_TIME"                      => "36000000",
            "CACHE_NOTES"                     => "",
            "CACHE_GROUPS"                    => "Y",
            "SET_TITLE"                       => "N",
            "SET_BROWSER_TITLE"               => "N",
            "BROWSER_TITLE"                   => "-",
            "SET_META_KEYWORDS"               => "N",
            "META_KEYWORDS"                   => "-",
            "SET_META_DESCRIPTION"            => "N",
            "META_DESCRIPTION"                => "-",
            "ADD_SECTIONS_CHAIN"              => "N",
            "SET_STATUS_404"                  => "N",
            "CACHE_FILTER"                    => "N",
            "PAGER_TEMPLATE"                  => "main",
            "DISPLAY_TOP_PAGER"               => "N",
            "DISPLAY_BOTTOM_PAGER"            => "N",
            "PAGER_TITLE"                     => "Товары",
            "PAGER_SHOW_ALWAYS"               => "N",
            "PAGER_DESC_NUMBERING"            => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL"                  => "N",
            'PRODUCT_ROW_VARIANTS'            => "[{'VARIANT':'3','BIG_DATA':false}]",
            "PRICE_CODE"                      => array(
                0 => "BASE",
            ),
            "USE_PRICE_COUNT"                 => "N",
            "SHOW_PRICE_COUNT"                => "1",
            "PRICE_VAT_INCLUDE"               => "Y",
            "PRICE_VAT_SHOW_VALUE"            => "N",
            "COMPARE_URL_TEMPLATE"            => "../../ajax/compare.php?action=#ACTION_CODE#",
            "COMPARE_DELETE_URL_TEMPLATE"     => "../../ajax/compare.php?action=#ACTION_CODE#",
            "SEF_URL_TEMPLATES"               => array(
                "sections"     => "",
                "section"      => "#SECTION_CODE_PATH#/",
                "element"      => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
                "compare"      => "../../ajax/compare.php?action=#ACTION_CODE#",
                "smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
            ),

        )
    );
} else {
    ?>
    <div class="cart-item">
        <div class="cart-page-nn th">
                <div class="cart-page-nn-inner">
                    <div class="cart-page-nn-tt">
                        <div class="cart-page-nn-title">В Избранном пока ничего нет</div>
                        <div class="cart-page-nn-tx">Добавляйте товары в Избранное с помощью  <img
                                    src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/fav2.svg" alt=''></div>
                    </div>
                </div>
        </div>
    </div>
<?
}
?>
    </div>
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
); ?>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/about_bits.php",
    array(),
    array("MODE" => "html")
); ?>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
