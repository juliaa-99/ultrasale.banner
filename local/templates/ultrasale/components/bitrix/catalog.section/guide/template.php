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
<div class="brands-item">
    <div class="brands-item__inner">
        <div class="container">
            <div class="brands-page__holder">
                <h1>Производитель <?= $arResult['NAME'] ?></h1>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <? if (count($arResult['ElementsBySubSection']['instruktsii'])) { ?>
                        <li class="nav-item"><a class="nav-link active" href="#brands-item1" id="brands-item1-tab"
                                                data-toggle="tab" role="tab" aria-controls="brands-item1"
                                                aria-selected="true">Инструкции</a></li>
                    <? } ?>
                    <? if (count($arResult['ElementsBySubSection']['katalogi'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="#brands-item2" id="brands-item2-tab"
                                                data-toggle="tab" role="tab" aria-controls="brands-item2"
                                                aria-selected="true">Каталоги</a></li>
                    <? } ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <? if (count($arResult['ElementsBySubSection']['instruktsii'])) { ?>
                    <div class="tab-pane fade show active" id="brands-item1" role="tabpanel"
                         aria-labelledby="brands-item1-tab">
                        <div class="brands-item__nav">
                            <? foreach ($arResult['ElementsBySubSection']['instruktsii'] as $section) { ?>
                            <div class="brands-item__nav-title"><?= $section['NAME'] ?></div>
                            <div class="brands-item__nav-list">
                                <? foreach ($section['ITEMS'] as $item) { ?>
                                    <a class="brands-item__nav-list-item" href="<?= $item['DETAIL_PAGE_URL'] ?>"><span
                                                class="title"><?= $item['NAME'] ?></span><span
                                                class="icon"><svg><use xlink:href="#link"></use></svg></span></a>
                                <? } ?>
                            </div>
                            <? } ?>
                        </div>
                    </div>
                <? } ?>
                    <? if (count($arResult['ElementsBySubSection']['katalogi'])) { ?>
                        <div class="tab-pane fade" id="brands-item2" role="tabpanel" aria-labelledby="brands-item2-tab">
                            <div class="brands-item__nav">
                                <? foreach ($arResult['ElementsBySubSection']['katalogi'] as $section) { ?>
                                    <div class="brands-item__nav-title"><?= $section['NAME'] ?></div>
                                    <div class="brands-item__nav-list">
                                        <? foreach ($section['ITEMS'] as $item) { ?>
                                            <a class="brands-item__nav-list-item" href="<?= $item['DETAIL_PAGE_URL'] ?>"><span
                                                        class="title"><?= $item['NAME'] ?></span><span
                                                        class="icon"><svg><use xlink:href="#link"></use></svg></span></a>
                                        <? } ?>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>

