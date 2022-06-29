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
<div class="cart-product__content-inner-left tw">
    <div class="cart-product__content-reviews">
        <? if (!empty($arResult['ITEMS'])) { $i = 0?>
            <? foreach ($arResult['ITEMS'] as $reply) { ?>
                <div class="cart-product__content-reviews-item <?=($i >= 3)?'d-none':''?>">
                    <?$i++;?>
                    <div class="cart-product__content-reviews-top">
                        <div class="cart-product__content-reviews-top-left">
                            <div class="rating">
<!--                                --><?//dump($reply);?>
                                <? for ($z = 0; $z < 5; $z++) {
                                    if ($z < $reply['PROPERTIES']['RATE']['VALUE']) { ?>
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/start-act.svg" alt="">
                                    <? } else { ?>
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/start-dis.svg" alt="">
                                    <? } ?>
                                <? } ?>
                            </div>
                            <div class="cart-product__content-reviews-title"><?= $reply['NAME'] ?></div>
                        </div>
                        <div class="cart-product__content-reviews-top-right">
                            <div class="cart-product__content-reviews-data"><?= explode(" ",$reply['TIMESTAMP_X'])[0] ?></div>
                        </div>
                    </div>
                    <div class="cart-product__content-reviews-inner">
                        <p><?= $reply['PREVIEW_TEXT'] ?></p>
                        <? if (!empty($reply['PROPERTIES']['PHOTO']['VALUE'])) { ?>
                            <div class="cart-product__content-reviews-inner-img">
                                <? foreach ($reply['PROPERTIES']['PHOTO']['VALUE'] as $photo) { ?>
                                    <a
                                            class="cart-product__content-reviews-inner-img-item"
                                            href="<?= SITE_TEMPLATE_PATH ?>/assets/images/rev-img1.jpg"
                                            data-fancybox="gallery-rev1"><img
                                                src="<?=CFile::GetPath($photo);?>"
                                                alt=""></a>
                                <? } ?>
                            </div>
                        <? } ?>
                    </div>
                </div>
            <? } ?>
            <a class="cart-product__content-reviews-btn js-open-all-reviws"
               ><span>Показать больше</span>
                <svg>
                    <use xlink:href="#arrow3"></use>
                </svg>
            </a>
        <? } else {?>
            <p>Ваш отзыв будет первым!</p>
        <? } ?>
    </div>
    <div class="cart-product__content-inner-right">
        <div class="delivery-page__call">
            <div class="delivery-page__call-tt">Есть впечатления о товаре?</div>
            <a class="delivery-page__call-title" href="#" data-toggle="modal"
               data-target="#modalReviews1"
               data-id="<?= $arParams['EXT_WARE_ID'] ?>">Поделитесь с нами</a>
        </div>
    </div>
</div>
