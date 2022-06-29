<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Избранное");

if (!defined('CATALOG_ID')) {
    define('CATALOG_ID', 13);
}

if ($USER->IsAuthorized()) {
    LocalRedirect('/personal/favorites/');
}
?>
    <?php
        $APPLICATION->AddHeadScript("/bitrix/js/main/popup/dist/main.popup.bundle.js");
        $APPLICATION->AddHeadScript("/bitrix/js/currency/currency-core/dist/currency-core.bundle.js");
        $APPLICATION->AddHeadScript("/bitrix/js/currency/core_currency.js");
        $APPLICATION->AddHeadScript("/bitrix/components/bitrix/catalog.item/templates/.default/script.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/components/bitrix/catalog.section/catalog_favs/script.js" );
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/components/bitrix/catalog.item/catalog_fav/script.js" );
    ?>

    <div id="favsList">
        <div class="cart-item">
            <div class="container">
                <h1><?= $APPLICATION->ShowTitle(true) ?></h1>
            </div>
            <div class="cart-page-nn th">
                <div class="container">
                    <div class="cart-page-nn-inner">
                        <div class="cart-page-nn-tt">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            if (typeof (loadLocalFavs) === 'function') {
                loadLocalFavs();
            } else {
                console.log('No loadLocalFavs function!');
            }
        });
    </script>
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
