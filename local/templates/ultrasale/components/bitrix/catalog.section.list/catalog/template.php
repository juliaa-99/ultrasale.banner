<?php
/**
 *
 */
/** @var array $arResult */

$this->setFrameMode(true);
?>
<div class="catalog-equipment-page">
    <div class="catalog-equipment-page__inner">

        <h1>Каталог оборудования</h1>
        <div class="row">
            <?
            foreach ($arResult['SECTIONS'] as $section) { ?>
                <div class="<?=$section['Class']['div']?>"><a class="catalog-equipment__item" href="<?= $section['SECTION_PAGE_URL'] ?>"><span
                                class="catalog-equipment__item-title"><?= $section['NAME'] ?></span><span
                                class="catalog-equipment__item-arrow"><svg><use
                                        xlink:href="#arrow2"></use></svg></span><span
                                class="catalog-equipment__item-img"><img src="<?= $section['PICTURE']['SAFE_SRC'] ?>"
                                                                         alt=""></span></a></div>

            <? } ?>
        </div>
    </div>

</div>
