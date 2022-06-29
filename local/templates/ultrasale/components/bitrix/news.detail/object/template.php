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
    <div class="news-item">
        <div class="news-item__holder">
            <div class="container">
                <div class="news-item__inner">
                    <div class="news-item__text">
                        <div class="news-item__text-tt">
                            <h1><?= $arResult['~NAME'] ?></h1><a class="button button-primary" href="#"
                                                                 data-toggle="modal" data-target="#modalCall"><span>Оставить заявку</span></a>
                        </div>
                        <div class="news-item__instruction">
                            <?php if (!empty($arResult['PROPERTIES']['OBJECT_TYPE']['VALUE'])) { ?>
                                <p><b>Тип объекта:</b> <?= $arResult['PROPERTIES']['OBJECT_TYPE']['~VALUE'] ?></p>
                            <?php } ?>
                            <?php if (!empty($arResult['PROPERTIES']['AREA']['VALUE'])) { ?>
                                <p><b>Площадь:</b> <?= $arResult['PROPERTIES']['AREA']['~VALUE'] ?></p>
                            <?php } ?>
                            <?php if (!empty($arResult['PROPERTIES']['JOBS_DONE']['VALUE']['TEXT'])) { ?>
                                <p><b>Работы:</b> <?= $arResult['PROPERTIES']['JOBS_DONE']['~VALUE']['TEXT'] ?></p>
                            <?php } ?>
                            <?php if (!empty($arResult['PROPERTIES']['EQUIPMENT']['VALUE']['TEXT'])) { ?>
                                <p><b>Оборудование:</b> <?= $arResult['PROPERTIES']['EQUIPMENT']['~VALUE']['TEXT'] ?>
                                </p>
                            <?php } ?>
                            <?php if (!empty($arResult['PROPERTIES']['EQUIPMENT_MISC']['VALUE']['TEXT'])) { ?>
                                <p><b>Оборудование (дополнительное):</b>
                                    <?= $arResult['PROPERTIES']['EQUIPMENT_MISC']['~VALUE']['TEXT'] ?></p>
                            <?php } ?>
                            <?php if (!empty($arResult['PROPERTIES']['ADDRESS']['VALUE'])) { ?>
                                <p><b>Адрес:</b> <?= $arResult['PROPERTIES']['ADDRESS']['VALUE'] ?></p>
                            <?php } ?>
                        </div>
                        <?php if (count($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) { ?>
                            <div class="news-item__slider th js-news-item-slider">
                                <?php foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $arVal) { ?>
                                    <div class="news-item__slider-item">
                                        <a href="<?= $arVal['THUMBNAIL']['src'] ?>" data-fancybox="images">
                                            <div class="news-item__slider-img"
                                                 style="background-image: url('<?= $arVal['THUMBNAIL']['src'] ?>')"></div>
                                            <div class="news-item__slider-tx"><?= $arVal['DESCRIPTION'] ?></div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if (!empty($arResult['PREVIEW_TEXT'])) { ?>
                            <?= $arResult['~PREVIEW_TEXT'] ?>
                        <?php } ?>
                        <?php if (!empty($arResult['PROPERTIES']['TASK']['VALUE'])) { ?>
                            <h4>Задача</h4>
                            <?= $arResult['PROPERTIES']['TASK']['~VALUE']['TEXT'] ?>
                        <?php } ?>
                        <?php if (!empty($arResult['PROPERTIES']['SOLUTION']['VALUE'])) { ?>
                            <h4>Выбор решения</h4>
                            <?= $arResult['PROPERTIES']['SOLUTION']['~VALUE']['TEXT'] ?>
                        <?php } ?>
                        <?php if (!empty($arResult['PROPERTIES']['SPECIALISTS']['VALUE'])) { ?>
                            <h4>Специалисты</h4>
<? /*
                            <ul class="col">
                                <?php foreach ($arResult['PROPERTIES']['SPECIALISTS']['VALUE'] as $item) { ?>
                                    <li><?= $item ?></li>
                                <?php } ?>
                            </ul>
 */ ?>
                            <?= $arResult['PROPERTIES']['SPECIALISTS']['~VALUE']['TEXT'] ?>
                        <?php } ?>
                        <?php if (!empty($arResult['PROPERTIES']['RESULT']['VALUE'])) { ?>
                            <h4>Результат</h4>
                            <?= $arResult['PROPERTIES']['RESULT']['~VALUE']['TEXT'] ?>
                        <?php } ?>
                        <?php if (count($arResult['PROPERTIES']['DONE_PHOTO']['VALUE'])) { ?>
                            <div class="row js-block" data-hide="true" data-amount="4">
                                <?php foreach ($arResult['PROPERTIES']['DONE_PHOTO']['VALUE'] as $item) { ?>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="object__item">
                                            <div class="object__item-img"
                                                 style="background-image: url('<?= $item['THUMBNAIL']['src'] ?>')
                                                         "></div>
                                            <div class="object__item-tx"><?= $item['ORIGINAL']['DESCRIPTION'] ?></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <? if (count($arResult['PROPERTIES']['DONE_PHOTO']['VALUE'])>4) {?>
                        <div class="button-center"><a class="button button-primary" href="#"
                                                      data-rel=".js-block"><span>Показать
                                    еще</span></a></div>
                        <? } ?>
                        <?php if (!empty($arResult['PROPERTIES']['VIDEO_URL']['VALUE'])) { ?>
                            <div class="object__video"><a class="about-main__video-inner"
                                                          href="<?= $arResult['PROPERTIES']['VIDEO_URL']['VALUE'] ?>"
                                                          data-fancybox
                                                          style="background-image: url('<?= $arResult['PROPERTIES']['VIDEO_IMG_PLACEHOLDER']['PREVIEW']['src'] ?>')"></a>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.share",
                        "main",
                        array(
                            "HANDLERS"   => array(
                                "telegram",
                                "wa",
                                "facebook",
                                "vk",
                            ),
                            "PAGE_URL"   => $APPLICATION->GetCurPage(),
                            "PAGE_TITLE" => $APPLICATION->GetTitle(),
                        ),
                        $component
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
