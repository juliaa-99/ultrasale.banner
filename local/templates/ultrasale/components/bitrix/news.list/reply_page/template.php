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
use \Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
Loc::loadMessages(__FILE__);
?>
<div class="certificates-page">
    <div class="container">
        <h1><?= Loc::getMessage("CERT_PAGE_NAME") ?></h1>
        <div class="certificates__inner">
            <?php foreach ($arResult['ITEMS'] as $item) { ?>
                <a class="certificates__item" href="<?= $item['DETAIL_PICTURE']['SRC'] ?>" data-fancybox="sertif"><span><img
                                src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt=""></span></a>
                <?php
            }
            ?>
        </div>
    </div>
</div>
