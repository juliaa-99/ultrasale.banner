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
    <div class="certificates <?=$arParams['OWN']['BG']?> tw">
        <div class="container">
            <div class="title-main">
                <h2>Свидетельства и <i>сертификаты</i></h2><a class="title-main__link" href="/certificate/">
                    Смотреть все
                    <svg>
                        <use xlink:href="#arrow2"></use>
                    </svg>
                </a>
            </div>
            <div class="certificates__inner certificates__slider js-certificates-slider">
                <? foreach ($arResult['ITEMS'] as $item) { ?>
                    <a class="certificates__item"
                       href="<?=$item['DETAIL_PICTURE']['SRC']?>"
                       data-fancybox="sertif"><span><img
                                    src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt=""></span></a>
                    <?
                }
                ?></div>
            <div class="certificates__btn-mob button-center">
                <a href="/certificate/" class="button button-primary"><span>Смотреть все</span></a>
            </div>
        </div>
    </div>
