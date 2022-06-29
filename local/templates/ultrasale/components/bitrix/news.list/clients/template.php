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
<div class="clients">
    <div class="container">
        <div class="title-main">
        <h2>Наши <i>клиенты</i></h2>
        </div>
        <div class="clients__inner">
            <?php foreach ($arResult['ITEMS'] as $item) {?>
                <a class="clients__item" href="<?=$item['PROPERTIES']['URL']['VALUE']?>"><img
                    src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>"></a>
            <?php } ?>
        </div>
    </div>
</div>
