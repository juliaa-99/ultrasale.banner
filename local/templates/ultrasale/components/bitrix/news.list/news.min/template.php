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
<div class="news-main">
    <div class="container">
        <div class="title-main">
            <h2>Читайте также</h2>
            <a class="title-main__link" href="<?=SITE_DIR?>news/">
                Смотреть все<svg><use xlink:href="#arrow2"></use></svg></a>
        </div>
        <div class="row">
            <?foreach ($arResult['ITEMS'] as $i => $arItem):?>
            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
                <div class="news__item"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
                    <div class="news__item-title"><?=$arItem['NAME']?></div>
                    <div class="news__item-tx"><?=$arItem['PREVIEW_TEXT']?></div>
                    <div class="news__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></div>
                </div>
            </div>
            <? if ($i === 2) break;
            endforeach;?>
        </div>
    </div>
</div>