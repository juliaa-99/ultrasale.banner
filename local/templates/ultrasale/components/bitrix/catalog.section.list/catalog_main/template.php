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
    <div class="catalog-equipment" style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/assets/images/bg1.png')">
    <div class="container">
        <h2>Каталог оборудования</h2>
        <div class="row">
            <? foreach ($arResult['SECTIONS'] as $section) { ?>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <a class="catalog-equipment__item <?= $section['Class']['a'] ?>" href="<?= $section['SECTION_PAGE_URL'] ?>">
                        <span class="catalog-equipment__item-title"><?= $section["NAME"] ?></span>
                        <span class="catalog-equipment__item-arrow">
                            <svg><use xlink:href="#arrow2"></use></svg></span>
                        <span class="catalog-equipment__item-img"><img src="<?= $section['PICTURE']['SRC'] ?>"
                                                                    alt=""></span></a>
                </div>
            <? } ?>
        </div>
        <div class="button-center"><a class="button button-primary" href="/catalog/"><span>Все
                    категории</span></a></div>
    </div>
</div>

<?php
/*
 * <div class="catalog-equipment" style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/assets/images/bg1.png')">
        <div class="container">
            <h2>Каталог оборудования</h2>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6"><a class="catalog-equipment__item" href="#"><span
                                class="catalog-equipment__item-title">Кондиционеры</span><span
                                class="catalog-equipment__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span><span
                                class="catalog-equipment__item-img"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/images/equipment-img1.png" alt=""></span></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6"><a class="catalog-equipment__item" href="#"><span
                                class="catalog-equipment__item-title">Водонагреватели</span><span
                                class="catalog-equipment__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span><span
                                class="catalog-equipment__item-img"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/images/equipment-img2.png" alt=""></span></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6"><a class="catalog-equipment__item" href="#"><span
                                class="catalog-equipment__item-title">Котлы отопления</span><span
                                class="catalog-equipment__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span><span
                                class="catalog-equipment__item-img"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/images/equipment-img3.png" alt=""></span></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6"><a class="catalog-equipment__item" href="#"><span
                                class="catalog-equipment__item-title">Обогреватели</span><span
                                class="catalog-equipment__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span><span
                                class="catalog-equipment__item-img"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/images/equipment-img4.png" alt=""></span></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6"><a class="catalog-equipment__item" href="#"><span
                                class="catalog-equipment__item-title">Тепловые завесы</span><span
                                class="catalog-equipment__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span><span
                                class="catalog-equipment__item-img"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/images/equipment-img5.png" alt=""></span></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6"><a class="catalog-equipment__item" href="#"><span
                                class="catalog-equipment__item-title">Тепловентиляторы</span><span
                                class="catalog-equipment__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span><span
                                class="catalog-equipment__item-img"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/images/equipment-img6.png" alt=""></span></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6"><a class="catalog-equipment__item" href="#"><span
                                class="catalog-equipment__item-title">Увлажнители<br> воздуха</span><span
                                class="catalog-equipment__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span><span
                                class="catalog-equipment__item-img"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/images/equipment-img7.png" alt=""></span></a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6"><a class="catalog-equipment__item" href="#"><span
                                class="catalog-equipment__item-title">Tепловые пушки</span><span
                                class="catalog-equipment__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span><span
                                class="catalog-equipment__item-img"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/assets/images/equipment-img8.png" alt=""></span></a>
                </div>
            </div>
            <div class="button-center"><a class="button button-primary" href="#"><span>Все категории</span></a></div>
        </div>
    </div>
 */