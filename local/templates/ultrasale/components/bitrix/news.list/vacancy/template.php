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
$isFirst = true;
?>
<div class="vacancies-list">
    <h4>Вакансии</h4>
    <div class="accordion" id="accordionExample">
        <?php foreach ($arResult['ITEMS'] as $item) {?>
        <div class="card">
            <div class="card-header" id="<?=$item['CODE']?>">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseInformation<?=$item['ID']?>"
                        aria-expanded="<?=($isFirst)?'true':'false'?>"
                        aria-controls="collapseInformation<?=$item['ID']?>"><span
                            class="card-header-title"><?=$item['NAME']?></span><span
                            class="card-header-plus"></span></button>
            </div>
            <div class="collapse <?=($isFirst)?'show':''?>" id="collapseInformation<?=$item['ID']?>"
                 aria-labelledby="<?=$item['CODE']?>">
                <div class="card-body">
                    <div class="vacancies-list__inner">
                        <?php
                        if (count($item['PROPERTIES']['RESPONSIBILITIES']['VALUE'])) { ?>
                        <div class="vacancies-list__row">
                            <div class="vacancies-list__left">Обязанности</div>
                            <div class="vacancies-list__right">
                                <ul>
                                    <?php foreach ($item['PROPERTIES']['RESPONSIBILITIES']['VALUE'] as $line) { ?>
                                    <li><?=$line?></li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                        <? } ?>
                        <?php
                        if (count($item['PROPERTIES']['REQUIREMENTS']['VALUE'])) { ?>
                            <div class="vacancies-list__row">
                                <div class="vacancies-list__left">Требования</div>
                                <div class="vacancies-list__right">
                                    <ul>
                                        <?php foreach ($item['PROPERTIES']['REQUIREMENTS']['VALUE'] as $line) { ?>
                                            <li><?=$line?></li>
                                        <? } ?>
                                    </ul>
                                </div>
                            </div>
                        <? } ?>
                        <?php
                        if (count($item['PROPERTIES']['CONDITIONS']['VALUE'])) { ?>
                            <div class="vacancies-list__row">
                                <div class="vacancies-list__left">Условия</div>
                                <div class="vacancies-list__right">
                                    <ul>
                                        <?php foreach ($item['PROPERTIES']['CONDITIONS']['VALUE'] as $line) { ?>
                                            <li><?=$line?></li>
                                        <? } ?>
                                    </ul>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
            <?php $isFirst = false; ?>
        <?php } ?>
    </div>
</div>
