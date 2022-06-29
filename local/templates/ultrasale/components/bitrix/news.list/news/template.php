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
<div class="news-page">
    <div class="container">
        <h1><?=$arResult['NAME']?></h1>
        <div class="row">
            <?foreach ($arResult['ITEMS'] as $arItem):?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="news__item"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
                    <div class="news__item-title"><?=$arItem['~NAME']?></div>
                    <div class="news__item-tx"><?=$arItem['PREVIEW_TEXT']?></div>
                    <div class="news__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></div>
                </div>
            </div>
            <?endforeach;?>
        </div>
<?= $arResult['NAV_STRING'] ?>
    </div>
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
    ),$component
); ?>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/about_bits.php",
    array(),
    array("MODE" => "html")
); ?>

