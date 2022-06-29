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
        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "",
            array("START_FROM" => "0")
        );
        ?>
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
                                        <div class="news-item__slider-img"
                                             style="background-image: url('<?= $arVal['THUMBNAIL']['src'] ?>')"></div>
                                        <div class="news-item__slider-tx"><?= $arVal['DESCRIPTION'] ?></div>
                                    </div>
                                <?php } ?>
                            </div>
                        <? } ?>
                        <?=$arResult['~DETAIL_TEXT']?>
                        <div class="button-center"><a class="button button-primary" href="#"><span>Показать еще</span></a></div>
                    </div>
                    <?
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
