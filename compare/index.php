<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Сравнение товаров");

$request = \Bitrix\Main\Context::getCurrent()->getRequest();

function findFirstParentSection($sect_id){
    $res = CIBlockSection::GetByID($sect_id);
    if($ar_res = $res->GetNext()){
        // dump($ar_res);die;
        if($ar_res['DEPTH_LEVEL'] > 1){
            return findFirstParentSection($ar_res['IBLOCK_SECTION_ID']);
        } else {
            return $ar_res;
        }
    }
}

if (!empty($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK]["ITEMS"])) {

    $arrCompareFilter = ['ID' => array_keys($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK]["ITEMS"])];

    $itemsCategoryCount = 0;
    if ($request->get('category')) {
        $arrCompareFilter['SECTION_ID'][] = $request->get('category');

        if (count($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK]["ITEMS"])) {
            foreach ($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK]["ITEMS"] as $item) {

                $parentId = findFirstParentSection($item["IBLOCK_SECTION_ID"]);
                if($parentId['ID'] == $request->get('category')){
                    $arrCompareFilter['SECTION_ID'][] = $item["IBLOCK_SECTION_ID"];
                    $itemsCategoryCount++;
                }

                // $arrCompareFilter['SECTION_ID'] = $item['IBLOCK_SECTION_ID'];
                // break;
            }
        }

        if($itemsCategoryCount < 1){
            header('location: /compare/');
        }
    } else {
        if (count($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK]["ITEMS"])) {
            $sect_id = current($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK]["ITEMS"])['IBLOCK_SECTION_ID'];
            $parentSection = findFirstParentSection($sect_id);

            foreach ($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK]["ITEMS"] as $item) 
            {
                $parentSect = findFirstParentSection($item['IBLOCK_SECTION_ID']);
                if($parentSect == $parentSection){
                    $arrCompareFilter['SECTION_ID'][] = $item["IBLOCK_SECTION_ID"];
                }
            }
        }
    }

// Элементы раздела
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "catalog_compare",
        array(
            "IBLOCK_TYPE"                      =>  "ultrasale",
            "IBLOCK_ID"                        =>  CATALOG_IBLOCK,
            "SECTION_ID"                       =>  "",
            "SECTION_CODE"                     =>  "",
            "SECTION_USER_FIELDS"              =>  array(''),
            "ELEMENT_SORT_FIELD"               =>  "sort",
            "ELEMENT_SORT_ORDER"               =>  "asc",
            "ELEMENT_SORT_FIELD2"              =>  "id",
            "ELEMENT_SORT_ORDER2"              =>  "desc",
            "FILTER_NAME"                      =>  "arrCompareFilter",
            "INCLUDE_SUBSECTIONS"              =>  "Y",
            "SHOW_ALL_WO_SECTION"              =>  "Y",
            "HIDE_NOT_AVAILABLE"               =>  "N",
            "PAGE_ELEMENT_COUNT"               =>  "30",
            "LINE_ELEMENT_COUNT"               =>  "3",
            "PROPERTY_CODE"                    =>  array(''),
            "SECTION_URL"                      =>  "",
            "DETAIL_URL"                       =>  "",
            "SECTION_ID_VARIABLE"              =>  "SECTION_ID",
            "CACHE_TYPE"                       =>  "A",
            "CACHE_TIME"                       =>  "36000000",
            "CACHE_NOTES"                      =>  "",
            "CACHE_GROUPS"                     =>  "Y",
            "SET_TITLE"                        =>  "N",
            "SET_BROWSER_TITLE"                =>  "N",
            "BROWSER_TITLE"                    =>  "-",
            "SET_META_KEYWORDS"                =>  "N",
            "META_KEYWORDS"                    =>  "-",
            "SET_META_DESCRIPTION"             =>  "N",
            "META_DESCRIPTION"                 =>  "-",
            "ADD_SECTIONS_CHAIN"               =>  "N",
            "SET_STATUS_404"                   =>  "N",
            "CACHE_FILTER"                     =>  "N",
            "PAGER_TEMPLATE"                   =>  "main",
            "DISPLAY_TOP_PAGER"                =>  "N",
            "DISPLAY_BOTTOM_PAGER"             =>  "N",
            "PAGER_TITLE"                      =>  "Товары",
            "PAGER_SHOW_ALWAYS"                =>  "N",
            "PAGER_DESC_NUMBERING"             =>  "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME"  =>  "36000",
            "PAGER_SHOW_ALL"                   =>  "N",
            'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
            "PRICE_CODE" => array(
                0 => "BASE",
            ),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "COMPARE_URL_TEMPLATE" => "../ajax/compare.php?action=#ACTION_CODE#",
            "COMPARE_DELETE_URL_TEMPLATE" => "../ajax/compare.php?action=#ACTION_CODE#",
            "SEF_URL_TEMPLATES" => array(
                "sections" => "",
                "section" => "#SECTION_CODE_PATH#/",
                "element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
                "compare" => "../ajax/compare.php?action=#ACTION_CODE#",
                "smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
            ),

        )
    );
} else { ?>
    <div class="cart-item">
        <div class="container">
            <h1><?= $APPLICATION->ShowTitle(true) ?></h1>
        </div>
        <div class="cart-page-nn th">
            <div class="container">
                <div class="cart-page-nn-inner">
                    <div class="cart-page-nn-tt">
                        <div class="cart-page-nn-title">Список сравниваемых товаров пока пуст</div>
                        <div class="cart-page-nn-tx">Добавляйте товары к сравнению с помощью   <img
                                    src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/stat2.svg" alt=''></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
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