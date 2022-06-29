<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<?php
/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 11.11.2021
 */

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

$this->setFrameMode(false);

?>
        <div class="row">
            <? foreach ($arResult['SECTIONS'] as $section) { ?>
                <div class="<?= $section['Class']['div'] ?>"><a
                            class="services__item <?= $section['Class']['a'] ?>"
                            href="<?= $section['SECTION_PAGE_URL'] ?>"><span
                                class="services__item-inner"><span
                                    class="services__item-title"><?= $section["NAME"] ?></span>
                                        <? if (count($section['Children'])) { ?>
                                            <object>
                                                <ul class="services__item-list">
                                                        <? foreach ($section['Children'] as $child) { ?>
                                                            <li><a href="<?= $child['SECTION_PAGE_URL'] ?>"><?= $child['NAME'] ?></a></li>
                                                        <? } ?>
                                                </ul>
                                            </object>
                                        <? } ?>
                                        <span
                                                class="services__item-icon"><svg><use
                                                        xlink:href="#arrow2"></use></svg></span><span
                                    class="services__item-img"><img src="<?= $section['PICTURE']['SRC'] ?>"
                                                                    alt=""></span></span></a></div>
            <? } ?>
        </div>