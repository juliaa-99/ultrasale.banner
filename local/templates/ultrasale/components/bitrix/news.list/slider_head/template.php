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
<div class="banner">
    <div class="banner__slider js-banner-slider">
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
            <div class="banner__slider-item">
                <div class="banner__slider-img"
                     style="background-image: url('<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>')"></div>
                <div class="banner__slider-img-mob"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/banner-mob.png"
                                                         alt=""></div>
                <div class="container">
                    <div class="banner__slider-inner">
                        <div class="banner__slider-title"><?= $arItem['~NAME'] ?></div>
                        <div class="banner__slider-tx"><?= $arItem['~PREVIEW_TEXT'] ?></div>
                        <? if (!empty($arItem['PROPERTIES']['URL']['VALUE'])): ?>
                            <a class="button button-primary" href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>"><span>Узнать больше</span></a>
                        <? endif; ?>
                        <a class="button button-ar" href="#" data-toggle="modal" data-target="#modalApp">
                            <span>Оставить заявку</span></a>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>

