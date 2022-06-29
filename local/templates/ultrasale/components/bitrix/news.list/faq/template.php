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
<div class="faq">
    <div class="faq__holder">
        <div class="container">
            <h1><?= $arResult['NAME'] ?></h1>
            <div class="faq__inner">
                <div class="accordion" id="accordionExample">
                    <? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
                        <div class="card">
                            <div class="card-header" id="headingInformation<?= $i ?>">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseInformation<?= $i ?>" aria-expanded="<?=$i === 0 ? 'false':'false'?>"
                                        aria-controls="collapseInformation<?= $i ?>">
                                    <span class="card-header-title"><?=$arItem['NAME']?></span><span
                                            class="card-header-plus"></span></button>
                            </div>
                            <div class="collapse <?=$i === 0 ? '':''?>" id="collapseInformation<?= $i ?>"
                                 aria-labelledby="headingInformation<?= $i ?>">
                                <div class="card-body">
                                    <p>
                                        <?=$arItem['PREVIEW_TEXT']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
<!--            --><?//= $arResult['NAV_STRING'] ?>
        </div>
    </div>
</div>